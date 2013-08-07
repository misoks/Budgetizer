$(document).ready(function() {
    if ($('#location-list').val() == "Other") {
        $('.custom-box').show();
    }
    else {
        $('.custom-box').hide();
    }
    $('#location-list').change(function(){ 
        var value = $(this).val();
        if (value == "Other") {
            $('.custom-box').show();
        }
        else {
            $('.custom-box').hide();
        }
    });
});