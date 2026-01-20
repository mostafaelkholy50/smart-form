// Mobile Menu Toggle Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Create mobile menu toggle button
    const header = document.querySelector('#Header');
    const menu = document.querySelector('.Menu');
    const menuUl = document.querySelector('.Menu ul');
    
    if (header && menu && menuUl) {
        // Create toggle button
        const toggleButton = document.createElement('button');
        toggleButton.className = 'mobile-menu-toggle';
        toggleButton.setAttribute('aria-label', 'Toggle mobile menu');
        toggleButton.innerHTML = '<span></span><span></span><span></span>';
        
        // Insert button before menu
        menu.parentNode.insertBefore(toggleButton, menu);
        
        // Toggle menu on button click
        toggleButton.addEventListener('click', function() {
            this.classList.toggle('active');
            menuUl.classList.toggle('mobile-active');
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInside = menu.contains(event.target) || toggleButton.contains(event.target);
            
            if (!isClickInside && menuUl.classList.contains('mobile-active')) {
                toggleButton.classList.remove('active');
                menuUl.classList.remove('mobile-active');
            }
        });
        
        // Close menu on window resize if switching to desktop
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (window.innerWidth > 768) {
                    toggleButton.classList.remove('active');
                    menuUl.classList.remove('mobile-active');
                }
            }, 250);
        });
    }
});
