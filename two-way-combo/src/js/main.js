
$(document).ready(function() {
    /* Main Menu */
    $("#btn-generate-rooms").click(function() {
        console.log(window.location);
        let baseUrl = window.location.href;
        let generateUrl = baseUrl + 'generate.php';
        console.log(generateUrl);

        $.ajax({
            method: "POST",
            url: generateUrl,
            data: {},
            dataType: "json",
            timeout: 2000,
            success: function(data, textStatus, jqXHR) {
                console.log("success");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Failed to generate rooms");
            }
        })
    });

    /* Room */
    $(".btn-rotate-left").click(function() {
        let index = $(this).data('index');
    });

    $(".btn-rotate-right").click(function() {
        console.log("right");
    });
});
