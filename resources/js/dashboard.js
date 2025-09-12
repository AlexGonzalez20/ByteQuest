document.addEventListener("DOMContentLoaded", function () {
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.getElementById("main-content");

    function updateLayout() {
        if (sidebar.classList.contains("show")) {
            mainContent.classList.remove("col-12");
            mainContent.classList.add("col-md-9", "col-lg-10");
        } else {
            mainContent.classList.remove("col-md-9", "col-lg-10");
            mainContent.classList.add("col-12");
        }
    }

    // Initial state
    function setInitialState() {
        if (window.innerWidth >= 768) {
            sidebar.classList.add("show");
        } else {
            sidebar.classList.remove("show");
        }
        updateLayout();
    }

    setInitialState();

    // Update on resize
    window.addEventListener("resize", setInitialState);

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener("click", function () {
            sidebar.classList.toggle("show");
            updateLayout();
        });
    }
});
