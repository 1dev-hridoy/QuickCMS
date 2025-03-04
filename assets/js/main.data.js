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

    }
);