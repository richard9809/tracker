let menuBtn = document.querySelector("#btn");
let sideBar = document.querySelector(".container");

menuBtn.onclick = function() {
    sideBar.classList.toggle("active");
}

