<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Destinology - Luxury Holidays & Travel</title>
    <link
      data-n-head="ssr"
      rel="icon"
      type="image/x-icon"
      href="https://www.destinology.co.uk/favicon.ico"
    />
    <link data-n-head="ssr" rel="preconnect" href="//fonts.googleapis.com">
    <link data-n-head="ssr" rel="preconnect" href="//fonts.gstatic.com">
    <link data-n-head="ssr" rel="stylesheet" href="https://use.typekit.net/qnw1adk.css" defer="">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <style>

      h1 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
        font-weight: 300;
        font-family: the-seasons,serif;
      }
      /* .sticky-cta-container {
          position: fixed;
          bottom: 20px;
          right: 20px;
          z-index: 1000;
          display: none;
          opacity: 0;
          transform: translateY(20px);
          transition: opacity 0.3s ease, transform 0.3s ease;
      } */

    </style>
  </head>
  <body>
    <div id="__nuxt">
    <div id="__layout">
        <div id="app">
          <!-- Header -->
          <?php
          function isMobile() {
              return preg_match('/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone|Opera Mini|IEMobile/i', $_SERVER['HTTP_USER_AGENT']);
            }

            if (isMobile()) {
              include 'header-mobile.php';
            } else {
              include 'header.php';
            }
          ?>
          <!-- sticky CTA -->
          <div class="sticky-cta-container" style="" data-v-7b6ed19f="">
            <div class="sticky-cta-item" data-v-7b6ed19f="">
              <svg
                aria-hidden="true"
                focusable="false"
                data-prefix="fas"
                data-icon="arrow-up"
                role="img"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 384 512"
                class="cta-icon svg-inline--fa fa-arrow-up"
                data-v-7b6ed19f=""
              >
                <path
                  fill="currentColor"
                  d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2 160 448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-306.7L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"
                  data-v-7b6ed19f=""
                  class=""
                ></path>
              </svg>
              <span data-v-7b6ed19f="">Back to Top</span>
            </div>
            <a
              href="tel:01204 269010"
              id="CTACall"
              class="sticky-cta-item InfinityNumber"
              data-v-7b6ed19f=""
              ><svg
                aria-hidden="true"
                focusable="false"
                data-prefix="fas"
                data-icon="phone"
                role="img"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"
                class="cta-icon svg-inline--fa fa-phone"
                data-v-7b6ed19f=""
              >
                <path
                  fill="currentColor"
                  d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"
                  data-v-7b6ed19f=""
                  class=""
                ></path>
              </svg>
              <span data-v-7b6ed19f="">Call</span></a
            >
            <div id="CTAEnquiry" class="sticky-cta-item" data-v-7b6ed19f="">
              <svg
                aria-hidden="true"
                focusable="false"
                data-prefix="fas"
                data-icon="envelope"
                role="img"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"
                class="cta-icon svg-inline--fa fa-envelope"
                data-v-7b6ed19f=""
              >
                <path
                  fill="currentColor"
                  d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"
                  data-v-7b6ed19f=""
                  class=""
                ></path>
              </svg>
              <span data-v-7b6ed19f="">Enquire</span>
            </div>
            <!---->
            <!---->
            <!---->
          </div>

          <!-- Content Area -->
          <div class="page-section container">
            <?php include 'search.php'; ?>
          </div>

          <?php include 'footer.php'; ?>
        </div>
      </div>
      </div>

    <script>
      // Add smooth hover effects and interaction
      document.addEventListener("DOMContentLoaded", function () {
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

        // Plan Your Holiday button interaction
        const planButton = document.querySelector(".top-plan-your-dest-button");
        planButton.addEventListener("click", function () {
          alert(
            "Plan Your Next Holiday clicked! This would typically open a booking form or destination selector."
          );
        });
      });
    </script>
    <script>
        // Sticky CTA Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const stickyContainer = document.querySelector('.sticky-cta-container');
            const backToTopBtn = document.querySelector('.sticky-cta-item:first-child');
            const scrollIndicator = document.getElementById('scrollIndicator');
            const scrollThreshold = 300; // 300px dari atas
            
            // Function untuk mengecek apakah device mobile
            function isMobile() {
                return window.innerWidth <= 768;
            }
            
            // Function untuk show/hide CTA berdasarkan scroll position
            function toggleCTAVisibility() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                // Update scroll indicator (for demo)
                if (scrollIndicator) {
                    const ctaStatus = scrollTop >= scrollThreshold || isMobile() ? 'Visible' : 'Hidden';
                    scrollIndicator.innerHTML = `Scroll: ${Math.round(scrollTop)}px | CTA: ${ctaStatus}`;
                }
                
                if (!isMobile()) {
                    // Desktop behavior - show/hide based on scroll position
                    if (scrollTop >= scrollThreshold) {
                        stickyContainer.style.opacity = '1';
                        stickyContainer.style.visibility = 'visible';
                        stickyContainer.style.transform = 'translateX(0)';
                    } else {
                        stickyContainer.style.opacity = '0';
                        stickyContainer.style.visibility = 'hidden';
                        stickyContainer.style.transform = 'translateX(100%)';
                    }
                } else {
                    // Mobile behavior - always visible at bottom
                    stickyContainer.style.opacity = '1';
                    stickyContainer.style.visibility = 'visible';
                    stickyContainer.style.transform = 'translateY(0)';
                }
            }
            
            // Function untuk smooth scroll ke atas
            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
            
            // Event listener untuk scroll
            window.addEventListener('scroll', toggleCTAVisibility);
            
            // Event listener untuk resize window (responsive)
            window.addEventListener('resize', function() {
                toggleCTAVisibility();
            });
            
            // Event listener untuk back to top button
            if (backToTopBtn) {
                backToTopBtn.addEventListener('click', scrollToTop);
            }
            
            // Initial setup
            if (stickyContainer) {
                // Set initial transition properties
                stickyContainer.style.transition = 'all 0.3s ease-in-out';
                
                // Initial visibility check
                toggleCTAVisibility();
            }
            
            // Optional: Add click handlers for other CTA items
            const callBtn = document.getElementById('CTACall');
            const enquiryBtn = document.getElementById('CTAEnquiry');
            
            // Call button sudah memiliki href, jadi tidak perlu handler tambahan
            
            // Enquiry button - bisa ditambahkan handler sesuai kebutuhan
            if (enquiryBtn) {
                enquiryBtn.addEventListener('click', function() {
                    // Tambahkan logic untuk enquiry form atau modal
                    alert('Enquiry button clicked! You can add your custom logic here.');
                    // Contoh: window.location.href = '#contact-form';
                    // Atau: openEnquiryModal();
                });
            }
        });

        // Optional: Tambahan untuk smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
  </body>
</html>
