(function () {
    var sendFormBtn = window.document.querySelector("#handbook-discount-form-btn");
    sendFormBtn.addEventListener("click", function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            async: true,
            url: "/send2.php",
            data: $("form[name='HANDBOOK_DISCOUNT_FORM']").serialize(),
            success: function (data) {
                title = "Уважаемый пользователь!";
                text = data;
                fillModalWindow(title, text);
                $.fancybox.open({
                    href: "#modal-window",
                    type: "inline"
                });
            },
            complete: function (jqXHR, textStatus) {
                console.warn(jqXHR);
                console.warn(textStatus);
            }
        });
    });

    function fillModalWindow(title, text) {
        $(".modal-window__title").html(title);
        $(".modal-window__text").html(text);
    }
})();
