<template>
  <div class="alternative-flights">
    <div class="alternative-flights-inner">
      <h2 class="alternative-flights-title">Alternative flights</h2>

      <div class="flights-content">
        <AlternativeFlightsSidebar />

        <div class="flights-list">
          <div class="flights-list-header">
            <div class="duration-pills">
              <div
                v-for="(period, index) in durationPeriods"
                :key="index"
                :class="['duration-pill', { active: period.active }]"
                @click="setActivePeriod(index)"
              >
                <span class="duration-pill-label">{{ period.label }}</span>
                <span class="duration-pill-price"
                  >from {{ period.price }} {{ period.note }}</span
                >
              </div>
            </div>
          </div>

          <div
            v-for="flight in allFlights"
            :key="flight.id"
            class="flight-card"
            @click="$emit('flight-selected', flight)"
          >
            <div class="flight-details-section">
              <!-- Outbound -->
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
                        }}<span
                          v-if="
                            showPlusOne(
                              flight.outbound.departure_time,
                              flight.outbound.arrival_time
                            )
                          "
                          >+1</span
                        >
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
                  />
                  <div class="flight-number">
                    {{ flight.outbound.flight_number }}
                  </div>
                </div>
              </div>

              <!-- Inbound -->
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
                  />
                  <div class="flight-number">
                    {{ flight.inbound.flight_number }}
                  </div>
                </div>
              </div>
            </div>

            <div class="flight-pricing-section">
              <div class="flight-price">
                £{{ flight.price.amount.toLocaleString() }}
              </div>
              <div class="flight-price-note">pp</div>
              <button class="flight-select-btn">
                {{ flight.package_type }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits, ref } from "vue";
import AlternativeFlightsSidebar from "./AlternativeFlightsSidebar.vue";

const props = defineProps({
  allFlights: Array,
});
const emit = defineEmits(["flight-selected"]);

const durationPeriods = ref([
  { label: "2 Nights", price: "£999", note: "pp" },
  { label: "3 Nights", price: "£1,289", note: "pp" },
  { label: "4 Nights", price: "£1,259", note: "pp" },
  { label: "5 Nights", price: "£1,459", note: "pp", active: true },
  { label: "6-8 Nights", price: "£1,609", note: "pp" },
  { label: "9-11 Nights", price: "£2,039", note: "pp" },
  { label: "12-15 Nights", price: "£2,539", note: "pp" },
]);

function setActivePeriod(index) {
  durationPeriods.value.forEach((p, i) => (p.active = i === index));
}

function formatDate(dateString) {
  const options = {
    weekday: "short",
    day: "numeric",
    month: "short",
    year: "numeric",
  };
  return new Date(dateString).toLocaleDateString("en-GB", options);
}

function getStopsText(stops) {
  if (stops === 0) return "Direct";
  if (stops === 1) return "1 stop";
  return `${stops} stops`;
}

function getAirlineLogoUrl(airline) {
  const map = {
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
    map[airline] ||
    airline.toLowerCase().replace(/\s+/g, "-").replace(/&/, "and");
  return `https://airhex.com/images/airline-logos/alt/${logoName}.png`;
}

function showPlusOne(departure, arrival) {
  return arrival < departure && !arrival.includes("+");
}
</script>

<style scoped>
.flights-content {
  display: flex;
  gap: 20px;
}
.flights-list {
  flex: 1;
}
</style>
