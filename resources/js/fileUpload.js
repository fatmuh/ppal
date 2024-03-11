class FileUpload {
    elements;

    constructor() {
        this.elements = document.querySelectorAll(`.form-upload[type=file]`);

        // Wrapping input
        this.elements.forEach(elm => {
            var defaultPreview = elm.dataset.defaultpreview || '';
            console.log(defaultPreview);
            elm.className = 'w-full border border-gray-300 rounded file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:bg-violet-50 hover:file:bg-violet-100';
            elm.outerHTML = `
        <div class="form-upload w-full">
        ${elm.outerHTML}
        <img src="${defaultPreview}" class="w-full p-2 mx-auto" style="max-width: 300px; display: none;"/> <!-- Menambahkan style="display: none;" -->
        <button class="form-upload__remove hidden rounded-lg bg-violet-50 px-4 py-2 mx-auto" style="display: none;">Remove</button> <!-- Menambahkan style="display: none;" -->
        </div>`;
        })

        // Action
        document.querySelectorAll('.form-upload').forEach((formUpload, i) => {
            var input = formUpload.querySelector('input');
            var isPreview = input.dataset.imagepreview;
            var preview = formUpload.querySelector('img');
            var buttonRemove = formUpload.querySelector('.form-upload__remove');

            function changePreview(input) {
                const [file] = input?.files || []
                if (file && isPreview) {
                    preview.src = URL.createObjectURL(file);
                    // Tampilkan elemen gambar dan tombol hapus jika ada file yang dipilih
                    preview.style.display = 'block';
                    buttonRemove.style.display = 'block';
                } else {
                    preview.src = '';
                    // Sembunyikan elemen gambar dan tombol hapus jika tidak ada file yang dipilih
                    preview.style.display = 'none';
                    buttonRemove.style.display = 'none';
                }
            }

            buttonRemove.onclick = (e) => {
                e.preventDefault();
                input.value = '';
                changePreview(null);
            }

            input.onchange = () => {
                changePreview(input);
            }
        })
    }
}

window.FileUpload = FileUpload;

(() => {
    new FileUpload('.form-upload');
})()
