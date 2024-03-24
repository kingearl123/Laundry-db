const body = document.querySelector("body");
const sidebar = document.querySelector(".sidebar");
const submenuItems = document.querySelectorAll(".submenu_item");
const sidebarOpen = document.querySelector("#sidebarOpen");
const overlay = document.getElementById("overlay"); // Get the overlay element

sidebarOpen.addEventListener("click", () => {
  sidebar.classList.toggle("close");
  overlay.style.display = sidebar.classList.contains("close")
    ? "block"
    : "none"; // Toggle the overlay based on the sidebar's state
});

submenuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    item.classList.toggle("show_submenu");
    submenuItems.forEach((item2, index2) => {
      if (index !== index2) {
        item2.classList.remove("show_submenu");
      }
    });
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
  closeButtons[i].addEventListener("click", function () {
    var modalId = this.closest(".modal").id;
    closeModal(modalId);
    toggleOverlay(); // Toggle overlay
  });
}