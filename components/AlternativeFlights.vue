<template>
  <div class="alternative-flights-modal" v-if="visible" @click="closeModal">
    <div class="modal-content" @click.stop>
      <div class="modal-header">
        <h2>Alternative Flights</h2>
        <button class="close-btn" @click="closeModal">&times;</button>
      </div>

      <div class="filters-section">
        <div class="filter-group">
          <label>Sort by:</label>
          <select v-model="sortBy" @change="applySorting">
            <option value="price_low">Price (Low to High)</option>
            <option value="price_high">Price (High to Low)</option>
            <option value="duration_short">Duration (Shortest)</option>
            <option value="departure_early">Departure (Earliest)</option>
          </select>
        </div>

        <div class="filter-group">
          <label>Airlines:</label>
          <select v-model="selectedAirline" @change="applyFilters">
            <option value="">All Airlines</option>
            <option
              v-for="airline in availableAirlines"
              :key="airline"
              :value="airline"
            >
              {{ airline }}
            </option>
          </select>
        </div>

        <div class="filter-group">
          <label>Departure Airport:</label>
          <select v-model="selectedAirport" @change="applyFilters">
            <option value="">All Airports</option>
            <option
              v-for="airport in availableAirports"
              :key="airport"
              :value="airport"
            >
              {{ getAirportCity(airport) }}
            </option>
          </select>
        </div>

        <div class="results-info">
          <span>{{ filteredFlights.length }} flights found</span>
        </div>
      </div>

      <div class="flights-list">
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
            class="flight-option"
            :class="{ selected: selectedFlight?.id === flight.id }"
            @click="selectFlight(flight)"
          >
            <div class="flight-header">
              <div class="airline-info">
                <img
                  :src="getAirlineLogo(flight.outbound.airline)"
                  :alt="flight.outbound.airline"
                  class="airline-logo"
                />
                <span class="airline-name">{{ flight.outbound.airline }}</span>
                <span class="flight-numbers"
                  >{{ flight.outbound.flight_number }} /
                  {{ flight.inbound.flight_number }}</span
                >
              </div>
              <div class="price-info">
                <span class="price">£{{ flight.price.amount }}</span>
                <span class="price-label">per person</span>
                <div
                  v-if="flight.price.amount <= cheapestPrice"
                  class="best-price-badge"
                >
                  Best Price
                </div>
              </div>
            </div>

            <div class="flight-details">
              <!-- Outbound -->
              <div class="flight-leg">
                <div class="leg-header">
                  <span class="flight-icon">✈️</span>
                  <span class="leg-title">Outbound</span>
                  <span class="flight-date">{{
                    formatDate(flight.outbound.date)
                  }}</span>
                </div>
                <div class="leg-details">
                  <div class="time-airport">
                    <span class="time">{{
                      flight.outbound.departure_time
                    }}</span>
                    <span class="airport">{{
                      getAirportCode(flight.outbound.departure_airport)
                    }}</span>
                  </div>
                  <div class="duration-stops">
                    <div class="route-line">
                      <div class="route-dot"></div>
                      <div
                        class="route-path"
                        :class="{ 'has-stops': flight.outbound.stops > 0 }"
                      ></div>
                      <div class="route-dot"></div>
                    </div>
                    <span class="duration">{{ flight.outbound.duration }}</span>
                    <span class="stops">{{
                      formatStops(flight.outbound.stops)
                    }}</span>
                  </div>
                  <div class="time-airport">
                    <span class="time">{{ flight.outbound.arrival_time }}</span>
                    <span class="airport">{{
                      getAirportCode(flight.outbound.arrival_airport)
                    }}</span>
                  </div>
                </div>
              </div>

              <!-- Inbound -->
              <div class="flight-leg">
                <div class="leg-header">
                  <span class="flight-icon">🛬</span>
                  <span class="leg-title">Inbound</span>
                  <span class="flight-date">{{
                    formatDate(flight.inbound.date)
                  }}</span>
                </div>
                <div class="leg-details">
                  <div class="time-airport">
                    <span class="time">{{
                      flight.inbound.departure_time
                    }}</span>
                    <span class="airport">{{
                      getAirportCode(flight.inbound.departure_airport)
                    }}</span>
                  </div>
                  <div class="duration-stops">
                    <div class="route-line">
                      <div class="route-dot"></div>
                      <div
                        class="route-path"
                        :class="{ 'has-stops': flight.inbound.stops > 0 }"
                      ></div>
                      <div class="route-dot"></div>
                    </div>
                    <span class="duration">{{ flight.inbound.duration }}</span>
                    <span class="stops">{{
                      formatStops(flight.inbound.stops)
                    }}</span>
                  </div>
                  <div class="time-airport">
                    <span class="time">{{ flight.inbound.arrival_time }}</span>
                    <span class="airport">{{
                      getAirportCode(flight.inbound.arrival_airport)
                    }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="pagination" v-if="totalPages > 1">
        <button
          class="pagination-btn"
          :disabled="currentPage === 1"
          @click="goToPage(currentPage - 1)"
        >
          ‹ Previous
        </button>

        <span class="pagination-info">
          Page {{ currentPage }} of {{ totalPages }} ({{
            filteredFlights.length
          }}
          flights)
        </span>

        <button
          class="pagination-btn"
          :disabled="currentPage === totalPages"
          @click="goToPage(currentPage + 1)"
        >
          Next ›
        </button>
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
      selectedAirline: "",
      selectedAirport: "",
      currentPage: 1,
      itemsPerPage: 5,
    };
  },
  computed: {
    availableAirlines() {
      return [
        ...new Set(
          this.flightData.search_results.flights.map((f) => f.outbound.airline)
        ),
      ];
    },
    availableAirports() {
      return [
        ...new Set(
          this.flightData.search_results.flights.map(
            (f) => f.outbound.departure_airport
          )
        ),
      ];
    },
    cheapestPrice() {
      return Math.min(
        ...this.flightData.search_results.flights.map((f) => f.price.amount)
      );
    },
    totalPages() {
      return Math.ceil(this.filteredFlights.length / this.itemsPerPage);
    },
    paginatedFlights() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filteredFlights.slice(start, end);
    },
  },
  watch: {
    visible(newVal) {
      if (newVal) {
        this.initializeData();
      }
    },
  },
  methods: {
    initializeData() {
      this.filteredFlights = [...this.flightData.search_results.flights];
      this.selectedFlight = this.currentFlight;
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
      this.currentPage = 1;
    },

    applyFilters() {
      let flights = [...this.flightData.search_results.flights];

      if (this.selectedAirline) {
        flights = flights.filter(
          (f) => f.outbound.airline === this.selectedAirline
        );
      }

      if (this.selectedAirport) {
        flights = flights.filter(
          (f) => f.outbound.departure_airport === this.selectedAirport
        );
      }

      this.filteredFlights = flights;
      this.applySorting();
    },

    resetFilters() {
      this.sortBy = "price_low";
      this.selectedAirline = "";
      this.selectedAirport = "";
      this.currentPage = 1;
      this.initializeData();
    },

    selectFlight(flight) {
      this.selectedFlight = flight;
    },

    confirmSelection() {
      this.$emit("flight-selected", this.selectedFlight);
      this.closeModal();
    },

    closeModal() {
      this.$emit("close");
    },

    goToPage(page) {
      if (page >= 1 && page <= this.totalPages) {
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
      });
    },

    formatStops(stops) {
      return stops === 0 ? "Direct" : stops === 1 ? "1 stop" : `${stops} stops`;
    },

    getAirportCode(airport) {
      const match = airport.match(/\(([^)]+)\)$/);
      return match ? match[1] : airport.split(" ")[0];
    },

    getAirportCity(airport) {
      return airport.split("(")[0].trim();
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
  z-index: 2000;
  padding: 20px;
}

