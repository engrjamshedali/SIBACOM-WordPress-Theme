/**
 * SIBACOM Countdown Timer JavaScript
 * Synchronized for official summit date: 30 November 2026
 */
(function () {
  'use strict';

  function parseTargetDate(dateStr) {
    if (!dateStr) {
      dateStr = (window.sibacomData && window.sibacomData.targetDate) || '2026-11-30T09:00:00';
    }
    // If no timezone offset is present, assume Pakistan Standard Time (PKT, UTC+5)
    if (!dateStr.includes('+') && !dateStr.includes('Z') && !dateStr.includes('-0') && !dateStr.includes('-1')) {
      dateStr += '+05:00';
    }
    return new Date(dateStr).getTime();
  }

  function initCountdown(container) {
    if (!container || container.getAttribute('data-countdown-initialized') === 'true') {
      return;
    }
    container.setAttribute('data-countdown-initialized', 'true');

    const targetAttr = container.getAttribute('data-target-date');
    const targetDate = parseTargetDate(targetAttr);
    const completedMsg = container.getAttribute('data-completed-msg') || 'The SIBACOM Summit is in Progress!';

    const daysEl = container.querySelector('.days-val');
    const hoursEl = container.querySelector('.hours-val');
    const minutesEl = container.querySelector('.minutes-val');
    const secondsEl = container.querySelector('.seconds-val');

    function updateCountdown() {
      const now = new Date().getTime();
      const difference = targetDate - now;

      if (difference > 0) {
        const days = Math.floor(difference / (1000 * 60 * 60 * 24));
        const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((difference % (1000 * 60)) / 1000);

        const daysStr = days < 10 ? '0' + days : '' + days;
        const hoursStr = hours < 10 ? '0' + hours : '' + hours;
        const minutesStr = minutes < 10 ? '0' + minutes : '' + minutes;
        const secondsStr = seconds < 10 ? '0' + seconds : '' + seconds;

        if (daysEl && daysEl.textContent !== daysStr) daysEl.textContent = daysStr;
        if (hoursEl && hoursEl.textContent !== hoursStr) hoursEl.textContent = hoursStr;
        if (minutesEl && minutesEl.textContent !== minutesStr) minutesEl.textContent = minutesStr;
        if (secondsEl && secondsEl.textContent !== secondsStr) secondsEl.textContent = secondsStr;
      } else {
        if (daysEl && daysEl.textContent !== '00') daysEl.textContent = '00';
        if (hoursEl && hoursEl.textContent !== '00') hoursEl.textContent = '00';
        if (minutesEl && minutesEl.textContent !== '00') minutesEl.textContent = '00';
        if (secondsEl && secondsEl.textContent !== '00') secondsEl.textContent = '00';

        // Check for completed message container or create one
        let notice = container.querySelector('.sibacom-countdown-completed-notice');
        if (!notice && container.getAttribute('data-show-completed') === 'true') {
          notice = document.createElement('div');
          notice.className = 'sibacom-countdown-completed-notice';
          notice.style.marginTop = '1rem';
          notice.style.fontWeight = '700';
          notice.style.color = 'var(--sibacom-techgreen, #079B58)';
          notice.textContent = completedMsg;
          container.appendChild(notice);
        }
      }
    }

    updateCountdown();
    const timerInterval = setInterval(updateCountdown, 1000);
    container._countdownInterval = timerInterval;
  }

  function initAllCountdowns() {
    document.querySelectorAll('.sibacom-countdown').forEach(function (container) {
      initCountdown(container);
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAllCountdowns);
  } else {
    initAllCountdowns();
  }

  // Hook into Elementor Frontend widget initialization
  if (window.jQuery) {
    window.jQuery(window).on('elementor/frontend/init', function () {
      if (window.elementorFrontend && window.elementorFrontend.hooks) {
        window.elementorFrontend.hooks.addAction('frontend/element_ready/sibacom_countdown.default', function ($scope) {
          const el = $scope.find('.sibacom-countdown')[0];
          if (el) {
            el.removeAttribute('data-countdown-initialized');
            initCountdown(el);
          }
        });
        window.elementorFrontend.hooks.addAction('frontend/element_ready/sibacom_hero.default', function ($scope) {
          const el = $scope.find('.sibacom-countdown')[0];
          if (el) {
            el.removeAttribute('data-countdown-initialized');
            initCountdown(el);
          }
        });
      }
    });
  }
})();
