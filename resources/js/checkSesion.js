$(document).ajaxError(function(event, jqxhr, settings, thrownError) {
    if (jqxhr.status == 401) {
        window.location.replace("/login");
    }
});
