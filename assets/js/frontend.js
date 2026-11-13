(function ($) {
    'use strict';

    // ==========================================
    // 1. Advanced Coupon Widget Handler
    // ==========================================
    var NextExtraCouponHandler = function ($scope, $) {
        var $card = $scope.find('.next-extra-coupon-card');
        if (!$card.length) return;

        var couponCode = $card.data('coupon');
        var autoApply = $card.data('auto-apply') === 'yes';
        var $copyBtn = $card.find('.next-extra-copy-btn');
        var $feedback = $card.find('.next-extra-coupon-feedback');
        var $timer = $card.find('.next-extra-coupon-timer');

        // Copy button action
        $copyBtn.on('click', function (e) {
            e.preventDefault();
            var $btn = $(this);
            var originalText = $btn.find('.btn-text').text();

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(couponCode).then(function () {
                    showCopySuccess($btn, originalText);
                }).catch(function () {
                    fallbackCopy(couponCode, $btn, originalText);
                });
            } else {
                fallbackCopy(couponCode, $btn, originalText);
            }

            // Auto apply to cart if enabled
            if (autoApply && typeof nextExtraVars !== 'undefined') {
                applyCouponAjax(couponCode, $feedback);
            }
        });

        function fallbackCopy(text, $btn, originalText) {
            var tempInput = $('<input>');
            $('body').append(tempInput);
            tempInput.val(text).select();
            document.execCommand('copy');
            tempInput.remove();
            showCopySuccess($btn, originalText);
        }

        function showCopySuccess($btn, originalText) {
            $btn.find('.btn-text').text((nextExtraVars && nextExtraVars.i18n.copied) || 'Copied!');
            $btn.addClass('copied');
            setTimeout(function () {
                $btn.find('.btn-text').text(originalText);
                $btn.removeClass('copied');
            }, 2500);
        }

        function applyCouponAjax(code, $feedbackBox) {
            $feedbackBox.removeClass('success error').hide();

            $.ajax({
                url: nextExtraVars.ajax_url,
                type: 'POST',
                data: {
                    action: 'next_extra_apply_coupon',
                    coupon_code: code,
                    security: nextExtraVars.nonce
                },
                beforeSend: function () {
                    $feedbackBox.text((nextExtraVars && nextExtraVars.i18n.applying) || 'Applying...').addClass('success').show();
                },
                success: function (res) {
                    if (res.success) {
                        $feedbackBox.removeClass('error').addClass('success').text(res.data.message).show();
                        $(document.body).trigger('update_checkout');
                        $(document.body).trigger('wc_update_cart');
                    } else {
                        $feedbackBox.removeClass('success').addClass('error').text(res.data.message).show();
                    }
                },
                error: function () {
                    $feedbackBox.removeClass('success').addClass('error').text('Could not connect to server.').show();
                }
            });
        }

        // Countdown Timer
        if ($timer.length) {
            var endTimeStr = $timer.data('endtime');
            if (endTimeStr) {
                var endTime = new Date(endTimeStr).getTime();

                var timerInterval = setInterval(function () {
                    var now = new Date().getTime();
                    var distance = endTime - now;

                    if (distance < 0) {
                        clearInterval(timerInterval);
                        $timer.html('<span class="next-extra-expired">Coupon Expired</span>');
                        return;
                    }

                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    $timer.find('.days').text(days < 10 ? '0' + days : days);
                    $timer.find('.hours').text(hours < 10 ? '0' + hours : hours);
                    $timer.find('.minutes').text(minutes < 10 ? '0' + minutes : minutes);
                    $timer.find('.seconds').text(seconds < 10 ? '0' + seconds : seconds);
                }, 1000);
            }
        }
    };

    // ==========================================
    // 2. Product Carousel Widget Handler
    // ==========================================
    var NextExtraCarouselHandler = function ($scope, $) {
        var $carousel = $scope.find('.next-extra-swiper');
        if (!$carousel.length) return;

        var config = $carousel.data('swiper-config');
        if (typeof config === 'string') {
            try {
                config = JSON.parse(config);
            } catch (e) {
                config = {};
            }
        }

        // Add navigation and pagination references
        var $prev = $scope.find('.next-extra-swiper-prev');
        var $next = $scope.find('.next-extra-swiper-next');
        var $dots = $scope.find('.next-extra-swiper-dots');

        if ($prev.length && $next.length) {
            config.navigation = {
                prevEl: $prev[0],
                nextEl: $next[0],
            };
        }

        if ($dots.length) {
            config.pagination = {
                el: $dots[0],
                clickable: true,
            };
        }

        // Swiper instance through Elementor or Global Swiper
        var SwiperConstructor = (elementorFrontend.utils && elementorFrontend.utils.swiper) 
            ? elementorFrontend.utils.swiper 
            : window.Swiper;

        if (SwiperConstructor) {
            if (typeof SwiperConstructor.init === 'function') {
                SwiperConstructor.init($carousel[0], config);
            } else {
                new SwiperConstructor($carousel[0], config);
            }
        }
    };

    // Hook into Elementor Frontend
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/next-extra-advanced-coupon.default', NextExtraCouponHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/next-extra-product-carousel.default', NextExtraCarouselHandler);
    });

})(jQuery);
