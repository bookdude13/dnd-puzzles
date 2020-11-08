
$(document).ready(function() {
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
});
