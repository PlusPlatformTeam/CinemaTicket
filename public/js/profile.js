  const imageUpload = document.getElementById('image-upload');
  const previewImage = document.getElementById('preview-image');
  const circleImage = document.querySelector('.circle-image');

  imageUpload.addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function () {
        previewImage.src = reader.result;
      };
      reader.readAsDataURL(file);
    }
  });


  circleImage.addEventListener('click', function () {
    imageUpload.click();
  });



  


  jalaliDatepicker.startWatch();
