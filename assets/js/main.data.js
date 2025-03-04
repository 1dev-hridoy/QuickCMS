       // Initialize Swiper
       const swiper = new Swiper(".mySwiper", {
        effect: "fade",
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    // Theme Toggle
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggle = document.getElementById('themeToggle');
        const icon = themeToggle.querySelector('i');
        const body = document.body;
        
        // Check saved theme
        const savedTheme = localStorage.getItem('theme') || 'dark';
        body.setAttribute('data-theme', savedTheme);
        updateIcon(savedTheme);
        
        themeToggle.addEventListener('click', function() {
            const currentTheme = body.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            body.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        });
        
        function updateIcon(theme) {
            if (theme === 'dark') {
                icon.classList.replace('bi-sun-fill', 'bi-moon-fill');
            } else {
                icon.classList.replace('bi-moon-fill', 'bi-sun-fill');
            }
        }
        
        // Post Modal
        const postModal = document.getElementById('postModal');
        const modalClose = document.getElementById('modalClose');
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('modalTitle');
        const modalDescription = document.getElementById('modalDescription');

        // Function to open post modal
        function openPostModal(image, title, description) {
            modalImage.src = image;
            modalTitle.textContent = title;
            modalDescription.textContent = description;
            postModal.classList.add('show');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }

        // Function to close post modal
        function closePostModal() {
            postModal.classList.remove('show');
            document.body.style.overflow = ''; // Restore scrolling
        }

        // Add click event to all blog posts
        document.querySelectorAll('.blog-post').forEach(post => {
            post.addEventListener('click', function(e) {
                // Don't open modal if clicking on links or meta items
                if (e.target.closest('.post-meta') || e.target.closest('a')) return;
                
                const image = post.querySelector('.blog-image').src;
                const title = post.querySelector('.post-title').textContent;
                const description = post.querySelector('.post-description').textContent;
                openPostModal(image, title, description);
            });
        });

        // Close post modal when clicking close button
        modalClose.addEventListener('click', closePostModal);

        // Close post modal when clicking outside
        postModal.addEventListener('click', function(e) {
            if (e.target === postModal) {
                closePostModal();
            }
        });

        // Search Modal
        const searchToggle = document.getElementById('searchToggle');
        const searchModal = document.getElementById('searchModal');
        const searchModalClose = document.getElementById('searchModalClose');
        const searchInput = document.getElementById('searchInput');
        const suggestionItems = document.querySelectorAll('.suggestion-item');
        const recentSearchItems = document.querySelectorAll('.recent-search-item');
        const recentSearchRemove = document.querySelectorAll('.recent-search-remove');

        // Open search modal
        searchToggle.addEventListener('click', function() {
            searchModal.classList.add('show');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                searchInput.focus();
            }, 300);
        });

        // Close search modal
        function closeSearchModal() {
            searchModal.classList.remove('show');
            document.body.style.overflow = '';
        }

        searchModalClose.addEventListener('click', closeSearchModal);

        // Close search modal when clicking outside
        searchModal.addEventListener('click', function(e) {
            if (e.target === searchModal) {
                closeSearchModal();
            }
        });

        // Process hashtags in search input
        searchInput.addEventListener('input', function(e) {
            const value = e.target.value;
            if (value.includes('#')) {
                // Highlight hashtags or add suggestions
                console.log('Hashtag detected:', value);
                // Here you could add real-time hashtag highlighting
            }
        });

        // Handle search suggestion clicks
        suggestionItems.forEach(item => {
            item.addEventListener('click', function() {
                const text = item.textContent.trim();
                searchInput.value = text;
                searchInput.focus();
            });
        });

        // Handle recent search item clicks
        recentSearchItems.forEach(item => {
            item.addEventListener('click', function(e) {
                if (!e.target.classList.contains('recent-search-remove')) {
                    const text = item.querySelector('span:not(.hashtag)').textContent.trim();
                    searchInput.value = text;
                    searchInput.focus();
                }
            });
        });

        // Remove recent search items
        recentSearchRemove.forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const item = this.closest('.recent-search-item');
                item.style.opacity = 0;
                setTimeout(() => {
                    item.remove();
                }, 300);
            });
        });

        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        if (searchModal.classList.contains('show')) {
            searchModal.classList.remove('show');
        }
        if (modal.classList.contains('show')) {
            closeModal();
        }
    }
});

    });