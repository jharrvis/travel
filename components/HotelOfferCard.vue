<template>
  <div class="offer-card">
    <div class="offer-header">
      <div class="offer-title">{{ offerData.title }}</div>
      <div class="best-offer-badge" v-if="offerData.isBestOffer">
        {{ offerData.badge }}
      </div>
    </div>

    <div class="offer-content">
      <div class="hotel-offer-name">{{ offerData.hotelName }}</div>
      <div class="offer-details">{{ offerData.details }}</div>

      <!-- Flight Information -->
      <div class="flight-info">
        <!-- Outbound Flight -->
        <div class="flight-segment-header">
          <div class="flight-segment-left">
            <span class="flight-icon">✈️</span>
            <div class="flight-segment-details">
              <div class="flight-date">{{ offerData.outboundFlight.date }}</div>
              <div class="flight-direction">Outbound</div>
            </div>
          </div>
          <div class="flight-segment-right">
            <img
              :src="offerData.outboundFlight.airline.logo"
              :alt="offerData.outboundFlight.airline.name"
              class="airline-logo-small"
            />
            <div class="flight-number-small">
              {{ offerData.outboundFlight.flightNumber }}
            </div>
          </div>
        </div>

        <div class="flight-times-detail">
          <div class="flight-time-item">
            <div class="time-dot"></div>
            <div class="time-info">
              <span class="time">{{
                offerData.outboundFlight.departure.time
              }}</span>
              <span class="airport">{{
                offerData.outboundFlight.departure.airport
              }}</span>
            </div>
          </div>

          <div class="flight-duration-detail">
            <span class="duration-icon">⏱️</span>
            <span class="duration-text">{{
              offerData.outboundFlight.duration
            }}</span>
            <span class="stops-info">{{ offerData.outboundFlight.stops }}</span>
            <span class="stop-icon" v-if="offerData.outboundFlight.hasStops"
              >●</span
            >
          </div>

          <div class="flight-time-item">
            <div class="time-dot"></div>
            <div class="time-info">
              <span class="time">{{
                offerData.outboundFlight.arrival.time
              }}</span>
              <span class="airport">{{
                offerData.outboundFlight.arrival.airport
              }}</span>
            </div>
          </div>
        </div>

        <!-- Inbound Flight -->
        <div class="flight-segment-header" style="margin-top: 20px">
          <div class="flight-segment-left">
            <span class="flight-icon">🛬</span>
            <div class="flight-segment-details">
              <div class="flight-date">{{ offerData.inboundFlight.date }}</div>
              <div class="flight-direction">Inbound</div>
            </div>
          </div>
          <div class="flight-segment-right">
            <img
              :src="offerData.inboundFlight.airline.logo"
              :alt="offerData.inboundFlight.airline.name"
              class="airline-logo-small"
            />
            <div class="flight-number-small">
              {{ offerData.inboundFlight.flightNumber }}
            </div>
          </div>
        </div>

        <div class="flight-times-detail">
          <div class="flight-time-item">
            <div class="time-dot"></div>
            <div class="time-info">
              <span class="time">{{
                offerData.inboundFlight.departure.time
              }}</span>
              <span class="airport">{{
                offerData.inboundFlight.departure.airport
              }}</span>
            </div>
          </div>

          <div class="flight-duration-detail">
            <span class="duration-icon">⏱️</span>
            <span class="duration-text">{{
              offerData.inboundFlight.duration
            }}</span>
            <span class="stops-info">{{ offerData.inboundFlight.stops }}</span>
            <span class="stop-icon" v-if="offerData.inboundFlight.hasStops"
              >●</span
            >
          </div>

          <div class="flight-time-item">
            <div class="time-dot"></div>
            <div class="time-info">
              <span class="time">{{
                offerData.inboundFlight.arrival.time
              }}</span>
              <span class="airport">{{
                offerData.inboundFlight.arrival.airport
              }}</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Protection Badges -->
      <div class="protection-badges">
        <div
          v-for="badge in offerData.protectionBadges"
          :key="badge.id"
          class="protection-badge"
        >
          <span>{{ badge.icon }}</span>
          <span>{{ badge.text }}</span>
        </div>
      </div>

      <!-- Pricing -->
      <div class="pricing-summary">
        <div class="original-price" v-if="offerData.pricing.originalPrice">
          {{ offerData.pricing.originalPrice }}
        </div>

        <div class="price-row">
          <span>Per person</span>
          <span class="per-person-price">{{
            offerData.pricing.perPerson
          }}</span>
        </div>
        <div class="price-row total">
          <span>Total price</span>
          <span>{{ offerData.pricing.total }}</span>
        </div>
      </div>

      <!-- Secure Today -->
      <div class="secure-today">
        <div class="secure-today-content">
          <span>Secure today for</span>
          <span class="secure-price">{{ offerData.pricing.secureToday }}</span>
        </div>
      </div>

      <!-- Payment Options -->
      <div class="payment-options">
        <select class="payment-dropdown" v-model="selectedPaymentOption">
          <option value="">Payment options</option>
          <option
            v-for="option in offerData.paymentOptions"
            :key="option.value"
            :value="option.value"
          >
            {{ option.label }}
          </option>
        </select>
      </div>

      <!-- Action Buttons -->
      <button class="select-btn" @click="selectHoliday">
        Select this holiday
      </button>
      <button class="alternative-btn" @click="showAlternativeFlights">
        Alternative flights
      </button>

      <!-- Further Charges -->
      <div class="further-charges">
        <div class="charges-title">Further charges</div>
        <div class="charges-text">{{ offerData.furtherCharges }}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "HotelOfferCard",
  props: {
    offerData: {
      type: Object,
      required: true,
      default: () => ({
        title: "Flight & Hotel Offer",
        badge: "Best Offer",
        isBestOffer: true,
        hotelName: "Jumeirah Beach Hotel",
        details: "Sun 30 Nov 2025 (5 nights)\nBreakfast included",
        outboundFlight: {
          date: "Sun 30 Nov 2025",
          airline: {
            name: "Jet2",
            logo: "https://airhex.com/images/airline-logos/alt/ajet.png",
          },
          flightNumber: "VF1988",
          departure: {
            time: "12:35",
            airport: "London Stansted (STN)",
          },
          arrival: {
            time: "03:50+1",
            airport: "Dubai (DXB)",
          },
          duration: "11h 15m",
          stops: "1 stop",
          hasStops: true,
        },
        inboundFlight: {
          date: "Fri 5 Dec 2025",
          airline: {
            name: "Jet2",
            logo: "https://airhex.com/images/airline-logos/alt/ajet.png",
          },
          flightNumber: "VF550",
          departure: {
            time: "06:00",
            airport: "Dubai (DXB)",
          },
          arrival: {
            time: "14:35",
            airport: "London Stansted (STN)",
          },
          duration: "12h 35m",
          stops: "1 stop",
          hasStops: true,
        },
        protectionBadges: [
          { id: 1, icon: "🛡️", text: "ATOL protected" },
          { id: 2, icon: "🔄", text: "Flexible Hotel Changes" },
        ],
        pricing: {
          originalPrice: "£3,121",
          perPerson: "£1,459",
          total: "£2,918",
          secureToday: "£29 pp",
        },
        paymentOptions: [
          { value: "full", label: "Pay in full" },
          { value: "deposit", label: "Pay deposit now" },
          { value: "monthly", label: "Monthly payments" },
        ],
        furtherCharges:
          "Your hotel may charge additional fees, which must be paid there.",
      }),
    },
  },
  emits: [
    "select-holiday",
    "show-alternative-flights",
    "payment-option-changed",
  ],
  data() {
    return {
      selectedPaymentOption: "",
    };
  },
  watch: {
    selectedPaymentOption(newValue) {
      this.$emit("payment-option-changed", newValue);
    },
  },
  methods: {
    selectHoliday() {
      this.$emit("select-holiday", {
        offer: this.offerData,
        paymentOption: this.selectedPaymentOption,
      });
    },
    showAlternativeFlights() {
      this.$emit("show-alternative-flights", this.offerData);
    },
  },
};
</script>

