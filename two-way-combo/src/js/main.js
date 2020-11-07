
$(document).ready(function() {
    /* Main Menu */
    $("#btn-generate-rooms").click(function() {
        let baseUrl = window.location.href;
        let generateUrl = baseUrl + 'generate.php';

        let errorHandler = (message) => {
            console.error("Failed to generate rooms: " + message);
        };

        let successHandler = (data) => {
            let rooms = data["rooms"];
            let idRoomA = encodeURIComponent( rooms["A"] );
            let urlRoomA = window.location.href + "room.php?rid=" + idRoomA;
            $("#room-a-link").text(urlRoomA);

            let idRoomB = encodeURIComponent( rooms["B"] );
            let urlRoomB = window.location.href + "room.php?rid=" + idRoomB;
            $("#room-b-link").text(urlRoomB);
        };

        $.ajax({
            method: "POST",
            url: generateUrl,
            data: {},
            dataType: "json",
            timeout: 2000,
            success: function(res, textStatus, jqXHR) {
                if (res.success !== true) {
                    errorHandler(JSON.stringify(res.errors));
                } else {
                    successHandler(res.data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                errorHandler(errorThrown);
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
