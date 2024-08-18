$(document).ready(function () {
    // Ketika checkbox diubah (dicentang atau tidak)
    $("#burger").change(function () {
        if (this.checked) {
            $(".divSidebar").css({
                transform: "translateX(-10px)",
            });
            // Atur timeout selama 5 detik (5000 ms)
            timeoutId = setTimeout(function () {
                $(".divSidebar").css({
                    transform: "translateX(250px)",
                });
                $("#burger").prop("checked", false);
            }, 4000);
        } else {
            clearTimeout(timeoutId);
            $(".divSidebar").css({
                transform: "translateX(250px)",
            });
        }
    });
});
