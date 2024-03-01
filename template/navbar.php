
    <nav class="navbar">
        <div class="logo_item">
            <i style="color: #fff;" class="bx bx-menu" id="sidebarOpen"></i>  
            <a href="./dashboard.php?page=homepage" class="logo_item">    
                NB Laundry
            </a>
        </div>

        <div class="navbar_content">
        <?= $_SESSION['username']; ?> (<?= $_SESSION['role']; ?>)

        </div>
    </nav>
