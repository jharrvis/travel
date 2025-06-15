<template>
  <div
    class="fullscreen-enquiry"
    data-v-3f212ead
    :style="{ display: visible ? 'block' : 'none' }"
    @click="handleBackdropClick"
  >
    <div class="enquiry-modal" data-v-3f212ead @click.stop>
      <div class="close-modal" data-v-3f212ead @click="closeModal">
        <svg
          data-v-3f212ead
          xmlns="http://www.w3.org/2000/svg"
          height="24px"
          viewBox="0 0 24 24"
          width="24px"
          fill="#000000"
        >
          <path data-v-3f212ead d="M0 0h24v24H0V0z" fill="none"></path>
          <path
            data-v-3f212ead
            d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"
          ></path>
        </svg>
      </div>

      <div class="enquiry-content container" data-v-3f212ead>
        <div class="enquiry-title-container" data-v-3f212ead>
          <h2 class="enquiry-title" data-v-3f212ead>It's Good to Talk</h2>
        </div>

        <div class="enquiry-title-container" data-v-3f212ead>
          <div class="enquiry-subtitle" data-v-3f212ead>
            Take a holiday from planning your holiday and contact our travel
            experts. Call us on
            <strong data-v-3f212ead>{{ phoneNumber }}</strong> or use the form
            below and we'll take care of every detail.
          </div>
        </div>

        <div class="enquiry-form" data-v-3f212ead>
          <form
            id="enquiryForm"
            name="enquiryForm"
            class="enquiryForm"
            data-v-3f212ead
            @submit.prevent="submitForm"
          >
            <div class="row" data-v-3f212ead>
              <div class="col-xs-12 col-sm-6" data-v-3f212ead>
                <input
                  id="firstName"
                  type="text"
                  placeholder="First Name"
                  class="form-control enquiry-form-input"
                  data-v-3f212ead
                  v-model="formData.firstName"
                  required
                />
              </div>
              <div class="col-xs-12 col-sm-6" data-v-3f212ead>
                <input
                  id="lastName"
                  type="text"
                  placeholder="Last Name"
                  class="form-control enquiry-form-input"
                  data-v-3f212ead
                  v-model="formData.lastName"
                  required
                />
              </div>
            </div>

            <div class="row" data-v-3f212ead>
              <div class="col-xs-12 col-sm-6" data-v-3f212ead>
                <input
                  id="phoneNumber"
                  type="tel"
                  placeholder="Mobile Number"
                  class="form-control enquiry-form-input"
                  data-v-3f212ead
                  v-model="formData.phoneNumber"
                  required
                />
              </div>
              <div class="col-xs-12 col-sm-6" data-v-3f212ead>
                <input
                  id="email"
                  type="email"
                  placeholder="Email Address"
                  class="form-control enquiry-form-input"
                  data-v-3f212ead
                  v-model="formData.email"
                  required
                />
              </div>
            </div>

            <div class="row" data-v-3f212ead>
              <div class="col-lg-12" data-v-3f212ead>
                <textarea
                  rows="4"
                  placeholder="What time is best to call you back?&#10;Please include the number of adults & children travelling, when and where you want to go and for how long."
                  name="enquiryText"
                  class="form-control enquiry-form-input ef-text-area"
                  data-v-3f212ead
                  v-model="formData.enquiryText"
                  required
                ></textarea>
                <div class="small" data-v-3f212ead>
                  Destinology take your privacy seriously. You can find out more
                  about how we use your personal data in our
                  <a
                    target="_blank"
                    href="/terms-and-conditions#privacy"
                    data-v-3f212ead
                    >Privacy Policy</a
                  >.
                </div>
              </div>
            </div>

            <div class="recaptcha-container" data-v-3f212ead>
              <div
                data-sitekey="6LfpsyYfAAAAABnk79rKfvEpTtsMiZbHWasL9YFc"
                data-size="normal"
                data-theme="light"
                data-badge="bottomright"
                data-tabindex="0"
                class="g-recaptcha"
                data-v-3f212ead
              >
                <!-- reCAPTCHA will be loaded here -->
              </div>
            </div>

            <div class="col-xs-12 submit-form-button" data-v-3f212ead>
              <button
                type="submit"
                class="btn btn-primary"
                data-v-3f212ead
                :disabled="isSubmitting"
              >
                {{ isSubmitting ? "Submitting..." : "Enquire now" }}
              </button>
            </div>

            <input
              type="hidden"
              id="Label"
              name="Label"
              value="genericEnquiryForm"
              data-v-3f212ead
            />
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "EnquiryModal",
  props: {
    visible: {
      type: Boolean,
      default: false,
    },
    phoneNumber: {
      type: String,
      default: "01204 269010",
    },
  },
  emits: ["close", "submit"],
  data() {
    return {
      isSubmitting: false,
      formData: {
        firstName: "",
        lastName: "",
        phoneNumber: "",
        email: "",
        enquiryText: "",
      },
    };
  },
  watch: {
    visible(newVal) {
      if (newVal) {
        // Prevent body scroll when modal is open
        document.body.style.overflow = "hidden";
        // Focus on first input
        this.$nextTick(() => {
          const firstInput = this.$el.querySelector("#firstName");
          if (firstInput) firstInput.focus();
        });
      } else {
        // Restore body scroll
        document.body.style.overflow = "";
      }
    },
  },
  mounted() {
    // Close modal with Escape key
    document.addEventListener("keydown", this.handleEscapeKey);
  },
  beforeUnmount() {
    // Cleanup event listener
    document.removeEventListener("keydown", this.handleEscapeKey);
    // Restore body scroll if modal was open
    document.body.style.overflow = "";
  },
  methods: {
    closeModal() {
      this.$emit("close");
    },
    handleBackdropClick() {
      // Close modal when clicking on backdrop
      this.closeModal();
    },
    handleEscapeKey(e) {
      if (e.key === "Escape" && this.visible) {
        this.closeModal();
      }
    },
    async submitForm() {
      if (this.isSubmitting) return;

      // Basic validation
      if (
        !this.formData.firstName.trim() ||
        !this.formData.lastName.trim() ||
        !this.formData.email.trim() ||
        !this.formData.phoneNumber.trim() ||
        !this.formData.enquiryText.trim()
      ) {
        alert("Please fill in all required fields.");
        return;
      }

      this.isSubmitting = true;

      try {
        // Emit form data to parent
        this.$emit("submit", { ...this.formData });

        // Show success message
        alert("Thank you for your enquiry! We will be in touch soon.");

        // Reset form
        this.resetForm();

        // Close modal
        this.closeModal();
      } catch (error) {
        console.error("Form submission error:", error);
        alert(
          "Sorry, there was an error submitting your enquiry. Please try again."
        );
      } finally {
        this.isSubmitting = false;
      }
    },
    resetForm() {
      this.formData = {
        firstName: "",
        lastName: "",
        phoneNumber: "",
        email: "",
        enquiryText: "",
      };
    },
  },
};
</script>

<style scoped>
/* Modal styles are included in the main.css file */
</style>
