document.addEventListener("DOMContentLoaded", function () {
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebar = document.getElementById("sidebar");

    function checkSidebarVisibility() {
        if (window.innerWidth >= 768) {
            // On medium and larger screens, ensure sidebar is visible
            sidebar.classList.add("show");
        } else {
            // On small screens, sidebar visibility controlled by toggle button
            sidebar.classList.remove("show");
        }
    }

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener("click", function () {
            sidebar.classList.toggle("show");
        });
    }

    // Initial check
    checkSidebarVisibility();

    // Listen for window resize events
    window.addEventListener("resize", checkSidebarVisibility);
});
