<template>
  <header>
    <nav id="navbar" class="header-top-trans fixed-nav-bar" data-v-6abff7dc>
      <div class="nav-header-container fixed-nav-header" data-v-6abff7dc>
        <div class="nav-header-details" data-v-6abff7dc>
          <div class="header-top-call" data-v-6abff7dc>
            <span class="nav-header-details-group trans" data-v-6abff7dc>
              <svg
                aria-hidden="true"
                focusable="false"
                data-prefix="fas"
                data-icon="phone"
                role="img"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"
                class="header-icon call-us-icon svg-inline--fa fa-phone"
                data-v-6abff7dc
              >
                <path
                  fill="currentColor"
                  d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"
                />
              </svg>
              <a
                id="call-us"
                :href="`tel:${menuData.contact.phone}`"
                class="InfinityNumber trans"
                data-v-6abff7dc
              >
                <span
                  class="InfinityNumber nav-header-details-text"
                  data-v-6abff7dc
                >
                  {{ formatPhoneNumber(menuData.contact.phone) }}
                </span>
              </a>
            </span>
          </div>
          <div class="header-top-times" data-v-6abff7dc>
            <span class="nav-header-details-group trans" data-v-6abff7dc>
              <svg
                aria-hidden="true"
                focusable="false"
                data-prefix="fas"
                data-icon="clock"
                role="img"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"
                class="header-icon opening-times-icon svg-inline--fa fa-clock"
                data-v-6abff7dc
              >
                <path
                  fill="currentColor"
                  d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"
                />
              </svg>
              <span class="nav-header-details-text" data-v-6abff7dc>
                {{ menuData.contact.hours }}
              </span>
            </span>
          </div>
        </div>
        <button
          id="planYourDestCTA"
          class="top-plan-your-dest-button"
          data-v-6abff7dc
          @click="$emit('open-enquiry-modal')"
        >
          <span class="top-plan-text" data-v-6abff7dc>
            {{ menuData.button.text }}
          </span>
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fas"
            data-icon="arrow-right"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 448 512"
            class="svg-inline--fa fa-arrow-right"
            data-v-6abff7dc
          >
            <path
              fill="currentColor"
              d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"
            />
          </svg>
        </button>
      </div>

      <div class="main-nav-container" data-v-6abff7dc>
        <!-- Menu before logo: Destinations, Holiday Types, Offers -->
        <template v-for="(item, idx) in menuData.menu">
          <!-- Show only first 3 items before logo -->
          <template v-if="idx < 3">
            <!-- Dropdown Items -->
            <div
              v-if="item.type === 'dropdown'"
              :key="`dropdown-${idx}`"
              class="nav-link trans"
              :data-dropdown="getDataDropdownValue(item.label)"
              data-v-6abff7dc
              @mouseenter="showDropdown = getDataDropdownValue(item.label)"
              @mouseleave="showDropdown = null"
            >
              <span data-v-6abff7dc>{{ item.label }}</span>

              <!-- Multi-column dropdown (like Destinations) -->
              <div
                v-if="item.columns"
                v-show="showDropdown === getDataDropdownValue(item.label)"
                class="dropdown dest fixed-dropdown"
                data-v-6abff7dc
              >
                <div class="dropdown-large-container" data-v-6abff7dc>
                  <div class="dropdown-column-container" data-v-6abff7dc>
                    <div
                      v-for="(col, cIdx) in item.columns"
                      :key="cIdx"
                      class="dropdown-column"
                      data-v-6abff7dc
                    >
                      <a
                        :href="col.links[0].url"
                        class="dropdown-link top-level"
                        data-v-6abff7dc
                      >
                        {{ col.title }}
                      </a>
                      <div class="sub-dest-links" data-v-6abff7dc>
                        <div
                          v-for="(link, lIdx) in col.links"
                          :key="lIdx"
                          class="dropdown-link sub-dest"
                          data-v-6abff7dc
                        >
                          <a :href="link.url">{{ link.label }}</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <a
                  v-if="item.footer"
                  :href="item.footer.url"
                  class="dropdown-footer view-dest"
                  data-v-6abff7dc
                >
                  {{ item.footer.label }}
                </a>
              </div>

              <!-- Simple dropdown (like Holiday Types) -->
              <div
                v-else
                v-show="showDropdown === getDataDropdownValue(item.label)"
                class="dropdown types fixed-dropdown"
                data-v-6abff7dc
              >
                <a
                  v-for="(link, lIdx) in item.links"
                  :key="lIdx"
                  :href="link.url"
                  class="dropdown-link sub-dest"
                  data-v-6abff7dc
                >
                  {{ link.label }}
                </a>
              </div>
            </div>

            <!-- Regular Link Items before logo -->
            <a
              v-else-if="item.type === 'link'"
              :key="`link-${idx}`"
              :href="item.url"
              class="nav-link trans"
              data-v-6abff7dc
            >
              {{ item.label }}
            </a>
          </template>
        </template>

        <!-- Logo -->
        <nuxt-link :to="menuData.logo.url" class="logo" data-v-6abff7dc>
          <img
            :src="menuData.logo.src"
            :alt="menuData.logo.alt"
            data-v-6abff7dc
          />
        </nuxt-link>

        <!-- Menu after logo: Luxury Cruise, Tailor-Made Holidays, Inspiration -->
        <template v-for="(item, idx) in menuData.menu">
          <!-- Show items from index 3 onwards (after logo) -->
          <template v-if="idx >= 3">
            <!-- Dropdown Items after logo -->
            <div
              v-if="item.type === 'dropdown'"
              :key="`dropdown-after-${idx}`"
              class="nav-link trans"
              :data-dropdown="getDataDropdownValue(item.label)"
              data-v-6abff7dc
              @mouseenter="showDropdown = getDataDropdownValue(item.label)"
              @mouseleave="showDropdown = null"
            >
              <span data-v-6abff7dc>{{ item.label }}</span>

              <!-- Simple dropdown (like Inspiration) with right alignment -->
              <div
                v-show="showDropdown === getDataDropdownValue(item.label)"
                class="dropdown types fixed-dropdown"
                :style="item.label === 'Inspiration' ? 'right: 0px' : ''"
                data-v-6abff7dc
              >
                <a
                  v-for="(link, lIdx) in item.links"
                  :key="lIdx"
                  :href="link.url"
                  class="dropdown-link sub-dest"
                  data-v-6abff7dc
                >
                  {{ link.label }}
                </a>
              </div>
            </div>

            <!-- Regular Link Items after logo -->
            <a
              v-else-if="item.type === 'link'"
              :key="`link-after-${idx}`"
              :href="item.url"
              class="nav-link trans"
              data-v-6abff7dc
            >
              {{ item.label }}
            </a>
          </template>
        </template>
      </div>
    </nav>
    <div style="margin-top: 100px">&nbsp;</div>
  </header>
