(function () {
	"use strict";

	function initMobileMenu() {
		var toggle = document.querySelector("[data-menu-toggle]");
		var nav = document.querySelector("[data-mobile-nav]");
		if (!toggle || !nav) return;

		toggle.addEventListener("click", function () {
			var isOpen = nav.classList.toggle("is-open");
			toggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
			document.body.classList.toggle("has-mobile-nav-open", isOpen);
		});
	}

	function initFilterBar() {
		var bars = document.querySelectorAll("[data-filter-bar]");

		bars.forEach(function (bar) {
			var grid = bar.closest("section").querySelector("[data-events-grid]");
			if (!grid) return;

			var items = grid.querySelectorAll(".event-grid__item, .agenda-cartelera__item");
			var buttons = bar.querySelectorAll("[data-filter]");
			var isAgenda = grid.closest(".agenda-list") !== null;

			function applyFilter(filter, updateUrl) {
				var target = null;
				buttons.forEach(function (b) {
					var match = b.getAttribute("data-filter") === filter;
					b.classList.toggle("is-active", match);
					if (match) target = b;
				});
				if (!target) return;

				items.forEach(function (item) {
					var match = filter === "todos" || item.getAttribute("data-category") === filter;
					item.hidden = !match;
				});
				bar.dispatchEvent(new CustomEvent("filterchange"));

				if (updateUrl && isAgenda && window.history && window.history.replaceState) {
					var url = new URL(window.location.href);
					if (filter === "todos") {
						url.searchParams.delete("cat");
					} else {
						url.searchParams.set("cat", filter);
					}
					window.history.replaceState(null, "", url);
				}
			}

			buttons.forEach(function (button) {
				button.addEventListener("click", function () {
					applyFilter(button.getAttribute("data-filter"), true);
				});
			});

			if (isAgenda) {
				var initial = new URLSearchParams(window.location.search).get("cat");
				if (initial && bar.querySelector('[data-filter="' + initial + '"]')) {
					applyFilter(initial, false);
				}
			}
		});
	}

	function initRevealOnLoad() {
		var titles = document.querySelectorAll(
			".hero__titular-line, .section__titular span, .cta-strip__titular span, " +
			".evento-poster__titular span, .lasala-palabras__lista li, .cat-hero__titular, " +
			".contacto-cover__titular"
		);

		if (!("IntersectionObserver" in window)) return;
		var reduceMotion = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;
		if (reduceMotion) return;

		titles.forEach(function (el, i) {
			el.style.opacity = "0";
			el.style.transform = "translateY(0.4em)";
			el.style.transition =
				"opacity 0.6s cubic-bezier(0.22,1,0.36,1) " + Math.min(i % 6, 5) * 0.06 + "s, " +
				"transform 0.6s cubic-bezier(0.22,1,0.36,1) " + Math.min(i % 6, 5) * 0.06 + "s";
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

	// Etiqueta de cursor editorial: un pequeño círculo con "VER" que sigue al
	// puntero sobre fotografías interactivas. Inspirado en patrones de
	// "cursor label" habituales en sitios de estudios de diseño, pero
	// reimplementado aquí en CSS + Vanilla JS (sin librerías, sin 3D).
	function initCursorLabel() {
		if (window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;
		if (window.matchMedia && window.matchMedia("(hover: none)").matches) return;

		var targets = document.querySelectorAll(
			".event-card__media, .event-card--destacado, .cat-destacado__media, .lasala-gallery__item, .gallery__item"
		);
		if (!targets.length) return;

		var label = document.createElement("div");
		label.className = "cursor-label";
		label.textContent = "VER";
		document.body.appendChild(label);

		var raf = null;
		var x = 0;
		var y = 0;

		function move(e) {
			x = e.clientX;
			y = e.clientY;
			if (raf) return;
			raf = requestAnimationFrame(function () {
				label.style.transform = "translate(" + x + "px, " + y + "px) translate(-50%, -50%) scale(1)";
				raf = null;
			});
		}

		targets.forEach(function (el) {
			el.addEventListener("mouseenter", function (e) {
				label.classList.add("is-active");
				move(e);
			});
			el.addEventListener("mousemove", move);
			el.addEventListener("mouseleave", function () {
				label.classList.remove("is-active");
			});
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

	// Botones "magnéticos": el texto se desplaza unos px hacia el cursor
	// dentro del propio botón, como en los sitios de estudios de diseño.
	// Nada de físicas raras: solo 6-8px de recorrido máximo.
	function initMagneticButtons() {
		if (window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;
		if (window.matchMedia && window.matchMedia("(hover: none)").matches) return;

		var buttons = document.querySelectorAll(".btn");
		var MAX_PX = 7;

		buttons.forEach(function (btn) {
			btn.addEventListener("mousemove", function (e) {
				var rect = btn.getBoundingClientRect();
				var px = (e.clientX - rect.left) / rect.width - 0.5;
				var py = (e.clientY - rect.top) / rect.height - 0.5;
				btn.style.transform = "translate(" + (px * MAX_PX).toFixed(1) + "px, " + (py * MAX_PX).toFixed(1) + "px)";
			});
			btn.addEventListener("mouseleave", function () {
				btn.style.transform = "";
			});
		});
	}

	// Aparición escalonada de tarjetas/fotos al hacer scroll (no solo
	// titulares): cada elemento entra con un pequeño retardo respecto al
	// anterior dentro de su mismo contenedor, para dar ritmo de "cartelera".
	function initStaggerReveal() {
		if (!("IntersectionObserver" in window)) return;
		if (window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

		var groups = document.querySelectorAll(
			".event-grid, .agenda-cartelera, .category-grid, .lasala-gallery, .gallery__track"
		);

		groups.forEach(function (group) {
			var items = group.children;
			Array.prototype.forEach.call(items, function (el, i) {
				el.style.opacity = "0";
				el.style.transform = "translateY(1.25rem)";
				el.style.transition =
					"opacity 0.55s cubic-bezier(0.22,1,0.36,1) " + Math.min(i % 8, 7) * 0.07 + "s, " +
					"transform 0.55s cubic-bezier(0.22,1,0.36,1) " + Math.min(i % 8, 7) * 0.07 + "s";
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
				{ threshold: 0.15 }
			);

			Array.prototype.forEach.call(items, function (el) {
				observer.observe(el);
			});
		});

		// Red de seguridad: si por lo que sea el observer no llega a disparar
		// para algún elemento (捕获 automatizadas, timing raro, etc.), a los
		// 2.5s se fuerza la visibilidad de todo. Preferible a arriesgarse a
		// contenido invisible.
		window.setTimeout(function () {
			document.querySelectorAll(
				".event-grid > *, .agenda-cartelera > *, .category-grid > *, .lasala-gallery > *, .gallery__track > *, " +
				".hero__titular-line, .section__titular span, .cta-strip__titular span, .evento-poster__titular span, " +
				".lasala-palabras__lista li, .cat-hero__titular, .contacto-cover__titular"
			).forEach(function (el) {
				el.style.opacity = "1";
				el.style.transform = "none";
			});
		}, 2500);
	}

	// Parallax muy sutil en la foto del hero: se mueve un poco más lento
	// que el scroll, físico, no un efecto de cine.
	function initHeroParallax() {
		var media = document.querySelector(".hero__figure img");
		if (!media) return;
		if (window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

		var ticking = false;
		window.addEventListener("scroll", function () {
			if (ticking) return;
			ticking = true;
			requestAnimationFrame(function () {
				var y = Math.min(window.scrollY, 600);
				media.style.transform = "translateY(" + (y * 0.12).toFixed(1) + "px) scale(1.08)";
				ticking = false;
			});
		}, { passive: true });
	}

	// Flashlight text reveal: una "linterna" circular que sigue al cursor
	// sobre el titular de portada, revelando una copia en color de acento
	// del mismo texto por debajo. Basado en el patrón de 21st.dev
	// "flashlight text reveal", reimplementado con mask-image + JS.
	function initFlashlightText() {
		if (window.matchMedia && window.matchMedia("(hover: none)").matches) return;

		var wrap = document.querySelector("[data-flashlight-text]");
		if (!wrap) return;
		var target = wrap.querySelector(".hero__titular");
		if (!target) return;

		var glow = target.cloneNode(true);
		glow.classList.add("hero__titular--glow");
		glow.setAttribute("aria-hidden", "true");
		// El clon copia los estilos inline que el scroll-reveal aplicó al
		// original (opacity 0 en cada línea hasta que entra en viewport);
		// como el clon nunca es observado, hay que limpiarlos a mano.
		glow.style.opacity = "";
		glow.querySelectorAll("*").forEach(function (el) {
			el.style.opacity = "1";
			el.style.transform = "none";
			el.style.transition = "none";
		});
		wrap.appendChild(glow);

		wrap.addEventListener("mousemove", function (e) {
			var rect = glow.getBoundingClientRect();
			glow.style.setProperty("--mx", e.clientX - rect.left + "px");
			glow.style.setProperty("--my", e.clientY - rect.top + "px");
			wrap.classList.add("is-lit");
		});
		wrap.addEventListener("mouseleave", function () {
			wrap.classList.remove("is-lit");
		});
	}

	// Pixelated image reveal: ciclo automático entre fotos de próximos
	// shows en la portada. Cada cambio se resuelve desde bloques de píxel
	// grandes hasta nitidez, dibujado en un <canvas> (patrón de 21st.dev
	// "pixelated image reveal", reimplementado sin librerías).
	function initHeroPixelReveal() {
		var figure = document.querySelector(".hero__figure[data-rotate-images]");
		if (!figure) return;
		var img = figure.querySelector("img");
		if (!img) return;
		if (window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

		var extra;
		try {
			extra = JSON.parse(figure.getAttribute("data-rotate-images") || "[]");
		} catch (err) {
			extra = [];
		}
		var images = [img.currentSrc || img.src].concat(extra);
		if (images.length < 2) return;

		var canvas = document.createElement("canvas");
		canvas.className = "hero__pixel-canvas";
		figure.appendChild(canvas);
		var ctx = canvas.getContext("2d");
		var off = document.createElement("canvas");
		var offCtx = off.getContext("2d");

		var badge = document.querySelector("[data-hero-badge]");
		var idx = 0;
		var busy = false;

		function resize() {
			canvas.width = figure.clientWidth;
			canvas.height = figure.clientHeight;
		}
		resize();
		window.addEventListener("resize", resize);

		function loadImage(src) {
			return new Promise(function (resolve) {
				var im = new Image();
				im.crossOrigin = "anonymous";
				im.onload = function () {
					resolve(im);
				};
				im.onerror = function () {
					resolve(null);
				};
				im.src = src;
			});
		}

		function cover(im, w, h) {
			var ratio = Math.max(w / im.width, h / im.height);
			var iw = im.width * ratio;
			var ih = im.height * ratio;
			return { x: (w - iw) / 2, y: (h - ih) / 2, w: iw, h: ih };
		}

		function revealTo(src) {
			loadImage(src).then(function (im) {
				if (!im) {
					busy = false;
					return;
				}
				var w = canvas.width;
				var h = canvas.height;
				var pos = cover(im, w, h);
				var steps = [40, 26, 16, 9, 4, 1];
				var i = 0;
				canvas.style.opacity = "1";

				function drawStep() {
					var block = steps[i];
					var sw = Math.max(1, Math.round(w / block));
					var sh = Math.max(1, Math.round(h / block));
					off.width = sw;
					off.height = sh;
					offCtx.imageSmoothingEnabled = true;
					offCtx.drawImage(im, pos.x * (sw / w), pos.y * (sh / h), pos.w * (sw / w), pos.h * (sh / h));
					ctx.imageSmoothingEnabled = false;
					ctx.clearRect(0, 0, w, h);
					ctx.drawImage(off, 0, 0, sw, sh, 0, 0, w, h);
					i++;
					if (i < steps.length) {
						window.setTimeout(drawStep, 85);
					} else {
						img.src = src;
						canvas.style.opacity = "0";
						busy = false;
					}
				}
				drawStep();
			});
		}

		window.setInterval(function () {
			if (busy) return;
			busy = true;
			idx = (idx + 1) % images.length;
			if (badge) {
				badge.textContent = "0" + (idx + 1) + " / 0" + images.length;
			}
			revealTo(images[idx]);
		}, 4500);
	}

	// Preselecciona "Tipo de consulta" en el formulario de contacto cuando
	// se llega con ?asunto=alquiler (enlace desde "Alquila la sala").
	function initContactoAsunto() {
		var select = document.getElementById("c-asunto");
		if (!select) return;
		var params = new URLSearchParams(window.location.search);
		var asunto = params.get("asunto");
		if (asunto && select.querySelector('option[value="' + asunto + '"]')) {
			select.value = asunto;
		}
	}

	// Estado vacío cuando un filtro de Agenda no tiene eventos.
	function initEmptyFilterState() {
		var bars = document.querySelectorAll("[data-filter-bar]");
		bars.forEach(function (bar) {
			var section = bar.closest("section");
			var grid = section && section.querySelector("[data-events-grid]");
			if (!grid) return;
			var empty = document.createElement("p");
			empty.className = "agenda-empty-state";
			empty.hidden = true;
			empty.textContent = "No hay eventos en esta categoría por ahora. Vuelve pronto o consulta \"Todos\".";
			grid.insertAdjacentElement("afterend", empty);
			bar.addEventListener("filterchange", function () {
				var visible = grid.querySelectorAll(
					".event-grid__item:not([hidden]), .agenda-cartelera__item:not([hidden])"
				);
				empty.hidden = visible.length > 0;
			});
		});
	}

	// Barra de compra fija en móvil (Single Evento): aparece cuando el CTA
	// original de la ficha sale de la pantalla al hacer scroll.
	function initStickyBuy() {
		var cta = document.querySelector("[data-buy-cta]");
		var sticky = document.querySelector("[data-sticky-buy]");
		if (!cta || !sticky || !("IntersectionObserver" in window)) return;

		var observer = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					sticky.hidden = entry.isIntersecting;
				});
			},
			{ threshold: 0 }
		);
		observer.observe(cta);
	}

	document.addEventListener("DOMContentLoaded", function () {
		initMobileMenu();
		initFilterBar();
		initEmptyFilterState();
		initContactoAsunto();
		initStickyBuy();
		initRevealOnLoad();
		initImageTilt();
		initCursorLabel();
		initMagneticButtons();
		initStaggerReveal();
		initHeroParallax();
		initFlashlightText();
		initHeroPixelReveal();
	});
})();