<style scoped>
.offer-card {
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  height: fit-content;
}

.offer-header {
  background: #ac7872;
  color: white;
  padding: 15px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.offer-title {
  font-weight: bold;
}

.best-offer-badge {
  background: rgba(255, 255, 255, 0.2);
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 12px;
}

.offer-content {
  padding: 20px;
}

.hotel-offer-name {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 5px;
}

.offer-details {
  color: #666;
  font-size: 14px;
  margin-bottom: 20px;
  white-space: pre-line;
}

.flight-info {
  margin-bottom: 20px;
}

.flight-segment-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
}

.flight-segment-left {
  display: flex;
  align-items: center;
  gap: 8px;
}

.flight-icon {
  font-size: 14px;
  width: 16px;
}

.flight-segment-details {
  display: flex;
  flex-direction: column;
}

.flight-date {
  font-weight: bold;
  font-size: 14px;
  color: #333;
}

.flight-direction {
  font-size: 12px;
  color: #666;
}

.flight-segment-right {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 2px;
}

.airline-logo-small {
  width: 62px;
  height: 20px;
  object-fit: contain;
}

.flight-number-small {
  font-size: 12px;
  color: #666;
}

.flight-times-detail {
  margin-left: 24px;
  margin-bottom: 15px;
}

.flight-time-item {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 8px;
}

