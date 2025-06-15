<template>
  <div class="alternative-flights-modal" v-if="visible" @click="closeModal">
    <div class="modal-content" @click.stop>
      <div class="modal-header">
        <h2>Alternative Flights</h2>
        <button class="close-btn" @click="closeModal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="flights-content">
          <!-- Sidebar Filters -->
          <div class="sidebar">
            <!-- Stops Filter -->
            <div class="filter-section">
              <div class="filter-title" @click="toggleFilterSection('stops')">
                <span>Stops</span>
                <svg
                  class="arrow"
                  :class="{ collapsed: !expandedSections.stops }"
                  viewBox="0 0 24 24"
                >
                  <path d="M8 10l4 4 4-4z" />
                </svg>
              </div>
              <div
                class="filter-content"
                :class="{ collapsed: !expandedSections.stops }"
              >
                <div class="filter-list">
                  <div class="filter-item" @click="toggleStopFilter('any')">
                    <div class="filter-item-left">
                      <div
                        class="filter-checkbox"
                        :class="{ checked: filters.stops === 'any' }"
                      ></div>
                      <span class="filter-label">Any</span>
                    </div>
                  </div>
                  <div class="filter-item" @click="toggleStopFilter('direct')">
                    <div class="filter-item-left">
                      <div
                        class="filter-checkbox"
                        :class="{ checked: filters.stops === 'direct' }"
                      ></div>
                      <span class="filter-label">Direct</span>
                    </div>
                    <span class="filter-price">£1,409</span>
                  </div>
                  <div class="filter-item" @click="toggleStopFilter('1-stop')">
                    <div class="filter-item-left">
                      <div
                        class="filter-checkbox"
                        :class="{ checked: filters.stops === '1-stop' }"
                      ></div>
                      <span class="filter-label">1 stop</span>
                    </div>
                    <span class="filter-price">£1,459</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Departure From Filter -->
            <div class="filter-section">
              <div
                class="filter-title"
                @click="toggleFilterSection('departure')"
              >
                <span>Departure from</span>
                <svg
                  class="arrow"
                  :class="{ collapsed: !expandedSections.departure }"
                  viewBox="0 0 24 24"
                >
                  <path d="M8 10l4 4 4-4z" />
                </svg>
              </div>
              <div
                class="filter-content"
                :class="{ collapsed: !expandedSections.departure }"
              >
                <div class="filter-list">
                  <div
                    v-for="airport in departureAirports"
                    :key="airport.code"
                    class="filter-item"
                    @click="toggleDepartureFilter(airport.code)"
                  >
                    <div class="filter-item-left">
                      <div
                        class="filter-checkbox"
                        :class="{ checked: filters.departure === airport.code }"
                      ></div>
                      <span class="filter-label">{{ airport.name }}</span>
                    </div>
                    <span v-if="airport.price" class="filter-price">{{
                      airport.price
                    }}</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Airlines Filter -->
            <div class="filter-section">
              <div
                class="filter-title"
                @click="toggleFilterSection('airlines')"
              >
                <span>Airlines</span>
                <svg
                  class="arrow"
                  :class="{ collapsed: !expandedSections.airlines }"
                  viewBox="0 0 24 24"
                >
                  <path d="M8 10l4 4 4-4z" />
                </svg>
              </div>
              <div
                class="filter-content"
                :class="{ collapsed: !expandedSections.airlines }"
              >
                <div class="filter-list">
                  <div
                    v-for="airline in airlinesOptions"
                    :key="airline.code"
                    class="filter-item"
                    @click="toggleAirlineFilter(airline.code)"
                  >
                    <div class="filter-item-left">
                      <div
                        class="filter-checkbox"
                        :class="{
                          checked: filters.airlines.includes(airline.code),
                        }"
                      ></div>
                      <img
                        v-if="airline.logo"
                        :src="airline.logo"
                        :alt="airline.name"
                        class="airline-logo-filter"
                        @error="$event.target.style.display = 'none'"
                      />
                      <span class="filter-label">{{ airline.name }}</span>
                    </div>
                    <span v-if="airline.price" class="filter-price">{{
                      airline.price
                    }}</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Duration Pills -->
            <div class="filter-section">
              <div class="filter-title">
                <span>Duration</span>
              </div>
              <div class="filter-content">
                <div class="duration-pills">
                  <div
                    v-for="period in durationPeriods"
                    :key="period.nights"
                    class="duration-pill"
                    :class="{ active: filters.duration === period.nights }"
                    @click="toggleDurationFilter(period.nights)"
                  >
                    <span class="duration-pill-label">{{ period.label }}</span>
                    <span class="duration-pill-price"
                      >from {{ period.price }} {{ period.note }}</span
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Flights List -->
          <div class="flights-list">
            <div class="flights-list-header">
              <div class="results-info">
                <span>{{ filteredFlights.length }} flights found</span>
              </div>
              <div class="sort-controls">
                <label>Sort by:</label>
                <select v-model="sortBy" @change="applySorting">
                  <option value="price_low">Price (Low to High)</option>
                  <option value="price_high">Price (High to Low)</option>
                  <option value="duration_short">Duration (Shortest)</option>
                  <option value="departure_early">Departure (Earliest)</option>
                </select>
              </div>
            </div>

            <div v-if="paginatedFlights.length === 0" class="no-results">
              <p>No flights found matching your criteria.</p>
              <button class="reset-filters-btn" @click="resetFilters">
                Reset Filters
              </button>
            </div>

            <div v-else>
              <div
                v-for="flight in paginatedFlights"
                :key="flight.id"
                class="flight-card"
              >
                <!-- Flight Details Section -->
                <div class="flight-details-section">
                  <!-- Outbound Flight Row -->
                  <div class="flight-row">
                    <div class="flight-date-info">
                      <span class="flight-icon">✈️</span>
                      <div class="flight-date-text">
                        <div class="flight-date-main">
                          {{ formatDate(flight.outbound.date) }}
                        </div>
                        <div class="flight-direction">Outbound</div>
                      </div>
                    </div>

                    <div class="flight-times">
                      <div class="flight-time-group">
                        <div class="flight-time-row">
                          <div class="flight-dot"></div>
                          <div class="flight-time">
                            {{ flight.outbound.departure_time }}
                          </div>
                          <div class="flight-airport">
                            {{ flight.outbound.departure_airport }}
                          </div>
                        </div>
                        <div class="flight-connecting-line"></div>
                        <div class="flight-duration-info">
                          <div class="flight-duration-badges">
                            <div class="duration-badge">
                              ⏱️ {{ flight.outbound.duration }}
                            </div>
                            <div class="duration-badge">
                              {{ formatStops(flight.outbound.stops) }} ●
                            </div>
                          </div>
                        </div>
                        <div class="flight-time-row">
                          <div class="flight-dot"></div>
                          <div class="flight-time">
                            {{ flight.outbound.arrival_time
                            }}{{
                              flight.outbound.arrival_time <
                              flight.outbound.departure_time
                                ? "+1"
                                : ""
                            }}
                          </div>
                          <div class="flight-airport">
                            {{ flight.outbound.arrival_airport }}
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="airline-section">
                      <img
                        :src="getAirlineLogo(flight.outbound.airline)"
                        :alt="flight.outbound.airline"
                        class="airline-logo"
                      />
                      <div class="flight-number">
                        {{ flight.outbound.flight_number }}
                      </div>
                    </div>
                  </div>

                  <!-- Inbound Flight Row -->
                  <div class="flight-row">
                    <div class="flight-date-info">
                      <span class="flight-icon">🛬</span>
                      <div class="flight-date-text">
                        <div class="flight-date-main">
                          {{ formatDate(flight.inbound.date) }}
                        </div>
                        <div class="flight-direction">Inbound</div>
                      </div>
                    </div>

                    <div class="flight-times">
                      <div class="flight-time-group">
                        <div class="flight-time-row">
                          <div class="flight-dot"></div>
                          <div class="flight-time">
                            {{ flight.inbound.departure_time }}
                          </div>
                          <div class="flight-airport">
                            {{ flight.inbound.departure_airport }}
                          </div>
                        </div>
                        <div class="flight-connecting-line"></div>
                        <div class="flight-duration-info">
                          <div class="flight-duration-badges">
                            <div class="duration-badge">
                              ⏱️ {{ flight.inbound.duration }}
                            </div>
                            <div class="duration-badge">
                              {{ formatStops(flight.inbound.stops) }} ●
                            </div>
                          </div>
                        </div>
                        <div class="flight-time-row">
                          <div class="flight-dot"></div>
                          <div class="flight-time">
                            {{ flight.inbound.arrival_time }}
                          </div>
                          <div class="flight-airport">
                            {{ flight.inbound.arrival_airport }}
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="airline-section">
                      <img
                        :src="getAirlineLogo(flight.inbound.airline)"
                        :alt="flight.inbound.airline"
                        class="airline-logo"
                      />
                      <div class="flight-number">
                        {{ flight.inbound.flight_number }}
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Pricing Section -->
                <div class="flight-pricing-section">
                  <div class="flight-price">£{{ flight.price.amount }}</div>
                  <div class="flight-price-note">pp</div>
                  <button
                    class="flight-select-btn"
                    @click="selectFlight(flight)"
                  >
                    Flights + Hotel
                  </button>
                </div>
              </div>
            </div>

            <!-- Pagination -->
            <div class="pagination-container" v-if="totalPages > 1">
              <div class="pagination">
                <button
                  class="pagination-btn"
                  :disabled="currentPage === 1"
                  @click="goToPage(currentPage - 1)"
                >
                  ‹
                </button>
                <button
                  v-for="page in visiblePages"
                  :key="page"
                  class="pagination-btn"
                  :class="{ active: currentPage === page }"
                  @click="goToPage(page)"
                >
                  {{ page }}
                </button>
                <button
                  class="pagination-btn"
                  :disabled="currentPage === totalPages"
                  @click="goToPage(currentPage + 1)"
                >
                  ›
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer" v-if="selectedFlight">
        <div class="selected-flight-info">
          <div class="selected-flight-details">
            <strong>{{ selectedFlight.outbound.airline }}</strong> - £{{
              selectedFlight.price.amount
            }}
            per person
          </div>
          <div class="selected-flight-route">
            {{ getAirportCode(selectedFlight.outbound.departure_airport) }} →
            {{ getAirportCode(selectedFlight.outbound.arrival_airport) }} →
            {{ getAirportCode(selectedFlight.inbound.arrival_airport) }}
          </div>
        </div>
        <div class="action-buttons">
          <button class="cancel-btn" @click="closeModal">Cancel</button>
          <button class="select-btn" @click="confirmSelection">
            Select This Flight
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import flightData from "@/static/data/flights.json";

