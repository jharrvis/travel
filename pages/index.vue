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
        @click="openEnquiry"
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
    <main>
      <Search />
    </main>

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
import Search from "@/components/Search.vue";
import Footer from "@/components/Footer.vue";
import EnquiryModal from "@/components/EnquiryModal.vue";

export default {
  components: {
    Header,
    Search,
    Footer,
    EnquiryModal,
  },
  data() {
    return {
      isModalVisible: false,
      phoneNumber: "01204 269010",
    };
  },
  mounted() {
    // Sticky CTA Functionality
    this.initStickyCTA();
  },
  methods: {
    scrollToTop() {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    },
    openEnquiry() {
      // Open the modal directly
      this.showEnquiryModal();
    },
    showEnquiryModal() {
      this.isModalVisible = true;
    },
    closeModal() {
      this.isModalVisible = false;
    },
    handleFormSubmit(formData) {
      // Handle form submission here
      console.log("Form submitted:", formData);

      // Here you can add API call to submit the form
      // Example:
      // await this.$api.submitEnquiry(formData);

      // You can also add analytics tracking here
      // this.$gtag('event', 'enquiry_submitted', { ...formData });
    },
    initStickyCTA() {
      const stickyContainer = document.querySelector(".sticky-cta-container");
      const scrollThreshold = 300; // 300px from top

      // Function to check if device is mobile
      const isMobile = () => window.innerWidth <= 768;

      // Function to show/hide CTA based on scroll position
      const toggleCTAVisibility = () => {
        const scrollTop =
          window.pageYOffset || document.documentElement.scrollTop;

        if (!isMobile()) {
          // Desktop behavior - show/hide based on scroll position
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
          // Mobile behavior - always visible at bottom
          stickyContainer.style.opacity = "1";
          stickyContainer.style.visibility = "visible";
          stickyContainer.style.transform = "translateY(0)";
        }
      };

      // Event listeners
      window.addEventListener("scroll", toggleCTAVisibility);
      window.addEventListener("resize", toggleCTAVisibility);

      // Initial setup
      if (stickyContainer) {
        stickyContainer.style.transition = "all 0.3s ease-in-out";
        toggleCTAVisibility();
      }
    },
  },
};
</script>

<style scoped>
/* Main styles are included in the main.css file */
</style>
