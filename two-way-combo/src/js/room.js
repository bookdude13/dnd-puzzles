
$(document).ready(function() {
    function setPuzzle( html ) {
        $("#puzzle-container").html(html);
    }

    function getRoomId() {
        let currentUrl = new URL(document.location);
        let params = currentUrl.searchParams;
        return params.get("rid");
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
    setInterval(updatePuzzle, 1000);

    $(".btn-rotate-left").click(function() {
        let index = $(this).data('index');
    });

    $(".btn-rotate-right").click(function() {
        console.log("right");
    });
});
