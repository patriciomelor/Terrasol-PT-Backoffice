/**
 * Main
 */

'use strict';

window.isRtl = window.Helpers.isRtl();
window.isDarkStyle = window.Helpers.isDarkStyle();
let menu,
  animate,
  isHorizontalLayout = false;

if (document.getElementById('layout-menu')) {
  isHorizontalLayout = document.getElementById('layout-menu').classList.contains('menu-horizontal');
}

(function () {
  setTimeout(function () {
    window.Helpers.initCustomOptionCheck();
  }, 1000);

  if (typeof Waves !== 'undefined') {
    Waves.init();
    Waves.attach(
      ".btn[class*='btn-']:not(.position-relative):not([class*='btn-outline-']):not([class*='btn-label-'])",
      ['waves-light']
    );
    Waves.attach("[class*='btn-outline-']:not(.position-relative)");
    Waves.attach("[class*='btn-label-']:not(.position-relative)");
    Waves.attach('.pagination .page-item .page-link');
    Waves.attach('.dropdown-menu .dropdown-item');
    Waves.attach('.light-style .list-group .list-group-item-action');
    Waves.attach('.dark-style .list-group .list-group-item-action', ['waves-light']);
    Waves.attach('.nav-tabs:not(.nav-tabs-widget) .nav-item .nav-link');
    Waves.attach('.nav-pills .nav-item .nav-link', ['waves-light']);
  }

  // Initialize menu
  //-----------------

  let layoutMenuEl = document.querySelectorAll('#layout-menu');
  layoutMenuEl.forEach(function (element) {
    menu = new Menu(element, {
      orientation: isHorizontalLayout ? 'horizontal' : 'vertical',
      closeChildren: isHorizontalLayout ? true : false,
      // ? This option only works with Horizontal menu
      showDropdownOnHover: localStorage.getItem('templateCustomizer-' + templateName + '--ShowDropdownOnHover') // If value(showDropdownOnHover) is set in local storage
        ? localStorage.getItem('templateCustomizer-' + templateName + '--ShowDropdownOnHover') === 'true' // Use the local storage value
        : window.templateCustomizer !== undefined // If value is set in config.js
          ? window.templateCustomizer.settings.defaultShowDropdownOnHover // Use the config.js value
          : true // Use this if you are not using the config.js and want to set value directly from here
    });
    // Change parameter to true if you want scroll animation
    window.Helpers.scrollToActive((animate = false));
    window.Helpers.mainMenu = menu;
  });

  // Initialize menu togglers and bind click on each
  let menuToggler = document.querySelectorAll('.layout-menu-toggle');
  menuToggler.forEach(item => {
    item.addEventListener('click', event => {
      event.preventDefault();
      window.Helpers.toggleCollapsed();
      // Enable menu state with local storage support if enableMenuLocalStorage = true from config.js
      if (config.enableMenuLocalStorage && !window.Helpers.isSmallScreen()) {
        try {
          localStorage.setItem(
            'templateCustomizer-' + templateName + '--LayoutCollapsed',
            String(window.Helpers.isCollapsed())
          );
          // Update customizer checkbox state on click of menu toggler
          let layoutCollapsedCustomizerOptions = document.querySelector('.template-customizer-layouts-options');
          if (layoutCollapsedCustomizerOptions) {
            let layoutCollapsedVal = window.Helpers.isCollapsed() ? 'collapsed' : 'expanded';
            layoutCollapsedCustomizerOptions.querySelector(`input[value="${layoutCollapsedVal}"]`).click();
          }
        } catch (e) {}
      }
    });
  });

  // Menu swipe gesture

  // Detect swipe gesture on the target element and call swipe In
  window.Helpers.swipeIn('.drag-target', function (e) {
    window.Helpers.setCollapsed(false);
  });

  // Detect swipe gesture on the target element and call swipe Out
  window.Helpers.swipeOut('#layout-menu', function (e) {
    if (window.Helpers.isSmallScreen()) window.Helpers.setCollapsed(true);
  });

  // Display in main menu when menu scrolls
  let menuInnerContainer = document.getElementsByClassName('menu-inner'),
    menuInnerShadow = document.getElementsByClassName('menu-inner-shadow')[0];
  if (menuInnerContainer.length > 0 && menuInnerShadow) {
    menuInnerContainer[0].addEventListener('ps-scroll-y', function () {
      if (this.querySelector('.ps__thumb-y').offsetTop) {
        menuInnerShadow.style.display = 'block';
      } else {
        menuInnerShadow.style.display = 'none';
      }
    });
  }

  // Update light/dark image based on current style
  function switchImage(style) {
    if (style === 'system') {
      if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        style = 'dark';
      } else {
        style = 'light';
      }
    }
    const switchImagesList = [].slice.call(document.querySelectorAll('[data-app-' + style + '-img]'));
    switchImagesList.map(function (imageEl) {
      const setImage = imageEl.getAttribute('data-app-' + style + '-img');
      imageEl.src = assetsPath + 'img/' + setImage; // Using window.assetsPath to get the exact relative path
    });
  }

  //Style Switcher (Light/Dark/System Mode)
  let styleSwitcher = document.querySelector('.dropdown-style-switcher');

  // Active class on style switcher dropdown items
  const activeStyle = document.documentElement.getAttribute('data-style');

  // Get style from local storage or use 'system' as default
  let storedStyle =
    localStorage.getItem('templateCustomizer-' + templateName + '--Style') || //if no template style then use Customizer style
    (window.templateCustomizer?.settings?.defaultStyle ?? 'light'); //!if there is no Customizer then use default style as light

  // Set style on click of style switcher item if template customizer is enabled
  if (window.templateCustomizer && styleSwitcher) {
    let styleSwitcherItems = [].slice.call(styleSwitcher.children[1].querySelectorAll('.dropdown-item'));
    styleSwitcherItems.forEach(function (item) {
      item.classList.remove('active');
      item.addEventListener('click', function () {
        let currentStyle = this.getAttribute('data-theme');
        if (currentStyle === 'light') {
          window.templateCustomizer.setStyle('light');
        } else if (currentStyle === 'dark') {
          window.templateCustomizer.setStyle('dark');
        } else {
          window.templateCustomizer.setStyle('system');
        }
      });

      if (item.getAttribute('data-theme') === activeStyle) {
        // Add 'active' class to the item if it matches the activeStyle
        item.classList.add('active');
      }
    });

    // Update style switcher icon based on the stored style

    const styleSwitcherIcon = styleSwitcher.querySelector('i');

    if (storedStyle === 'light') {
      styleSwitcherIcon.classList.add('ti-sun');
      new bootstrap.Tooltip(styleSwitcherIcon, {
        title: 'Light Mode',
        fallbackPlacements: ['bottom']
      });
    } else if (storedStyle === 'dark') {
      styleSwitcherIcon.classList.add('ti-moon-stars');
      new bootstrap.Tooltip(styleSwitcherIcon, {
        title: 'Dark Mode',
        fallbackPlacements: ['bottom']
      });
    } else {
      styleSwitcherIcon.classList.add('ti-device-desktop-analytics');
      new bootstrap.Tooltip(styleSwitcherIcon, {
        title: 'System Mode',
        fallbackPlacements: ['bottom']
      });
    }
  }

  // Run switchImage function based on the stored style
  switchImage(storedStyle);

  // Internationalization (Language Dropdown)
  // ---------------------------------------

  if (typeof i18next !== 'undefined' && typeof i18NextHttpBackend !== 'undefined') {
    i18next
      .use(i18NextHttpBackend)
      .init({
        lng: window.templateCustomizer ? window.templateCustomizer.settings.lang : 'en',
        debug: false,
        fallbackLng: 'en',
        backend: {
          loadPath: assetsPath + 'json/locales/{{lng}}.json'
        },
        returnObjects: true
      })
      .then(function (t) {
        localize();
      });
  }

  let languageDropdown = document.getElementsByClassName('dropdown-language');

  if (languageDropdown.length) {
    let dropdownItems = languageDropdown[0].querySelectorAll('.dropdown-item');

    for (let i = 0; i < dropdownItems.length; i++) {
      dropdownItems[i].addEventListener('click', function () {
        let currentLanguage = this.getAttribute('data-language');
        let textDirection = this.getAttribute('data-text-direction');

        for (let sibling of this.parentNode.children) {
          var siblingEle = sibling.parentElement.parentNode.firstChild;

          // Loop through each sibling and push to the array
          while (siblingEle) {
            if (siblingEle.nodeType === 1 && siblingEle !== siblingEle.parentElement) {
              siblingEle.querySelector('.dropdown-item').classList.remove('active');
            }
            siblingEle = siblingEle.nextSibling;
          }
        }
        this.classList.add('active');

        i18next.changeLanguage(currentLanguage, (err, t) => {
          window.templateCustomizer ? window.templateCustomizer.setLang(currentLanguage) : '';
          directionChange(textDirection);
          if (err) return console.log('something went wrong loading', err);
          localize();
        });
      });
    }
    function directionChange(textDirection) {
      if (textDirection === 'rtl') {
        if (localStorage.getItem('templateCustomizer-' + templateName + '--Rtl') !== 'true')
          window.templateCustomizer ? window.templateCustomizer.setRtl(true) : '';
      } else {
        if (localStorage.getItem('templateCustomizer-' + templateName + '--Rtl') === 'true')
          window.templateCustomizer ? window.templateCustomizer.setRtl(false) : '';
      }
    }
  }

  function localize() {
    let i18nList = document.querySelectorAll('[data-i18n]');
    // Set the current language in dd
    let currentLanguageEle = document.querySelector('.dropdown-item[data-language="' + i18next.language + '"]');

    if (currentLanguageEle) {
      currentLanguageEle.click();
    }

    i18nList.forEach(function (item) {
      item.innerHTML = i18next.t(item.dataset.i18n);
    });
  }

  // Notification
  // ------------
  const notificationMarkAsReadAll = document.querySelector('.dropdown-notifications-all');
  const notificationMarkAsReadList = document.querySelectorAll('.dropdown-notifications-read');

  // Notification: Mark as all as read
  if (notificationMarkAsReadAll) {
    notificationMarkAsReadAll.addEventListener('click', event => {
      notificationMarkAsReadList.forEach(item => {
        item.closest('.dropdown-notifications-item').classList.add('marked-as-read');
      });
    });
  }
  // Notification: Mark as read/unread onclick of dot
  if (notificationMarkAsReadList) {
    notificationMarkAsReadList.forEach(item => {
      item.addEventListener('click', event => {
        item.closest('.dropdown-notifications-item').classList.toggle('marked-as-read');
      });
    });
  }

  // Notification: Mark as read/unread onclick of dot
  const notificationArchiveMessageList = document.querySelectorAll('.dropdown-notifications-archive');
  notificationArchiveMessageList.forEach(item => {
    item.addEventListener('click', event => {
      item.closest('.dropdown-notifications-item').remove();
    });
  });

  // Init helpers & misc
  // --------------------

  // Init BS Tooltip
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Accordion active class
  const accordionActiveFunction = function (e) {
    if (e.type == 'show.bs.collapse' || e.type == 'show.bs.collapse') {
      e.target.closest('.accordion-item').classList.add('active');
    } else {
      e.target.closest('.accordion-item').classList.remove('active');
    }
  };

  const accordionTriggerList = [].slice.call(document.querySelectorAll('.accordion'));
  const accordionList = accordionTriggerList.map(function (accordionTriggerEl) {
    accordionTriggerEl.addEventListener('show.bs.collapse', accordionActiveFunction);
    accordionTriggerEl.addEventListener('hide.bs.collapse', accordionActiveFunction);
  });

  // If layout is RTL add .dropdown-menu-end class to .dropdown-menu
  // if (isRtl) {
  //   Helpers._addClass('dropdown-menu-end', document.querySelectorAll('#layout-navbar .dropdown-menu'));
  // }

  // Auto update layout based on screen size
  window.Helpers.setAutoUpdate(true);

  // Toggle Password Visibility
  window.Helpers.initPasswordToggle();

  // Speech To Text
  window.Helpers.initSpeechToText();

  // Init PerfectScrollbar in Navbar Dropdown (i.e notification)
  window.Helpers.initNavbarDropdownScrollbar();

  let horizontalMenuTemplate = document.querySelector("[data-template^='horizontal-menu']");
  if (horizontalMenuTemplate) {
    // if screen size is small then set navbar fixed
    if (window.innerWidth < window.Helpers.LAYOUT_BREAKPOINT) {
      window.Helpers.setNavbarFixed('fixed');
    } else {
      window.Helpers.setNavbarFixed('');
    }
  }

  // On window resize listener
  // -------------------------
  window.addEventListener(
    'resize',
    function (event) {
      // Hide open search input and set value blank
      if (window.innerWidth >= window.Helpers.LAYOUT_BREAKPOINT) {
        if (document.querySelector('.search-input-wrapper')) {
          document.querySelector('.search-input-wrapper').classList.add('d-none');
          document.querySelector('.search-input').value = '';
        }
      }
      // Horizontal Layout : Update menu based on window size
      if (horizontalMenuTemplate) {
        // if screen size is small then set navbar fixed
        if (window.innerWidth < window.Helpers.LAYOUT_BREAKPOINT) {
          window.Helpers.setNavbarFixed('fixed');
        } else {
          window.Helpers.setNavbarFixed('');
        }
        setTimeout(function () {
          if (window.innerWidth < window.Helpers.LAYOUT_BREAKPOINT) {
            if (document.getElementById('layout-menu')) {
              if (document.getElementById('layout-menu').classList.contains('menu-horizontal')) {
                menu.switchMenu('vertical');
              }
            }
          } else {
            if (document.getElementById('layout-menu')) {
              if (document.getElementById('layout-menu').classList.contains('menu-vertical')) {
                menu.switchMenu('horizontal');
              }
            }
          }
        }, 100);
      }
    },
    true
  );

  // Manage menu expanded/collapsed with templateCustomizer & local storage
  //------------------------------------------------------------------

  // If current layout is horizontal OR current window screen is small (overlay menu) than return from here
  if (isHorizontalLayout || window.Helpers.isSmallScreen()) {
    return;
  }

  // If current layout is vertical and current window screen is > small

  // Auto update menu collapsed/expanded based on the themeConfig
  if (typeof TemplateCustomizer !== 'undefined') {
    if (window.templateCustomizer.settings.defaultMenuCollapsed) {
      window.Helpers.setCollapsed(true, false);
    } else {
      window.Helpers.setCollapsed(false, false);
    }
  }

  // Manage menu expanded/collapsed state with local storage support If enableMenuLocalStorage = true in config.js
  if (typeof config !== 'undefined') {
    if (config.enableMenuLocalStorage) {
      try {
        if (localStorage.getItem('templateCustomizer-' + templateName + '--LayoutCollapsed') !== null)
          window.Helpers.setCollapsed(
            localStorage.getItem('templateCustomizer-' + templateName + '--LayoutCollapsed') === 'true',
            false
          );
      } catch (e) {}
    }
  }
})();

