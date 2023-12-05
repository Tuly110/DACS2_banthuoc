// IMG
document.getElementById('img').onchange = function(){
    document.getElementById('image').src = URL.createObjectURL(img.files[0])
  }

// console.log(URL.createObjectURL(imgFile.files[0]));