export default {
  name: "AlternativeFlights",
  props: {
    visible: {
      type: Boolean,
      default: false,
    },
    currentFlight: {
      type: Object,
      default: null,
    },
  },
  emits: ["close", "flight-selected"],
  data() {
    return {
      flightData,
      filteredFlights: [],
      selectedFlight: null,
      sortBy: "price_low",
      currentPage: 1,
      itemsPerPage: 10,

      // Filter states
      filters: {
        stops: "any",
        departure: "any",
        airlines: [],
        duration: 5,
      },

      // Expanded sections
      expandedSections: {
        stops: true,
        departure: true,
        airlines: true,
        duration: true,
      },

      // Filter options
      departureAirports: [
        { code: "any", name: "Any", price: "" },
        { code: "ABZ", name: "Aberdeen", price: "£1,679" },
        { code: "BHD", name: "Belfast City", price: "£1,689" },
        { code: "BHX", name: "Birmingham", price: "£1,459" },
        { code: "CWL", name: "Cardiff", price: "£1,919" },
        { code: "EDI", name: "Edinburgh", price: "£1,479" },
        { code: "GLA", name: "Glasgow", price: "£1,609" },
        { code: "LGW", name: "London Gatwick", price: "£1,479" },
        { code: "LHR", name: "London Heathrow", price: "£1,489" },
        { code: "STN", name: "London Stansted", price: "£1,459" },
        { code: "MAN", name: "Manchester", price: "£1,389" },
      ],

      airlinesOptions: [
        { code: "any", name: "Any", price: "", logo: null },
        {
          code: "ajet",
          name: "AJet",
          price: "£1,459",
          logo: "https://airhex.com/images/airline-logos/alt/ajet.png",
        },
        {
          code: "saudia",
          name: "Saudia",
          price: "£1,389",
          logo: "https://airhex.com/images/airline-logos/alt/saudia.png",
        },
        {
          code: "eurowings",
          name: "Eurowings",
          price: "£1,479",
          logo: "https://airhex.com/images/airline-logos/alt/eurowings.png",
        },
        {
          code: "turkish",
          name: "Turkish Airlines",
          price: "£1,479",
          logo: "https://airhex.com/images/airline-logos/alt/turkish-airlines.png",
        },
        {
          code: "emirates",
          name: "Emirates",
          price: "£1,509",
          logo: "https://airhex.com/images/airline-logos/alt/emirates.png",
        },
        {
          code: "ba",
          name: "British Airways",
          price: "£1,589",
          logo: "https://airhex.com/images/airline-logos/alt/british-airways.png",
        },
      ],

      durationPeriods: [
        { nights: 2, label: "2 Nights", price: "£999", note: "pp" },
        { nights: 3, label: "3 Nights", price: "£1,289", note: "pp" },
        { nights: 4, label: "4 Nights", price: "£1,259", note: "pp" },
        { nights: 5, label: "5 Nights", price: "£1,459", note: "pp" },
        { nights: 6, label: "6-8 Nights", price: "£1,609", note: "pp" },
        { nights: 9, label: "9-11 Nights", price: "£2,039", note: "pp" },
        { nights: 12, label: "12-15 Nights", price: "£2,539", note: "pp" },
      ],
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.filteredFlights.length / this.itemsPerPage);
    },
    paginatedFlights() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filteredFlights.slice(start, end);
    },
    visiblePages() {
      const pages = [];
      const total = this.totalPages;
      const current = this.currentPage;

      if (total <= 7) {
        for (let i = 1; i <= total; i++) {
          pages.push(i);
        }
      } else {
        if (current <= 4) {
          for (let i = 1; i <= 5; i++) {
            pages.push(i);
          }
          pages.push("...");
          pages.push(total);
        } else if (current >= total - 3) {
          pages.push(1);
          pages.push("...");
          for (let i = total - 4; i <= total; i++) {
            pages.push(i);
          }
        } else {
          pages.push(1);
          pages.push("...");
          for (let i = current - 1; i <= current + 1; i++) {
            pages.push(i);
          }
          pages.push("...");
          pages.push(total);
        }
      }

      return pages;
    },
  },
  watch: {
    visible(newVal) {
      console.log("AlternativeFlights modal visibility changed:", newVal);
      if (newVal) {
        this.initializeData();
      }
    },
  },
  methods: {
    initializeData() {
      console.log("Initializing AlternativeFlights data...");
      const flights = this.flightData?.search_results?.flights || [];
      this.filteredFlights = [...flights];
      this.selectedFlight = this.currentFlight;
      this.applyFilters();
      this.currentPage = 1;
    },

    toggleFilterSection(section) {
      this.expandedSections[section] = !this.expandedSections[section];
    },

    toggleStopFilter(value) {
      this.filters.stops = value;
      this.applyFilters();
    },

    toggleDepartureFilter(value) {
      this.filters.departure = value;
      this.applyFilters();
    },

    toggleAirlineFilter(value) {
      if (value === "any") {
        this.filters.airlines = [];
      } else {
        const index = this.filters.airlines.indexOf(value);
        if (index > -1) {
          this.filters.airlines.splice(index, 1);
        } else {
          this.filters.airlines.push(value);
        }
      }
      this.applyFilters();
    },

    toggleDurationFilter(nights) {
      this.filters.duration = nights;
      this.applyFilters();
    },

    applyFilters() {
      const allFlights = this.flightData?.search_results?.flights || [];
      let flights = [...allFlights];

      // Apply stops filter
      if (this.filters.stops === "direct") {
        flights = flights.filter(
          (f) => f.outbound.stops === 0 && f.inbound.stops === 0
        );
      } else if (this.filters.stops === "1-stop") {
        flights = flights.filter(
          (f) => f.outbound.stops === 1 || f.inbound.stops === 1
        );
      }

      // Apply departure airport filter
      if (this.filters.departure !== "any") {
        flights = flights.filter((f) =>
          f.outbound.departure_airport.includes(this.filters.departure)
        );
      }

      // Apply airline filter
      if (this.filters.airlines.length > 0) {
        flights = flights.filter((f) =>
          this.filters.airlines.some((airline) =>
            f.outbound.airline.toLowerCase().includes(airline.toLowerCase())
          )
        );
      }

      this.filteredFlights = flights;
      this.applySorting();
      this.currentPage = 1;
    },

    applySorting() {
      switch (this.sortBy) {
        case "price_low":
          this.filteredFlights.sort((a, b) => a.price.amount - b.price.amount);
          break;
        case "price_high":
          this.filteredFlights.sort((a, b) => b.price.amount - a.price.amount);
          break;
        case "duration_short":
          this.filteredFlights.sort((a, b) => {
            const durationA = this.parseDuration(a.outbound.duration);
            const durationB = this.parseDuration(b.outbound.duration);
            return durationA - durationB;
          });
          break;
        case "departure_early":
          this.filteredFlights.sort((a, b) => {
            const timeA = this.parseTime(a.outbound.departure_time);
            const timeB = this.parseTime(b.outbound.departure_time);
            return timeA - timeB;
          });
          break;
      }
    },

    resetFilters() {
      this.filters = {
        stops: "any",
        departure: "any",
        airlines: [],
        duration: 5,
      };
      this.sortBy = "price_low";
      this.currentPage = 1;
      this.initializeData();
    },

    selectFlight(flight) {
      console.log("Flight selected:", flight);
      this.selectedFlight = flight;
    },

    confirmSelection() {
      console.log("Confirming flight selection:", this.selectedFlight);
      this.$emit("flight-selected", this.selectedFlight);
      this.closeModal();
    },

    closeModal() {
      console.log("Closing AlternativeFlights modal");
      this.$emit("close");
    },

    goToPage(page) {
      if (page >= 1 && page <= this.totalPages && page !== "...") {
        this.currentPage = page;
      }
    },

    // Helper methods
    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString("en-GB", {
        weekday: "short",
        day: "numeric",
        month: "short",
        year: "numeric",
      });
    },

    formatStops(stops) {
      return stops === 0 ? "Direct" : stops === 1 ? "1 stop" : `${stops} stops`;
    },

    getAirportCode(airport) {
      const match = airport.match(/\(([^)]+)\)$/);
      return match ? match[1] : airport.split(" ")[0];
    },

    getAirlineLogo(airline) {
      const logoMap = {
        ajet: "https://airhex.com/images/airline-logos/alt/ajet.png",
        Saudia: "https://airhex.com/images/airline-logos/alt/saudia.png",
        Eurowings: "https://airhex.com/images/airline-logos/alt/eurowings.png",
        "Turkish Airlines":
          "https://airhex.com/images/airline-logos/alt/turkish-airlines.png",
      };

      return (
        logoMap[airline] ||
        "https://airhex.com/images/airline-logos/alt/default.png"
      );
    },

    parseDuration(duration) {
      const hours = parseInt(duration.match(/(\d+)h/)?.[1] || 0);
      const minutes = parseInt(duration.match(/(\d+)m/)?.[1] || 0);
      return hours * 60 + minutes;
    },

    parseTime(time) {
      const [hours, minutes] = time.split(":").map(Number);
      return hours * 60 + minutes;
    },
  },
};
</script>

