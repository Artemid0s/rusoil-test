function addRemoveFormGroup() {
    const addFormGroup = $(".row-controls .add");
    const removeFormGroup = $(".row-controls .remove");
    const formGroup = $(".form-group");
    const insertion = '<div class="row form-group wo-padding">'
        + formGroup.html()
        + '</div>';

    addFormGroup.click(function () {
        $(formGroup).after(insertion);

        $(".row-controls")[1].remove();
    });

    removeFormGroup.click(function () {
        if ($(".form-group").length > 1) {
            $(".form-group").last().remove();
        }
    });
}

function submitForm() {
    const form = $(".order_form");

    form.submit(function (e) {
        e.preventDefault();

        let formData = new FormData(form[0]);

        $(".spinner-overlay").addClass("show");
        $(".spinner-border").addClass("show");

        BX.ajax.runComponentAction(
            "artemy:email-order_form",
            "sendMail",
            {
                mode: "class",
                data: formData
            })
            .then(function (response) {
                    $("form").addClass("hide");
                    $(".success").addClass("show");
                    $(".spinner-overlay").removeClass("show");
                    $(".spinner-border").removeClass("show");
                },
                function(response) {
                    $(".error-message").text(response.data.message);

                    $(".spinner-overlay").removeClass("show");
                    $(".spinner-border").removeClass("show");
                }
            );
    });
}

$(function () {
    addRemoveFormGroup();
    submitForm();
})
