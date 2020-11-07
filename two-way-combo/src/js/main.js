
$(document).ready(function() {
    console.log( "ready!" );

    $(".btn-rotate-left").click(function() {
        let index = $(this).data('index');
    });

    $(".btn-rotate-right").click(function() {
        console.log("right");
    });
});