<style scoped>
.alternative-flights-modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999 !important;
  padding: 20px;
}

.modal-content {
  background: white;
  border-radius: 12px;
  max-width: 1400px;
  width: 100%;
  max-height: 95vh;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.modal-header {
  padding: 20px 30px;
  border-bottom: 1px solid #eee;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.modal-header h2 {
  font-size: 24px;
  font-weight: 600;
  color: #333;
  margin: 0;
}

.close-btn {
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  padding: 5px;
  color: #666;
  transition: color 0.2s;
}

.close-btn:hover {
  color: #333;
}

.modal-body {
  flex: 1;
  overflow: hidden;
  padding: 20px 30px;
}

/* Flights Content Layout */
.flights-content {
  display: flex;
  gap: 30px;
  height: 100%;
}

/* Sidebar */
.sidebar {
  width: 280px;
  flex-shrink: 0;
  overflow-y: auto;
  max-height: 70vh;
}

.filter-section {
  background: white;
  padding: 15px;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  margin-bottom: 15px;
}

.filter-title {
  font-weight: bold;
  margin-bottom: 15px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  cursor: pointer;
}

.filter-title .arrow {
  transition: transform 0.3s;
  width: 16px;
  height: 16px;
  fill: #666;
}

.filter-title .arrow.collapsed {
  transform: rotate(-90deg);
}

.filter-content {
  max-height: 300px;
  overflow: hidden;
  transition: max-height 0.3s ease-out;
}

.filter-content.collapsed {
  max-height: 0;
}

.filter-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.filter-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  cursor: pointer;
  padding: 2px 0;
}

