
function off_overlay() {
    document.getElementById("overlay").style.display = "none";
  }

function on_overlay() {
  document.getElementById("overlay").style.display = "block";
}

function backLogin() {
  window.location = "Login.html"
}

function backHome() {
  window.location = "Home.html"
}

let active = document.getElementsByClassName("active");
let slider_imgs = document.getElementsByClassName("slider-img")

for (var i = 0; i < slider_imgs.length; i++){
  slider_imgs[i].addEventListener('click', function(){
  this.classList.toggle('active');
  document.getElementById('imge').src = this.src;
  })
}















