
$(document).ready(function() {
    function getInitialRooms() {
        let baseUrl = window.location.href;
        let getRoomsUrl = baseUrl + 'get_room_pairs.php';

        let errorHandler = (message) => {
            console.error("Failed to retrieve rooms: " + message);
        };

        let successHandler = (data) => {
            let roomPairs = data["room_pairs"];
            console.debug(roomPairs.length + " room pairs loaded");
            for (var i = 0; i < roomPairs.length; i++) {
                let roomPair = roomPairs[i];
                let urlRoomA = window.location.href + "room.php?rid=" + roomPair["room_id_a"];
                let urlRoomB = window.location.href + "room.php?rid=" + roomPair["room_id_b"];
                addRoomLinks(urlRoomA, urlRoomB);
            }

            updateMessage("black", "Loaded rooms.");
        };

        doAjaxGet( getRoomsUrl, {}, successHandler, errorHandler );
    }

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
            let idRoomB = encodeURIComponent( rooms["B"] );
            let urlRoomB = window.location.href + "room.php?rid=" + idRoomB;
            addRoomLinks(urlRoomA, urlRoomB);

            updateMessage("black", "Generated rooms.");
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
            $roomContainer = $("#room-container");
            $roomContainer.html("");
        };

        doAjaxPost( generateUrl, {}, successHandler, errorHandler );
    });

    function addRoomLinks(urlA, urlB) {
        $roomContainer = $("#room-container");
        $roomContainer.append( getRoomsHtml(urlA, urlB) );
    }

    function getRoomsHtml(urlA, urlB) {
        var html = "";
        html += "<div class=\"row\">";
        html += "    <div class=\"u-full-width\">";
        html += "        <span>Room A: </span><a target=\"_blank\" href=\"" + urlA + "\">" + urlA + "</a><br>";
        html += "        <span>Room B: </span><a target=\"_blank\" href=\"" + urlB + "\">" + urlB + "</a><br>";
        html += "    </div>";
        html += "</div>";
        html += "<br />";
        return html;
    }

    // Initialization
    getInitialRooms();
});