.filter-item:hover {
  color: #ac7872;
}

.filter-item-left {
  display: flex;
  align-items: center;
  gap: 10px;
  flex: 1;
}

.airline-logo-filter {
  width: 44px;
  height: 16px;
  object-fit: contain;
  background: white;
  border-radius: 2px;
}

.filter-checkbox {
  width: 16px;
  height: 16px;
  border: 1px solid #ddd;
  border-radius: 3px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}

.filter-checkbox.checked {
  background: #ac7872;
  border-color: #ac7872;
  color: white;
}

.filter-checkbox.checked::after {
  content: "✓";
  font-size: 12px;
  font-weight: bold;
}

.filter-label {
  font-size: 14px;
}

.filter-price {
  font-size: 13px;
  color: #666;
}

/* Duration Pills */
.duration-pills {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.duration-pill {
  padding: 10px 14px;
  border: 1px solid #ddd;
  border-radius: 6px;
  text-align: center;
  cursor: pointer;
  transition: all 0.3s;
  background: white;
}

.duration-pill.active {
  background: #ac7872;
  color: white;
  border-color: #ac7872;
}

.duration-pill:hover:not(.active) {
  border-color: #ac7872;
}

.duration-pill-label {
  font-size: 13px;
  font-weight: bold;
  display: block;
  margin-bottom: 2px;
}

.duration-pill-price {
  font-size: 11px;
}

/* Flights List */
.flights-list {
  flex: 1;
  overflow-y: auto;
  max-height: 70vh;
}

.flights-list-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding: 10px 0;
}

