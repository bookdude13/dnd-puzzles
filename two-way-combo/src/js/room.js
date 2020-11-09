
$(document).ready(function() {
    function setPuzzle( html ) {
        let container = $("#puzzle-container");
        if ( html !== container.html() ) {
            container.html(html);
        }
    }

    function updatePuzzle() {
        let errorHandler = (message) => {
            console.error("Failed to update puzzle:");
            console.error(message);
        };

        let successHandler = (data) => {
            let puzzleHtml = data["html"];
            setPuzzle(puzzleHtml);
        }

        let currentUrl = window.location.href;
        let getPuzzleUrl = currentUrl.replace("room.php", "get_puzzle.php");
        doAjaxGet( getPuzzleUrl, {}, successHandler, errorHandler );
    }

    updatePuzzle();
    setInterval(updatePuzzle, 100);

    $("#puzzle-container").on('click', '.btn-rotate-left', {}, function() {
        let parent = $(this).parents("div.gem-wheel-container").first();
        let wheelIndex = parent.data("index");
        rotateWheel( wheelIndex, "left" );
    });

    $("#puzzle-container").on('click', '.btn-rotate-right', {}, function() {
        let parent = $(this).parents("div.gem-wheel-container").first();
        let wheelIndex = parent.data("index");
        rotateWheel( wheelIndex, "right" );
    });

    function rotateWheel( wheel_index, direction ) {
        let errorHandler = (message) => {
            console.error("Failed to update room state:");
            console.error(message);
        };

        let successHandler = (data) => {
        }

        let updateData = {
            "update": {
                "wheel_index": wheel_index,
                "direction": direction    
            }
        };

        let currentUrl = window.location.href;
        let updateUrl = currentUrl.replace("room.php", "update_puzzle.php");
        doAjaxPost( updateUrl, updateData, successHandler, errorHandler );
    }
});
