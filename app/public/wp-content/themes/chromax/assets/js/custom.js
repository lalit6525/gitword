(function($) {
    'use strict';

    // Function to hide preloader
    var preloader = $('.dt_preloader');
    function initHidePreloader() {
        $('body').addClass('overlay--enabled')
        if (preloader.length) {
            preloader.addClass('loaded');
            preloader.delay(600).fadeOut();
            $('body').removeClass('overlay--enabled');
        }
    }
    if (preloader.length) {
        $('.dt_preloader-close').on('click', function() {
            preloader.addClass('loaded');
            preloader.delay(600).fadeOut();
            $('body').removeClass('overlay--enabled');
        });
    }

    // Function to handle scrolling and update progress bar
    function initUpdateProgressBar() {
        var scroll = $(window).scrollTop();
        var height = $(document).height() - $(window).height();
        var progressPath = $('.dt_uptop path')[0];
        var pathLength = progressPath.getTotalLength();
        var progress = pathLength - (scroll * pathLength / height);
        progressPath.style.strokeDashoffset = progress;
    }
    
    // Function to initialize Owl Slider Main
    function splitTitleWords($element) {
        const text = $element.data('text');
        if (!text) return;
        // Wrap the text in a temp div to allow HTML parsing
        const tempDiv = $('<div>').html(text);
        const contentNodes = tempDiv.contents();
        $element.html('');
        //const words = text.split(' ');
        //$element.html('');
        // words.forEach((word) => {
        //     $element.append(`<span>${word}</span> `);
        // });
        /*if ($('.dt_slider').hasClass('dt_slider--one')) {
            words.forEach((word, index) => {
                const delay = index * 0.1;
                $element.append(`<span style="animation-delay: ${delay}s">${word} </span>`);
            });
        }*/
       if ($('.dt_slider').hasClass('dt_slider--one')) {
            let wordIndex = 0;
            contentNodes.each(function () {
                if (this.nodeType === 3) {
                    // Text node
                    const words = this.textContent.split(' ');
                    words.forEach((word) => {
                        const delay = wordIndex * 0.1;
                        $element.append(`<span style="animation-delay: ${delay}s">${word} </span>`);
                        wordIndex++;
                    });
                } else if (this.nodeType === 1) {
                    // Element node (e.g., span)
                    const $span = $(this);
                    const words = $span.text().split(' ');
                    words.forEach((word) => {
                        const delay = wordIndex * 0.1;
                        $element.append(`<span class="${$span.attr('class')}" style="animation-delay: ${delay}s">${word} </span>`);
                        wordIndex++;
                    });
                }
            });
        } else {
            $element.html(text);
        }
    }


    function prepareAllTitles() {
        $('.dt_slider .title').each(function () {
            splitTitleWords($(this));
        });
    }
    
    function animateCurrentSlideContent() {
        const $activeSlide = $('.dt_slider .owl-item.active').not('.cloned');
        const $title = $activeSlide.find('.title');
        const $subtitle = $activeSlide.find('.subtitle');
        const $text = $activeSlide.find('.text');
        const $btnGroup = $activeSlide.find('.dt_btn-group');

        // Skip if already animated
        if ($activeSlide.hasClass('content-animated')) return;

        // Remove animations from all other slides
        $('.dt_slider .owl-item').removeClass('content-animated');
        $('.dt_slider .title').removeClass('animate-title');
        $('.dt_slider .subtitle').removeClass('animate-subtitle');
        $('.dt_slider .text').removeClass('animate-text');
        $('.dt_slider .dt_btn-group').removeClass('animate-buttons');

        // Add animation classes
        $title.addClass('animate-title');
        $subtitle.addClass('animate-subtitle');
        $text.addClass('animate-text');
        $btnGroup.addClass('animate-buttons');

        // Mark this slide as animated
        $activeSlide.addClass('content-animated');
    }
    
    function initOwlCarousels() {
        $(".dt_owl_carousel").each(function () {
            const $carousel = $(this);
            const options = typeof $carousel.data("owl-options") === "object"
                ? $carousel.data("owl-options")
                : JSON.parse($carousel.attr("data-owl-options"));
    
            $carousel.owlCarousel(options)
                .on('initialized.owl.carousel', function () {
                    prepareAllTitles();         // Split title words to spans
                    if ($('.dt_slider').hasClass('dt_slider--one')) {
                        animateCurrentSlideContent(); // Animate first slide
                    }
                })
                .on('translated.owl.carousel', function () {
                    if ($('.dt_slider').hasClass('dt_slider--one')) {
                        animateCurrentSlideContent(); // Animate after slide transition
                    }
                });
        });
    }

    // Event handling for scrolling and updating progress bar
    $(window).on('scroll', function() {
        $('.dt_uptop').toggleClass('active', $(this).scrollTop() > 50);
        initUpdateProgressBar();
    });

    // Function to handle click event for scrolling to top
    $('.dt_uptop').on('click', function(event) {
        event.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 550);
    });

    if ($('.smoother-yes').length) {
        const lenis = new Lenis({
            smoothWheel: true,
            wheelMultiplier: 1.2,
            duration: 1.5,
            lerp: 0.1,
        });
        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);

        // Handle scroll animation for anchor links
        document.querySelectorAll('a[href^="#"]').forEach((el) => {
            el.addEventListener('click', (e) => {
                e.preventDefault();
                const id = el.getAttribute('href')?.slice(1);
                if (!id) return;
                const target = document.getElementById(id);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Function to handle lenis prevent for dynamic select woo checkout
        if($('body.woocommerce-checkout').length) {
            const lenisPreventDynamic = () => {
                document.querySelectorAll('.select2-results__options:not([data-lenis-prevent])').forEach((el) => {
                    el.setAttribute('data-lenis-prevent', '');
                });
            };
            const observer = new MutationObserver((mutationsList) => {
                mutationsList.forEach((mutation) => {
                    mutation.addedNodes.forEach((node) => {
                        if (node.nodeType === 1 && node.matches('.select2-results__options')) {
                            lenisPreventDynamic();
                        } else if (node.nodeType === 1 && node.querySelector('.select2-results__options')) {
                            lenisPreventDynamic();
                        }
                    });
                });
            });
            observer.observe(document.body, {
                childList: true,
                subtree: true,
            });
            lenisPreventDynamic();
        }
    }

    // Title Animation
    const bodyClass = document.body.classList;
    const animationStyle = [...bodyClass].find(cls => cls.startsWith("use-animation-style-"));

    document.querySelectorAll(".text-animate").forEach(el => {
        let split;

        switch (animationStyle) {
            case "use-animation-style-1":
                split = new SplitText(el, {
                    type: "chars, words"
                });
                gsap.from(split.words, {
                    duration: 1,
                    delay: 0.5,
                    x: 20,
                    autoAlpha: 0,
                    stagger: 0.05,
                    scrollTrigger: {
                        trigger: el,
                        start: "top 85%"
                    }
                });
                break;

            case "use-animation-style-2":
                split = new SplitText(el, {
                    type: "chars, words"
                });
                gsap.from(split.chars, {
                    duration: 2,
                    delay: 0.1,
                    x: 20,
                    autoAlpha: 0,
                    stagger: 0.03,
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: el,
                        start: "top 85%"
                    }
                });
                break;

            case "use-animation-style-3":
                if (el.animation) {
                    el.animation.progress(1).kill();
                    el.split.revert();
                }
                el.split = new SplitText(el, {
                    type: "lines,words,chars",
                    linesClass: "split-line"
                });
                gsap.set(el, {
                    perspective: 400
                });
                gsap.set(el.split.chars, {
                    opacity: 0,
                    x: "50"
                });
                el.animation = gsap.to(el.split.chars, {
                    scrollTrigger: {
                        trigger: el,
                        start: "top 90%"
                    },
                    x: "0",
                    y: "0",
                    rotateX: "0",
                    opacity: 1,
                    duration: 1,
                    ease: "back.out(1.7)",
                    stagger: 0.02
                });
                break;

            case "use-animation-style-4":
                const tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 90%',
                        end: 'bottom 60%',
                        scrub: false,
                        markers: false,
                        toggleActions: 'play none none none'
                    }
                });
                const itemSplitted = new SplitText(el, {
                    type: "words, lines"
                });
                gsap.set(el, {
                    perspective: 400
                });
                itemSplitted.split({
                    type: "lines"
                });
                tl.from(itemSplitted.lines, {
                    duration: 1,
                    delay: 0.3,
                    opacity: 0,
                    rotationX: -80,
                    force3D: true,
                    transformOrigin: "top center -50",
                    stagger: 0.1
                });
                break;
        }
    });
    
    // Function to initialize FancyBox for lightbox images
    function initLightbox() {
        if ($('.dt_lightbox_img').length) {
            $('.dt_lightbox_img').fancybox({
                openEffect: 'fade',
                closeEffect: 'fade',
                helpers: { media: {} }
            });
        }
        $('.wp-block-image').each(function() {
            $(this).find("a").attr('data-fancybox', 'gallery');
        });
        if ($('.wp-block-image a').length) {
            $('[data-fancybox="gallery"]').fancybox({
                buttons: ["slideShow", "thumbs", "zoom", "fullScreen", "share", "close"],
                loop: false,
                protect: true
            });
        }
    }

    // Function to initialize scroll pin effect
    function initScrollPinEffect() {
        //gsap.registerPlugin(ScrollTrigger);

        document.querySelectorAll(".gsap-fixed-yes").forEach(container => {
            const elements = container.querySelectorAll(":scope > *");

            // Only kill triggers inside this container
            ScrollTrigger.getAll().forEach(trigger => {
                const el = trigger.trigger;
                if (el && el.closest && el.closest(".gsap-fixed-yes") === container) {
                    trigger.kill();
                }
            });

            // Force container to have enough height
            const totalHeight = Array.from(elements).reduce((acc, el) => acc + el.offsetHeight, 0);
            container.style.minHeight = totalHeight + "px";

            const startClass = Array.from(container.classList).find(c => c.startsWith("start-"));
            const startOffset = startClass ? parseInt(startClass.split("-")[1]) : 40;

            elements.forEach((element, index) => {
                ScrollTrigger.create({
                    trigger: element,
                    start: `top-=${startOffset}`,
                    end: `bottom top+=${element.offsetHeight + startOffset}`,
                    endTrigger: container,
                    pin: true,
                    pinSpacing: false,
                    scrub: false,
                    id: `${container.id}-trigger-${index}`,
                    invalidateOnRefresh: true
                });
            });
        });

        // Important: Refresh after everything
        ScrollTrigger.refresh(true);
    }

    // Particles
    const particleOptions = {
        "particles": {
            "number": {
                "value": 100,
                "density": {
                    "enable": true,
                    "value_area": 4000
                }
            },
            "color": {
                "value": "random"
            },
            "shape": {
                "type": "polygon",
                "polygon": {
                    "nb_sides": 6
                },
                "image": {
                    "src": "img/github.svg",
                    "width": 100,
                    "height": 100
                }
            },
            "opacity": {
                "value": 1,
                "random": true,
                "anim": {
                    "enable": true,
                    "speed": 1,
                    "opacity_min": 0,
                    "sync": false
                }
            },
            "size": {
                "value": 3,
                "random": true,
                "anim": {
                    "enable": false,
                    "speed": 4,
                    "size_min": 0.3,
                    "sync": false
                }
            },
            "move": {
                "enable": true,
                "speed": 1,
                "direction": "none",
                "random": true,
                "straight": false,
                "out_mode": "out",
                "bounce": false,
                "attract": {
                    "enable": false,
                    "rotateX": 600,
                    "rotateY": 600
                }
            }
        },
        "retina_detect": true
    };

    // Data Background
    $("[data-background]").each(function () {
        $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
    });

    // Text animation for bounce effect
    if ($('.bounce-text').length) {
        $('.bounce-text').each(function () {
            let $this = $(this);
            let targetColor = $this.data('bounce-color') || '#000DFF';

            // Split the text into characters
            let mySplitText = new SplitText($this, { type: "chars" });
            let chars = mySplitText.chars;

            // Hide initially
            gsap.set($this, { opacity: 0 });

            // Animation Timeline (paused initially)
            let tl = gsap.timeline({ repeat: -1, paused: true });

            tl.to(chars, {
                duration: 0.5,
                scaleY: 0.6,
                ease: "power3.out",
                stagger: 0.04,
                transformOrigin: 'center bottom'
            });

            tl.to(chars, {
                yPercent: -20,
                ease: "elastic",
                stagger: 0.03,
                duration: 0.8
            }, 0.5);

            tl.to(chars, {
                scaleY: 1,
                ease: "elastic.out(2.5, 0.2)",
                stagger: 0.03,
                duration: 1.5
            }, 0.5);

            tl.to(chars, {
                yPercent: 0,
                ease: "back",
                stagger: 0.03,
                duration: 0.8
            }, 0.7);

            tl.to(chars, {
                color: 'targetColor',
                duration: 1.4,
                stagger: 0.05
            });

            // ScrollTrigger to reveal and play animation
            ScrollTrigger.create({
                trigger: $this[0],
                start: 'bottom 100%-=50px',
                once: true,
                onEnter: function () {
                    gsap.to($this, {
                        opacity: 1,
                        duration: 1,
                        ease: 'power2.out',
                        onComplete: function () {
                            tl.play();
                        }
                    });
                }
            });
        });
    }    

    // Function to initialize headline and preloader on window load
    function initializeComponents() {
        $(window).on('load', function() {
            initHidePreloader();            
            initUpdateProgressBar();
            initScrollPinEffect();
        });
    }

    $(document).ready(function () {
        prepareAllTitles(); // Setup spans
        initOwlCarousels(); // Init everything
        initLightbox(); // Initialize lightbox
        $('.particles-js-area').each(function(index) {
            const id = 'particles-js-' + index;
            $(this).attr('id', id);
            particlesJS(id, particleOptions);
        });
    });

    // Initialize headline and preloader
    initializeComponents();

})(jQuery);