// State Management
let transactions = [];
let totalIncome = 0;
let totalExpenses = 0;
let isNavOpen = false;

// Mobile Navigation
const navToggle = document.getElementById("navToggle");
const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("overlay");
const mainContent = document.querySelector(".main-content");

function toggleNav() {
    isNavOpen = !isNavOpen;
    sidebar.classList.toggle("active");
    overlay.classList.toggle("active");
    navToggle.classList.toggle("hidden");

    if (isNavOpen) {
        document.body.style.overflow = "hidden";
    } else {
        document.body.style.overflow = "";
    }
}

navToggle.addEventListener("click", toggleNav);
overlay.addEventListener("click", toggleNav);

// Close nav when clicking menu items on mobile
const menuItems = document.querySelectorAll(".menu-item");
menuItems.forEach(item => {
    item.addEventListener("click", () => {
        if (window.innerWidth <= 768 && isNavOpen) {
            toggleNav();
        }
    });
});

