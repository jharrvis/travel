<template>
  <div class="alternative-flights">
    <div class="alternative-flights-inner">
      <h2 class="alternative-flights-title">Alternative flights</h2>

      <div class="flights-content">
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Stops Filter -->
          <div class="filter-section">
            <div class="filter-title" @click="toggleFilter('stops')">
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
                <div
                  v-for="stop in stopsOptions"
                  :key="stop.name"
                  class="filter-item"
                  @click="toggleFilterCheckbox('stops', stop.name)"
                >
                  <div class="filter-item-left">
                    <div
                      class="filter-checkbox"
                      :class="{ checked: filters.stops === stop.name }"
                    ></div>
                    <span class="filter-label">{{ stop.name }}</span>
                  </div>
                  <span v-if="stop.price" class="filter-price">{{
                    stop.price
                  }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Departure From Filter -->
          <div class="filter-section">
            <div class="filter-title" @click="toggleFilter('departure')">
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
                  :key="airport.name"
                  class="filter-item"
                  @click="toggleFilterCheckbox('departure', airport.name)"
                >
                  <div class="filter-item-left">
                    <div
                      class="filter-checkbox"
                      :class="{ checked: filters.departure === airport.name }"
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
            <div class="filter-title" @click="toggleFilter('airlines')">
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
                  :key="airline.name"
                  class="filter-item"
                  @click="toggleFilterCheckbox('airlines', airline.name)"
                >
                  <div class="filter-item-left">
                    <div
                      class="filter-checkbox"
                      :class="{
                        checked: filters.airlines.includes(airline.name),
                      }"
                    ></div>
                    <img
                      v-if="airline.logo && airline.name !== 'Any'"
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

          <!-- Outbound Times Filter -->
          <div class="filter-section">
            <div class="filter-title" @click="toggleFilter('outboundTimes')">
              <span>Outbound times</span>
              <svg
                class="arrow"
                :class="{ collapsed: !expandedSections.outboundTimes }"
                viewBox="0 0 24 24"
              >
                <path d="M8 10l4 4 4-4z" />
              </svg>
            </div>
            <div
              class="filter-content"
              :class="{ collapsed: !expandedSections.outboundTimes }"
            >
              <div class="filter-list">
                <div
                  v-for="time in outboundTimesOptions"
                  :key="time.name"
                  class="filter-item"
                  @click="toggleFilterCheckbox('outboundTimes', time.name)"
                >
                  <div class="filter-item-left">
                    <div
                      class="filter-checkbox"
                      :class="{ checked: filters.outboundTimes === time.name }"
                    ></div>
                    <div
                      v-if="time.timeRange"
                      style="display: flex; flex-direction: column"
                    >
                      <span class="filter-label">{{ time.name }}</span>
                      <span style="font-size: 11px; color: #999">{{
                        time.timeRange
                      }}</span>
                    </div>
                    <span v-else class="filter-label">{{ time.name }}</span>
                  </div>
                  <span v-if="time.price" class="filter-price">{{
                    time.price
                  }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Inbound Times Filter -->
          <div class="filter-section">
            <div class="filter-title" @click="toggleFilter('inboundTimes')">
              <span>Inbound times</span>
              <svg
                class="arrow"
                :class="{ collapsed: !expandedSections.inboundTimes }"
                viewBox="0 0 24 24"
              >
                <path d="M8 10l4 4 4-4z" />
              </svg>
            </div>
            <div
              class="filter-content"
              :class="{ collapsed: !expandedSections.inboundTimes }"
            >
              <div class="filter-list">
                <div
                  v-for="time in inboundTimesOptions"
                  :key="time.name"
                  class="filter-item"
                  @click="toggleFilterCheckbox('inboundTimes', time.name)"
                >
                  <div class="filter-item-left">
                    <div
                      class="filter-checkbox"
                      :class="{ checked: filters.inboundTimes === time.name }"
                    ></div>
                    <div
                      v-if="time.timeRange"
                      style="display: flex; flex-direction: column"
                    >
                      <span class="filter-label">{{ time.name }}</span>
                      <span style="font-size: 11px; color: #999">{{
                        time.timeRange
                      }}</span>
                    </div>
                    <span v-else class="filter-label">{{ time.name }}</span>
                  </div>
                  <span v-if="time.price" class="filter-price">{{
                    time.price
                  }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Journey Duration Filter -->
          <div class="filter-section">
            <div class="filter-title" @click="toggleFilter('journeyDuration')">
              <span>Journey duration</span>
              <svg
                class="info-icon"
                viewBox="0 0 24 24"
                style="width: 16px; height: 16px; fill: #666; margin-left: 5px"
              >
                <path
                  d="M12,2C6.48,2 2,6.48 2,12C2,17.52 6.48,22 12,22C17.52,22 22,17.52 22,12C22,6.48 17.52,2 12,2ZM13,17H11V11H13V17ZM13,9H11V7H13V9Z"
                />
              </svg>
              <svg
                class="arrow"
                :class="{ collapsed: !expandedSections.journeyDuration }"
                viewBox="0 0 24 24"
                style="margin-left: auto"
              >
                <path d="M8 10l4 4 4-4z" />
              </svg>
            </div>
            <div
              class="filter-content"
              :class="{ collapsed: !expandedSections.journeyDuration }"
            >
              <div class="duration-range-container">
                <div class="duration-range-labels">
                  <span>{{ durationRangeText }}</span>
                </div>
                <div class="duration-slider">
                  <div class="slider-track"></div>
                  <div
                    class="slider-range"
                    :style="{ width: sliderProgress + '%' }"
                  ></div>
                  <div
                    class="slider-thumb slider-thumb-left"
                    :style="{ left: '0%' }"
                  ></div>
                  <div
                    class="slider-thumb slider-thumb-right"
                    :style="{ left: sliderProgress + '%' }"
                  ></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Red Eye Flights Filter -->
          <div class="filter-section">
            <div class="filter-title" @click="toggleFilter('redEyeFlights')">
              <span>Red eye flights</span>
              <svg
                class="moon-icon"
                viewBox="0 0 24 24"
                style="width: 16px; height: 16px; fill: #666; margin-left: 5px"
              >
                <path
                  d="M17.75,4.09L15.22,6.03L16.13,9.09L13.5,7.28L10.87,9.09L11.78,6.03L9.25,4.09L12.44,4L13.5,1L14.56,4L17.75,4.09M21.25,11L19.61,12.25L20.2,14.23L18.5,13.06L16.8,14.23L17.39,12.25L15.75,11L17.81,10.95L18.5,9L19.19,10.95L21.25,11M12.97,15.91L10.44,17.85L11.35,20.91L8.72,19.1L6.09,20.91L7,17.85L4.47,15.91L7.66,15.82L8.72,12.82L9.78,15.82L12.97,15.91Z"
                />
              </svg>
              <svg
                class="arrow"
                :class="{ collapsed: !expandedSections.redEyeFlights }"
                viewBox="0 0 24 24"
                style="margin-left: auto"
              >
                <path d="M8 10l4 4 4-4z" />
              </svg>
            </div>
            <div
              class="filter-content"
              :class="{ collapsed: !expandedSections.redEyeFlights }"
            >
              <div class="filter-list">
                <div class="filter-item" @click="toggleRedEyeFilter()">
                  <div class="filter-item-left">
                    <div
                      class="filter-checkbox"
                      :class="{ checked: filters.hideRedEye }"
                    ></div>
                    <span class="filter-label">Hide red-eye flights</span>
                  </div>
                  <span class="filter-price">£1,569</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Flights List -->
        <div class="flights-list">
          <!-- Duration Pills - Horizontal scrollable -->
          <div class="flights-list-header">
            <div class="duration-pills-wrapper">
              <div class="duration-pills-container">
                <div class="duration-pills">
                  <div
                    v-for="(period, index) in durationPeriods"
                    :key="index"
                    class="duration-pill"
                    :class="{ active: period.active }"
                    @click="setActivePeriod(index)"
                  >
                    <span class="duration-pill-label">{{ period.label }}</span>
                    <span class="duration-pill-price">
                      from {{ period.price }} {{ period.note }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div
            v-for="flight in paginatedFlights"
            :key="flight.id"
            class="flight-card"
            :class="{ 'selected-flight': flight.id === currentFlight?.id }"
          >
            <!-- Current Flight Badge -->
            <div
              v-if="flight.id === currentFlight?.id"
              class="current-flight-badge"
            >
              Current Selection
            </div>

            <!-- Flight Details Section (Left Column) -->
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
                          {{ getStopsText(flight.outbound.stops) }} ●
                        </div>
                      </div>
                    </div>
                    <div class="flight-time-row">
                      <div class="flight-dot"></div>
                      <div class="flight-time">
                        {{ flight.outbound.arrival_time
                        }}{{
                          showPlusOne(
                            flight.outbound.departure_time,
                            flight.outbound.arrival_time
                          )
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
                    :src="getAirlineLogoUrl(flight.outbound.airline)"
                    :alt="flight.outbound.airline"
                    class="airline-logo"
                    @error="
                      $event.target.src =
                        'https://airhex.com/images/airline-logos/alt/default.png'
                    "
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
                          {{ getStopsText(flight.inbound.stops) }} ●
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
                    :src="getAirlineLogoUrl(flight.inbound.airline)"
                    :alt="flight.inbound.airline"
                    class="airline-logo"
                    @error="
                      $event.target.src =
                        'https://airhex.com/images/airline-logos/alt/default.png'
                    "
                  />
                  <div class="flight-number">
                    {{ flight.inbound.flight_number }}
                  </div>
                </div>
              </div>
            </div>

            <!-- Pricing Section (Right Column) -->
            <div class="flight-pricing-section">
              <div class="flight-price">
                {{ formatPrice(flight.price.amount) }}
              </div>
              <div class="flight-price-note">pp</div>
              <button
                class="flight-select-btn"
                :class="{ selected: flight.id === currentFlight?.id }"
                @click="selectFlight(flight)"
                :disabled="flight.id === currentFlight?.id"
              >
                {{
                  flight.id === currentFlight?.id
                    ? "Selected"
                    : flight.package_type
                }}
              </button>
            </div>
          </div>

          <!-- No Results -->
          <div v-if="paginatedFlights.length === 0" class="no-results">
            <p>No flights found matching your criteria.</p>
            <button class="reset-filters-btn" @click="resetFilters">
              Reset Filters
            </button>
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
  </div>
</template>

<script>
export default {
  name: "AlternativeFlights",
  props: {
    allFlights: {
      type: Array,
      required: true,
      default: () => [],
    },
    currentFlight: {
      type: Object,
      default: null,
    },
  },
  emits: ["flight-selected"],
  data() {
    return {
      // Filter states
      filters: {
        stops: "Any",
        departure: "Any",
        airlines: [],
        outboundTimes: "Any",
        inboundTimes: "Any",
        maxDuration: 13.5,
        hideRedEye: false,
      },

      // Expanded sections - All open by default
      expandedSections: {
        stops: true,
        departure: true,
        airlines: true,
        outboundTimes: true,
        inboundTimes: true,
        journeyDuration: true,
        redEyeFlights: true,
      },

      // Pagination
      currentPage: 1,
      itemsPerPage: 5,

      // Duration pills
      durationPeriods: [
        { label: "2 Nights", price: "£999", note: "pp", active: false },
        { label: "3 Nights", price: "£1,289", note: "pp", active: false },
        { label: "4 Nights", price: "£1,259", note: "pp", active: false },
        { label: "5 Nights", price: "£1,459", note: "pp", active: true },
        { label: "6-8 Nights", price: "£1,609", note: "pp", active: false },
        { label: "9-11 Nights", price: "£2,039", note: "pp", active: false },
        { label: "12-15 Nights", price: "£2,539", note: "pp", active: false },
      ],

      // Filter options
      stopsOptions: [
        { name: "Any", price: "", checked: true },
        { name: "Direct", price: "£1,409" },
        { name: "1 stop", price: "£1,459" },
      ],

      departureAirports: [
        { name: "Any", price: "", checked: true },
        { name: "Aberdeen", price: "£1,679" },
        { name: "Belfast City", price: "£1,689" },
        { name: "Birmingham", price: "£1,459" },
        { name: "Cardiff", price: "£1,919" },
        { name: "Edinburgh", price: "£1,479" },
        { name: "Glasgow", price: "£1,609" },
        { name: "Humberside", price: "£1,799" },
        { name: "Leeds Bradford", price: "£1,759" },
        { name: "London Gatwick", price: "£1,479" },
        { name: "London Heathrow", price: "£1,489" },
        { name: "London Stansted", price: "£1,459" },
        { name: "Manchester", price: "£1,389" },
        { name: "Newcastle", price: "£1,609" },
        { name: "Norwich", price: "£1,849" },
        { name: "Southampton", price: "£1,789" },
      ],

      airlinesOptions: [
        { name: "Any", price: "", checked: true },
        {
          name: "Aer Lingus",
          price: "£1,659",
          logo: "https://airhex.com/images/airline-logos/alt/aer-lingus.png",
        },
        {
          name: "Air France",
          price: "£1,589",
          logo: "https://airhex.com/images/airline-logos/alt/air-france.png",
        },
        {
          name: "Air India",
          price: "£1,659",
          logo: "https://airhex.com/images/airline-logos/alt/air-india.png",
        },
        {
          name: "AJet",
          price: "£1,459",
          logo: "https://airhex.com/images/airline-logos/alt/ajet.png",
        },
        {
          name: "British Airways",
          price: "£1,589",
          logo: "https://airhex.com/images/airline-logos/alt/british-airways.png",
        },
        {
          name: "EgyptAir",
          price: "£1,459",
          logo: "https://airhex.com/images/airline-logos/alt/egyptair.png",
        },
        {
          name: "Emirates",
          price: "£1,509",
          logo: "https://airhex.com/images/airline-logos/alt/emirates.png",
        },
        {
          name: "Ethiopian Airlines",
          price: "£1,579",
          logo: "https://airhex.com/images/airline-logos/alt/ethiopian-airlines.png",
        },
        {
          name: "Gulf Air",
          price: "£1,569",
          logo: "https://airhex.com/images/airline-logos/alt/gulf-air.png",
        },
        {
          name: "KLM Royal Dutch Airlines",
          price: "£1,759",
          logo: "https://airhex.com/images/airline-logos/alt/klm.png",
        },
        {
          name: "Lufthansa",
          price: "£1,459",
          logo: "https://airhex.com/images/airline-logos/alt/lufthansa.png",
        },
        {
          name: "Pegasus Airlines",
          price: "£1,479",
          logo: "https://airhex.com/images/airline-logos/alt/pegasus-airlines.png",
        },
        {
          name: "Qatar Airways",
          price: "£1,809",
          logo: "https://airhex.com/images/airline-logos/alt/qatar-airways.png",
        },
        {
          name: "Saudia",
          price: "£1,389",
          logo: "https://airhex.com/images/airline-logos/alt/saudia.png",
        },
        {
          name: "Swiss International Air Lines",
          price: "£1,569",
          logo: "https://airhex.com/images/airline-logos/alt/swiss.png",
        },
        {
          name: "Turkish Airlines",
          price: "£1,479",
          logo: "https://airhex.com/images/airline-logos/alt/turkish-airlines.png",
        },
        {
          name: "Virgin Atlantic",
          price: "£1,469",
          logo: "https://airhex.com/images/airline-logos/alt/virgin-atlantic.png",
        },
      ],

      outboundTimesOptions: [
        { name: "Any", checked: true },
        { name: "Early Morning", timeRange: "00:00-06:59" },
        { name: "Morning", timeRange: "07:00-11:59", price: "£1,479" },
        { name: "Afternoon", timeRange: "12:00-16:59", price: "£1,459" },
        { name: "Evening", timeRange: "17:00-20:59", price: "£1,409" },
        { name: "Night time", timeRange: "21:00-23:59", price: "£1,469" },
      ],

      inboundTimesOptions: [
        { name: "Any", checked: true },
        { name: "Early Morning", timeRange: "00:00-06:59", price: "£1,459" },
        { name: "Morning", timeRange: "07:00-11:59", price: "£1,479" },
        { name: "Afternoon", timeRange: "12:00-16:59", price: "£1,479" },
        { name: "Evening", timeRange: "17:00-20:59", price: "£1,579" },
        { name: "Night time", timeRange: "21:00-23:59", price: "£1,529" },
      ],

      // Internal data
      filteredFlights: [],
      minDuration: 7.5,
      maxDuration: 13.5,
    };
  },

  computed: {
    paginatedFlights() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filteredFlights.slice(start, end);
    },

    totalPages() {
      return Math.ceil(this.filteredFlights.length / this.itemsPerPage);
    },

    visiblePages() {
      const pages = [];
      const total = this.totalPages;
      const current = this.currentPage;

      if (total <= 5) {
        for (let i = 1; i <= total; i++) {
          pages.push(i);
        }
      } else {
        if (current <= 3) {
          for (let i = 1; i <= 5; i++) {
            pages.push(i);
          }
          pages.push("...");
          pages.push(total);
        } else if (current >= total - 2) {
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

    durationRangeText() {
      return `${this.minDuration} hours - ${this.filters.maxDuration} hours`;
    },

    sliderProgress() {
      return (
        ((this.filters.maxDuration - this.minDuration) /
          (this.maxDuration - this.minDuration)) *
        100
      );
    },
  },

  watch: {
    allFlights: {
      immediate: true,
      handler() {
        this.initializeFlights();
      },
    },
  },

  methods: {
    initializeFlights() {
      this.filteredFlights = [...this.allFlights];
      this.applyFilters();
      this.currentPage = 1;
    },

    toggleFilter(section) {
      this.expandedSections[section] = !this.expandedSections[section];
    },

    toggleFilterCheckbox(filterType, value) {
      if (filterType === "airlines") {
        if (value === "Any") {
          this.filters.airlines = [];
        } else {
          const index = this.filters.airlines.indexOf(value);
          if (index > -1) {
            this.filters.airlines.splice(index, 1);
          } else {
            this.filters.airlines.push(value);
          }
        }
      } else {
        this.filters[filterType] = value;
      }
      this.applyFilters();
    },

    toggleRedEyeFilter() {
      this.filters.hideRedEye = !this.filters.hideRedEye;
      this.applyFilters();
    },

    applyFilters() {
      let filtered = [...this.allFlights];

      // Apply stops filter
      if (this.filters.stops !== "Any") {
        if (this.filters.stops === "Direct") {
          filtered = filtered.filter(
            (f) => f.outbound.stops === 0 && f.inbound.stops === 0
          );
        } else if (this.filters.stops === "1 stop") {
          filtered = filtered.filter(
            (f) => f.outbound.stops === 1 || f.inbound.stops === 1
          );
        }
      }

      // Apply departure airport filter
      if (this.filters.departure !== "Any") {
        filtered = filtered.filter((f) =>
          f.outbound.departure_airport
            .toLowerCase()
            .includes(this.filters.departure.toLowerCase())
        );
      }

      // Apply airlines filter
      if (this.filters.airlines.length > 0) {
        filtered = filtered.filter((f) =>
          this.filters.airlines.some(
            (airline) =>
              f.outbound.airline
                .toLowerCase()
                .includes(airline.toLowerCase()) ||
              f.inbound.airline.toLowerCase().includes(airline.toLowerCase())
          )
        );
      }

      // Apply outbound times filter
      if (this.filters.outboundTimes !== "Any") {
        filtered = filtered.filter((f) => {
          const hour = parseInt(f.outbound.departure_time.split(":")[0]);
          switch (this.filters.outboundTimes) {
            case "Early Morning":
              return hour >= 0 && hour < 7;
            case "Morning":
              return hour >= 7 && hour < 12;
            case "Afternoon":
              return hour >= 12 && hour < 17;
            case "Evening":
              return hour >= 17 && hour < 21;
            case "Night time":
              return hour >= 21 || hour < 0;
            default:
              return true;
          }
        });
      }

      // Apply inbound times filter
      if (this.filters.inboundTimes !== "Any") {
        filtered = filtered.filter((f) => {
          const hour = parseInt(f.inbound.departure_time.split(":")[0]);
          switch (this.filters.inboundTimes) {
            case "Early Morning":
              return hour >= 0 && hour < 7;
            case "Morning":
              return hour >= 7 && hour < 12;
            case "Afternoon":
              return hour >= 12 && hour < 17;
            case "Evening":
              return hour >= 17 && hour < 21;
            case "Night time":
              return hour >= 21 || hour < 0;
            default:
              return true;
          }
        });
      }

      // Apply duration filter
      filtered = filtered.filter((f) => {
        const outDuration = this.parseDuration(f.outbound.duration);
        const inDuration = this.parseDuration(f.inbound.duration);
        const maxDuration = Math.max(outDuration, inDuration);
        return maxDuration <= this.filters.maxDuration;
      });

      // Apply red-eye filter
      if (this.filters.hideRedEye) {
        filtered = filtered.filter((f) => {
          const outHour = parseInt(f.outbound.departure_time.split(":")[0]);
          const inHour = parseInt(f.inbound.departure_time.split(":")[0]);
          return !(outHour >= 22 || outHour < 6 || inHour >= 22 || inHour < 6);
        });
      }

      this.filteredFlights = filtered;
      this.currentPage = 1;
    },

    resetFilters() {
      this.filters = {
        stops: "Any",
        departure: "Any",
        airlines: [],
        outboundTimes: "Any",
        inboundTimes: "Any",
        maxDuration: 13.5,
        hideRedEye: false,
      };
      this.applyFilters();
    },

    setActivePeriod(index) {
      this.durationPeriods.forEach((p, i) => {
        p.active = i === index;
      });
    },

    selectFlight(flight) {
      if (flight.id !== this.currentFlight?.id) {
        this.$emit("flight-selected", flight);
      }
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

    formatPrice(amount) {
      return "£" + amount.toLocaleString();
    },

    getStopsText(stops) {
      return stops === 0 ? "Direct" : stops === 1 ? "1 stop" : `${stops} stops`;
    },

    getAirlineLogoUrl(airline) {
      const logoMap = {
        ajet: "ajet",
        Saudia: "saudia",
        Eurowings: "eurowings",
        "Turkish Airlines": "turkish-airlines",
        "Aer Lingus": "aer-lingus",
        "Air France": "air-france",
        "Air India": "air-india",
        AJet: "ajet",
        "British Airways": "british-airways",
        EgyptAir: "egyptair",
        Emirates: "emirates",
        "Ethiopian Airlines": "ethiopian-airlines",
        "Gulf Air": "gulf-air",
        "KLM Royal Dutch Airlines": "klm",
        Lufthansa: "lufthansa",
        "Pegasus Airlines": "pegasus-airlines",
        "Qatar Airways": "qatar-airways",
        "Swiss International Air Lines": "swiss",
        "Virgin Atlantic": "virgin-atlantic",
      };

      const logoName =
        logoMap[airline] ||
        airline.toLowerCase().replace(/\s+/g, "-").replace(/&/, "and");
      return `https://airhex.com/images/airline-logos/alt/${logoName}.png`;
    },

    showPlusOne(departure, arrival) {
      return arrival < departure && !arrival.includes("+");
    },

    parseDuration(duration) {
      const hours = parseInt(duration.match(/(\d+)h/)?.[1] || 0);
      const minutes = parseInt(duration.match(/(\d+)m/)?.[1] || 0);
      return hours + minutes / 60;
    },
  },
};
</script>

<style scoped>
.flights-content {
  display: flex;
  gap: 20px;
  max-width: 100%;
  width: 100%;
  box-sizing: border-box;
}

.sidebar {
  width: 280px;
  flex-shrink: 0;
}

.flights-list {
  flex: 1;
  min-width: 0; /* ⚠️ penting agar flex item tidak overflow */
  overflow: hidden; /* mencegah isi meluap */
  box-sizing: border-box;
}

.filter-section {
  margin-bottom: 20px;
}

.filter-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-weight: bold;
  cursor: pointer;
  padding: 10px 0;
}

.filter-title .arrow {
  width: 16px;
  height: 16px;
  fill: #666;
  transition: transform 0.3s;
}

.filter-title .arrow.collapsed {
  transform: rotate(-90deg);
}

.filter-content {
  max-height: 300px;
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

.airline-logo-filter {
  width: 44px;
  height: 16px;
  object-fit: contain;
  background: white;
  border-radius: 2px;
}

.filter-label {
  font-size: 14px;
}

.filter-price {
  font-size: 13px;
  color: #666;
}

.duration-range-container {
  padding: 15px 0;
}

.duration-range-labels {
  text-align: center;
  margin-bottom: 15px;
  font-size: 14px;
  color: #666;
}

.duration-slider {
  position: relative;
  height: 4px;
  background: #eee;
  border-radius: 2px;
}

.slider-track {
  position: absolute;
  width: 100%;
  height: 100%;
  background: #eee;
  border-radius: 2px;
}

.slider-range {
  position: absolute;
  height: 100%;
  background: #ac7872;
  border-radius: 2px;
}

.slider-thumb {
  position: absolute;
  width: 16px;
  height: 16px;
  background: #ac7872;
  border-radius: 50%;
  top: -6px;
  cursor: pointer;
}

.flights-list-header {
  margin-bottom: 20px;
}

.duration-pills-wrapper {
  width: 100%;
  overflow: hidden;
  padding-bottom: 5px;
}

.duration-pills-container {
  overflow-x: auto;
  overflow-y: hidden;
  -webkit-overflow-scrolling: touch;
  scrollbar-width: none; /* Firefox */
  -ms-overflow-style: none; /* IE 10+ */
}

.duration-pills-container::-webkit-scrollbar {
  display: none; /* Chrome/Safari */
}

.duration-pills {
  display: flex;
  gap: 15px;
  min-width: 100%; /* Tambahkan baris ini */
  width: max-content; /* Tambahkan baris ini */
  min-width: 100%;
  width: max-content;
  padding: 0 10px; /* optional padding */
}

.duration-pill {
  background: transparent;
  border: none;
  border-bottom: 2px solid transparent;
  padding: 8px 16px;
  cursor: pointer;
  transition: all 0.2s;
  text-align: center;
  white-space: nowrap;
  flex-shrink: 0;
}

.duration-pill:hover {
  color: #ac7872;
}

.duration-pill.active {
  color: #ac7872;
  border-bottom-color: #ac7872;
}

.duration-pill-label {
  display: block;
  font-weight: bold;
  font-size: 12px;
}

.duration-pill-price {
  display: block;
  font-size: 11px;
  opacity: 0.8;
}

.flight-card {
  border: 1px solid #ddd;
  border-radius: 12px;
  margin-bottom: 15px;
  overflow: hidden;
  background: white;
  transition: all 0.3s;
  display: flex;
  min-height: 120px;
  position: relative;
}

.flight-card:hover {
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.flight-card.selected-flight {
  border-color: #ac7872;
  background: #fefefe;
  box-shadow: 0 4px 15px rgba(172, 120, 114, 0.2);
}

.current-flight-badge {
  position: absolute;
  top: -1px;
  left: 20px;
  background: #ac7872;
  color: white;
  padding: 4px 12px;
  border-radius: 0 0 8px 8px;
  font-size: 12px;
  font-weight: bold;
  z-index: 2;
}

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

.flight-select-btn:hover:not(:disabled) {
  background: #0f2b2c;
}

.flight-select-btn.selected {
  background: #ac7872;
  cursor: default;
}

.flight-select-btn:disabled {
  cursor: default;
  opacity: 0.8;
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

@media (max-width: 1200px) {
  .flights-content {
    flex-direction: column;
  }

  .sidebar {
    width: 280px;
    flex-shrink: 0;
    box-sizing: border-box;
  }

  .filter-section {
    min-width: 250px;
    flex-shrink: 0;
  }
}

@media (max-width: 768px) {
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

  .flight-time-group {
    min-width: 200px;
  }

  .flight-pricing-section {
    align-items: center;
    border-top: 1px solid #eee;
    border-left: none;
    padding-top: 15px;
    text-align: center;
  }

  .current-flight-badge {
    position: static;
    margin-bottom: 10px;
    border-radius: 8px;
    display: inline-block;
  }

  .flight-date-info {
    min-width: 120px;
  }

  .airline-section {
    min-width: 60px;
  }

  .sidebar {
    flex-direction: column;
  }

  .filter-section {
    min-width: auto;
  }

  .duration-pills {
    justify-content: center;
  }
}
</style>