.results-info {
  font-size: 14px;
  color: #666;
  font-weight: 500;
}

.sort-controls {
  display: flex;
  align-items: center;
  gap: 10px;
}

.sort-controls label {
  font-size: 14px;
  font-weight: 500;
  color: #666;
}

.sort-controls select {
  padding: 8px 12px;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-size: 14px;
}

.no-results {
  text-align: center;
  padding: 40px;
}

.reset-filters-btn {
  background: #ac7872;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 6px;
  cursor: pointer;
  margin-top: 15px;
}

/* Flight Card */
.flight-card {
  border: 1px solid #ddd;
  border-radius: 12px;
  margin-bottom: 15px;
  overflow: hidden;
  background: white;
  transition: box-shadow 0.3s;
  display: flex;
  min-height: 120px;
}

.flight-card:hover {
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Flight Details Section */
.flight-details-section {
  flex: 1;
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 0;
}

.flight-row {
  display: flex;
  align-items: center;
  gap: 20px;
  padding: 15px 0;
  border-bottom: 1px solid #f0f0f0;
}

.flight-row:last-child {
  border-bottom: none;
}

.flight-date-info {
  display: flex;
  align-items: center;
  gap: 12px;
  min-width: 140px;
}

.flight-icon {
  font-size: 16px;
  width: 20px;
}

.flight-date-text {
  display: flex;
  flex-direction: column;
}

.flight-date-main {
  font-weight: bold;
  font-size: 14px;
  color: #333;
}

.flight-direction {
  font-size: 12px;
  color: #666;
}

.flight-times {
  display: flex;
  align-items: flex-start;
  gap: 20px;
  flex: 1;
}

.flight-time-group {
  display: flex;
  flex-direction: column;
  position: relative;
  min-width: 250px;
}

.flight-time-row {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 8px;
}

.flight-time-row:last-child {
  margin-bottom: 0;
}

.flight-dot {
  width: 6px;
  height: 6px;
  background-color: #666;
  border-radius: 50%;
  flex-shrink: 0;
  position: relative;
  z-index: 2;
}

.flight-connecting-line {
  position: absolute;
  left: 2.5px;
  top: 12px;
  width: 1px;
  height: 25px;
  background-color: #ddd;
  z-index: 1;
}

.flight-time {
  font-weight: bold;
  font-size: 16px;
  color: #333;
  min-width: 60px;
}

.flight-airport {
  color: #666;
  font-size: 14px;
  flex: 1;
}

.flight-duration-info {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-left: 14px;
  margin-bottom: 8px;
}

.flight-duration-badges {
  display: flex;
  gap: 5px;
}

.duration-badge {
  background-color: #f0f0f0;
  color: #666;
  padding: 2px 6px;
  border-radius: 12px;
  font-size: 11px;
  display: flex;
  align-items: center;
  gap: 3px;
}

.airline-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 5px;
  min-width: 70px;
}

