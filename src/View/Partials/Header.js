function state(obj) {

    const links = document.getElementsByClassName("nav_item");
    for (let i = 0; i < links.length; i++) {
        links[i].setAttribute("class", "nav_item");
    }

    obj.setAttribute("class", "nav_item active");

}

const btnHamburger = document.querySelector("#navbar_toggle");
const menu = document.querySelector(".menu");
btnHamburger.addEventListener("click", () => {
    menu.classList.toggle("menu_active");
})