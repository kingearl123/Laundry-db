document.addEventListener("DOMContentLoaded", function() {
    const body = document.querySelector("body");
    const submenuItems = document.querySelectorAll(".submenu_item");
    const sidebar = document.querySelector(".sidebar");
    const sidebarOpen = document.querySelector("#sidebarOpen");
    const overlay = document.getElementById("overlay");

    sidebarOpen.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });

    submenuItems.forEach((item) => {
        item.addEventListener("click", (event) => {
            // Stop event propagation to prevent closing sidebar
            event.stopPropagation();
            item.classList.toggle("show_submenu");
        });
    });

    // Modifikasi event listener untuk menangani pengalihan URL ketika item dropdown diklik
    const sidebarItems = document.querySelectorAll(".nav_link, .sublink");
    sidebarItems.forEach((item) => {
        item.addEventListener("click", (event) => {
            // Prevent default behavior to prevent page reload
            event.preventDefault();
            // Redirect to the clicked link
            const href = item.getAttribute("href");
            if (href) {
                window.location.href = href;
            }
        });
    });

    // Function to close sidebar without overlay
    function closeSidebar() {
        sidebar.classList.add("close");
    }

    // Event listener for overlay
    overlay.addEventListener("click", () => {
        closeSidebar();
    });
});

// Function to toggle overlay
function closeModal1() {
    var modal = document.getElementById("modaltambah");
    if (modal) {
        modal.style.display = "none";
        toggleOverlay(); // Toggle overlay
    } else {
        console.error("No modal found with id: modaltambah");
    }
}

function closeModal2() {
    var modal = document.getElementById("modaltambahpaket");
    if (modal) {
        modal.style.display = "none";
        toggleOverlay(); // Toggle overlay
    } else {
        console.error("No modal found with id: modaltambah");
    }
}

// Function to toggle overlay
function toggleOverlay() {
    var overlay = document.getElementById("overlay");
    overlay.classList.toggle("active");
}

// Function to open modal
function openModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "block";
        toggleOverlay(); // Toggle overlay
    } else {
        console.error(`No modal found with id: ${modalId}`);
    }
}

// Function to close modal
function closeModal(modalId) {
    var modalElement = document.getElementById(modalId);
    if (modalElement) {
        modalElement.style.display = "none";
    } else {
        console.error("No modal found with id: " + modalId);
    }

    // Check if any modal is open
    var openModals = document.querySelectorAll('.modal[style="display: block;"]');
    if (openModals.length === 0) {
        toggleOverlay(); // Close overlay if no modals are open
    }
}

// Event listener for close buttons
var closeButtons = document.getElementsByClassName("close");
for (var i = 0; i < closeButtons.length; i++) {
    closeButtons[i].addEventListener("click", function() {
        var modalId = this.closest(".modal").id;
        closeModal(modalId);
        toggleOverlay(); // Toggle overlay
    });
}