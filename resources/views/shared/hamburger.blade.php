<style>
/* Hamburger button is hidden by default on Desktop */
.hamburger-btn {
    display: none;
}

/* On mobile, unhide the hamburger button */
@media screen and (max-width: 768px) {
    .hamburger-btn {
        display: inline-flex;
    }
}
</style>

<!-- Hamburger Button -->
<button type="button" class="hamburger-btn" onclick="toggleMenu()">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="12" x2="21" y2="12"></line>
        <line x1="3" y1="6" x2="21" y2="6"></line>
        <line x1="3" y1="18" x2="21" y2="18"></line>
    </svg>
</button>

<!-- Tap-out Overlay Background -->
<div class="menu-overlay" id="menuOverlay" onclick="toggleMenu()"></div>

<script>
    function toggleMenu() {
        const menu = document.querySelector('.menu');
        const overlay = document.getElementById('menuOverlay');
        
        // Toggle the 'open' class on the menu drawer and overlay
        if(menu) {
            menu.classList.toggle('open');
        }
        if(overlay) {
            overlay.classList.toggle('open');
        }
    }
</script>
