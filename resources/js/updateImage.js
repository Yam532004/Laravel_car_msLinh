function updateImagePreview(){
    var input = document.getElementById('image_preview');
    var inputPreview = document.getElementById('image_preview');
    var imageLinkInput = document.getElementById('image_link');

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imageLinkInput.value = e.target.result; // Update hidden input with image link
        }
        reader.readAsDataURL(input.files[0]);
    }


}