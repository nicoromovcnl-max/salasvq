(function () {
	"use strict";

	function initMobileMenu() {
		var toggle = document.querySelector("[data-menu-toggle]");
		var nav = document.querySelector("[data-mobile-nav]");
		if (!toggle || !nav) return;

		toggle.addEventListener("click", function () {
			var isOpen = nav.classList.toggle("is-open");
			toggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
		});
	}

	function initFilterBar() {
		var bars = document.querySelectorAll("[data-filter-bar]");

		bars.forEach(function (bar) {
			var grid = bar.closest("section").querySelector("[data-events-grid]");
			if (!grid) return;

			var items = grid.querySelectorAll(".event-grid__item");
			var buttons = bar.querySelectorAll("[data-filter]");

			buttons.forEach(function (button) {
				button.addEventListener("click", function () {
					var filter = button.getAttribute("data-filter");

					buttons.forEach(function (b) {
						b.classList.toggle("is-active", b === button);
					});

					items.forEach(function (item) {
						var match = filter === "todos" || item.getAttribute("data-category") === filter;
						item.hidden = !match;
					});
				});
			});
		});
	}

	function initRevealOnLoad() {
		var titles = document.querySelectorAll(
			".hero__titular-line, .section__titular span, .cta-strip__titular span"
		);

		if (!("IntersectionObserver" in window)) return;

		titles.forEach(function (el) {
			el.style.opacity = "0";
			el.style.transform = "translateY(0.4em)";
			el.style.transition = "opacity 0.6s cubic-bezier(0.22,1,0.36,1), transform 0.6s cubic-bezier(0.22,1,0.36,1)";
		});

		var observer = new IntersectionObserver(
			function (entries, obs) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						entry.target.style.opacity = "1";
						entry.target.style.transform = "translateY(0)";
						obs.unobserve(entry.target);
					}
				});
			},
			{ threshold: 0.2 }
		);

		titles.forEach(function (el) {
			observer.observe(el);
		});
	}

	// Detalle de firma: ligerísimo tilt 3D de la fotografía al pasar el
	// cursor por encima. Nada de efectos de tarjeta SaaS: solo 3-4 grados,
	// desactivado si el visitante prefiere menos movimiento.
	function initImageTilt() {
		if (window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;
		if (window.matchMedia && window.matchMedia("(hover: none)").matches) return;

		var selectors = ".event-card__media, .category-card__media, .cat-destacado__media, .lasala-gallery__item";
		var containers = document.querySelectorAll(selectors);
		var MAX_DEG = 4;

		containers.forEach(function (el) {
			var img = el.querySelector("img");
			if (!img) return;
			var raf = null;

			el.addEventListener("mousemove", function (e) {
				var rect = el.getBoundingClientRect();
				var px = (e.clientX - rect.left) / rect.width - 0.5;
				var py = (e.clientY - rect.top) / rect.height - 0.5;

				if (raf) cancelAnimationFrame(raf);
				raf = requestAnimationFrame(function () {
					var rx = (-py * MAX_DEG).toFixed(2);
					var ry = (px * MAX_DEG).toFixed(2);
					img.style.transform =
						"scale(1.06) rotateX(" + rx + "deg) rotateY(" + ry + "deg)";
				});
			});

			el.addEventListener("mouseleave", function () {
				if (raf) cancelAnimationFrame(raf);
				img.style.transform = "";
			});
		});
	}

	document.addEventListener("DOMContentLoaded", function () {
		initMobileMenu();
		initFilterBar();
		initRevealOnLoad();
		initImageTilt();
	});
})();
