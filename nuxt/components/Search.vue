<template>
  <div class="search-area">
    <input v-model="query" placeholder="Search hotels..." class="search-input" />
    <div class="hotel-list">
      <div v-for="hotel in filteredHotels" :key="hotel.id" class="hotel-card">
        <img :src="hotel.image" :alt="hotel.name" class="hotel-image" />
        <div class="info">
          <h3>{{ hotel.name }}</h3>
          <p>{{ hotel.location }}</p>
          <p>{{ hotel.currentPrice }} {{ hotel.priceNote }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      query: '',
      hotels: []
    }
  },
  async mounted() {
    const data = await fetch('/data/hotels.json').then(r => r.json())
    this.hotels = data.hotels
  },
  computed: {
    filteredHotels() {
      const q = this.query.toLowerCase()
      return this.hotels.filter(h => h.name.toLowerCase().includes(q))
    }
  }
}
</script>

<style scoped>
.search-area {
  padding: 1rem 0;
}
.search-input {
  padding: 0.5rem 1rem;
  width: 100%;
  max-width: 400px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-bottom: 1rem;
}
.hotel-card {
  display: flex;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  margin-bottom: 1rem;
  overflow: hidden;
}
.hotel-image {
  width: 150px;
  object-fit: cover;
}
.info {
  padding: 0.5rem 1rem;
}
</style>