.time-dot {
  width: 6px;
  height: 6px;
  background-color: #333;
  border-radius: 50%;
  flex-shrink: 0;
}

.time-info {
  display: flex;
  gap: 8px;
  align-items: center;
}

.time {
  font-weight: bold;
  font-size: 14px;
  color: #333;
  min-width: 50px;
}

.airport {
  color: #666;
  font-size: 14px;
}

.flight-duration-detail {
  display: flex;
  align-items: center;
  gap: 6px;
  margin: 8px 0 8px 18px;
  font-size: 12px;
  color: #666;
}

.duration-icon {
  font-size: 12px;
}

.duration-text {
  font-weight: 500;
}

.stops-info {
  margin-left: 4px;
}

.stop-icon {
  margin-left: 4px;
  font-size: 10px;
}

.protection-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 20px;
}

.protection-badge {
  background: #f8f9fa;
  border: 1px solid #ddd;
  padding: 6px 10px;
  border-radius: 15px;
  font-size: 12px;
  display: flex;
  align-items: center;
  gap: 5px;
}

.pricing-summary {
  border-top: 1px solid #eee;
  padding-top: 20px;
}

.original-price {
  text-decoration: line-through;
  color: #999;
  font-size: 14px;
  text-align: right;
  margin-bottom: 5px;
}

.price-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
}

.price-row.total {
  font-weight: bold;
  font-size: 18px;
  border-top: 1px solid #eee;
  padding-top: 15px;
  margin-top: 15px;
}

.per-person-price {
  font-size: 24px;
  font-weight: bold;
}

.secure-today {
  background: #f8f9fa;
  padding: 15px;
  border-radius: 8px;
  margin: 20px 0;
}

.secure-today-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.secure-price {
  font-weight: bold;
  font-size: 16px;
}

.payment-options {
  margin: 15px 0;
}

.payment-dropdown {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 6px;
  background: white;
  font-size: 14px;
}

.select-btn {
  width: 100%;
  background: #153b3c;
  color: white;
  border: none;
  padding: 15px;
  border-radius: 8px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  margin-bottom: 15px;
  transition: background-color 0.2s;
}

.select-btn:hover {
  background: #0f2d2e;
}

.alternative-btn {
  width: 100%;
  background: white;
  color: #333;
  border: 2px solid #ddd;
  padding: 15px;
  border-radius: 8px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.2s;
}

.alternative-btn:hover {
  border-color: #ac7872;
  color: #ac7872;
}

.further-charges {
  margin-top: 20px;
  padding-top: 20px;
  border-top: 1px solid #eee;
}

.charges-title {
  font-weight: bold;
  margin-bottom: 10px;
}

.charges-text {
  font-size: 14px;
  color: #666;
}

@media (max-width: 768px) {
  .offer-content {
    padding: 15px;
  }

  .flight-segment-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 8px;
  }

  .flight-segment-right {
    align-items: flex-start;
  }

  .protection-badges {
    flex-direction: column;
  }

  .protection-badge {
    justify-content: center;
  }
}
</style>