.airline-logo {
  width: 60px;
  height: 24px;
  object-fit: contain;
  background: white;
}

.flight-number {
  font-size: 11px;
  color: #666;
  text-align: center;
}

/* Pricing Section */
.flight-pricing-section {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-end;
  padding: 20px;
  min-width: 160px;
  text-align: right;
  border-left: 1px solid #f0f0f0;
}

.flight-price {
  font-size: 32px;
  font-weight: bold;
  color: #333;
  line-height: 1;
}

.flight-price-note {
  font-size: 16px;
  color: #666;
  margin-bottom: 15px;
}

.flight-select-btn {
  background: #153b3c;
  color: white;
  border: none;
  padding: 12px 20px;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s;
  font-size: 14px;
}

.flight-select-btn:hover {
  background: #0f2b2c;
}

/* Pagination */
.pagination-container {
  display: flex;
  justify-content: flex-start;
  margin-top: 30px;
  padding-top: 20px;
  border-top: 1px solid #eee;
}

.pagination {
  display: flex;
  align-items: center;
  gap: 8px;
}

.pagination-btn {
  width: 36px;
  height: 36px;
  border: 1px solid #ddd;
  background: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  font-size: 14px;
  font-weight: 500;
  transition: all 0.3s;
  text-decoration: none;
  color: #666;
}

