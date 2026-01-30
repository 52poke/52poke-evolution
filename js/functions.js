(function () {
    'use strict';

    function onReady(fn) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', fn);
        } else {
            fn();
        }
    }

    function initMenuToggle() {
        var header = document.querySelector('.site-header');
        var toggle = document.querySelector('.site-header .menu-toggle');
        if (!header || !toggle) {
            return;
        }
        toggle.addEventListener('click', function () {
            header.classList.toggle('toggle-on');
        });
    }

    function initMasonry() {
        var container = document.querySelector('.article-container');
        if (!container || !window.imagesLoaded || !window.Masonry) {
            return;
        }

        window.imagesLoaded(container, function () {
            new window.Masonry(container);
            var main = document.getElementById('main');
            if (main) {
                main.style.display = 'block';
                setTimeout(function () {
                    main.style.display = '';
                }, 0);
            }
        });
    }

    function initMonthArchive() {
        var archives = document.querySelectorAll('#wgt-month-archive');
        if (!archives.length) {
            return;
        }

        Array.prototype.forEach.call(archives, function (archive) {
            Array.prototype.forEach.call(archive.querySelectorAll('script'), function (script) {
                script.parentNode.removeChild(script);
            });

            var yearEl = archive.querySelector('.year');
            var currentYear = new Date().getFullYear();
            var year = yearEl ? parseInt(yearEl.textContent, 10) : currentYear;
            if (!year || isNaN(year)) {
                year = currentYear;
            }

            function update() {
                if (year < 2005) {
                    year = 2005;
                }
                if (year > currentYear) {
                    year = currentYear;
                }
                if (yearEl) {
                    yearEl.textContent = String(year);
                }

                Array.prototype.forEach.call(archive.querySelectorAll('.disabled'), function (el) {
                    el.classList.remove('disabled');
                });

                var prev = archive.querySelector('.switch-prev');
                var next = archive.querySelector('.switch-next');
                if (year === 2005 && prev) {
                    prev.classList.add('disabled');
                }

                if (year === currentYear) {
                    if (next) {
                        next.classList.add('disabled');
                    }
                    var currentMonth = new Date().getMonth() + 1;
                    Array.prototype.forEach.call(archive.querySelectorAll('.month-line a'), function (link) {
                        var month = parseInt(link.getAttribute('data-month'), 10);
                        if (month > currentMonth) {
                            link.classList.add('disabled');
                        }
                    });
                }
            }

            archive.addEventListener('click', function (event) {
                var target = event.target;

                var prev = target.closest('.switch-prev');
                if (prev && archive.contains(prev)) {
                    event.preventDefault();
                    year -= 1;
                    update();
                    return;
                }

                var next = target.closest('.switch-next');
                if (next && archive.contains(next)) {
                    event.preventDefault();
                    year += 1;
                    update();
                    return;
                }

                var yearLink = target.closest('.year');
                if (yearLink && archive.contains(yearLink)) {
                    event.preventDefault();
                    window.location.href = '/post/date/' + year + '/';
                    return;
                }

                var monthLink = target.closest('.month-line a');
                if (monthLink && archive.contains(monthLink)) {
                    event.preventDefault();
                    if (monthLink.classList.contains('disabled')) {
                        return;
                    }
                    var month = monthLink.getAttribute('data-month');
                    if (!month) {
                        return;
                    }
                    var monthPadded = ('0' + month).slice(-2);
                    window.location.href = '/post/date/' + year + '/' + monthPadded + '/';
                }
            });

            update();
        });
    }

    function initHeaderPokeBall() {
        var headerPokeBall = document.querySelector('.header-poke-ball');
        if (!headerPokeBall) {
            return;
        }

        try {
            if (!window.localStorage || localStorage.getItem('header-poke-ball') === '1') {
                return;
            }
        } catch (err) {
            return;
        }

        fetch('/wp-content/themes/52poke-evolution/images/header-poke-ball.svg', { credentials: 'same-origin' })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('Failed to load SVG');
                }
                return response.text();
            })
            .then(function (text) {
                var parser = new DOMParser();
                var doc = parser.parseFromString(text, 'image/svg+xml');
                var svg = doc.documentElement;
                if (svg) {
                    headerPokeBall.classList.add('svg-loaded');
                    headerPokeBall.appendChild(svg);
                }
            })
            .catch(function () {
                // Ignore SVG load errors.
            });

        headerPokeBall.classList.add('animate');
        var onClick = function () {
            headerPokeBall.classList.remove('animate');
            try {
                localStorage.setItem('header-poke-ball', '1');
            } catch (err) {
                // Ignore storage errors.
            }
            headerPokeBall.removeEventListener('click', onClick);
        };
        headerPokeBall.addEventListener('click', onClick);
    }

    onReady(function () {
        initMenuToggle();
        initMasonry();
        initMonthArchive();
        initHeaderPokeBall();
    });
})();
