let register = document.querySelector("button.register");
let login = document.querySelector("button.login");
let formSide = document.querySelector(".form-side");
let registerContent = document.querySelector(".register-content");
let loginContent = document.querySelector(".login-content");
let formLogin = document.querySelector(".form-content-login");
let formRegister = document.querySelector(".form-content-register");

register.addEventListener("click", () => {
    if (window.innerWidth > 750) {
        formSide.style.animation = "fullToRight 1.6s ease-in-out forwards";
        registerContent.style.animation = "slideToLeft 1s ease-in-out forwards";
        loginContent.style.animation =
            "bigSlideRightToLeft 1s ease-in-out 1s forwards";
        formLogin.style.animation = "slideToRight 1s ease-in-out forwards";
        formRegister.style.animation =
            "slideLeftToRight 1s ease-in-out 1.1s forwards";
    } else {
        formLogin.style.animation = "slideToLeft 1s ease-in-out forwards";
        formRegister.style.animation =
            "slideRightToLeft 1s ease-in-out forwards";
        loginContent.style.animation =
            "slideLeftToRight 1s ease-in-out forwards";
        registerContent.style.animation =
            "slideToRight 1s ease-in-out forwards";
    }
});

login.addEventListener("click", () => {
    if (window.innerWidth > 750) {
        formSide.style.animation = "fullToLeft 1.6s ease-in-out forwards";
        registerContent.style.animation =
            "bigSlideLeftToRight 1s ease-in-out 1s forwards";
        registerContent.style.opacity = 0;
        registerContent.style.pointerEvents = "none";
        loginContent.style.animation = "slideToRight 1s ease-in-out forwards";
        formLogin.style.animation =
            "slideRightToLeft 1s ease-in-out 1.1s forwards";
        formLogin.style.opacity = 0;
        formLogin.style.pointerEvents = "none";
        formRegister.style.animation = "slideToLeft 1s ease-in-out forwards";
    } else {
        formLogin.style.animation = "slideLeftToRight 1s ease-in-out forwards";
        formRegister.style.animation = "slideToRight 1s ease-in-out forwards";
        loginContent.style.animation = "slideToLeft 1s ease-in-out forwards";
        registerContent.style.animation =
            "slideRightToLeft 1s ease-in-out forwards";
    }
});
function closeAlert() {
    let alert = document.getElementById("alert-danger");
    alert.style.display = "none";
}
