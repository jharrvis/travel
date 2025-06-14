<!-- Recently Viewed Hotels -->
<div class="recently-viewed">
    <div class="recently-viewed-inner">
        <div class="recently-viewed-header">
            <h2 class="recently-viewed-title">Your recently viewed hotels</h2>
            <div class="carousel-navigation">
                <button class="carousel-btn" id="prevBtn">‹</button>
                <button class="carousel-btn" id="nextBtn">›</button>
            </div>
        </div>
        
        <div class="carousel-container">
            <div class="carousel-wrapper" id="carouselWrapper">
                <?php foreach ($recentlyViewedHotels as $hotel): ?>
                    <div class="recently-viewed-item">
                        <img src="<?php echo htmlspecialchars($hotel['image']); ?>" alt="<?php echo htmlspecialchars($hotel['name']); ?>" class="recently-viewed-image">
                        <div class="recently-viewed-content">
                            <div class="recently-viewed-stars"><?php echo generateStars($hotel['stars']); ?></div>
                            <div class="recently-viewed-name"><?php echo htmlspecialchars($hotel['name']); ?></div>
                            <div class="recently-viewed-location"><?php echo htmlspecialchars($hotel['location']); ?></div>
                            <div class="recently-viewed-rating">
                                <div class="recently-viewed-circles">
                                    <?php echo generateRatingCircles($hotel['rating']); ?>
                                </div>
                                <span class="recently-viewed-reviews"><?php echo number_format($hotel['reviews']); ?> reviews</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
// Recently Viewed Hotels Carousel
document.addEventListener('DOMContentLoaded', function() {
    let currentSlide = 0;
    const itemsPerView = 4;
    const carouselWrapper = document.getElementById('carouselWrapper');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    if (!carouselWrapper || !prevBtn || !nextBtn) {
        console.log('Carousel elements not found');
        return;
    }
    
    const totalItems = carouselWrapper.children.length;
    const maxSlides = Math.max(0, totalItems - itemsPerView);
    
    console.log('Carousel initialized:', totalItems, 'items,', maxSlides, 'max slides');

    function updateCarousel() {
        // Calculate item width including gap
        const itemWidth = 280; // Fixed width per item
        const gap = 20; // Gap between items
        const translateX = currentSlide * (itemWidth + gap);
        
        carouselWrapper.style.transform = `translateX(-${translateX}px)`;
        
        // Update button states
        prevBtn.disabled = currentSlide === 0;
        nextBtn.disabled = currentSlide >= maxSlides;
        
        console.log(`Carousel updated: slide ${currentSlide}/${maxSlides}, translateX: -${translateX}px`);
    }

    // Remove any existing event listeners
    const newPrevBtn = prevBtn.cloneNode(true);
    const newNextBtn = nextBtn.cloneNode(true);
    prevBtn.parentNode.replaceChild(newPrevBtn, prevBtn);
    nextBtn.parentNode.replaceChild(newNextBtn, nextBtn);

    // Add event listeners to new buttons
    newPrevBtn.addEventListener('click', function() {
        if (currentSlide > 0) {
            currentSlide--;
            updateCarousel();
            console.log('Previous clicked, current slide:', currentSlide);
        }
    });

    newNextBtn.addEventListener('click', function() {
        if (currentSlide < maxSlides) {
            currentSlide++;
            updateCarousel();
            console.log('Next clicked, current slide:', currentSlide);
        }
    });

    // Initialize carousel
    updateCarousel();
    console.log('Carousel ready with', totalItems, 'items!');
    
    // Show/hide navigation buttons based on content
    if (totalItems <= itemsPerView) {
        newPrevBtn.style.display = 'none';
        newNextBtn.style.display = 'none';
        console.log('Navigation hidden - not enough items');
    }
});
</script>