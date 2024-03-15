<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <title>KTA - PPAL</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.4/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link
        href="{{ asset('assets/img/logo.png') }}"
        rel="shortcut icon"
    >
</head>

<body class="bg-gray-100">

    <div class="bg-gray-100 min-h-screen flex items-center justify-center py-1">
        <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="PPAL"></a>
    </div>
    <div class="bg-gray-100 min-h-screen flex items-center justify-center py-4">

        <div class="max-w-4xl w-full bg-white p-8 rounded-lg shadow-md" id="formContainer">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div id="formTop">
                    <!-- Post Content Section -->

                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 gap-y-3">
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                                <div>
                                    <input type="text" id="full_name" name="full_name" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Nama Lengkap"></input>
                                </div>
                            </div>
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Tempat, Tanggal Lahir</label>
                                <div>
                                    <input type="text" id="ttl" name="ttl" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Tempat, Tanggal Lahir"></input>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 gap-y-3">
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Agama</label>
                                <div>
                                    <input type="text" id="agama" name="agama" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Agama"></input>
                                </div>
                            </div>
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Golongan Darah</label>
                                <div>
                                    <select id="gol_darah" name="gol_darah" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500">
                                        <option>----Golongan Darah----</option>
                                        <option value="-">Tidak Ada</option>
                                        <option value="A">A</option>
                                        <option value="A+">A+</option>
                                        <option value="B">B</option>
                                        <option value="B+">B+</option>
                                        <option value="AB">AB</option>
                                        <option value="AB+">AB+</option>
                                        <option value="O">O</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 gap-y-3">
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Pangkat Terakhir</label>
                                <div>
                                    <input type="text" id="pangkat_terakhir" name="pangkat_terakhir" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Pangkat Terakhir"></input>
                                </div>
                            </div>
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Nomor Induk Kependudukan (NIK)</label>
                                <div>
                                    <input type="text" id="nik" name="nik" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Nomor Induk Kependudukan (NIK)"></input>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="grid grid-cols-1 gap-4 gap-y-3">
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Tanda Jasa Tertinggi</label>
                                <div>
                                    <input type="text" id="tanda_jasa_tertinggi" name="tanda_jasa_tertinggi" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Tanda Jasa Tertinggi"></input>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden" id="formBottom">
                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 gap-y-3">
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Istri / Suami</label>
                                <div>
                                    <select id="istri_suami" name="istri_suami" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500">
                                        <option>----Istri/Suami----</option>
                                        <option value="Istri">Istri</option>
                                        <option value="Suami">Suami</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Nama Istri / Suami</label>
                                <div>
                                    <input type="text" id="nama_istri_suami" name="nama_istri_suami" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Nama Istri / Suami"></input>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 gap-y-3">
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">NIK Istri/Suami</label>
                                <div>
                                    <input type="text" id="nik_istri_suami" name="nik_istri_suami" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan NIK Istri/Suami"></input>
                                </div>
                            </div>
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Wilayah/Rayon</label>
                                <div>
                                    <input type="text" id="wil_rayon" name="wil_rayon" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Wilayah/Rayon"></input>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 gap-y-3">
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Alamat 1</label>
                                <div>
                                    <input type="text" id="alamat1" name="alamat1" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Alamat 1"></input>
                                </div>
                            </div>
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Alamat 2</label>
                                <div>
                                    <input type="text" id="alamat2" name="alamat2" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Alamat 2"></input>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2 mb-6">
                            Submit <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                                id="send" fill="#fff">
                                <path fill="none" d="M0 0h24v24H0V0z"></path>
                                <path
                                    d="M3.4 20.4l17.45-7.48c.81-.35.81-1.49 0-1.84L3.4 3.6c-.66-.29-1.39.2-1.39.91L2 9.12c0 .5.37.93.87.99L17 12 2.87 13.88c-.5.07-.87.5-.87 1l.01 4.61c0 .71.73 1.2 1.39.91z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
            <div class="flex items-center justify-center">
                <button type="button" id="expandButton" class="flex justify-center items-center bg-gray-400 hover:bg-gray-500 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2">
                    <span id="toggleButtonText">Buka Form</span>
                    <svg id="expandIconDown" class="w-4 h-4 ml-2 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <svg id="expandIconUp" class="w-4 h-4 ml-2 transform transition-transform duration-300 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                </button>
            </div>
        </div>

    </div>

    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        const formTop = document.getElementById('formTop');
        const formBottom = document.getElementById('formBottom');
        const expandButton = document.getElementById('expandButton');
        const expandIconDown = document.getElementById('expandIconDown');
        const expandIconUp = document.getElementById('expandIconUp');
        const toggleButtonText = document.getElementById('toggleButtonText');

        expandButton.addEventListener('click', function () {
            if (formBottom.classList.contains('hidden')) {
                formBottom.classList.remove('hidden');
                formBottom.classList.add('block');
                formBottom.classList.add('opacity-100');
                formBottom.classList.remove('opacity-0');
                expandIconDown.classList.add('hidden');
                expandIconUp.classList.remove('hidden');
                toggleButtonText.textContent = 'Tutup Form';
            } else {
                formBottom.classList.remove('block');
                formBottom.classList.remove('opacity-100');
                formBottom.classList.add('opacity-0');
                formBottom.classList.add('hidden');
                expandIconDown.classList.remove('hidden');
                expandIconUp.classList.add('hidden');
                toggleButtonText.textContent = 'Buka Form';
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            axios.post('{{ route('landing.store') }}', formData)
                .then(function (response) {
                    // Jika validasi berhasil
                    alert("Data KTA berhasil dikirim!");
                    form.reset();
                    // Lakukan aksi sesuai kebutuhan, contoh: form.submit();
                })
                .catch(function (error) {
                    // Jika terjadi kesalahan validasi
                    if (error.response.status === 422) {
                        let errors = error.response.data.errors;
                        // Tampilkan pesan kesalahan validasi
                        Object.keys(errors).forEach(function (key) {
                            let errorMessage = errors[key][0];
                            let inputField = document.querySelector('#' + key);
                            let errorElement = inputField.nextElementSibling;
                            if (errorElement && errorElement.classList.contains('text-red-500')) {
                                errorElement.textContent = errorMessage;
                            } else {
                                inputField.insertAdjacentHTML('afterend', '<p class="text-red-500 text-sm">' + errorMessage + '</p>');
                            }
                        });
                    }
                });
        });

        // Hilangkan pesan validasi saat input menerima fokus
        form.querySelectorAll('input, select, textarea').forEach(function(input) {
            input.addEventListener('focus', function() {
                let errorElement = this.nextElementSibling;
                if (errorElement && errorElement.classList.contains('text-red-500')) {
                    errorElement.remove();
                }
            });
        });
    });
    </script>

    <!-- BEGIN: Validation Javascript-->
    {{-- <script type="module" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\BacklogRequest') !!} --}}
    <!-- END: Validation Javascript-->

</body>

</html>