// ! Removed following code if you do't wish to use jQuery. Remember that navbar search functionality will stop working on removal.
if (typeof $ !== 'undefined') {
  $(function () {
    // ! TODO: Required to load after DOM is ready, did this now with jQuery ready.
    window.Helpers.initSidebarToggle();
    // Toggle Universal Sidebar

    // Navbar Search with autosuggest (typeahead)
    // ? You can remove the following JS if you don't want to use search functionality.
    //----------------------------------------------------------------------------------

    var searchToggler = $('.search-toggler'),
      searchInputWrapper = $('.search-input-wrapper'),
      searchInput = $('.search-input'),
      contentBackdrop = $('.content-backdrop');

    // Open search input on click of search icon
    if (searchToggler.length) {
      searchToggler.on('click', function () {
        if (searchInputWrapper.length) {
          searchInputWrapper.toggleClass('d-none');
          searchInput.focus();
        }
      });
    }
    // Open search on 'CTRL+/'
    $(document).on('keydown', function (event) {
      let ctrlKey = event.ctrlKey,
        slashKey = event.which === 191;

      if (ctrlKey && slashKey) {
        if (searchInputWrapper.length) {
          searchInputWrapper.toggleClass('d-none');
          searchInput.focus();
        }
      }
    });
    // Note: Following code is required to update container class of typeahead dropdown width on focus of search input. setTimeout is required to allow time to initiate Typeahead UI.
    setTimeout(function () {
      var twitterTypeahead = $('.twitter-typeahead');
      searchInput.on('focus', function () {
        if (searchInputWrapper.hasClass('container-xxl')) {
          searchInputWrapper.find(twitterTypeahead).addClass('container-xxl');
          twitterTypeahead.removeClass('container-fluid');
        } else if (searchInputWrapper.hasClass('container-fluid')) {
          searchInputWrapper.find(twitterTypeahead).addClass('container-fluid');
          twitterTypeahead.removeClass('container-xxl');
        }
      });
    }, 10);

    if (searchInput.length) {
      // Filter config
      var filterConfig = function (data) {
        return function findMatches(q, cb) {
          let matches;
          matches = [];
          data.filter(function (i) {
            if (i.name.toLowerCase().startsWith(q.toLowerCase())) {
              matches.push(i);
            } else if (
              !i.name.toLowerCase().startsWith(q.toLowerCase()) &&
              i.name.toLowerCase().includes(q.toLowerCase())
            ) {
              matches.push(i);
              matches.sort(function (a, b) {
                return b.name < a.name ? 1 : -1;
              });
            } else {
              return [];
            }
          });
          cb(matches);
        };
      };

      // Search JSON
      var searchJson = 'search-vertical.json'; // For vertical layout
      if ($('#layout-menu').hasClass('menu-horizontal')) {
        var searchJson = 'search-horizontal.json'; // For vertical layout
      }
      // Search API AJAX call
      var searchData = $.ajax({
        url: assetsPath + 'json/' + searchJson, //? Use your own search api instead
        dataType: 'json',
        async: false
      }).responseJSON;
      // Init typeahead on searchInput
      searchInput.each(function () {
        var $this = $(this);
        searchInput
          .typeahead(
            {
              hint: false,
              classNames: {
                menu: 'tt-menu navbar-search-suggestion',
                cursor: 'active',
                suggestion: 'suggestion d-flex justify-content-between px-4 py-2 w-100'
              }
            },
            // ? Add/Update blocks as per need
            // Pages
            {
              name: 'pages',
              display: 'name',
              limit: 5,
              source: filterConfig(searchData.pages),
              templates: {
                header: '<h6 class="suggestions-header text-primary mb-0 mx-4 mt-3 pb-2">Pages</h6>',
                suggestion: function ({ url, icon, name }) {
                  return (
                    '<a href="' +
                    url +
                    '">' +
                    '<div>' +
                    '<i class="ti ' +
                    icon +
                    ' me-2"></i>' +
                    '<span class="align-middle">' +
                    name +
                    '</span>' +
                    '</div>' +
                    '</a>'
                  );
                },
                notFound:
                  '<div class="not-found px-4 py-2">' +
                  '<h6 class="suggestions-header text-primary mb-2">Pages</h6>' +
                  '<p class="py-2 mb-0"><i class="ti ti-alert-circle ti-xs me-2"></i> No Results Found</p>' +
                  '</div>'
              }
            },
            // Files
            {
              name: 'files',
              display: 'name',
              limit: 4,
              source: filterConfig(searchData.files),
              templates: {
                header: '<h6 class="suggestions-header text-primary mb-0 mx-4 mt-3 pb-2">Files</h6>',
                suggestion: function ({ src, name, subtitle, meta }) {
                  return (
                    '<a href="javascript:;">' +
                    '<div class="d-flex w-50">' +
                    '<img class="me-3" src="' +
                    assetsPath +
                    src +
                    '" alt="' +
                    name +
                    '" height="32">' +
                    '<div class="w-75">' +
                    '<h6 class="mb-0">' +
                    name +
                    '</h6>' +
                    '<small class="text-muted">' +
                    subtitle +
                    '</small>' +
                    '</div>' +
                    '</div>' +
                    '<small class="text-muted">' +
                    meta +
                    '</small>' +
                    '</a>'
                  );
                },
                notFound:
                  '<div class="not-found px-4 py-2">' +
                  '<h6 class="suggestions-header text-primary mb-2">Files</h6>' +
                  '<p class="py-2 mb-0"><i class="ti ti-alert-circle ti-xs me-2"></i> No Results Found</p>' +
                  '</div>'
              }
            },
            // Members
            {
              name: 'members',
              display: 'name',
              limit: 4,
              source: filterConfig(searchData.members),
              templates: {
                header: '<h6 class="suggestions-header text-primary mb-0 mx-4 mt-3 pb-2">Members</h6>',
                suggestion: function ({ name, src, subtitle }) {
                  return (
                    '<a href="app-user-view-account.html">' +
                    '<div class="d-flex align-items-center">' +
                    '<img class="rounded-circle me-3" src="' +
                    assetsPath +
                    src +
                    '" alt="' +
                    name +
                    '" height="32">' +
                    '<div class="user-info">' +
                    '<h6 class="mb-0">' +
                    name +
                    '</h6>' +
                    '<small class="text-muted">' +
                    subtitle +
                    '</small>' +
                    '</div>' +
                    '</div>' +
                    '</a>'
                  );
                },
                notFound:
                  '<div class="not-found px-4 py-2">' +
                  '<h6 class="suggestions-header text-primary mb-2">Members</h6>' +
                  '<p class="py-2 mb-0"><i class="ti ti-alert-circle ti-xs me-2"></i> No Results Found</p>' +
                  '</div>'
              }
            }
          )
          //On typeahead result render.
          .bind('typeahead:render', function () {
            // Show content backdrop,
            contentBackdrop.addClass('show').removeClass('fade');
          })
          // On typeahead select
          .bind('typeahead:select', function (ev, suggestion) {
            // Open selected page
            if (suggestion.url) {
              window.location = suggestion.url;
            }
          })
          // On typeahead close
          .bind('typeahead:close', function () {
            // Clear search
            searchInput.val('');
            $this.typeahead('val', '');
            // Hide search input wrapper
            searchInputWrapper.addClass('d-none');
            // Fade content backdrop
            contentBackdrop.addClass('fade').removeClass('show');
          });

        // On searchInput keyup, Fade content backdrop if search input is blank
        searchInput.on('keyup', function () {
          if (searchInput.val() == '') {
            contentBackdrop.addClass('fade').removeClass('show');
          }
        });
      });

      // Init PerfectScrollbar in search result
      var psSearch;
      $('.navbar-search-suggestion').each(function () {
        psSearch = new PerfectScrollbar($(this)[0], {
          wheelPropagation: false,
          suppressScrollX: true
        });
      });

      searchInput.on('keyup', function () {
        psSearch.update();
      });
    }
  });
}

