<template>
  <div>
    <Header @open-enquiry-modal="showEnquiryModal" />

    <!-- Sticky CTA -->
    <div class="sticky-cta-container" style="" data-v-7b6ed19f>
      <div class="sticky-cta-item" data-v-7b6ed19f @click="scrollToTop">
        <svg
          aria-hidden="true"
          focusable="false"
          data-prefix="fas"
          data-icon="arrow-up"
          role="img"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 384 512"
          class="cta-icon svg-inline--fa fa-arrow-up"
          data-v-7b6ed19f
        >
          <path
            fill="currentColor"
            d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2 160 448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-306.7L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"
            data-v-7b6ed19f
          />
        </svg>
        <span data-v-7b6ed19f>Back to Top</span>
      </div>
      <a
        href="tel:01204 269010"
        id="CTACall"
        class="sticky-cta-item InfinityNumber"
        data-v-7b6ed19f
      >
        <svg
          aria-hidden="true"
          focusable="false"
          data-prefix="fas"
          data-icon="phone"
          role="img"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 512 512"
          class="cta-icon svg-inline--fa fa-phone"
          data-v-7b6ed19f
        >
          <path
            fill="currentColor"
            d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"
            data-v-7b6ed19f
          />
        </svg>
        <span data-v-7b6ed19f>Call</span>
      </a>
      <div
        id="CTAEnquiry"
        class="sticky-cta-item"
        data-v-7b6ed19f
        @click="showEnquiryModal"
      >
        <svg
          aria-hidden="true"
          focusable="false"
          data-prefix="fas"
          data-icon="envelope"
          role="img"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 512 512"
          class="cta-icon svg-inline--fa fa-envelope"
          data-v-7b6ed19f
        >
          <path
            fill="currentColor"
            d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"
            data-v-7b6ed19f
          />
        </svg>
        <span data-v-7b6ed19f>Enquire</span>
      </div>
    </div>

    <!-- Content Area -->
    <div class="page-section container">
      <!-- Tab Navigation -->
      <div class="tab-navigation">
        <button
          v-for="tab in tabs"
          :key="tab.id"
          class="tab-item"
          :class="{ active: activeTab === tab.id }"
          @click="setActiveTab(tab.id)"
        >
          {{ tab.label }}
        </button>
      </div>

      <div class="content-wrapper">
        <!-- Left Column -->
        <div class="left-column">
          <!-- Hotel Information -->
          <HotelDetailHeader
            :hotel-data="hotelData"
            :initial-favorite="isFavorite"
            @toggle-favorite="handleToggleFavorite"
            @show-hotel-details="showHotelDetails"
            @show-map="showMap"
          />

          <!-- Refine Your Holiday -->
          <HotelRefineForm
            :form-data="refineFormData"
            :guarantee="guaranteeData"
            @edit-field="handleEditField"
            @guarantee-clicked="showGuaranteeInfo"
          />

          <!-- Alternative Flights Section - Always visible below hotel info -->
          <div
            id="alternative-flights-section"
            class="alternative-flights-inline"
          >
            <AlternativeFlightsInline
              :current-flight="
                flightData.search_results.flights[currentFlightIndex]
              "
              :all-flights="flightData.search_results.flights"
              @flight-selected="handleFlightSelected"
            />
          </div>
        </div>

        <!-- Middle Column - Calendar -->
        <div class="middle-column">
          <HotelCalendar
            :initial-selected-date="selectedDate"
            @date-selected="handleDateSelected"
            @price-toggle="handlePriceToggle"
          />
        </div>

        <!-- Right Column -->
        <div class="right-column">
          <HotelOfferCard
            :offer-data="currentOffer"
            @select-holiday="handleSelectHoliday"
            @show-alternative-flights="scrollToAlternativeFlights"
            @payment-option-changed="handlePaymentOptionChanged"
          />
        </div>
      </div>
    </div>

    <Footer />

    <!-- Enquiry Modal Component -->
    <EnquiryModal
      :visible="isModalVisible"
      :phone-number="phoneNumber"
      @close="closeModal"
      @submit="handleFormSubmit"
    />
  </div>
</template>

<script>
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import EnquiryModal from "@/components/EnquiryModal.vue";
import HotelDetailHeader from "@/components/HotelDetailHeader.vue";
import HotelRefineForm from "@/components/HotelRefineForm.vue";
import HotelCalendar from "@/components/HotelCalendar.vue";
import HotelOfferCard from "@/components/HotelOfferCard.vue";
import AlternativeFlightsInline from "@/components/AlternativeFlights.vue";
import flightData from "@/static/data/flights.json";

