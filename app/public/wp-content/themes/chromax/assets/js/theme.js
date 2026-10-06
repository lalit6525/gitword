! function($, b) {
    "use strict";
    var a = {
        eventID: "DtThemeJs",
        document: $(document),
        window: $(window),
        body: $("body"),
        classes: {
            toggled: "active", isOverlay: "overlay--enabled", mobileMainMenuActive: "dt_mobilenav-mainmenu--active", headerSearchActive: "dt_header-search--active", headerSidebarActive: "sidebar--active"
        },
        init: function() {
            this.document.on("ready", this.documentReadyRender.bind(this)), 
            this.document.on("ready", this.menuFocusAccessibility.bind(this)), 
            this.document.on("ready", this.headerHeight.bind(this)), 
            this.document.on("ready", this.topbarMobile.bind(this)),
            this.document.on("ready", this.mobileNavRight.bind(this)),
            this.document.on("ready", this.fixDuplicateSearchIds.bind(this)),
            this.window.on("ready", this.documentReadyRender.bind(this))
        },
        documentReadyRender: function() {
            this.document.on("click." + this.eventID, ".dt_mobilenav-mainmenu-toggle", this.menuToggleHandler.bind(this)).on("click." + this.eventID, ".dt_header-closemenu", this.menuToggleHandler.bind(this)).on("click." + this.eventID, this.hideHeaderMobilePopup.bind(this)).on("click." + this.eventID, ".dt_mobilenav-dropdown-toggle", this.verticalMobileSubMenuLinkHandle.bind(this)).on("click." + this.eventID, ".dt_header-closemenu", this.resetVerticalMobileMenu.bind(this)).on("hideHeaderMobilePopup." + this.eventID, this.resetVerticalMobileMenu.bind(this)).on("click." + this.eventID, ".dt_navbar-search-toggle", this.searchPopupHandler.bind(this)).on("click." + this.eventID, ".dt_search-close", this.searchPopupHandler.bind(this)).on("click." + this.eventID, ".dt_navbar-sidebar-toggle", this.sidebarPopupHandler.bind(this)).on("click." + this.eventID, ".dt_sidebar-close", this.sidebarPopupHandler.bind(this)), this.window.on("scroll." + this.eventID, this.scrollToSticky.bind(this)).on("resize." + this.eventID, this.headerHeight.bind(this))
        },
        scrollToSticky: function(b) {
            var $sticky = $(".is--sticky");
            var scrollTop = $(window).scrollTop();

            // Preserve lastScrollTop outside the function so it remembers previous value
            if (typeof this.lastScrollTop === "undefined") {
                this.lastScrollTop = 0;
            }

            if ($sticky.hasClass("reverse")) {
                // Reverse scroll behavior
                if (scrollTop < 200) {
                    $sticky.removeClass("on");
                } else if (scrollTop > this.lastScrollTop) {
                    // Scrolling down
                    $sticky.removeClass("on");
                } else {
                    // Scrolling up
                    $sticky.addClass("on");
                }
            } else {
                // Normal sticky behavior
                if (scrollTop >= 220) {
                    $sticky.addClass("on");
                } else {
                    $sticky.removeClass("on");
                }
            }

            this.lastScrollTop = scrollTop;
        },
        headerHeight: function(d) {
            var a = $(".dt_header-navwrapper"),
                b = $(".dt_header-navwrapperinner"),
                c = 0;
            $("body").find("div").hasClass("is--sticky") && (b.each(function() {
                var a = this.clientHeight;
                a > c && (c = a)
            }), a.css("min-height", c))
        },
        // New function to fix duplicate IDs
        fixDuplicateSearchIds: function() {
            // Fix desktop search IDs
            var desktopSearch = document.querySelector('.dt_navbar .dt_search-form');
            var desktopSearchField = document.querySelector('.dt_navbar .dt_search-field');
            var desktopSearchLabel = document.querySelector('.dt_navbar .dt_search-form label');
            
            if (desktopSearch && desktopSearchField && desktopSearchLabel) {
                desktopSearchField.id = "dt_search-form-desktop";
                desktopSearchLabel.setAttribute('for', 'dt_search-form-desktop');
            }
            
            // Fix mobile search IDs  
            var mobileSearch = document.querySelector('.dt_mobilenav .dt_search-form');
            var mobileSearchField = document.querySelector('.dt_mobilenav .dt_search-field');
            var mobileSearchLabel = document.querySelector('.dt_mobilenav .dt_search-form label');
            
            if (mobileSearch && mobileSearchField && mobileSearchLabel) {
                mobileSearchField.id = "dt_search-form-mobile";
                mobileSearchLabel.setAttribute('for', 'dt_search-form-mobile');
            }
        },
        topbarAccessibility: function() {
            var b, a, d, c = document.querySelector(".dt_mobilenav-topbar");
            var f = document.querySelector(".dt_mobilenav-topbar-toggle"),
                e = c.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
                g = e[e.length - 1];
            if (!c) return !1;
            for (a = 0, d = (b = c.getElementsByTagName("a")).length; a < d; a++) b[a].addEventListener("focus", h, !0), b[a].addEventListener("blur", h, !0);

            function h() {
                for (var a = this; - 1 === a.className.indexOf("dt_mobilenav-topbar");) "*" === a.tagName.toLowerCase() && (-1 !== a.className.indexOf("focus") ? a.className = a.className.replace(" focus", "") : a.className += " focus"), a = a.parentElement
            }
            document.addEventListener("keydown", function(a) {
                ("Tab" === a.key || 9 === a.keyCode) && f.classList.contains("active") && (a.shiftKey ? document.activeElement === f && (g.focus(), a.preventDefault()) : document.activeElement === g && (f.focus(), a.preventDefault()))
            })
        },
        topbarMobile: function() {
            var c = $(".dt_mobilenav-topbar-content"),
                b = $(".dt_header-widget"),
                a = $(".dt_mobilenav-topbar-toggle");
            !b.children().length > 0 ? a.hide() : (a.show(), a.on("click", function(b) {
                c.slideToggle(), a.toggleClass("active"), b.preventDefault()
            }), this.topbarAccessibility())
        },
        mobileNavRight: function() {
            $(".dt_navbar-right .dt_navbar-cart-item").clone().prependTo(".dt_mobilenav-right .dt_navbar-list-right");
        },
        menuFocusAccessibility: function(a) {
            $(".dt_navbar-nav, .widget_nav_menu").find("a").on("focus blur", function() {
                $(this).parents("ul, li").toggleClass("focus")
            })
        },
        menuToggleHandler: function(c) {
            var b = $(".dt_mobilenav-mainmenu-content"),
                a = $(".dt_mobilenav-mainmenu-toggle");
            this.body.toggleClass(this.classes.mobileMainMenuActive), this.body.toggleClass(this.classes.isOverlay), a.toggleClass(this.classes.toggled), b.fadeToggle(), this.body.hasClass(this.classes.mobileMainMenuActive) ? $(".dt_header-closemenu").focus() : a.focus(), this.menuAccessibility()
        },
        hideHeaderMobilePopup: function(a) {
            var b = $(".dt_mobilenav-mainmenu-toggle"),
                c = $(".dt_mobilenav-mainmenu");
            !$(a.target).closest(b).length && !$(a.target).closest(c).length && this.body.hasClass(this.classes.mobileMainMenuActive) && (this.body.removeClass(this.classes.mobileMainMenuActive), this.body.removeClass(this.classes.isOverlay), b.removeClass(this.classes.toggled), $(".dt_mobilenav-mainmenu-content").fadeOut(), this.document.trigger("hideHeaderMobilePopup." + this.eventID), a.stopPropagation())
        },
        verticalMobileSubMenuLinkHandle: function(a) {
            a.preventDefault();
            var b = $(a.currentTarget);
            var self = this;
            b.closest(".dt_mobilenav-mainmenu .dt_navbar-mainmenu"), b.parents(".dropdown-menu").length, this.isRTL, setTimeout(function() {
                b.parent().toggleClass("current"), b.next().slideToggle();
                // Update focus trap when submenu opens/closes
                self.updateMenuFocusTrap();
            }, 250)
        },
        resetVerticalMobileMenu: function(a) {
            $(".dt_mobilenav-mainmenu .dt_navbar-mainmenu");
            var b = $(".dt_mobilenav-mainmenu  .menu-item"),
                c = $(".dt_mobilenav-mainmenu .dropdown-menu");
            var self = this;
            setTimeout(function() {
                b.removeClass("current"), c.hide();
                // Update focus trap when submenus close
                self.updateMenuFocusTrap();
            }, 250)
        },
        // Updated and improved menu accessibility function
        menuAccessibility: function() {
            var self = this;
            var mobileMenuContent = document.querySelector(".dt_mobilenav-mainmenu-content");
            var closeButton = document.querySelector(".dt_header-closemenu:not(.off--layer)");
            
            if (!mobileMenuContent || !closeButton) return false;

            // Remove existing event listener to avoid duplicates
            if (this.keydownHandler) {
                document.removeEventListener("keydown", this.keydownHandler);
            }

            // Create the keydown handler
            this.keydownHandler = function(event) {
                if (("Tab" === event.key || 9 === event.keyCode) && 
                    document.body.classList.contains("dt_mobilenav-mainmenu--active")) {
                    self.handleMenuTabNavigation(event);
                }
            };

            document.addEventListener("keydown", this.keydownHandler);

            // Set up focus handlers for menu items
            this.setupMenuFocusHandlers();
        },

        // New function to handle tab navigation in mobile menu
        handleMenuTabNavigation: function(event) {
            var focusableElements = this.getFocusableElements();
            if (focusableElements.length === 0) return;

            var firstElement = focusableElements[0];
            var lastElement = focusableElements[focusableElements.length - 1];

            if (event.shiftKey) {
                // Shift + Tab
                if (document.activeElement === firstElement) {
                    lastElement.focus();
                    event.preventDefault();
                }
            } else {
                // Tab
                if (document.activeElement === lastElement) {
                    firstElement.focus();
                    event.preventDefault();
                }
            }
        },

        // New function to get currently focusable elements (including visible submenu items)
        getFocusableElements: function() {
            var mobileMenuContent = document.querySelector(".dt_mobilenav-mainmenu-content");
            if (!mobileMenuContent) return [];

            var selector = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
            var allFocusableElements = mobileMenuContent.querySelectorAll(selector);
            
            // Filter out elements that are not visible (e.g., in closed submenus)
            var visibleElements = [];
            for (var i = 0; i < allFocusableElements.length; i++) {
                var element = allFocusableElements[i];
                var isVisible = this.isElementVisible(element);
                if (isVisible) {
                    visibleElements.push(element);
                }
            }
            
            return visibleElements;
        },

        // New function to check if an element is visible
        isElementVisible: function(element) {
            var style = window.getComputedStyle(element);
            var rect = element.getBoundingClientRect();
            
            // Check if element is hidden by CSS
            if (style.display === 'none' || style.visibility === 'hidden' || style.opacity === '0') {
                return false;
            }
            
            // Check if element is in a closed submenu
            var submenu = element.closest('.dropdown-menu');
            if (submenu) {
                var parentLi = submenu.parentElement;
                if (parentLi && !parentLi.classList.contains('current')) {
                    return false;
                }
            }
            
            return true;
        },

        // New function to update focus trap when submenus open/close
        updateMenuFocusTrap: function() {
            // Only update if mobile menu is active
            if (document.body.classList.contains("dt_mobilenav-mainmenu--active")) {
                // Small delay to ensure DOM is updated after submenu animation
                setTimeout(function() {
                    // Focus trap will be handled by handleMenuTabNavigation function
                    // which dynamically gets focusable elements
                }, 300);
            }
        },

        // New function to set up focus handlers for menu items
        setupMenuFocusHandlers: function() {
            var mobileMenuContent = document.querySelector(".dt_mobilenav-mainmenu-content");
            if (!mobileMenuContent) return;

            var menuLinks = mobileMenuContent.getElementsByTagName("a");
            var menuButtons = mobileMenuContent.getElementsByTagName("button");

            // Focus handler function
            function focusHandler() {
                var currentElement = this;
                while (currentElement && currentElement.className.indexOf("dt_mobilenav-mainmenu-inner") === -1) {
                    if (currentElement.tagName.toLowerCase() === "li") {
                        if (currentElement.className.indexOf("focus") !== -1) {
                            currentElement.className = currentElement.className.replace(" focus", "");
                        } else {
                            currentElement.className += " focus";
                        }
                    }
                    currentElement = currentElement.parentElement;
                }
            }

            // Add focus handlers to links
            for (var i = 0; i < menuLinks.length; i++) {
                menuLinks[i].addEventListener("focus", focusHandler, true);
                menuLinks[i].addEventListener("blur", focusHandler, true);
            }

            // Add focus handlers to buttons
            for (var j = 0; j < menuButtons.length; j++) {
                menuButtons[j].addEventListener("focus", focusHandler, true);
                menuButtons[j].addEventListener("blur", focusHandler, true);
            }
        },

        searchPopupHandler: function(c) {
            var clickedButton = c.currentTarget;
            var searchContainer, searchField, searchToggle;
            
            // Determine if it's desktop or mobile search based on the clicked button's context
            if ($(clickedButton).closest('.dt_navbar').length) {
                // Desktop search
                searchContainer = $('.dt_navbar .dt_search.search--header');
                searchField = $('.dt_navbar .dt_search-field');
                searchToggle = $('.dt_navbar .dt_navbar-search-toggle');
            } else {
                // Mobile search
                searchContainer = $('.dt_mobilenav .dt_search.search--header');
                searchField = $('.dt_mobilenav .dt_search-field');
                searchToggle = $('.dt_mobilenav .dt_navbar-search-toggle');
            }
            
            this.body.toggleClass(this.classes.headerSearchActive);
            this.body.toggleClass(this.classes.isOverlay);
            
            if (this.body.hasClass(this.classes.headerSearchActive)) {
                searchField.focus();
            } else {
                searchToggle.focus();
            }
            
            // Call accessibility function with the specific search context
            this.searchPopupAccessibility(clickedButton);
        },

        // Updated search popup accessibility function
        searchPopupAccessibility: function(clickedButton) {
            var searchContainer, searchField;
            var self = this;
            
            // Determine context based on the clicked button
            if ($(clickedButton).closest('.dt_navbar').length) {
                // Desktop search
                searchContainer = document.querySelector('.dt_navbar .search--header');
                searchField = document.querySelector('.dt_navbar .dt_search-field');
            } else {
                // Mobile search  
                searchContainer = document.querySelector('.dt_mobilenav .search--header');
                searchField = document.querySelector('.dt_mobilenav .dt_search-field');
            }

            if (!searchContainer || !searchField) return false;

            // Remove existing search keydown handler if it exists
            if (this.searchKeydownHandler) {
                document.removeEventListener("keydown", this.searchKeydownHandler);
            }

            // Get all focusable elements within the active search container
            var focusableElements = searchContainer.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            
            if (focusableElements.length === 0) return false;

            var firstElement = focusableElements[0];
            var lastElement = focusableElements[focusableElements.length - 1];

            // Create new keydown handler
            this.searchKeydownHandler = function(event) {
                if (("Tab" === event.key || 9 === event.keyCode) && 
                    document.body.classList.contains("dt_header-search--active")) {
                    
                    if (event.shiftKey) {
                        // Shift + Tab
                        if (document.activeElement === firstElement) {
                            lastElement.focus();
                            event.preventDefault();
                        }
                    } else {
                        // Tab
                        if (document.activeElement === lastElement) {
                            firstElement.focus();
                            event.preventDefault();
                        }
                    }
                }
            };

            document.addEventListener("keydown", this.searchKeydownHandler);

            // Set up focus handlers for search elements
            this.setupSearchFocusHandlers(searchContainer);
        },

        // New function to set up focus handlers for search elements
        setupSearchFocusHandlers: function(searchContainer) {
            if (!searchContainer) return;

            var searchButtons = searchContainer.getElementsByTagName("button");
            var searchInputs = searchContainer.getElementsByTagName("input");

            // Focus handler function for search elements
            function searchFocusHandler() {
                var currentElement = this;
                while (currentElement && currentElement.className.indexOf("search--header") === -1) {
                    if (currentElement.tagName.toLowerCase() === "input" || currentElement.tagName.toLowerCase() === "button") {
                        if (currentElement.className.indexOf("focus") !== -1) {
                            currentElement.className = currentElement.className.replace(" focus", "");
                        } else {
                            currentElement.className += " focus";
                        }
                    }
                    currentElement = currentElement.parentElement;
                }
            }

            // Add focus handlers to buttons
            for (var i = 0; i < searchButtons.length; i++) {
                searchButtons[i].addEventListener("focus", searchFocusHandler, true);
                searchButtons[i].addEventListener("blur", searchFocusHandler, true);
            }

            // Add focus handlers to inputs
            for (var j = 0; j < searchInputs.length; j++) {
                searchInputs[j].addEventListener("focus", searchFocusHandler, true);
                searchInputs[j].addEventListener("blur", searchFocusHandler, true);
            }
        },

        sidebarPopupHandler: function(d) {
            var a = $(".dt_navbar-sidebar-toggle"),
                b = $(".dt_sidebar"),
                c = $(".dt_sidebar-close");
            this.body.toggleClass(this.classes.headerSidebarActive), this.body.toggleClass(this.classes.isOverlay), a.toggleClass(this.classes.toggled), this.body.hasClass(this.classes.headerSidebarActive) ? (c.focus()) : (a.focus()), this.sidebarPopupAccessibility()
        },
        sidebarPopupAccessibility: function() {
            var b, a, d, c = document.querySelector(".dt_sidebar");
            var f = document.querySelector(".dt_sidebar-close:not(.off--layer)"),
                e = c.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
                g = e[e.length - 1];
            if (!c) return !1;
            for (a = 0, d = (b = c.getElementsByTagName("button")).length; a < d; a++) b[a].addEventListener("focus", h, !0), b[a].addEventListener("blur", h, !0);

            function h() {
                for (var a = this; - 1 === a.className.indexOf("dt_sidebar-inner");) "input" === a.tagName.toLowerCase() && (-1 !== a.className.indexOf("focus") ? a.className = a.className.replace("focus", "") : a.className += " focus"), a = a.parentElement
            }
            document.addEventListener("keydown", function(a) {
                ("Tab" === a.key || 9 === a.keyCode) && (a.shiftKey ? document.activeElement === f && (g.focus(), a.preventDefault()) : document.activeElement === g && (f.focus(), a.preventDefault()))
            })
        }
    };
    a.init()
}(jQuery, window.asConfig);