.modal-content {
  background: white;
  border-radius: 12px;
  max-width: 1000px;
  width: 100%;
  max-height: 90vh;
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

.filters-section {
  padding: 20px 30px;
  border-bottom: 1px solid #eee;
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  align-items: flex-end;
}

.filter-group {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.filter-group label {
  font-size: 14px;
  font-weight: 500;
  color: #666;
}

.filter-group select {
  padding: 8px 12px;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-size: 14px;
  min-width: 150px;
}

.results-info {
  margin-left: auto;
  font-size: 14px;
  color: #666;
  font-weight: 500;
}

.flights-list {
  flex: 1;
  overflow-y: auto;
  padding: 20px 30px;
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

.flight-option {
  border: 1px solid #ddd;
  border-radius: 8px;
  margin-bottom: 15px;
  cursor: pointer;
  transition: all 0.2s;
}

.flight-option:hover {
  border-color: #ac7872;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.flight-option.selected {
  border-color: #ac7872;
  background: #f8f9fa;
  box-shadow: 0 0 0 2px rgba(172, 120, 114, 0.1);
}

.flight-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 20px;
  border-bottom: 1px solid #eee;
}

.airline-info {
  display: flex;
  align-items: center;
  gap: 12px;
}

.airline-logo {
  width: 50px;
  height: 30px;
  object-fit: contain;
}

.airline-name {
  font-weight: 600;
  font-size: 16px;
}

.flight-numbers {
  font-size: 12px;
  color: #666;
  background: #f5f5f5;
  padding: 2px 6px;
  border-radius: 4px;
}

.price-info {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  position: relative;
}

.price {
  font-size: 22px;
  font-weight: bold;
  color: #153b3c;
}

.price-label {
  font-size: 12px;
  color: #666;
}

.best-price-badge {
  position: absolute;
  top: -8px;
  right: -8px;
  background: #28a745;
  color: white;
  font-size: 10px;
  padding: 2px 6px;
  border-radius: 3px;
  font-weight: bold;
}

.flight-details {
  padding: 20px;
}

.flight-leg {
  margin-bottom: 20px;
}

.flight-leg:last-child {
  margin-bottom: 0;
}

.leg-header {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 12px;
}

.flight-icon {
  font-size: 16px;
}

.leg-title {
  font-weight: 500;
  color: #333;
}

.flight-date {
  color: #666;
  font-size: 14px;
  margin-left: auto;
}

.leg-details {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-left: 24px;
}

.time-airport {
  display: flex;
  flex-direction: column;
  gap: 4px;
  align-items: center;
}

.time {
  font-weight: bold;
  font-size: 18px;
  color: #333;
}

.airport {
  font-size: 12px;
  color: #666;
  font-weight: 500;
}

.duration-stops {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  flex: 1;
  margin: 0 20px;
}

.route-line {
  display: flex;
  align-items: center;
  width: 100%;
  position: relative;
}

.route-dot {
  width: 8px;
  height: 8px;
  background: #333;
  border-radius: 50%;
  z-index: 2;
}

.route-path {
  flex: 1;
  height: 2px;
  background: #333;
  margin: 0 4px;
  position: relative;
}

.route-path.has-stops::after {
  content: "";
  position: absolute;
  top: -3px;
  left: 50%;
  transform: translateX(-50%);
  width: 8px;
  height: 8px;
  background: #ffa500;
  border-radius: 50%;
}

.duration {
  font-weight: 500;
  font-size: 14px;
  color: #333;
}

.stops {
  font-size: 12px;
  color: #666;
}

.pagination {
  padding: 15px 30px;
  border-top: 1px solid #eee;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.pagination-btn {
  background: #f8f9fa;
  border: 1px solid #ddd;
  padding: 8px 16px;
  border-radius: 6px;
  cursor: pointer;
  font-size: 14px;
  transition: all 0.2s;
}

.pagination-btn:hover:not(:disabled) {
  background: #e9ecef;
  border-color: #adb5bd;
}

.pagination-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.pagination-info {
  font-size: 14px;
  color: #666;
}

.modal-footer {
  padding: 20px 30px;
  border-top: 1px solid #eee;
  display: flex;
  justify-content: space-between;
  align-items: center;
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

@media (max-width: 768px) {
  .modal-content {
    margin: 10px;
    max-height: 95vh;
  }

  .filters-section {
    flex-direction: column;
    gap: 15px;
  }

  .filter-group select {
    min-width: auto;
    width: 100%;
  }

  .leg-details {
    flex-direction: column;
    gap: 15px;
    align-items: center;
  }

  .duration-stops {
    margin: 0;
    width: 100%;
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
}
</style>
