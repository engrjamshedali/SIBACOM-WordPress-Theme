/**
 * SIBACOM Theme Navigation JavaScript
 * Responsive, touch-accessible, high-performance multi-page navigation logic
 *
 * @package SIBACOM
 */
function initNavigation() {
  const header = document.querySelector('.sibacom-header');
  const toggleBtn = document.querySelector('.sibacom-mobile-toggle');
  const mobileMenu = document.querySelector('.sibacom-mobile-menu');
  const closeBtn = document.querySelector('.sibacom-mobile-close');

  // Sticky Header Scroll Detection (Passive for maximum scroll performance & INP)
  if (header) {
    let ticking = false;
    window.addEventListener('scroll', function () {
      if (!ticking) {
        window.requestAnimationFrame(function () {
          if (window.scrollY > 40) {
            header.classList.add('is-scrolled');
          } else {
            header.classList.remove('is-scrolled');
          }
          ticking = false;
        });
        ticking = true;
      }
    }, { passive: true });
  }

  // Prevent background scrolling while mobile menu is open
  function lockScroll() {
    document.body.classList.add('sibacom-menu-locked');
    document.documentElement.classList.add('sibacom-menu-locked');
  }

  function unlockScroll() {
    document.body.classList.remove('sibacom-menu-locked');
    document.documentElement.classList.remove('sibacom-menu-locked');
  }

  // Open accessible mobile menu drawer
  function openMobileMenu() {
    if (!mobileMenu) return;
    mobileMenu.classList.add('active');
    lockScroll();

    if (toggleBtn) {
      toggleBtn.setAttribute('aria-expanded', 'true');
      const icon = toggleBtn.querySelector('i');
      if (icon) {
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-xmark');
      }
    }

    if (closeBtn) {
      closeBtn.focus();
    }
  }

  // Close accessible mobile menu drawer
  function closeMobileMenu() {
    if (!mobileMenu) return;
    mobileMenu.classList.remove('active');
    unlockScroll();

    if (toggleBtn) {
      toggleBtn.setAttribute('aria-expanded', 'false');
      const icon = toggleBtn.querySelector('i');
      if (icon) {
        icon.classList.remove('fa-xmark');
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');
      }
    }
  }

  function toggleMobileMenu() {
    if (!mobileMenu) return;
    if (mobileMenu.classList.contains('active')) {
      closeMobileMenu();
    } else {
      openMobileMenu();
    }
  }

  // Mobile Menu Event Listeners
  if (toggleBtn && mobileMenu) {
    toggleBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      toggleMobileMenu();
    });

    if (closeBtn) {
      closeBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        closeMobileMenu();
        toggleBtn.focus();
      });
    }

    // Close when clicking outside menu drawer and toggle button
    document.addEventListener('click', function (e) {
      if (mobileMenu.classList.contains('active') && !mobileMenu.contains(e.target) && !toggleBtn.contains(e.target)) {
        closeMobileMenu();
      }
    });

    // Close menu when clicking navigation links (natural multi-page navigation proceeds)
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(function (link) {
      link.addEventListener('click', function () {
        closeMobileMenu();
      });
    });

    // Keyboard Accessibility: Escape key closes menu and restores focus
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
        closeMobileMenu();
        toggleBtn.focus();
      }
    });
  }

  // Highlight currently active page across Desktop & Mobile menus
  function highlightActiveNavigation() {
    const rawPath = window.location.pathname.toLowerCase();
    // Normalize path: extract filename or last segment
    let pathSegments = rawPath.split('/').filter(Boolean);
    let currentPage = 'home';

    if (pathSegments.length > 0) {
      let lastSegment = pathSegments[pathSegments.length - 1];
      if (lastSegment === 'index.html' || lastSegment === '') {
        currentPage = 'home';
      } else {
        currentPage = lastSegment.replace('.html', '').replace(/\/$/, '');
      }
    }

    const navSelectors = '.sibacom-nav-desktop a, .sibacom-mobile-nav a, .sibacom-footer-links a';
    const allLinks = document.querySelectorAll(navSelectors);

    allLinks.forEach(function (link) {
      const href = link.getAttribute('href');
      if (!href) return;

      let linkTarget = '';
      if (href === '/' || href === 'index.html' || href.endsWith('/index.html') || href.endsWith('/')) {
        linkTarget = 'home';
      } else {
        // Extract slug from href
        let clean = href.split('?')[0].split('#')[0];
        let parts = clean.split('/').filter(Boolean);
        if (parts.length > 0) {
          linkTarget = parts[parts.length - 1].replace('.html', '');
        }
      }

      // Check match
      const isMatch = (currentPage === linkTarget) || (currentPage === 'home' && linkTarget === 'home');
      const li = link.closest('li');

      if (isMatch) {
        link.classList.add('active', 'is-active');
        link.setAttribute('aria-current', 'page');
        if (li && !li.classList.contains('sibacom-btn-wrap')) {
          li.classList.add('current-menu-item');
        }
      } else {
        // Only remove if it doesn't match
        link.classList.remove('active', 'is-active');
        link.removeAttribute('aria-current');
        if (li && !li.querySelector('.active')) {
          li.classList.remove('current-menu-item');
        }
      }
    });
  }

  highlightActiveNavigation();
  window.addEventListener('popstate', highlightActiveNavigation);

  // Smooth scroll strictly for in-page anchors with dynamic header offset
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      if (targetId && targetId.length > 1 && targetId !== '#') {
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
          e.preventDefault();
          const headerH = header ? header.offsetHeight : 82;
          const elementPosition = targetElement.getBoundingClientRect().top;
          const offsetPosition = elementPosition + window.pageYOffset - headerH - 12;
          window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
          });
        }
      }
    });
  });
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initNavigation);
} else {
  initNavigation();
}
