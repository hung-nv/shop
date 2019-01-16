$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    setTimeout(function () {
        $(".alert-info, .alert-danger, .alert-warning").hide();
    }, 3000);
});