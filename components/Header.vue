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
                href="tel:01204269010"
                class="InfinityNumber trans"
                data-v-6abff7dc
              >
                <span
                  class="InfinityNumber nav-header-details-text"
                  data-v-6abff7dc
                >
                  01204&nbsp;269010
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
                Open until 19:00
              </span>
            </span>
          </div>
        </div>
        <button
          id="planYourDestCTA"
          class="top-plan-your-dest-button"
          data-v-6abff7dc
          @click="planYourHoliday"
        >
          <span class="top-plan-text" data-v-6abff7dc>
            Plan Your Next Holiday
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
        <!-- Destinations Dropdown -->
        <div
          class="nav-link trans"
          data-dropdown="destinations"
          data-v-6abff7dc
          @mouseenter="showDropdown = 'destinations'"
          @mouseleave="showDropdown = null"
        >
          <span data-v-6abff7dc>Destinations</span>
          <div
            v-show="showDropdown === 'destinations'"
            class="dropdown dest fixed-dropdown"
            data-v-6abff7dc
          >
            <div class="dropdown-large-container" data-v-6abff7dc>
              <div class="dropdown-column-container" data-v-6abff7dc>
                <div class="dropdown-column" data-v-6abff7dc>
                  <a
                    href="/destinations/indian-ocean/hotels"
                    class="dropdown-link top-level"
                    data-v-6abff7dc
                  >
                    Indian Ocean
                  </a>
                  <div class="sub-dest-links" data-v-6abff7dc>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a href="/destinations/indian-ocean/maldives/hotels"
                        >Maldives</a
                      >
                    </div>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a href="/destinations/indian-ocean/mauritius/hotels"
                        >Mauritius</a
                      >
                    </div>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a href="/destinations/indian-ocean/seychelles/hotels"
                        >Seychelles</a
                      >
                    </div>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a
                        href="https://tailor-made-holidays.destinology.co.uk/country/sri-lanka"
                        >Sri Lanka</a
                      >
                    </div>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a
                        href="https://tailor-made-holidays.destinology.co.uk/country/india"
                        >India</a
                      >
                    </div>
                  </div>
                </div>

                <div class="dropdown-column" data-v-6abff7dc>
                  <a
                    href="/destinations/middle-east/hotels"
                    class="dropdown-link top-level"
                    data-v-6abff7dc
                  >
                    Middle East
                  </a>
                  <div class="sub-dest-links" data-v-6abff7dc>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a href="/destinations/united-arab-emirates/dubai/hotels"
                        >Dubai</a
                      >
                    </div>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a
                        href="/destinations/united-arab-emirates/abu-dhabi/hotels"
                        >Abu Dhabi</a
                      >
                    </div>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a href="/destinations/middle-east/oman/hotels">Oman</a>
                    </div>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a href="/destinations/middle-east/qatar/hotels">Qatar</a>
                    </div>
                  </div>
                </div>

                <div class="dropdown-column" data-v-6abff7dc>
                  <a
                    href="/destinations/europe/hotels"
                    class="dropdown-link top-level"
                    data-v-6abff7dc
                  >
                    Europe
                  </a>
                  <div class="sub-dest-links" data-v-6abff7dc>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a href="/destinations/europe/greece/hotels">Greece</a>
                    </div>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a href="/destinations/europe/spain/hotels">Spain</a>
                    </div>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a href="/destinations/europe/cyprus/hotels">Cyprus</a>
                    </div>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a href="/destinations/europe/portugal/hotels"
                        >Portugal</a
                      >
                    </div>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a href="/destinations/europe/italy/hotels">Italy</a>
                    </div>
                  </div>
                </div>

                <div class="dropdown-column" data-v-6abff7dc>
                  <a
                    href="/destinations/caribbean/hotels"
                    class="dropdown-link top-level"
                    data-v-6abff7dc
                  >
                    Caribbean & Mexico
                  </a>
                  <div class="sub-dest-links" data-v-6abff7dc>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a href="/destinations/caribbean/barbados/hotels"
                        >Barbados</a
                      >
                    </div>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a href="/destinations/caribbean/saint-lucia/hotels"
                        >Saint Lucia</a
                      >
                    </div>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a href="/destinations/caribbean/jamaica/hotels"
                        >Jamaica</a
                      >
                    </div>
                    <div class="dropdown-link sub-dest" data-v-6abff7dc>
                      <a href="/destinations/caribbean/mexico/hotels">Mexico</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <a
              href="/destinations"
              class="dropdown-footer view-dest"
              data-v-6abff7dc
            >
              View All Destinations
            </a>
          </div>
        </div>

        <!-- Holiday Types Dropdown -->
        <div
          class="nav-link trans"
          data-dropdown="holiday-types"
          data-v-6abff7dc
          @mouseenter="showDropdown = 'holiday-types'"
          @mouseleave="showDropdown = null"
        >
          <span data-v-6abff7dc>Holiday Types</span>
          <div
            v-show="showDropdown === 'holiday-types'"
            class="dropdown types fixed-dropdown"
            data-v-6abff7dc
          >
            <a
              href="/holidays/all-inclusive"
              class="dropdown-link sub-dest"
              data-v-6abff7dc
            >
              All Inclusive Holidays
            </a>
            <a
              href="/holidays/family-holidays"
              class="dropdown-link sub-dest"
              data-v-6abff7dc
            >
              Family Holidays
            </a>
            <a
              href="/holidays/luxury-adult-only-holidays"
              class="dropdown-link sub-dest"
              data-v-6abff7dc
            >
              Adult Only Holidays
            </a>
            <a
              href="/holidays/honeymoons"
              class="dropdown-link sub-dest"
              data-v-6abff7dc
            >
              Honeymoons
            </a>
            <a
              href="/holidays/city-breaks"
              class="dropdown-link sub-dest"
              data-v-6abff7dc
            >
              City Breaks
            </a>
          </div>
        </div>

        <!-- Offers Link -->
        <a href="/holiday-offers" class="nav-link trans" data-v-6abff7dc>
          Offers
        </a>

        <!-- Logo -->
        <nuxt-link to="/" class="logo" data-v-6abff7dc>
          <img
            src="https://res.cloudinary.com/destinology/image/upload/v1726650313/Logos/Base/Black/Black_Wide_SVG.svg"
            alt="Destinology"
            data-v-6abff7dc
          />
        </nuxt-link>

        <!-- Other Links -->
        <a
          href="https://cruise.destinology.co.uk"
          class="nav-link trans"
          data-v-6abff7dc
        >
          Luxury Cruise
        </a>
        <a
          href="https://tailor-made-holidays.destinology.co.uk"
          class="nav-link trans"
          data-v-6abff7dc
        >
          Tailor-Made Holidays
        </a>

        <!-- Inspiration Dropdown -->
        <div
          class="nav-link trans"
          data-dropdown="inspiration"
          data-v-6abff7dc
          @mouseenter="showDropdown = 'inspiration'"
          @mouseleave="showDropdown = null"
        >
          <span data-v-6abff7dc>Inspiration</span>
          <div
            v-show="showDropdown === 'inspiration'"
            class="dropdown types fixed-dropdown"
            style="right: 0px"
            data-v-6abff7dc
          >
            <a href="/blog" class="dropdown-link sub-dest" data-v-6abff7dc>
              Blog
            </a>
            <a
              href="/holidays/friends-of-destinology"
              class="dropdown-link sub-dest"
              data-v-6abff7dc
            >
              Friends of Destinology
            </a>
          </div>
        </div>
      </div>
    </nav>
    <div style="margin-top: 100px">&nbsp;</div>
  </header>
</template>

<script>
export default {
  name: "AppHeader",
  data() {
    return {
      showDropdown: null,
    };
  },
  methods: {
    planYourHoliday() {
      alert(
        "Plan Your Next Holiday clicked! This would typically open a booking form or destination selector."
      );
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