</template>

<script>
import menuData from "~/static/data/menu.json";

export default {
  name: "AppHeader",
  emits: ["open-enquiry-modal"],
  data() {
    return {
      showDropdown: null,
      menuData,
    };
  },
  methods: {
    formatPhoneNumber(phone) {
      // Format phone number like "01204 269010"
      return phone.replace(/(\d{5})(\d{6})/, "$1&nbsp;$2");
    },
    getDataDropdownValue(label) {
      return label.toLowerCase().replace(/\s+/g, "-");
    },
  },
  mounted() {
    // Add smooth hover effects and interaction
    const navLinks = document.querySelectorAll(".nav-link");

    navLinks.forEach((link) => {
      const dropdown = link.querySelector(".dropdown");
      if (dropdown) {
        let timeout;

        link.addEventListener("mouseenter", function () {
          clearTimeout(timeout);
          dropdown.style.opacity = "1";
          dropdown.style.visibility = "visible";
          dropdown.style.transform = "translateY(0)";
        });

        link.addEventListener("mouseleave", function () {
          timeout = setTimeout(() => {
            dropdown.style.opacity = "0";
            dropdown.style.visibility = "hidden";
            dropdown.style.transform = "translateY(-10px)";
          }, 100);
        });
      }
    });
  },
};
</script>

<style scoped>
/* Header styles are included in the main.css file */
</style>
