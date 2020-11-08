
$(document).ready(function() {
    /* Utility */
    function doAjaxPost( url, data, onSuccess, onError ) {
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

    function updateMessage(color, message) {
        let messageElement = $("#message");
        messageElement.css('color', color);
        messageElement.text(message);
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
            setRoomLink("#room-a-link", urlRoomA);

            let idRoomB = encodeURIComponent( rooms["B"] );
            let urlRoomB = window.location.href + "room.php?rid=" + idRoomB;
            setRoomLink("#room-b-link", urlRoomB);
        };

        doAjaxPost( generateUrl, {}, successHandler, errorHandler );
    });

    $("#btn-clear-rooms").click(function() {
        let baseUrl = window.location.href;
        let generateUrl = baseUrl + 'clear_rooms.php';

        let errorHandler = (message) => {
            console.error("Failed to clear rooms: " + message);
            updateMessage("red", "Failed to clear rooms.");
        };

        let successHandler = (data) => {
            updateMessage("black", "Cleared rooms.");
            setRoomLink("#room-a-link", "");
            setRoomLink("#room-b-link", "");
        };

        doAjaxPost( generateUrl, {}, successHandler, errorHandler );
    });

    function setRoomLink(id, url) {
        $(id).html("<a target=\"_blank\" href=\"" + url + "\">" + url + "</a>");
    }

    /* Room */
    $(".btn-rotate-left").click(function() {
        let index = $(this).data('index');
    });

    $(".btn-rotate-right").click(function() {
        console.log("right");
    });
});