.pagination-btn:hover:not(:disabled) {
  border-color: #ac7872;
  color: #ac7872;
}

.pagination-btn.active {
  background: #333;
  color: white;
  border-color: #333;
}

.pagination-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

/* Modal Footer */
.modal-footer {
  padding: 20px 30px;
  border-top: 1px solid #eee;
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #f8f9fa;
}

.selected-flight-info {
  flex: 1;
}

.selected-flight-details {
  font-weight: 600;
  color: #333;
  margin-bottom: 4px;
}

.selected-flight-route {
  font-size: 14px;
  color: #666;
}

.action-buttons {
  display: flex;
  gap: 12px;
}

.cancel-btn {
  background: white;
  color: #333;
  border: 2px solid #ddd;
  padding: 10px 20px;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s;
}

.cancel-btn:hover {
  border-color: #bbb;
}

.select-btn {
  background: #153b3c;
  color: white;
  border: none;
  padding: 12px 24px;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 500;
  transition: background-color 0.2s;
}

.select-btn:hover {
  background: #0f2d2e;
}

/* Responsive Design */
@media (max-width: 1200px) {
  .modal-content {
    max-width: 95vw;
  }

  .flights-content {
    flex-direction: column;
  }

  .sidebar {
    width: 100%;
    max-height: 40vh;
    display: flex;
    gap: 15px;
    overflow-x: auto;
  }

  .filter-section {
    min-width: 250px;
    flex-shrink: 0;
  }
}

@media (max-width: 768px) {
  .modal-content {
    margin: 10px;
    max-height: 95vh;
  }

  .modal-body {
    padding: 15px;
  }

  .flights-content {
    gap: 20px;
  }

  .flight-card {
    flex-direction: column;
    min-height: auto;
  }

  .flight-row {
    flex-direction: column;
    gap: 10px;
    align-items: flex-start;
  }

  .flight-times {
    width: 100%;
  }

  .flight-pricing-section {
    align-items: center;
    border-top: 1px solid #eee;
    border-left: none;
    padding-top: 15px;
  }

  .modal-footer {
    flex-direction: column;
    gap: 15px;
    align-items: stretch;
  }

  .action-buttons {
    justify-content: stretch;
  }

  .cancel-btn,
  .select-btn {
    flex: 1;
  }

  .duration-pills {
    flex-direction: row;
    overflow-x: auto;
    gap: 10px;
  }

  .duration-pill {
    min-width: 120px;
    flex-shrink: 0;
  }
}
</style>
