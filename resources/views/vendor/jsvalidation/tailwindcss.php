<script type="module">
    jQuery(document).ready(function () {

        let btnText = $("<?= $validator['selector']; ?>").find(':submit').text();

        $("<?= $validator['selector']; ?>").on('submit', function () {
            //$("<?php //= $validator['selector']; ?>//").find(':submit').html(btnText.replace("Remove", ""));
            $("<?= $validator['selector']; ?>").find(':submit').prop('disabled', true);
            //$("<?php //= $validator['selector']; ?>//").find(':submit').prepend('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 pr-1"></i>');
            //tailwind.svgLoader()
            //helper.delay(1500)
        });

        $("<?= $validator['selector']; ?>").each(function () {

            $(this).validate({
                errorElement: 'div',
                errorClass: 'text-danger mt-2',

                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length ||
                        element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                        error.insertAfter(element.parent());
                        // else just place the validation message immediately after the input
                    } else if (element.parent('.relative'.length)) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element) {
                    $(element).removeClass('border-slate-200').removeClass('border-gray-300').removeClass('border-success').addClass('border-danger'); // add the Bootstrap error class to the control group
                    parent = $(element).parent();
                    parent.find('label.form-label').removeClass('text-success').addClass('text-danger');
                },
                
                <?php if (isset($validator['ignore']) && is_string($validator['ignore'])): ?>

                ignore: "<?= $validator['ignore']; ?>",
                <?php endif; ?>

                // Uncomment this to mark as validated non required fields
                unhighlight: function (element) {
                    $(element).removeClass('border-slate-200').removeClass('border-gray-300').removeClass('border-danger').addClass('border-success');
                    parent = $(element).parent();
                    parent.find('label.form-label').removeClass('text-danger').addClass('text-success');
                },

                success: function (element) {
                    $(element).removeClass('border-slate-200').removeClass('border-gray-300').removeClass('border-danger').addClass('border-success'); // remove the Boostrap error class from the control group
                    parent = $(element).parent();
                    // parent.find('label.form-label').removeClass('text-danger').addClass('text-success');
                },

                focusInvalid: true,
                <?php if (Config::get('jsvalidation.focus_on_error')): ?>
                invalidHandler: function (form, validator) {
                    if (!validator.numberOfInvalids()) {
                        return;
                    }

                    // Enable submit button again (necessary for invalid remote validation).
                    //$("<?php //= $validator['selector']; ?>//").find(':submit').html(btnText.replace("Remove", ""));
                    $("<?= $validator['selector']; ?>").find(':submit').prop('disabled', false);
                },
                <?php endif; ?>

                rules: <?= json_encode($validator['rules']); ?>
            });
        });
    });
</script>
