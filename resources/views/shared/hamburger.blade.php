<button
    type="button"
    class="hamburger-btn"
    id="menuToggleButton"
    aria-label="Toggle navigation menu"
    aria-expanded="false"
    onclick="toggleMenu()"
>
    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <line x1="3" y1="12" x2="21" y2="12"></line>
        <line x1="3" y1="6" x2="21" y2="6"></line>
        <line x1="3" y1="18" x2="21" y2="18"></line>
    </svg>
</button>

<div class="menu-overlay" id="menuOverlay" onclick="toggleMenu(false)"></div>

<script>
    function toggleMenu(forceState) {
        const menu = document.querySelector('.menu');
        const overlay = document.getElementById('menuOverlay');
        const toggleButton = document.getElementById('menuToggleButton');

        if (!menu || !overlay || !toggleButton) {
            return;
        }

        const nextState = typeof forceState === 'boolean'
            ? forceState
            : !menu.classList.contains('open');

        menu.classList.toggle('open', nextState);
        overlay.classList.toggle('open', nextState);
        document.body.classList.toggle('menu-open', nextState);
        toggleButton.setAttribute('aria-expanded', nextState ? 'true' : 'false');
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            toggleMenu(false);
        }
    });
</script>