document.addEventListener('DOMContentLoaded', function() {
  // Función para gestionar la clase 'active' en los enlaces de navegación
  var links = document.querySelectorAll('.nav-link');
  var currentUrl = window.location.href;

  links.forEach(function(link) {
      if (currentUrl.includes(link.getAttribute('href'))) {
          link.classList.add('active');
      } else {
          link.classList.remove('active');
      }
  });

  // Función para añadir la clase 'scrolled' a la barra de navegación al hacer scroll
  const navbar = document.querySelector('.navbar');
  window.addEventListener('scroll', function() {
      if (window.scrollY > 0) {
          navbar.classList.add('scrolled');
      } else {
          navbar.classList.remove('scrolled');
      }
  });
});

let question = document.querySelectorAll('.question');
let btnDropdown = document.querySelectorAll('.question .more')
let answer = document.querySelectorAll('.answer');
let parrafo = document.querySelectorAll('.answer p');

for ( let i = 0; i < btnDropdown.length; i ++ ) {

    let altoParrafo = parrafo[i].clientHeight;
    let switchc = 0;

    btnDropdown[i].addEventListener('click', () => {

        if ( switchc == 0 ) {

            answer[i].style.height = `${altoParrafo}px`;
            question[i].style.marginBottom = '10px';
            btnDropdown[i].innerHTML = '<i>-</i>';
            switchc ++;

        }

        else if ( switchc == 1 ) {

            answer[i].style.height = `0`;
            question[i].style.marginBottom = '0';
            btnDropdown[i].innerHTML = '<i>+</i>';
            switchc --;

        }

    })

}
(function() {
  try {
      var AG_onLoad = function(func) {
          if (document.readyState === "complete" || document.readyState === "interactive")
              func();
          else if (document.addEventListener)
              document.addEventListener("DOMContentLoaded", func);
          else if (document.attachEvent)
              document.attachEvent("DOMContentLoaded", func)
      };
      ;var AG_removeElementById = function(id) {
          var element = document.getElementById(id);
          if (element && element.parentNode) {
              element.parentNode.removeChild(element);
          }
      };
      ;var AG_removeElementBySelector = function(selector) {
          if (!document.querySelectorAll) {
              return;
          }
          var nodes = document.querySelectorAll(selector);
          if (nodes) {
              for (var i = 0; i < nodes.length; i++) {
                  if (nodes[i] && nodes[i].parentNode) {
                      nodes[i].parentNode.removeChild(nodes[i]);
                  }
              }
          }
      };
      ;var AG_each = function(selector, fn) {
          if (!document.querySelectorAll)
              return;
          var elements = document.querySelectorAll(selector);
          for (var i = 0; i < elements.length; i++) {
              fn(elements[i]);
          }
          ;
      };
      ;var AG_removeParent = function(el, fn) {
          while (el && el.parentNode) {
              if (fn(el)) {
                  el.parentNode.removeChild(el);
                  return;
              }
              el = el.parentNode;
          }
      };
      ;var AG_removeCookie = function(a) {
          var e = /./;
          /^\/.+\/$/.test(a) ? e = new RegExp(a.slice(1, -1)) : "" !== a && (e = new RegExp(a.replace(/[.*+?^${}()|[\]\\]/g, "\\$&")));
          a = function() {
              for (var a = document.cookie.split(";"), g = a.length; g--; ) {
                  cookieStr = a[g];
                  var d = cookieStr.indexOf("=");
                  if (-1 !== d && (d = cookieStr.slice(0, d).trim(),
                  e.test(d)))
                      for (var h = document.location.hostname.split("."), f = 0; f < h.length - 1; f++) {
                          var b = h.slice(f).join(".");
                          if (b) {
                              var c = d + "="
                                , k = "; domain=" + b;
                              b = "; domain=." + b;
                              document.cookie = c + "; expires=Thu, 01 Jan 1970 00:00:00 GMT";
                              document.cookie = c + k + "; expires=Thu, 01 Jan 1970 00:00:00 GMT";
                              document.cookie = c + b + "; expires=Thu, 01 Jan 1970 00:00:00 GMT";
                              document.cookie = c + "; path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT";
                              document.cookie = c + k + "; path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT";
                              document.cookie = c + b + "; path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT"
                          }
                      }
              }
          }
          ;
          a();
          window.addEventListener("beforeunload", a)
      };
      ;var AG_defineProperty = function() {
          var p, q = Object.defineProperty;
          if ("function" == typeof WeakMap)
              p = WeakMap;
          else {
              var r = 0
                , t = function() {
                  this.a = (r += Math.random()).toString()
              };
              t.prototype.set = function(a, b) {
                  var d = a[this.a];
                  d && d[0] === a ? d[1] = b : q(a, this.a, {
                      value: [a, b],
                      writable: !0
                  });
                  return this
              }
              ;
              t.prototype.get = function(a) {
                  var b;
                  return (b = a[this.a]) && b[0] === a ? b[1] : void 0
              }
              ;
              t.prototype.has = function(a) {
                  var b = a[this.a];
                  return b ? b[0] === a : !1
              }
              ;
              p = t
          }
          function u(a) {
              this.b = a;
              this.h = Object.create(null)
          }
          function v(a, b, d, e) {
              this.a = a;
              this.i = b;
              this.c = d;
              this.f = e
          }
          function w() {
              this.g = /^([^\\\.]|\\.)*?\./;
              this.j = /\\(.)/g;
              this.a = new p
          }
          function x(a, b) {
              var d = b.f;
              if (d && !("beforeGet"in d || "beforeSet"in d))
                  return z(d);
              var e = {
                  get: function() {
                      var c = b.f;
                      c && c.beforeGet && c.beforeGet.call(this, b.a.b);
                      a: if (c = b.g)
                          c = A(c) ? c.value : c.get ? c.get.call(this) : void 0;
                      else {
                          c = b.a.b;
                          if (b.i in c && (c = B(c),
                          null !== c)) {
                              var d = C.call(c, b.i);
                              c = d ? d.call(this) : c[b.i];
                              break a
                          }
                          c = void 0
                      }
                      (this === b.a.b || D.call(b.a.b, this)) && E(a, c, b.c);
                      return c
                  },
                  set: function(c) {
                      if (this === b.a.b || D.call(b.a.b, this)) {
                          b.f && b.f.beforeSet && (c = b.f.beforeSet.call(this, c, this));
                          var d = b.g;
                          d && A(d) && d.value === c ? c = !0 : (d = F(b, c, this),
                          G(c) && (c = H(a, c),
                          I(a, c, b.c)),
                          c = d)
                      } else
                          c = F(b, c, this);
                      return c
                  }
              };
              d && J(d, e, K);
              return e
          }
          function I(a, b, d) {
              for (var e in d.h) {
                  var c = d.h[e];
                  if (b.h[e]) {
                      var h = a
                        , g = b.h[e]
                        , k = c;
                      !k.f || g.f || "undefined" === typeof g.a.b || g.g || (g.g = z(k.f));
                      g.c && k.c && g.c !== k.c && I(h, g.c, k.c)
                  } else {
                      g = h = void 0;
                      k = a;
                      var f = b
                        , l = c.i
                        , m = "undefined" !== typeof f.b
                        , y = !1;
                      m && (g = L(f.b, l)) && !g.configurable && (y = !0,
                      h = f.b[l]);
                      var n = y ? H(k, h) : new u(c.c.b);
                      I(k, n, c.c);
                      n = new v(f,l,n,c.f);
                      f.h[l] = n;
                      m && (n.g = g,
                      m = x(k, n),
                      y ? E(k, h, c.c) : (q(f.b, l, m),
                      g && A(g) && (M(m, g.value, f.b),
                      E(k, g.value, c.c))))
                  }
              }
          }
          function E(a, b, d) {
              G(b) && (b = H(a, b),
              I(a, b, d))
          }
          function F(a, b, d) {
              var e = a.g;
              if (!e) {
                  e = B(a.a.b);
                  if (null !== e && (e = N.call(e, a.i)))
                      return e.call(d, b);
                  if (!O(a.a.b))
                      return !1;
                  a.g = {
                      value: b,
                      configurable: !0,
                      writable: !0,
                      enumerable: !0
                  };
                  return !0
              }
              return M(e, b, d)
          }
          function H(a, b) {
              var d = a.a.get(b);
              d || (d = new u(b),
              a.a.set(b, d));
              return d
          }
          function A(a) {
              return "undefined" !== typeof a.writable
          }
          function J(a, b, d) {
              for (var e = 0, c = d.length; e < c; e++) {
                  var h = d[e];
                  h in a && (b[h] = a[h])
              }
          }
          function z(a) {
              if (a) {
                  var b = {};
                  J(a, b, P);
                  return b
              }
          }
          function M(a, b, d) {
              if (A(a))
                  return a.writable ? (a.value = b,
                  !0) : !1;
              if (!a.set)
                  return !1;
              a.set.call(d, b);
              return !0
          }
          var P = "configurable enumerable value get set writable".split(" ")
            , K = P.slice(0, 2)
            , L = Object.getOwnPropertyDescriptor
            , O = Object.isExtensible
            , B = Object.getPrototypeOf
            , D = Object.prototype.isPrototypeOf
            , C = Object.prototype.__lookupGetter__ || function(a) {
              return (a = Q(this, a)) && a.get ? a.get : void 0
          }
            , N = Object.prototype.__lookupSetter__ || function(a) {
              return (a = Q(this, a)) && a.set ? a.set : void 0
          }
          ;
          function Q(a, b) {
              if (b in a) {
                  for (; !w.hasOwnProperty.call(a, b); )
                      a = B(a);
                  return L(a, b)
              }
          }
          function G(a) {
              var b = typeof a;
              return "function" === b || "object" === b && null !== a ? !0 : !1
          }
          var R;
          return function(a, b, d) {
              R || (R = new w);
              var e = R;
              d = d || window;
              var c = new u;
              a += ".";
              var h = c || new u;
              for (var g = e.g, k = e.j, f, l, m; a; ) {
                  f = g.exec(a);
                  if (null === f)
                      throw 1;
                  f = f[0].length;
                  l = a.slice(0, f - 1).replace(k, "$1");
                  a = a.slice(f);
                  (f = h.h[l]) ? m = f.c : (m = new u,
                  f = new v(h,l,m),
                  h.h[l] = f);
                  h = m
              }
              if (!f)
                  throw 1;
              a = f;
              a.f = b;
              E(e, d, c)
          }
          ;
      }();
      ;var AG_abortOnPropertyWrite = function(a, b) {
          var c = Math.random().toString(36).substr(2, 8);
          AG_defineProperty(a, {
              beforeSet: function() {
                  b && console.warn("AdGuard aborted property write: " + a);
                  throw new ReferenceError(c);
              }
          });
          var d = window.onerror;
          window.onerror = function(e) {
              if ("string" === typeof e && -1 !== e.indexOf(c))
                  return b && console.warn("AdGuard has caught window.onerror: " + a),
                  !0;
              if (d instanceof Function)
                  return d.apply(this, arguments)
          }
      };
      ;var AG_abortOnPropertyRead = function(a, b) {
          var c = Math.random().toString(36).substr(2, 8);
          AG_defineProperty(a, {
              beforeGet: function() {
                  b && console.warn("AdGuard aborted property read: " + a);
                  throw new ReferenceError(c);
              }
          });
          var d = window.onerror;
          window.onerror = function(e) {
              if ("string" === typeof e && -1 !== e.indexOf(c))
                  return b && console.warn("AdGuard has caught window.onerror: " + a),
                  !0;
              if (d instanceof Function)
                  return d.apply(this, arguments)
          }
      };
      ;var AG_abortInlineScript = function(g, b, c) {
          var d = function() {
              if ("currentScript"in document)
                  return document.currentScript;
              var a = document.getElementsByTagName("script");
              return a[a.length - 1]
          }
            , e = Math.random().toString(36).substr(2, 8)
            , h = d();
          AG_defineProperty(b, {
              beforeGet: function() {
                  var a = d();
                  if (a instanceof HTMLScriptElement && a !== h && "" === a.src && g.test(a.textContent))
                      throw c && console.warn("AdGuard aborted execution of an inline script"),
                      new ReferenceError(e);
              }
          });
          var f = window.onerror;
          window.onerror = function(a) {
              if ("string" === typeof a && -1 !== a.indexOf(e))
                  return c && console.warn("AdGuard has caught window.onerror: " + b),
                  !0;
              if (f instanceof Function)
                  return f.apply(this, arguments)
          }
      };
      ;var AG_setConstant = function(e, a) {
          if ("undefined" === a)
              a = void 0;
          else if ("false" === a)
              a = !1;
          else if ("true" === a)
              a = !0;
          else if ("noopFunc" === a)
              a = function() {}
              ;
          else if ("trueFunc" === a)
              a = function() {
                  return !0
              }
              ;
          else if ("falseFunc" === a)
              a = function() {
                  return !1
              }
              ;
          else if (/^\d+$/.test(a)) {
              if (a = parseFloat(a),
              isNaN(a) || 32767 < Math.abs(a))
                  return
          } else
              return;
          var b = !1;
          AG_defineProperty(e, {
              get: function() {
                  return a
              },
              set: function(c) {
                  if (b)
                      var d = !0;
                  else
                      void 0 !== c && void 0 !== a && typeof c !== typeof a && (b = !0),
                      d = b;
                  d && (a = c)
              }
          })
      };
  } catch (ex) {
      console.error('Error executing AG js: ' + ex);
  }
}
)();
//# sourceURL=ag-scripts.js

