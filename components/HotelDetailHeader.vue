<template>
  <div class="section hotel-main-info">
    <div class="hotel-image-container">
      <img
        :src="hotelData.mainImage"
        :alt="hotelData.name"
        class="hotel-image-main"
      />
      <div class="image-counter">{{ hotelData.imageCounter }}</div>
      <div class="heart-icon" @click="toggleFavorite">
        {{ isFavorite ? "❤️" : "♡" }}
      </div>
    </div>

    <div class="hotel-info-content">
      <div class="hotel-stars">
        <span v-for="star in hotelData.stars" :key="star">★</span>
      </div>

      <h1 class="hotel-name">{{ hotelData.name }}</h1>

      <div class="hotel-location">{{ hotelData.location }}</div>

      <div class="hotel-rating">
        <div
          v-for="circle in 5"
          :key="circle"
          class="rating-circle"
          :class="{ filled: circle <= hotelData.rating }"
        ></div>
        <span class="rating-text">{{ hotelData.reviewCount }} reviews</span>
      </div>

      <div class="hotel-actions">
        <span class="action-link" @click="$emit('show-hotel-details')">
          Hotel details
        </span>
        <span class="action-link" @click="$emit('show-map')"> 🗺️ Map </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "HotelDetailHeader",
  props: {
    hotelData: {
      type: Object,
      required: true,
      default: () => ({
        name: "Jumeirah Beach Hotel",
        location: "Jumeirah Beach, Dubai, United Arab Emirates",
        stars: 5,
        rating: 5,
        reviewCount: "5,124",
        mainImage:
          "https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=200&fit=crop",
        imageCounter: "1/86",
      }),
    },
    initialFavorite: {
      type: Boolean,
      default: false,
    },
  },
  emits: ["toggle-favorite", "show-hotel-details", "show-map"],
  data() {
    return {
      isFavorite: this.initialFavorite,
    };
  },
  methods: {
    toggleFavorite() {
      this.isFavorite = !this.isFavorite;
      this.$emit("toggle-favorite", {
        hotel: this.hotelData,
        isFavorite: this.isFavorite,
      });
    },
  },
};
</script>

<style scoped>
.section {
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  margin-bottom: 30px;
  overflow: hidden;
}

.hotel-main-info {
  position: relative;
}

.hotel-image-container {
  position: relative;
}

.hotel-image-main {
  width: 100%;
  height: 200px;
  object-fit: cover;
  position: relative;
}

.image-counter {
  position: absolute;
  bottom: 15px;
  left: 50%;
  transform: translateX(-50%);
  background: rgba(0, 0, 0, 0.7);
  color: white;
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 13px;
  font-weight: 500;
}

.heart-icon {
  position: absolute;
  top: 15px;
  right: 15px;
  background: white;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  cursor: pointer;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
  transition: transform 0.2s;
}

.heart-icon:hover {
  transform: scale(1.1);
}

.hotel-info-content {
  padding: 20px;
}

.hotel-stars {
  color: #ffa500;
  margin-bottom: 8px;
  font-size: 16px;
}

.hotel-name {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 8px;
  color: #333;
  font-family: the-seasons, serif;
  font-weight: 300;
}

.hotel-location {
  color: #666;
  margin-bottom: 15px;
  font-size: 14px;
}

.hotel-rating {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 20px;
}

.rating-circle {
  width: 12px;
  height: 12px;
  background: #ddd;
  border-radius: 50%;
  transition: background-color 0.2s;
}

.rating-circle.filled {
  background: #153b3c;
}

.rating-text {
  color: #666;
  font-size: 14px;
}

.hotel-actions {
  display: flex;
  gap: 15px;
}

.action-link {
  color: #ac7872;
  text-decoration: underline;
  cursor: pointer;
  font-size: 14px;
  transition: color 0.2s;
}

.action-link:hover {
  color: #8b5f5a;
}

@media (max-width: 768px) {
  .hotel-image-main {
    height: 150px;
  }

  .hotel-info-content {
    padding: 15px;
  }

  .hotel-name {
    font-size: 20px;
  }

  .hotel-actions {
    flex-direction: column;
    gap: 8px;
  }
}
</style>
