<template>
  <div class="search-area">
    <!-- Search Form -->
    <div class="container">
      <div class="search-form">
        <div class="form-row">
          <div class="form-group">
            <label>Destination or Hotel</label>
            <div class="location-input">
              <input
                type="text"
                v-model="searchQuery"
                placeholder="Enter destination"
                @input="filterHotels"
              />
            </div>
          </div>
          <div class="form-group">
            <label>Departure airport</label>
            <select v-model="departureAirport">
              <option value="">Any airport</option>
              <option value="LHR">London Heathrow</option>
              <option value="LGW">London Gatwick</option>
              <option value="MAN">Manchester</option>
              <option value="BHX">Birmingham</option>
            </select>
          </div>
          <div class="form-group">
            <label>When</label>
            <input
              type="text"
              v-model="departureDate"
              placeholder="Select dates"
            />
          </div>
          <div class="form-group">
            <label>How long</label>
            <input type="text" v-model="duration" placeholder="Duration" />
          </div>
          <div class="form-group">
            <label>Room(s)</label>
            <input type="text" v-model="rooms" placeholder="Rooms & guests" />
          </div>
        </div>
      </div>
    </div>

    <!-- Results Header -->
    <div class="container">
      <div class="results-header">
        <h1 class="results-title">{{ resultsTitle }}</h1>
        <div class="sort-controls">
          <span>Sort by</span>
          <select v-model="sortBy" @change="sortHotels" class="sort-dropdown">
            <option value="recommended">Most popular</option>
            <option value="price-low">Price (low to high)</option>
            <option value="price-high">Price (high to low)</option>
            <option value="rating">Star rating</option>
          </select>
          <button class="map-btn" @click="showMap">🗺️ Map</button>
        </div>
      </div>
    </div>

    <!-- Content Wrapper -->
    <div class="container">
      <div class="content-wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Price Toggle -->
          <div class="filter-section">
            <div class="price-toggle">
              <span>Price Per Person</span>
              <div
                class="toggle-switch"
                :class="{ active: priceToggle }"
                @click="priceToggle = !priceToggle"
              ></div>
              <span>Total Price</span>
            </div>
          </div>

          <!-- Popular Filters -->
          <div class="filter-section">
            <div class="filter-title" @click="toggleFilterSection('popular')">
              Popular filters
              <svg
                class="arrow"
                :class="{ collapsed: !expandedSections.popular }"
                viewBox="0 0 24 24"
              >
                <path d="M7 10l5 5 5-5z" />
              </svg>
            </div>
            <div
              class="filter-content"
              :class="{ collapsed: !expandedSections.popular }"
            >
              <div class="filter-tags">
                <div
                  class="filter-tag"
                  :class="{ outline: !filters.fiveStar }"
                  @click="
                    filters.fiveStar = !filters.fiveStar;
                    applyFilters();
                  "
                >
                  5-star hotel
                </div>
                <div
                  class="filter-tag outline"
                  :class="{ '': filters.fourPlusRating }"
                  @click="
                    filters.fourPlusRating = !filters.fourPlusRating;
                    applyFilters();
                  "
                >
                  4+ Tripadvisor rating
                </div>
                <div
                  class="filter-tag outline"
                  :class="{ '': filters.beach }"
                  @click="
                    filters.beach = !filters.beach;
                    applyFilters();
                  "
                >
                  Beach
                </div>
              </div>
            </div>
          </div>

          <!-- Star Rating -->
          <div class="filter-section">
            <div
              class="filter-title"
              @click="toggleFilterSection('starRating')"
            >
              Star rating
              <svg
                class="arrow"
                :class="{ collapsed: !expandedSections.starRating }"
                viewBox="0 0 24 24"
              >
                <path d="M7 10l5 5 5-5z" />
              </svg>
            </div>
            <div
              class="filter-content"
              :class="{ collapsed: !expandedSections.starRating }"
            >
              <div class="filter-list">
                <div class="filter-item" @click="toggleStarFilter(5)">
                  <div class="filter-item-left">
                    <div
                      class="filter-checkbox"
                      :class="{ checked: filters.stars.includes(5) }"
                    ></div>
                    <span class="filter-label">5-star hotel</span>
                  </div>
                  <div class="filter-count">{{ getStarCount(5) }}</div>
                </div>
                <div class="filter-item" @click="toggleStarFilter(4)">
                  <div class="filter-item-left">
                    <div
                      class="filter-checkbox"
                      :class="{ checked: filters.stars.includes(4) }"
                    ></div>
                    <span class="filter-label">4-star hotel</span>
                  </div>
                  <div class="filter-count">{{ getStarCount(4) }}</div>
                </div>
                <div class="filter-item" @click="toggleStarFilter(3)">
                  <div class="filter-item-left">
                    <div
                      class="filter-checkbox"
                      :class="{ checked: filters.stars.includes(3) }"
                    ></div>
                    <span class="filter-label">3-star hotel</span>
                  </div>
                  <div class="filter-count">{{ getStarCount(3) }}</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Board Basis -->
          <div class="filter-section">
            <div
              class="filter-title"
              @click="toggleFilterSection('boardBasis')"
            >
              Board basis
              <svg
                class="arrow"
                :class="{ collapsed: !expandedSections.boardBasis }"
                viewBox="0 0 24 24"
              >
                <path d="M7 10l5 5 5-5z" />
              </svg>
            </div>
            <div
              class="filter-content"
              :class="{ collapsed: !expandedSections.boardBasis }"
            >
              <div class="filter-list">
                <div
                  v-for="basis in boardBasisOptions"
                  :key="basis"
                  class="filter-item"
                  @click="toggleBoardBasis(basis)"
                >
                  <div class="filter-item-left">
                    <div
                      class="filter-checkbox"
                      :class="{ checked: filters.boardBasis.includes(basis) }"
                    ></div>
                    <span class="filter-label">{{ basis }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Max Price -->
          <div class="filter-section">
            <div class="filter-title" @click="toggleFilterSection('maxPrice')">
              Max price
              <svg
                class="arrow"
                :class="{ collapsed: !expandedSections.maxPrice }"
                viewBox="0 0 24 24"
              >
                <path d="M7 10l5 5 5-5z" />
              </svg>
            </div>
            <div
              class="filter-content"
              :class="{ collapsed: !expandedSections.maxPrice }"
            >
              <div class="price-slider-container">
                <div class="price-range-label">{{ priceRangeLabel }}</div>
                <div class="slider-wrapper">
                  <input
                    type="range"
                    class="price-slider"
                    min="200"
                    max="5000"
                    v-model="filters.maxPrice"
                    @input="updatePriceRange"
                    id="priceRange"
                  />
                  <div class="slider-track"></div>
                </div>
                <div class="price-range-values">
                  <span>£200</span>
                  <span>{{ priceRangeMax }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Popular Resorts -->
          <div class="filter-section">
            <div
              class="filter-title"
              @click="toggleFilterSection('popularResorts')"
            >
              Popular resorts
              <svg
                class="arrow"
                :class="{ collapsed: !expandedSections.popularResorts }"
                viewBox="0 0 24 24"
              >
                <path d="M7 10l5 5 5-5z" />
              </svg>
            </div>
            <div
              class="filter-content"
              :class="{ collapsed: !expandedSections.popularResorts }"
            >
              <div class="filter-list">
                <div
                  v-for="resort in popularResorts"
                  :key="resort.name"
                  class="filter-item"
                  @click="toggleResort(resort.name)"
                >
                  <div class="filter-item-left">
                    <div
                      class="filter-checkbox"
                      :class="{
                        checked: filters.resorts.includes(resort.name),
                      }"
                    ></div>
                    <span class="filter-label">{{ resort.name }}</span>
                  </div>
                  <div class="filter-count">{{ resort.count }}</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Holiday Type -->
          <div class="filter-section">
            <div
              class="filter-title"
              @click="toggleFilterSection('holidayType')"
            >
              Holiday type
              <svg
                class="arrow"
                :class="{ collapsed: !expandedSections.holidayType }"
                viewBox="0 0 24 24"
              >
                <path d="M7 10l5 5 5-5z" />
              </svg>
            </div>
            <div
              class="filter-content"
              :class="{ collapsed: !expandedSections.holidayType }"
            >
              <div class="filter-list">
                <div
                  v-for="type in holidayTypes"
                  :key="type.name"
                  class="filter-item"
                  @click="toggleHolidayType(type.name)"
                >
                  <div class="filter-item-left">
                    <div
                      class="filter-checkbox"
                      :class="{
                        checked: filters.holidayTypes.includes(type.name),
                      }"
                    ></div>
                    <span class="filter-label">{{ type.name }}</span>
                  </div>
                  <div class="filter-count" v-if="type.count">
                    {{ type.count }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Hotel Listings -->
        <div class="hotel-list">
          <div v-for="hotel in sortedHotels" :key="hotel.id" class="hotel-card">
            <div class="hotel-image">
              <img :src="hotel.image" :alt="hotel.name" />
              <div class="image-counter">1/{{ hotel.imageCount }}</div>
            </div>
            <div class="hotel-info">
              <div class="hotel-header">
                <div>
                  <h3 class="hotel-name">{{ hotel.name }}</h3>
                  <div class="hotel-stars">
                    {{ generateStars(hotel.stars) }}
                  </div>
                  <div class="hotel-location">
                    {{ hotel.location }} • {{ hotel.category }}
                  </div>
                </div>
                <div class="heart-icon" @click="toggleFavorite(hotel.id)">
                  {{ favorites.includes(hotel.id) ? "❤️" : "♡" }}
                </div>
              </div>

              <div class="hotel-rating">
                <div
                  v-for="n in Math.floor(hotel.rating)"
                  :key="n"
                  class="rating-circle"
                ></div>
                <span class="rating-text"
                  >{{ hotel.reviews.toLocaleString() }} reviews</span
                >
              </div>

              <div class="hotel-details">
                <span>📅 {{ hotel.dates }}</span>
                <span
                  >{{ getBoardBasisIcon(hotel.boardBasis) }}
                  {{ hotel.boardBasis }}</span
                >
                <span v-if="hotel.flightsIncluded">✈️ Flights included ⌄</span>
              </div>

              <div class="hotel-pricing">
                <div class="pricing-left">
                  <div class="deposit-info">{{ hotel.deposit }}</div>
                  <div class="save-badge" v-if="hotel.savings">
                    {{ hotel.savings }}
                  </div>
                </div>
                <div class="pricing-right">
                  <div class="original-price" v-if="hotel.originalPrice">
                    {{ hotel.originalPrice }}
                  </div>
                  <div class="current-price">
                    {{ hotel.currentPrice }}
                    <span class="price-note">{{ hotel.priceNote }}</span>
                  </div>
                </div>
              </div>

              <button class="view-deal-btn" @click="viewDeal(hotel)">
                <svg
                  width="24"
                  height="24"
                  version="1.1"
                  viewBox="0 0 48 48"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="m23.349 16.244c0.06372-0.00125 0.12744-0.0025 0.18991-0.0025 1.8679 0 3.627 0.71375 4.9677 2.0212 1.3868 1.3525 2.1502 3.1638 2.1502 5.1 0 3.9288-3.1935 7.11-7.1317 7.1225-1.7767 0.00625-7.1054 0.045-7.1054 0.045v-6.9538c0-3.945 3.1085-7.2325 6.9293-7.3325m21.987-3.6525c-1.7442-3.0562-4.0494-5.5625-6.8518-7.45-2.74-1.8438-5.8548-3.1825-9.2582-3.9775-3.3035-0.77375-6.6331-1.1638-9.8979-1.1638h-19.328l0.099953 19.25c0.02124 4.2675 1.7055 8.2712 4.739 11.272 1.9766 1.955 4.373 3.3312 6.9817 4.0475 2.3139 0.445 4.4042 0.5525 4.6253 0.5625l7.0917-0.04625c6.462 0 11.718-5.2588 11.718-11.724 0-3.1875-1.2569-6.1688-3.5396-8.395-2.2814-2.225-5.295-3.405-8.486-3.3238-6.2908 0.16125-11.41 5.515-11.41 11.932v6.1438c-1.3844-0.55625-2.6563-1.3888-3.7495-2.4688-2.159-2.1375-3.3572-4.9875-3.3734-8.0262l-0.073715-14.625h14.704c2.9124 0 5.891 0.35125 8.8521 1.0438 2.8574 0.6675 5.4612 1.7838 7.7364 3.315 2.2102 1.4888 4.0356 3.4788 5.425 5.9125 1.3669 2.395 2.059 5.4662 2.059 9.1288 0 3.3762-0.69093 6.2888-2.0553 8.66-1.3981 2.4312-3.2347 4.4512-5.4599 6.0038-2.2864 1.595-4.9027 2.7925-7.7739 3.5575-2.9399 0.78125-5.8947 1.1788-8.7834 1.1788h-2.9074v-5.6625c-0.79088-0.03-3.4284-0.27125-4.6003-0.5675l0.0012495 10.83h7.5065c3.2885 0 6.6419-0.44875 9.9666-1.3338 3.3909-0.90125 6.4945-2.3238 9.2219-4.2288 2.7849-1.9425 5.0776-4.46 6.8156-7.4825 1.7704-3.0775 2.6675-6.765 2.6675-10.955 0-4.4725-0.89583-8.31-2.6638-11.409"
                    fill-rule="evenodd"
                  />
                </svg>
                View deal
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Recently Viewed Hotels -->
    <RecentlyViewed />
  </div>
</template>

<script>
export default {
  name: "SearchComponent",
  data() {
    return {
      searchQuery: "Dubai",
      departureAirport: "",
      departureDate: "Nov 2025",
      duration: "5 nights",
      rooms: "1 Room / 2 Adults",
      sortBy: "recommended",
      priceToggle: false,
      hotels: [],
      filteredHotels: [],
      favorites: [],

      // Filter states
      filters: {
        fiveStar: true,
        fourPlusRating: false,
        beach: false,
        stars: [5],
        boardBasis: [],
        maxPrice: 5000,
        resorts: ["Jumeirah Beach"],
        holidayTypes: [],
      },

      // Expanded sections
      expandedSections: {
        popular: true,
        starRating: true,
        boardBasis: true,
        maxPrice: true,
        popularResorts: true,
        holidayType: true,
      },

      // Filter options
      boardBasisOptions: [
        "All inclusive",
        "Full board",
        "Breakfast and dinner",
        "Breakfast included",
        "Self catering",
        "Room only",
      ],

      popularResorts: [
        { name: "Dubai City", count: 69 },
        { name: "Downtown Dubai", count: 23 },
        { name: "The Palm Jumeirah", count: 22 },
        { name: "Jumeirah Beach", count: 15 },
        { name: "Dubai Marina", count: 13 },
        { name: "Jumeirah Beach Residence", count: 13 },
        { name: "Deira", count: 10 },
        { name: "Bur Dubai", count: 8 },
        { name: "Al Barsha", count: 7 },
        { name: "Jebel Ali", count: 6 },
      ],

      holidayTypes: [
        { name: "Adults Only Hotels", count: null },
        { name: "Beach", count: 9 },
        { name: "Close to Airport", count: null },
        { name: "Couples", count: 10 },
        { name: "Family", count: 3 },
        { name: "Honeymoon", count: 2 },
        { name: "Luxury Hotels", count: 5 },
        { name: "Spa and Relaxation", count: 2 },
      ],
    };
  },

  async mounted() {
    try {
      const response = await fetch("/data/hotels.json");
      const data = await response.json();
      this.hotels = data.hotels;
      this.applyFilters();

      // Initialize slider progress
      this.$nextTick(() => {
        this.updatePriceRange();
      });
    } catch (error) {
      console.error("Failed to load hotels:", error);
      this.hotels = [];
      this.filteredHotels = [];
    }
  },

  computed: {
    resultsTitle() {
      return `${this.filteredHotels.length} holidays found`;
    },

    sortedHotels() {
      const hotels = [...this.filteredHotels];

      switch (this.sortBy) {
        case "price-low":
          return hotels.sort((a, b) => {
            const priceA = parseInt(a.currentPrice.replace(/[£,]/g, ""));
            const priceB = parseInt(b.currentPrice.replace(/[£,]/g, ""));
            return priceA - priceB;
          });
        case "price-high":
          return hotels.sort((a, b) => {
            const priceA = parseInt(a.currentPrice.replace(/[£,]/g, ""));
            const priceB = parseInt(b.currentPrice.replace(/[£,]/g, ""));
            return priceB - priceA;
          });
        case "rating":
          return hotels.sort((a, b) => b.stars - a.stars);
        default:
          return hotels;
      }
    },

    priceRangeLabel() {
      return this.filters.maxPrice == 5000
        ? "Any"
        : `Up to £${this.filters.maxPrice}`;
    },

    priceRangeMax() {
      return this.filters.maxPrice == 5000
        ? "Any"
        : `£${this.filters.maxPrice}`;
    },
  },

  methods: {
    filterHotels() {
      this.applyFilters();
    },

    applyFilters() {
      let filtered = [...this.hotels];

      // Search query filter
      if (this.searchQuery.trim()) {
        const query = this.searchQuery.toLowerCase();
        filtered = filtered.filter(
          (hotel) =>
            hotel.name.toLowerCase().includes(query) ||
            hotel.location.toLowerCase().includes(query) ||
            hotel.category.toLowerCase().includes(query)
        );
      }

      // Star rating filter
      if (this.filters.stars.length > 0) {
        filtered = filtered.filter((hotel) =>
          this.filters.stars.includes(hotel.stars)
        );
      }

      // Board basis filter
      if (this.filters.boardBasis.length > 0) {
        filtered = filtered.filter((hotel) =>
          this.filters.boardBasis.includes(hotel.boardBasis)
        );
      }

      // Price filter
      if (this.filters.maxPrice < 5000) {
        filtered = filtered.filter((hotel) => {
          const price = parseInt(hotel.currentPrice.replace(/[£,]/g, ""));
          return price <= this.filters.maxPrice;
        });
      }

      // Resort filter
      if (this.filters.resorts.length > 0) {
        filtered = filtered.filter((hotel) => {
          return this.filters.resorts.some((resort) =>
            hotel.location.toLowerCase().includes(resort.toLowerCase())
          );
        });
      }

      // Beach filter
      if (this.filters.beach) {
        filtered = filtered.filter(
          (hotel) =>
            hotel.category.toLowerCase().includes("beach") ||
            hotel.location.toLowerCase().includes("beach")
        );
      }

      // Four plus rating filter
      if (this.filters.fourPlusRating) {
        filtered = filtered.filter((hotel) => hotel.rating >= 4.0);
      }

      this.filteredHotels = filtered;
    },

    sortHotels() {
      // Reactivity is handled by computed property
    },

    showMap() {
      alert("Map view would be implemented here");
    },

    viewDeal(hotel) {
      alert(
        `Viewing deal for ${hotel.name} - ${hotel.currentPrice} ${hotel.priceNote}`
      );
    },

    toggleFavorite(hotelId) {
      const index = this.favorites.indexOf(hotelId);
      if (index > -1) {
        this.favorites.splice(index, 1);
      } else {
        this.favorites.push(hotelId);
      }
    },

    toggleFilterSection(section) {
      this.expandedSections[section] = !this.expandedSections[section];
    },

    toggleStarFilter(stars) {
      const index = this.filters.stars.indexOf(stars);
      if (index > -1) {
        this.filters.stars.splice(index, 1);
      } else {
        this.filters.stars.push(stars);
      }
      this.applyFilters();
    },

    toggleBoardBasis(basis) {
      const index = this.filters.boardBasis.indexOf(basis);
      if (index > -1) {
        this.filters.boardBasis.splice(index, 1);
      } else {
        this.filters.boardBasis.push(basis);
      }
      this.applyFilters();
    },

    toggleResort(resort) {
      const index = this.filters.resorts.indexOf(resort);
      if (index > -1) {
        this.filters.resorts.splice(index, 1);
      } else {
        this.filters.resorts.push(resort);
      }
      this.applyFilters();
    },

    toggleHolidayType(type) {
      const index = this.filters.holidayTypes.indexOf(type);
      if (index > -1) {
        this.filters.holidayTypes.splice(index, 1);
      } else {
        this.filters.holidayTypes.push(type);
      }
      this.applyFilters();
    },

    updatePriceRange() {
      const slider = document.getElementById("priceRange");
      if (slider) {
        const progress = ((this.filters.maxPrice - 200) / (5000 - 200)) * 100;
        slider.parentElement.style.setProperty(
          "--slider-progress",
          `${progress}%`
        );
      }
      this.applyFilters();
    },

    generateStars(stars) {
      return "★".repeat(stars);
    },

    getBoardBasisIcon(boardBasis) {
      switch (boardBasis.toLowerCase()) {
        case "breakfast included":
          return "🍽️";
        case "all inclusive":
          return "🍽️";
        case "full board":
          return "🍽️";
        case "room only":
          return "🏨";
        case "self catering":
          return "🍳";
        default:
          return "🍽️";
      }
    },

    getStarCount(stars) {
      return this.hotels.filter((hotel) => hotel.stars === stars).length;
    },
  },
};
</script>

<style scoped>
/* Styles are handled by the main.css file */
.search-area {
  padding: 0;
}

.filter-title.collapsed .arrow {
  transform: rotate(-90deg);
}

.filter-content.collapsed {
  max-height: 0;
  overflow: hidden;
}

.filter-content {
  max-height: 1000px;
  transition: max-height 0.3s ease-out;
}

.arrow {
  transition: transform 0.3s ease;
}
</style>
