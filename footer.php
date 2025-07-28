<!-- Footer -->
<footer>
    <div class="container">
        <div class="footer-section">
            <div class="row">
                <div class="col-md-4">
                    <h6>Xpressions by Riya</h6>
                    <p>
                        <img src="images/logo-xr.jpeg" alt="" style="width: 100px; height: auto;">
                    </p>

                </div>
                <div class="col-md-4">
                    <h6>Contact Details</h6>
                    <p>E-mail Address:
                        <br>xpressionsbyriya@gmail.com
                    </p>
                    <div class="btn-cont"><a href="https://wa.me/917044379995"><span>Book Appointment</span></a></div>
                    <br>
                </div>
                <div class="col-md-4">
                    <h1>+91 70443 79995</h1>
                    <p>Working Hours:
                        <br>Mon-Fri: 7 am–10:30 pm
                        <br>Sunday: 8 am–10:30 pm
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="text-left">
                        <p>© 2025. All right reserved. Powered by Createdge</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-right">
                        <ul class="footer-social-link">
                            <li><a href="https://www.facebook.com/xpressionsbyriya/"><i class="ti-facebook"></i></a></li>
                            <!-- <li><a href="#0"><i class="ti-twitter"></i></a></li> -->
                            <li><a href="https://www.instagram.com/xpressionsbyriya/?igsh=MTFmdWJucWwzaWtvNg%3D%3D#"><i class="ti-instagram"></i></a></li>
                            <!-- <li><a href="#0"><i class="ti-pinterest"></i></a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- toTop -->
<a href="index.html#" class="totop">TOP</a>
<!-- jQuery -->
<script src="js/plugins/jquery-3.5.1.min.js"></script>
<script src="js/plugins/bootstrap.min.js"></script>
<script src="js/plugins/imagesloaded.pkgd.min.js"></script>
<script src="js/plugins/jquery.isotope.v3.0.2.js"></script>
<script src="js/plugins/modernizr-2.6.2.min.js"></script>
<script src="js/plugins/jquery.waypoints.min.js"></script>
<script src="modules/owl-carousel/owl.carousel.min.js"></script>
<script src="modules/swiper/swiper.min.js"></script>
<script src="modules/magnific-popup/jquery.magnific-popup.js"></script>
<script src="modules/masonry/masonry.pkgd.min.js"></script>
<script src="js/script.js"></script>

<script>
$(document).ready(function() {
    // Get all sections that have an ID defined
    const sections = $('div[id]');
    
    // Get all navigation links
    const navLinks = $('.navbar-nav .nav-link');
    
    // Function to update active navigation
    function updateActiveNav() {
        let current = '';
        const scrollTop = $(window).scrollTop();
        
        sections.each(function() {
            const section = $(this);
            const sectionTop = section.offset().top - 100; // 100px offset for better UX
            const sectionHeight = section.height();
            
            if (scrollTop >= sectionTop && scrollTop < sectionTop + sectionHeight) {
                current = section.attr('id');
            }
        });
        
        // Special case for home section (when at top of page)
        if (scrollTop < 100) {
            current = 'home';
        }
        
        // Remove active class from all nav links
        navLinks.removeClass('active');
        
        // Add active class to current section's nav link
        if (current) {
            if (current === 'home') {
                $('.nav-link[href="#"]').addClass('active');
            } else {
                $('.nav-link[href="#' + current + '"]').addClass('active');
            }
        }
    }
    
    // Run on scroll
    $(window).on('scroll', updateActiveNav);
    
    // Run on page load
    updateActiveNav();
    
    // Smooth scrolling for navigation links
    $('.navbar-nav .nav-link').click(function(e) {
        const target = $(this).attr('href');
        
        if (target.startsWith('#') && target !== '#') {
            e.preventDefault();
            const targetElement = $(target);
            
            if (targetElement.length) {
                $('html, body').animate({
                    scrollTop: targetElement.offset().top - 80
                }, 800);
            }
        } else if (target === '#') {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 800);
        }
    });
});
</script>

<script>
$(document).ready(function() {
    let currentlyShown = 12;
    let totalImages = $('.gallery-item').length;
    
    // Update counter
    $('#totalCount').text(totalImages);
    
    // Filter functionality
    $('.filter-btn').click(function() {
        const filter = $(this).data('filter');
        
        // Update active button
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        
        // Filter items with animation
        $('.gallery-item').each(function() {
            const item = $(this);
            const category = item.data('category');
            
            if (filter === 'all' || category === filter) {
                item.removeClass('fade-out').addClass('fade-in');
                setTimeout(() => {
                    item.show();
                }, 150);
            } else {
                item.removeClass('fade-in').addClass('fade-out');
                setTimeout(() => {
                    item.hide();
                }, 300);
            }
        });
        
        // Update counter for visible items
        setTimeout(() => {
            const visibleItems = $('.gallery-item:visible').length;
            $('#currentCount').text(Math.min(visibleItems, currentlyShown));
        }, 350);
    });
    
    // Load more functionality
    $('#loadMoreBtn').click(function() {
        const hiddenItems = $('.hidden-items .gallery-item');
        const button = $(this);
        
        button.html('<span>Loading...</span><i class="ti-reload"></i>');
        
        setTimeout(() => {
            // Show 12 more items
            hiddenItems.slice(0, 12).each(function() {
                $(this).appendTo('#galleryGrid').hide().fadeIn(500);
            });
            
            currentlyShown += 12;
            $('#currentCount').text(Math.min(currentlyShown, totalImages));
            
            // Hide button if no more items
            if (hiddenItems.length <= 12) {
                button.fadeOut();
            } else {
                button.html('<span>Load More Images</span><i class="ti-angle-down"></i>');
            }
            
            // Re-initialize magnific popup for new items
            $('.img-zoom').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300
                }
            });
            
        }, 1000);
    });
    
    // Initialize magnific popup
    $('.img-zoom').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        },
        zoom: {
            enabled: true,
            duration: 300
        }
    });
    
    // Lazy loading for images
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '50px'
    };
    
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src || img.src;
                img.classList.add('loaded');
                imageObserver.unobserve(img);
            }
        });
    }, observerOptions);
    
    // Observe all images
    $('.gallery-img img').each(function() {
        imageObserver.observe(this);
    });
});
</script>
</body>

</html>