export default {
  name: "HotelDetailPage",
  components: {
    Header,
    Footer,
    EnquiryModal,
    HotelDetailHeader,
    HotelRefineForm,
    HotelCalendar,
    HotelOfferCard,
    AlternativeFlightsInline,
  },
  data() {
    return {
      flightData, // Import langsung data JSON
      isModalVisible: false,
      phoneNumber: "01204 269010",
      activeTab: "flights-hotel",
      isFavorite: false,
      selectedDate: { day: 30, month: 10, year: 2025 },
      selectedPaymentOption: "",
      currentFlightIndex: 0, // Index flight yang sedang aktif
      tabs: [
        { id: "flights-hotel", label: "Flights + Hotel" },
        { id: "hotel-only", label: "Hotel only" },
      ],
      hotelData: {
        name: "Jumeirah Beach Hotel",
        location: "Jumeirah Beach, Dubai, United Arab Emirates",
        stars: 5,
        rating: 5,
        reviewCount: "5,124",
        mainImage:
          "https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=200&fit=crop",
        imageCounter: "1/86",
      },
      refineFormData: {
        airport: "✈️ Any airport",
        nights: "🌙 5 nights",
        boardBasis: "🍽️ Any board basis",
        rooms: "👥 1 Room / 2 Adults",
        flightTime: "✈️ Any flight time",
      },
      guaranteeData: {
        title: "Price Match Guarantee",
        description: "We won't be beaten on price",
      },
    };
  },
  computed: {
    currentOffer() {
      const flight =
        this.flightData.search_results.flights[this.currentFlightIndex];
      if (!flight) return null;

      return {
        title: "Flight & Hotel Offer",
        badge: flight.price.amount <= 1400 ? "Best Price" : "Best Offer",
        isBestOffer: true,
        hotelName: "Jumeirah Beach Hotel",
        details: `${this.formatDate(
          flight.outbound.date
        )} (5 nights)\nBreakfast included`,
        outboundFlight: {
          date: this.formatDate(flight.outbound.date),
          airline: {
            name: flight.outbound.airline,
            logo: this.getAirlineLogo(flight.outbound.airline),
          },
          flightNumber: flight.outbound.flight_number,
          departure: {
            time: flight.outbound.departure_time,
            airport: flight.outbound.departure_airport,
          },
          arrival: {
            time: flight.outbound.arrival_time + "+1",
            airport: flight.outbound.arrival_airport,
          },
          duration: flight.outbound.duration,
          stops: this.formatStops(flight.outbound.stops),
          hasStops: flight.outbound.stops > 0,
        },
        inboundFlight: {
          date: this.formatDate(flight.inbound.date),
          airline: {
            name: flight.inbound.airline,
            logo: this.getAirlineLogo(flight.inbound.airline),
          },
          flightNumber: flight.inbound.flight_number,
          departure: {
            time: flight.inbound.departure_time,
            airport: flight.inbound.departure_airport,
          },
          arrival: {
            time: flight.inbound.arrival_time,
            airport: flight.inbound.arrival_airport,
          },
          duration: flight.inbound.duration,
          stops: this.formatStops(flight.inbound.stops),
          hasStops: flight.inbound.stops > 0,
        },
        protectionBadges: [
          { id: 1, icon: "🛡️", text: "ATOL protected" },
          { id: 2, icon: "🔄", text: "Flexible Hotel Changes" },
        ],
        pricing: {
          originalPrice:
            flight.price.amount > 1400 ? `£${flight.price.amount + 200}` : null,
          perPerson: `£${flight.price.amount}`,
          total: `£${flight.price.amount * 2}`, // Assuming 2 people
          secureToday: "£29 pp",
        },
        paymentOptions: [
          { value: "full", label: "Pay in full" },
          { value: "deposit", label: "Pay deposit now" },
          { value: "monthly", label: "Monthly payments" },
        ],
        furtherCharges:
          "Your hotel may charge additional fees, which must be paid there.",
      };
    },
  },
  mounted() {
    this.initStickyCTA();
  },
  methods: {
    // Modal methods
    showEnquiryModal() {
      this.isModalVisible = true;
    },
    closeModal() {
      this.isModalVisible = false;
    },
    handleFormSubmit(formData) {
      console.log("Form submitted:", formData);
    },

    // Sticky CTA methods
    scrollToTop() {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    },

    // Scroll to Alternative Flights section
    scrollToAlternativeFlights() {
      const element = document.getElementById("alternative-flights-section");
      if (element) {
        element.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    },

    initStickyCTA() {
      const stickyContainer = document.querySelector(".sticky-cta-container");
      const scrollThreshold = 300;

      const isMobile = () => window.innerWidth <= 768;

      const toggleCTAVisibility = () => {
        const scrollTop =
          window.pageYOffset || document.documentElement.scrollTop;

        if (!isMobile()) {
          if (scrollTop >= scrollThreshold) {
            stickyContainer.style.opacity = "1";
            stickyContainer.style.visibility = "visible";
            stickyContainer.style.transform = "translateX(0)";
          } else {
            stickyContainer.style.opacity = "0";
            stickyContainer.style.visibility = "hidden";
            stickyContainer.style.transform = "translateX(100%)";
          }
        } else {
          stickyContainer.style.opacity = "1";
          stickyContainer.style.visibility = "visible";
          stickyContainer.style.transform = "translateY(0)";
        }
      };

      window.addEventListener("scroll", toggleCTAVisibility);
      window.addEventListener("resize", toggleCTAVisibility);

      if (stickyContainer) {
        stickyContainer.style.transition = "all 0.3s ease-in-out";
        toggleCTAVisibility();
      }
    },

    // Tab methods
    setActiveTab(tabId) {
      this.activeTab = tabId;
    },

    // Hotel methods
    handleToggleFavorite(data) {
      this.isFavorite = data.isFavorite;
      console.log("Hotel favorite toggled:", data);
    },
    showHotelDetails() {
      console.log("Show hotel details");
    },
    showMap() {
      console.log("Show map");
    },

    // Form methods
    handleEditField(fieldName) {
      console.log("Edit field:", fieldName);
    },
    showGuaranteeInfo(guarantee) {
      console.log("Show guarantee info:", guarantee);
    },

    // Calendar methods
    handleDateSelected(data) {
      this.selectedDate = data.date;
      console.log("Date selected:", data);
    },
    handlePriceToggle(showTotalPrice) {
      console.log("Price toggle:", showTotalPrice);
    },

    // Offer methods
    handleSelectHoliday(data) {
      console.log("Select holiday:", data);
      alert("Proceeding to booking...");
    },

    // Flight methods
    handleFlightSelected(selectedFlight) {
      console.log("Flight selected from alternatives:", selectedFlight);

      // Find the index of the selected flight in our flight data
      const flightIndex = this.flightData.search_results.flights.findIndex(
        (f) => f.id === selectedFlight.id
      );
      if (flightIndex !== -1) {
        this.currentFlightIndex = flightIndex;
      }

      console.log(
        "Now showing flight:",
        selectedFlight.outbound.airline,
        selectedFlight.outbound.flight_number
      );
    },

    handlePaymentOptionChanged(option) {
      this.selectedPaymentOption = option;
      console.log("Payment option changed:", option);
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
  },
};
</script>

<style scoped>
/* Container */
.page-section {
  padding: 60px 20px;
  max-width: 1200px;
  margin: 0 auto;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

/* Tab Navigation */
.tab-navigation {
  display: flex;
  margin-bottom: 30px;
  border-bottom: 1px solid #ddd;
}

.tab-item {
  padding: 12px 24px;
  background: none;
  border: none;
  border-bottom: 3px solid transparent;
  cursor: pointer;
  font-size: 16px;
  font-weight: 500;
  color: #666;
  transition: all 0.2s;
}

.tab-item.active {
  color: #333;
  border-bottom-color: #ac7872;
}

.tab-item:hover {
  color: #333;
}

/* Content Layout */
.content-wrapper {
  display: flex;
  gap: 30px;
}

.left-column {
  flex: 1;
  min-width: 0;
}

.middle-column {
  flex: 1;
  min-width: 0;
}

.right-column {
  width: 350px;
  flex-shrink: 0;
}

/* Alternative Flights Inline Section */
.alternative-flights-inline {
  margin-top: 30px;
  scroll-margin-top: 100px; /* Account for fixed header */
}

/* Responsive Design */
@media (max-width: 1024px) {
  .content-wrapper {
    flex-direction: column;
  }

  .left-column,
  .middle-column,
  .right-column {
    width: 100%;
  }
}

@media (max-width: 768px) {
  .page-section {
    padding: 40px 15px;
  }

  .container {
    padding: 15px;
  }

  .tab-navigation {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
    -ms-overflow-style: none;
  }

  .tab-navigation::-webkit-scrollbar {
    display: none;
  }

  .tab-item {
    white-space: nowrap;
    min-width: auto;
  }

  .content-wrapper {
    gap: 20px;
  }

  .alternative-flights-inline {
    margin-top: 20px;
  }
}
</style>
