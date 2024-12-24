function showPreload(){
    $('.preload').show();
    $('.form-control').removeClass('is-invalid');
    $('.error.invalid-feedback').remove();
}

function hidePreload() {
    $('.preload').hide();
}

function showErrorValidate(error) {

    if(typeof error.responseJSON !== "undefined" && typeof error.responseJSON.errors !== "undefined"){

        $.each(error.responseJSON.errors, function(key, value){
            if(key.includes('.')){
                key = key.replace(/(.*)\.(.*)/, function(match, p1, p2) {
                    return p1 + "[" + p2 + "]";
                });
            }
            console.log(key);
            let errorField = $('[name="'+key+'"]');
            if(errorField.length){
                errorField.addClass('is-invalid').parent().append('<span class="error invalid-feedback">'+value[0]+'</span>');
            }
        });

        showErrorMessage(error.responseJSON.message);

    }else if(error.status == 403 && error.responseJSON.message){

        showErrorMessage(error.responseJSON.message);
        location.reload();
    }
    else{
        showErrorMessage('Có lỗi xảy ra vui lòng thử lại');
    }
}

function showErrorMessage(message) {
    toastr.error(message);
}

function showSuccessMessage(message) {
    toastr.success(message);
}

$(document).on('click', '.check_all', function () {
    $('.check_one').prop('checked', this.checked);
    if(this.checked){
        $('.btn_delete_user').prop('disabled', '');
    }else{
        $('.btn_delete_user').prop('disabled', 'disabled');
    }
});

$(document).on('click', '.check_one', function () {
    let $boxes = $('.check_one:checked');
    let $allBoxes = $('.check_one');
    if($boxes.length){
        $('.btn_delete_user').prop('disabled', '');
    }else{
        $('.btn_delete_user').prop('disabled', 'disabled');
    }

    if($boxes.length != $allBoxes.length){
        $('.check_all').prop('checked', false);
    }else{
        $('.check_all').prop('checked', true);
    }
});

$(document).ready(function () {
    $('.select2').select2({
        theme: 'bootstrap4'
    });

    $('.input-number').on('input', function () {
        this.value = this.value.replace(/\D/g, '');
    });
});
