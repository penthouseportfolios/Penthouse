function toggleMenu() {
    var navLinks = document.getElementById("nav-links");
    if (navLinks.classList.contains("collapsed")) {
        navLinks.classList.remove("collapsed");
    } else {
        navLinks.classList.add("collapsed");
    }
}