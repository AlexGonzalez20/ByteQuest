// Toggle the sidebar menu on small screens
document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("sidebarToggle");
    const sidebar = document.getElementById("gestionMenu");

    if (toggleButton && sidebar) {
        toggleButton.addEventListener("click", function () {
            sidebar.classList.toggle("show");
        });
    }
});
