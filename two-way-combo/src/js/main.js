
$(document).ready(function() {
    /* Utility */
    function doAjaxPost( url, data, onSuccess, onFailure ) {
        $.ajax({
            method: "POST",
            url: url,
            data: data,
            dataType: "json",
            timeout: 2000,
            success: function(res, textStatus, jqXHR) {
                if (res.success !== true) {
                    onError(JSON.stringify(res.errors));
                } else {
                    onSuccess(res.data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                onError(errorThrown);
            }
        });
    }

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
            $("#room-a-link").html("<a target=\"_blank\" href=\"" + urlRoomA + "\">" + urlRoomA + "</a>");

            let idRoomB = encodeURIComponent( rooms["B"] );
            let urlRoomB = window.location.href + "room.php?rid=" + idRoomB;
            $("#room-b-link").html("<a target=\"_blank\" href=\"" + urlRoomB + "\">" + urlRoomB + "</a>");
        };

        doAjaxPost( generateUrl, {}, successHandler, errorHandler );
    });

    /* Room */
    $(".btn-rotate-left").click(function() {
        let index = $(this).data('index');
    });

    $(".btn-rotate-right").click(function() {
        console.log("right");
    });
});
