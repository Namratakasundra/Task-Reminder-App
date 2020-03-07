
$(document).ready(function (){
    //console.log("doc")
    $uploadCrop = $('#profile_picture-demo').croppie({
        url : $('#upload-demo-image').val(),
        enableExif: true,
        viewport: 
        {
            width: 150,
            height: 150,
            type: 'square'
            
        },
        boundary: 
        {
            width: 250,
            height: 250
        }
    });

    $('#profile_picture').on('change', function () { 
        var reader = new FileReader();
        reader.onload = function (e) {
        //console.log("IMG :: ", e.target.result)
        $uploadCrop.croppie('bind', {
            url: e.target.result
            }).then(function(){
                console.log('jQuery bind complete');
            });
            }
        reader.readAsDataURL(this.files[0]);
    });

    $('#user-form').on('submit', function (ev) {
        ev.preventDefault();
        $uploadCrop.croppie('result', 
        {
            type: 'canvas',
            size: 'viewport'
        }).then(function (base64) {
        $('#profile_picture_data64').val(base64);
            $('#user-form').unbind().submit();
            });
    });
        
});