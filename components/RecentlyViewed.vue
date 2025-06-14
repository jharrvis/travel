<template>
  <div class="recently-viewed">
    <div class="container">
      <div class="recently-viewed-inner">
        <div class="recently-viewed-header">
          <h2 class="recently-viewed-title">Recently viewed hotels</h2>
          <div class="carousel-navigation">
            <button
              class="carousel-btn"
              @click="previousSlide"
              :disabled="currentSlide === 0"
            >
              ‹
            </button>
            <button
              class="carousel-btn"
              @click="nextSlide"
              :disabled="currentSlide >= maxSlides"
            >
              ›
            </button>
          </div>
        </div>

        <div class="carousel-container">
          <div
            class="carousel-wrapper"
            :style="{
              transform: `translateX(-${currentSlide * slideWidth}px)`,
            }"
          >
            <div
              v-for="hotel in recentlyViewedHotels"
              :key="hotel.id"
              class="recently-viewed-item"
              @click="viewHotel(hotel)"
            >
              <img
                :src="hotel.image"
                :alt="hotel.name"
                class="recently-viewed-image"
              />
              <div class="recently-viewed-content">
                <div class="recently-viewed-stars">
                  {{ generateStars(hotel.stars) }}
                </div>
                <h3 class="recently-viewed-name">{{ hotel.name }}</h3>
                <p class="recently-viewed-location">{{ hotel.location }}</p>
                <div class="recently-viewed-rating">
                  <div class="recently-viewed-circles">
                    <div
                      v-for="n in Math.floor(hotel.rating)"
                      :key="n"
                      class="recently-viewed-circle"
                    ></div>
                  </div>
                  <span class="recently-viewed-reviews"
                    >{{ hotel.reviews.toLocaleString() }} reviews</span
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "RecentlyViewed",
  data() {
    return {
      currentSlide: 0,
      slideWidth: 300, // 280px + 20px gap
      recentlyViewedHotels: [
        {
          id: 1,
          name: "Radisson Beach Resort Palm Jumeirah",
          location: "The Palm Jumeirah, Dubai, United Arab Emirates",
          stars: 4,
          rating: 4.2,
          reviews: 1104,
          image:
            "https://images.unsplash.com/photo-1566073771259-6a8506099945?w=280&h=140&fit=crop",
        },
        {
          id: 2,
          name: "Dukes The Palm, a Royal Hideaway Hotel",
          location: "The Palm Jumeirah, Dubai, United Arab Emirates",
          stars: 5,
          rating: 4.6,
          reviews: 4414,
          image:
            "https://images.unsplash.com/photo-1582719508461-905c673771fd?w=280&h=140&fit=crop",
        },
        {
          id: 3,
          name: "Ibis London Heathrow Airport",
          location: "London, England, United Kingdom",
          stars: 3,
          rating: 4.0,
          reviews: 6345,
          image:
            "https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=280&h=140&fit=crop",
        },
        {
          id: 4,
          name: "The Biltmore Hotel Villas",
          location: "Al Barsha, Dubai, United Arab Emirates",
          stars: 5,
          rating: 4.8,
          reviews: 44,
          image:
            "https://images.unsplash.com/photo-1564501049412-61c2a3083791?w=280&h=140&fit=crop",
        },
        {
          id: 5,
          name: "Four Seasons Resort Dubai",
          location: "Jumeirah Beach, Dubai, United Arab Emirates",
          stars: 5,
          rating: 4.7,
          reviews: 2187,
          image:
            "https://images.unsplash.com/photo-1584132967334-10e028bd69f7?w=280&h=140&fit=crop",
        },
        {
          id: 6,
          name: "Atlantis The Palm",
          location: "The Palm Jumeirah, Dubai, United Arab Emirates",
          stars: 5,
          rating: 4.3,
          reviews: 8234,
          image:
            "https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=280&h=140&fit=crop",
        },
      ],
    };
  },

  computed: {
    maxSlides() {
      // Calculate max slides based on container width
      // Assuming 4 items visible at once on desktop
      return Math.max(0, this.recentlyViewedHotels.length - 4);
    },
  },

  mounted() {
    this.calculateSlideWidth();
    window.addEventListener("resize", this.calculateSlideWidth);
  },

  beforeDestroy() {
    window.removeEventListener("resize", this.calculateSlideWidth);
  },

  methods: {
    generateStars(stars) {
      return "★".repeat(stars);
    },

    viewHotel(hotel) {
      alert(`Viewing details for ${hotel.name}`);
      // Here you would typically navigate to hotel details
      // this.$router.push(`/hotel/${hotel.id}`)
    },

    previousSlide() {
      if (this.currentSlide > 0) {
        this.currentSlide--;
      }
    },

    nextSlide() {
      if (this.currentSlide < this.maxSlides) {
        this.currentSlide++;
      }
    },

    calculateSlideWidth() {
      // Responsive slide width calculation
      const containerWidth = window.innerWidth;
      if (containerWidth <= 768) {
        this.slideWidth = 260; // Mobile: smaller cards
      } else if (containerWidth <= 1024) {
        this.slideWidth = 280; // Tablet
      } else {
        this.slideWidth = 300; // Desktop
      }
    },
  },
};
</script>

<style scoped>
/* Styles are handled by main.css, but we can add component-specific styles here if needed */
.carousel-wrapper {
  transition: transform 0.3s ease;
}

.recently-viewed-item {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.recently-viewed-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

.carousel-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.carousel-btn:disabled:hover {
  border-color: #ddd;
  color: #666;
}
</style>
