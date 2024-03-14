import "./tabulator";

(function () {
    "use strict";

    $(document).on('click', '.btn-users-edit', function (e) {
        e.preventDefault();

        formReset("PATCH", $(this).data('form-url'));

        const url = $(this).data('url');

        axios.get(url).then((res) => {
            const data = res.data.data;

            $("input#name").val(data.name);
            $("input#email").val(data.email);
            $('#password-column').addClass('hidden');
            $('#email-column').removeClass('md:col-span-6');

        }).catch((err) => {
            console.error(err);
            alert(err);
        }).finally(() => {
            createIcons({
                icons,
                "stroke-width": 1.5,
                nameAttr: "data-lucide",
            });

            const el = document.querySelector("#form-users-modal");
            const modal = window.tailwind.Modal.getOrCreateInstance(el);
            modal.toggle();
        });
    });

    $(".btn-users-add").on('click', function (e) {
        e.preventDefault();

        $('#password-column').removeClass('hidden');
        $('#email-column').addClass('md:col-span-6');
        formReset("POST", $(this).data('form-url'));

        const el = document.querySelector("#form-users-modal");
        const modal = window.tailwind.Modal.getOrCreateInstance(el);
        modal.toggle();
    });

    function formReset(method = 'POST', url) {
        const form = $("form#form-users");
        form[0].reset();

        form.find("input[name=\"_method\"]").val(method);
        form.attr("action", url);
    }
})();