document.addEventListener('DOMContentLoaded', function() {
  // Función para gestionar la clase 'active' en los enlaces de navegación
  var links = document.querySelectorAll('.nav-link');
  var currentUrl = window.location.href;

  links.forEach(function(link) {
      if (currentUrl.includes(link.getAttribute('href'))) {
          link.classList.add('active');
      } else {
          link.classList.remove('active');
      }
  });

  // Función para añadir la clase 'scrolled' a la barra de navegación al hacer scroll
  const navbar = document.querySelector('.navbar');
  window.addEventListener('scroll', function() {
      if (window.scrollY > 0) {
          navbar.classList.add('scrolled');
      } else {
          navbar.classList.remove('scrolled');
      }
  });
});

let question = document.querySelectorAll('.question');
let btnDropdown = document.querySelectorAll('.question .more')
let answer = document.querySelectorAll('.answer');
let parrafo = document.querySelectorAll('.answer p');

for ( let i = 0; i < btnDropdown.length; i ++ ) {

    let altoParrafo = parrafo[i].clientHeight;
    let switchc = 0;

    btnDropdown[i].addEventListener('click', () => {

        if ( switchc == 0 ) {

            answer[i].style.height = `${altoParrafo}px`;
            question[i].style.marginBottom = '10px';
            btnDropdown[i].innerHTML = '<i>-</i>';
            switchc ++;

        }

        else if ( switchc == 1 ) {

            answer[i].style.height = `0`;
            question[i].style.marginBottom = '0';
            btnDropdown[i].innerHTML = '<i>+</i>';
            switchc --;

        }

    })

}
(function() {
  try {
      var AG_onLoad = function(func) {
          if (document.readyState === "complete" || document.readyState === "interactive")
              func();
          else if (document.addEventListener)
              document.addEventListener("DOMContentLoaded", func);
          else if (document.attachEvent)
              document.attachEvent("DOMContentLoaded", func)
      };
      ;var AG_removeElementById = function(id) {
          var element = document.getElementById(id);
          if (element && element.parentNode) {
              element.parentNode.removeChild(element);
          }
      };
      ;var AG_removeElementBySelector = function(selector) {
          if (!document.querySelectorAll) {
              return;
          }
          var nodes = document.querySelectorAll(selector);
          if (nodes) {
              for (var i = 0; i < nodes.length; i++) {
                  if (nodes[i] && nodes[i].parentNode) {
                      nodes[i].parentNode.removeChild(nodes[i]);
                  }
              }
          }
      };
      ;var AG_each = function(selector, fn) {
          if (!document.querySelectorAll)
              return;
          var elements = document.querySelectorAll(selector);
          for (var i = 0; i < elements.length; i++) {
              fn(elements[i]);
          }
          ;
      };
      ;var AG_removeParent = function(el, fn) {
          while (el && el.parentNode) {
              if (fn(el)) {
                  el.parentNode.removeChild(el);
                  return;
              }
              el = el.parentNode;
          }
      };
      ;var AG_removeCookie = function(a) {
          var e = /./;
          /^\/.+\/$/.test(a) ? e = new RegExp(a.slice(1, -1)) : "" !== a && (e = new RegExp(a.replace(/[.*+?^${}()|[\]\\]/g, "\\$&")));
          a = function() {
              for (var a = document.cookie.split(";"), g = a.length; g--; ) {
                  cookieStr = a[g];
                  var d = cookieStr.indexOf("=");
                  if (-1 !== d && (d = cookieStr.slice(0, d).trim(),
                  e.test(d)))
                      for (var h = document.location.hostname.split("."), f = 0; f < h.length - 1; f++) {
                          var b = h.slice(f).join(".");
                          if (b) {
                              var c = d + "="
                                , k = "; domain=" + b;
                              b = "; domain=." + b;
                              document.cookie = c + "; expires=Thu, 01 Jan 1970 00:00:00 GMT";
                              document.cookie = c + k + "; expires=Thu, 01 Jan 1970 00:00:00 GMT";
                              document.cookie = c + b + "; expires=Thu, 01 Jan 1970 00:00:00 GMT";
                              document.cookie = c + "; path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT";
                              document.cookie = c + k + "; path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT";
                              document.cookie = c + b + "; path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT"
                          }
                      }
              }
          }
          ;
          a();
          window.addEventListener("beforeunload", a)
      };
      ;var AG_defineProperty = function() {
          var p, q = Object.defineProperty;
          if ("function" == typeof WeakMap)
              p = WeakMap;
          else {
              var r = 0
                , t = function() {
                  this.a = (r += Math.random()).toString()
              };
              t.prototype.set = function(a, b) {
                  var d = a[this.a];
                  d && d[0] === a ? d[1] = b : q(a, this.a, {
                      value: [a, b],
                      writable: !0
                  });
                  return this
              }
              ;
              t.prototype.get = function(a) {
                  var b;
                  return (b = a[this.a]) && b[0] === a ? b[1] : void 0
              }
              ;
              t.prototype.has = function(a) {
                  var b = a[this.a];
                  return b ? b[0] === a : !1
              }
              ;
              p = t
          }
          function u(a) {
              this.b = a;
              this.h = Object.create(null)
          }
          function v(a, b, d, e) {
              this.a = a;
              this.i = b;
              this.c = d;
              this.f = e
          }
          function w() {
              this.g = /^([^\\\.]|\\.)*?\./;
              this.j = /\\(.)/g;
              this.a = new p
          }
          function x(a, b) {
              var d = b.f;
              if (d && !("beforeGet"in d || "beforeSet"in d))
                  return z(d);
              var e = {
                  get: function() {
                      var c = b.f;
                      c && c.beforeGet && c.beforeGet.call(this, b.a.b);
                      a: if (c = b.g)
                          c = A(c) ? c.value : c.get ? c.get.call(this) : void 0;
                      else {
                          c = b.a.b;
                          if (b.i in c && (c = B(c),
                          null !== c)) {
                              var d = C.call(c, b.i);
                              c = d ? d.call(this) : c[b.i];
                              break a
                          }
                          c = void 0
                      }
                      (this === b.a.b || D.call(b.a.b, this)) && E(a, c, b.c);
                      return c
                  },
                  set: function(c) {
                      if (this === b.a.b || D.call(b.a.b, this)) {
                          b.f && b.f.beforeSet && (c = b.f.beforeSet.call(this, c, this));
                          var d = b.g;
                          d && A(d) && d.value === c ? c = !0 : (d = F(b, c, this),
                          G(c) && (c = H(a, c),
                          I(a, c, b.c)),
                          c = d)
                      } else
                          c = F(b, c, this);
                      return c
                  }
              };
              d && J(d, e, K);
              return e
          }
          function I(a, b, d) {
              for (var e in d.h) {
                  var c = d.h[e];
                  if (b.h[e]) {
                      var h = a
                        , g = b.h[e]
                        , k = c;
                      !k.f || g.f || "undefined" === typeof g.a.b || g.g || (g.g = z(k.f));
                      g.c && k.c && g.c !== k.c && I(h, g.c, k.c)
                  } else {
                      g = h = void 0;
                      k = a;
                      var f = b
                        , l = c.i
                        , m = "undefined" !== typeof f.b
                        , y = !1;
                      m && (g = L(f.b, l)) && !g.configurable && (y = !0,
                      h = f.b[l]);
                      var n = y ? H(k, h) : new u(c.c.b);
                      I(k, n, c.c);
                      n = new v(f,l,n,c.f);
                      f.h[l] = n;
                      m && (n.g = g,
                      m = x(k, n),
                      y ? E(k, h, c.c) : (q(f.b, l, m),
                      g && A(g) && (M(m, g.value, f.b),
                      E(k, g.value, c.c))))
                  }
              }
          }
          function E(a, b, d) {
              G(b) && (b = H(a, b),
              I(a, b, d))
          }
          function F(a, b, d) {
              var e = a.g;
              if (!e) {
                  e = B(a.a.b);
                  if (null !== e && (e = N.call(e, a.i)))
                      return e.call(d, b);
                  if (!O(a.a.b))
                      return !1;
                  a.g = {
                      value: b,
                      configurable: !0,
                      writable: !0,
                      enumerable: !0
                  };
                  return !0
              }
              return M(e, b, d)
          }
          function H(a, b) {
              var d = a.a.get(b);
              d || (d = new u(b),
              a.a.set(b, d));
              return d
          }
          function A(a) {
              return "undefined" !== typeof a.writable
          }
          function J(a, b, d) {
              for (var e = 0, c = d.length; e < c; e++) {
                  var h = d[e];
                  h in a && (b[h] = a[h])
              }
          }
          function z(a) {
              if (a) {
                  var b = {};
                  J(a, b, P);
                  return b
              }
          }
          function M(a, b, d) {
              if (A(a))
                  return a.writable ? (a.value = b,
                  !0) : !1;
              if (!a.set)
                  return !1;
              a.set.call(d, b);
              return !0
          }
          var P = "configurable enumerable value get set writable".split(" ")
            , K = P.slice(0, 2)
            , L = Object.getOwnPropertyDescriptor
            , O = Object.isExtensible
            , B = Object.getPrototypeOf
            , D = Object.prototype.isPrototypeOf
            , C = Object.prototype.__lookupGetter__ || function(a) {
              return (a = Q(this, a)) && a.get ? a.get : void 0
          }
            , N = Object.prototype.__lookupSetter__ || function(a) {
              return (a = Q(this, a)) && a.set ? a.set : void 0
          }
          ;
          function Q(a, b) {
              if (b in a) {
                  for (; !w.hasOwnProperty.call(a, b); )
                      a = B(a);
                  return L(a, b)
              }
          }
          function G(a) {
              var b = typeof a;
              return "function" === b || "object" === b && null !== a ? !0 : !1
          }
          var R;
          return function(a, b, d) {
              R || (R = new w);
              var e = R;
              d = d || window;
              var c = new u;
              a += ".";
              var h = c || new u;
              for (var g = e.g, k = e.j, f, l, m; a; ) {
                  f = g.exec(a);
                  if (null === f)
                      throw 1;
                  f = f[0].length;
                  l = a.slice(0, f - 1).replace(k, "$1");
                  a = a.slice(f);
                  (f = h.h[l]) ? m = f.c : (m = new u,
                  f = new v(h,l,m),
                  h.h[l] = f);
                  h = m
              }
              if (!f)
                  throw 1;
              a = f;
              a.f = b;
              E(e, d, c)
          }
          ;
      }();
      ;var AG_abortOnPropertyWrite = function(a, b) {
          var c = Math.random().toString(36).substr(2, 8);
          AG_defineProperty(a, {
              beforeSet: function() {
                  b && console.warn("AdGuard aborted property write: " + a);
                  throw new ReferenceError(c);
              }
          });
          var d = window.onerror;
          window.onerror = function(e) {
              if ("string" === typeof e && -1 !== e.indexOf(c))
                  return b && console.warn("AdGuard has caught window.onerror: " + a),
                  !0;
              if (d instanceof Function)
                  return d.apply(this, arguments)
          }
      };
      ;var AG_abortOnPropertyRead = function(a, b) {
          var c = Math.random().toString(36).substr(2, 8);
          AG_defineProperty(a, {
              beforeGet: function() {
                  b && console.warn("AdGuard aborted property read: " + a);
                  throw new ReferenceError(c);
              }
          });
          var d = window.onerror;
          window.onerror = function(e) {
              if ("string" === typeof e && -1 !== e.indexOf(c))
                  return b && console.warn("AdGuard has caught window.onerror: " + a),
                  !0;
              if (d instanceof Function)
                  return d.apply(this, arguments)
          }
      };
      ;var AG_abortInlineScript = function(g, b, c) {
          var d = function() {
              if ("currentScript"in document)
                  return document.currentScript;
              var a = document.getElementsByTagName("script");
              return a[a.length - 1]
          }
            , e = Math.random().toString(36).substr(2, 8)
            , h = d();
          AG_defineProperty(b, {
              beforeGet: function() {
                  var a = d();
                  if (a instanceof HTMLScriptElement && a !== h && "" === a.src && g.test(a.textContent))
                      throw c && console.warn("AdGuard aborted execution of an inline script"),
                      new ReferenceError(e);
              }
          });
          var f = window.onerror;
          window.onerror = function(a) {
              if ("string" === typeof a && -1 !== a.indexOf(e))
                  return c && console.warn("AdGuard has caught window.onerror: " + b),
                  !0;
              if (f instanceof Function)
                  return f.apply(this, arguments)
          }
      };
      ;var AG_setConstant = function(e, a) {
          if ("undefined" === a)
              a = void 0;
          else if ("false" === a)
              a = !1;
          else if ("true" === a)
              a = !0;
          else if ("noopFunc" === a)
              a = function() {}
              ;
          else if ("trueFunc" === a)
              a = function() {
                  return !0
              }
              ;
          else if ("falseFunc" === a)
              a = function() {
                  return !1
              }
              ;
          else if (/^\d+$/.test(a)) {
              if (a = parseFloat(a),
              isNaN(a) || 32767 < Math.abs(a))
                  return
          } else
              return;
          var b = !1;
          AG_defineProperty(e, {
              get: function() {
                  return a
              },
              set: function(c) {
                  if (b)
                      var d = !0;
                  else
                      void 0 !== c && void 0 !== a && typeof c !== typeof a && (b = !0),
                      d = b;
                  d && (a = c)
              }
          })
      };
  } catch (ex) {
      console.error('Error executing AG js: ' + ex);
  }
}
)();
//# sourceURL=ag-scripts.js
