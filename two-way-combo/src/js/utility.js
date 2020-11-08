
function doAjaxPost( url, data, onSuccess, onError ) {
    $.ajax({
        method: "POST",
        url: url,
        data: data,
        dataType: "json",
        timeout: 1000,
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

function doAjaxGet( url, data, onSuccess, onError ) {
    $.ajax({
        method: "GET",
        url: url,
        dataType: "json",
        data: data,
        timeout: 500,
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
