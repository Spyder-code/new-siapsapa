$('#loading').hide();
$(document).ajaxStart(function() {
    window.ajax_loading = true;
    $('#loading').show();
});
$(document).ajaxStop(function() {
    window.ajax_loading = false;
    $('#loading').hide();
});
