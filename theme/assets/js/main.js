/**
 * SIBACOM Main JavaScript
 * Handles accessible interactive components (Accordion, Schedule Tabs, Card Visibility)
 * with full Elementor Editor & Frontend lifecycle support.
 *
 * @package SIBACOM
 */
(function () {
  'use strict';

  var faqIdCounter = 0;

  /**
   * Initialize Accessible Accordion
   * Supports WAI-ARIA accordion pattern with keyboard navigation (Enter, Space, Arrows, Home, End).
   *
   * @param {HTMLElement|Document} root
   */
  function initAccordions(root) {
    if (!root) return;
    var accordions = root.querySelectorAll('.sibacom-accordion');

    accordions.forEach(function (accordion) {
      var items = accordion.querySelectorAll('.sibacom-accordion-item');
      var headers = [];

      items.forEach(function (item) {
        var header = item.querySelector('.sibacom-accordion-header');
        var content = item.querySelector('.sibacom-accordion-content');

        if (!header) return;
        headers.push(header);

        faqIdCounter++;
        var headerId = header.id || 'sibacom-faq-h-' + faqIdCounter;
        var contentId = content ? (content.id || 'sibacom-faq-c-' + faqIdCounter) : '';

        header.id = headerId;
        header.setAttribute('role', 'button');
        header.setAttribute('tabindex', '0');

        if (content) {
          content.id = contentId;
          content.setAttribute('role', 'region');
          content.setAttribute('aria-labelledby', headerId);
          header.setAttribute('aria-controls', contentId);
        }

        var isActive = item.classList.contains('active');
        header.setAttribute('aria-expanded', isActive ? 'true' : 'false');
        if (content) {
          content.setAttribute('aria-hidden', isActive ? 'false' : 'true');
        }

        // Click handler
        if (!header.dataset.sibacomAccordionBound) {
          header.dataset.sibacomAccordionBound = 'true';

          header.addEventListener('click', function () {
            var currentlyActive = item.classList.contains('active');

            // Close other sibling items in the same accordion
            items.forEach(function (otherItem) {
              if (otherItem !== item) {
                otherItem.classList.remove('active');
                var otherHeader = otherItem.querySelector('.sibacom-accordion-header');
                var otherContent = otherItem.querySelector('.sibacom-accordion-content');
                if (otherHeader) otherHeader.setAttribute('aria-expanded', 'false');
                if (otherContent) otherContent.setAttribute('aria-hidden', 'true');
              }
            });

            // Toggle current item
            if (currentlyActive) {
              item.classList.remove('active');
              header.setAttribute('aria-expanded', 'false');
              if (content) content.setAttribute('aria-hidden', 'true');
            } else {
              item.classList.add('active');
              header.setAttribute('aria-expanded', 'true');
              if (content) content.setAttribute('aria-hidden', 'false');
            }
          });

          // Keyboard Accessibility
          header.addEventListener('keydown', function (e) {
            var key = e.key;
            var index = headers.indexOf(header);

            if (key === 'Enter' || key === ' ' || key === 'Spacebar') {
              e.preventDefault();
              header.click();
            } else if (key === 'ArrowDown') {
              e.preventDefault();
              var nextIndex = (index + 1) % headers.length;
              headers[nextIndex].focus();
            } else if (key === 'ArrowUp') {
              e.preventDefault();
              var prevIndex = (index - 1 + headers.length) % headers.length;
              headers[prevIndex].focus();
            } else if (key === 'Home') {
              e.preventDefault();
              if (headers.length > 0) headers[0].focus();
            } else if (key === 'End') {
              e.preventDefault();
              if (headers.length > 0) headers[headers.length - 1].focus();
            }
          });
        }
      });
    });
  }

  /**
   * Initialize Schedule Day Filter Tabs
   *
   * @param {HTMLElement|Document} root
   */
  function initScheduleTabs(root) {
    if (!root) return;
    var tabContainers = root.querySelectorAll('.sibacom-schedule-tabs');

    tabContainers.forEach(function (tabContainer) {
      var tabButtons = tabContainer.querySelectorAll('.sibacom-tab-btn');
      var timelineContainer = tabContainer.closest('.sibacom-schedule-wrapper') || document.querySelector('.sibacom-timeline');

      if (!timelineContainer) return;

      tabButtons.forEach(function (btn) {
        if (btn.dataset.sibacomTabBound) return;
        btn.dataset.sibacomTabBound = 'true';

        btn.addEventListener('click', function () {
          var targetDay = btn.getAttribute('data-day') || 'all';

          tabButtons.forEach(function (b) {
            b.classList.remove('active');
          });
          btn.classList.add('active');

          var items = timelineContainer.querySelectorAll('.sibacom-timeline-item');
          items.forEach(function (item) {
            var itemDay = item.getAttribute('data-day') || '';
            if (targetDay === 'all' || itemDay === targetDay) {
              item.style.display = '';
            } else {
              item.style.display = 'none';
            }
          });
        });
      });
    });
  }

  /**
   * Guarantee 100% Visual Clarity and Sharpness
   * Eliminates stuck opacity, filters, and animation delays.
   *
   * @param {HTMLElement|Document} root
   */
  function revealCards(root) {
    if (!root) return;
    var cardSelector = '.neu-card, .neu-card-flat, .sibacom-highlight-card, .sibacom-speaker-card, .sibacom-timeline-card, .sibacom-org-card, .sibacom-event-card, .sibacom-info-card, .sibacom-guest-card, .sibacom-sponsor-card';
    var cards = root.querySelectorAll(cardSelector);

    cards.forEach(function (el) {
      el.classList.add('is-revealed');
      el.style.opacity = '1';
      el.style.transform = 'none';
      el.style.visibility = 'visible';
      el.style.filter = 'none';
    });
  }

  /**
   * DOM Ready Initializer
   */
  function init() {
    initAccordions(document);
    initScheduleTabs(document);
    revealCards(document);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  /**
   * Hook into Elementor Frontend and Editor Lifecycles
   */
  function bindElementorHooks() {
    if (window.elementorFrontend && window.elementorFrontend.hooks) {
      window.elementorFrontend.hooks.addAction('frontend/element_ready/sibacom_faq.default', function ($scope) {
        var el = $scope ? $scope[0] : null;
        if (el) {
          initAccordions(el);
          revealCards(el);
        }
      });

      window.elementorFrontend.hooks.addAction('frontend/element_ready/sibacom_schedule.default', function ($scope) {
        var el = $scope ? $scope[0] : null;
        if (el) {
          initScheduleTabs(el);
          revealCards(el);
        }
      });

      window.elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($scope) {
        var el = $scope ? $scope[0] : null;
        if (el) {
          revealCards(el);
        }
      });
    }
  }

  if (window.jQuery) {
    window.jQuery(window).on('elementor/frontend/init', bindElementorHooks);
  }
  // Also invoke directly if already initialized
  if (window.elementorFrontend && window.elementorFrontend.hooks) {
    bindElementorHooks();
  }
})();
