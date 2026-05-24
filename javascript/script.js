/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */

document.addEventListener('DOMContentLoaded', () => {
	const btnOpen = document.getElementById('btn-menu-mobile');
	const btnClose = document.getElementById('close-mobile-menu');
	const mobileMenu = document.getElementById('mobile-menu');
	const overlay = document.getElementById('mobile-menu-overlay');
	const panel = document.getElementById('mobile-menu-panel');

	if (btnOpen && mobileMenu && panel) {
		function openMenu() {
			mobileMenu.classList.remove('invisible', 'opacity-0');
			mobileMenu.setAttribute('aria-hidden', 'false');
			panel.classList.remove('-translate-x-full');
			document.body.style.overflow = 'hidden';
			btnOpen.setAttribute('aria-expanded', 'true');
		}

		function closeMenu() {
			panel.classList.add('-translate-x-full');
			mobileMenu.classList.add('opacity-0');
			setTimeout(() => {
				mobileMenu.classList.add('invisible');
				mobileMenu.setAttribute('aria-hidden', 'true');
				document.body.style.overflow = '';
				btnOpen.setAttribute('aria-expanded', 'false');
			}, 300);
		}

		btnOpen.addEventListener('click', openMenu);
		if (btnClose) btnClose.addEventListener('click', closeMenu);
		if (overlay) overlay.addEventListener('click', closeMenu);

		// Mobile sub-menu toggles
		mobileMenu.querySelectorAll('.menu-item-has-children > a').forEach((link) => {
			const toggle = document.createElement('button');
			toggle.className = 'absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center text-gray-400';
			toggle.innerHTML = '<svg class="w-3 h-3 fill-current transition-transform duration-200" viewBox="0 0 16 16"><path d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>';
			toggle.setAttribute('aria-expanded', 'false');

			const li = link.parentElement;
			li.style.position = 'relative';
			li.appendChild(toggle);

			const subMenu = li.querySelector(':scope > .sub-menu, :scope > ul');
			if (subMenu) {
				subMenu.style.display = 'none';
				toggle.addEventListener('click', (e) => {
					e.preventDefault();
					e.stopPropagation();
					const isOpen = subMenu.style.display !== 'none';
					subMenu.style.display = isOpen ? 'none' : 'block';
					toggle.setAttribute('aria-expanded', String(!isOpen));
					toggle.querySelector('svg').style.transform = isOpen ? '' : 'rotate(180deg)';
				});
			}
		});
	}

	// ============================================================
	// Footer accordions (mobile only).
	// Each [data-footer-accordion] block has:
	//   - a button.footer-section__toggle with aria-controls=<contentId>
	//   - a div.footer-section__content keyed by that id
	// Below md breakpoint (768px) the content is collapsed by default
	// and toggled via the button. Above md, content is always visible
	// (the JS no-ops because the button is pointer-events:none in CSS).
	// ============================================================
	const FOOTER_BREAKPOINT = 768;
	const footerSections = document.querySelectorAll('[data-footer-accordion]');

	footerSections.forEach((section) => {
		const btn = section.querySelector('.footer-section__toggle');
		const content = section.querySelector('.footer-section__content');
		const chevron = section.querySelector('.footer-section__chevron');
		if (!btn || !content) return;

		btn.addEventListener('click', () => {
			if (window.innerWidth >= FOOTER_BREAKPOINT) return;
			const isOpen = btn.getAttribute('aria-expanded') === 'true';
			btn.setAttribute('aria-expanded', String(!isOpen));
			content.classList.toggle('max-md:hidden', isOpen);
			if (chevron) chevron.style.transform = isOpen ? '' : 'rotate(180deg)';
		});
	});

	// On resize past the breakpoint, restore desktop state so a previously
	// opened-on-mobile section doesn't leave aria-expanded=true.
	window.addEventListener('resize', () => {
		if (window.innerWidth < FOOTER_BREAKPOINT) return;
		footerSections.forEach((section) => {
			const btn = section.querySelector('.footer-section__toggle');
			const chevron = section.querySelector('.footer-section__chevron');
			const content = section.querySelector('.footer-section__content');
			if (btn) btn.setAttribute('aria-expanded', 'false');
			if (chevron) chevron.style.transform = '';
			if (content) content.classList.add('max-md:hidden');
		});
	});

	// Back to top
	const backToTop = document.getElementById('back-to-top');
	if (backToTop) {
		window.addEventListener('scroll', () => {
			if (window.scrollY > 400) {
				backToTop.classList.add('!opacity-100', '!visible', '!translate-y-0');
			} else {
				backToTop.classList.remove('!opacity-100', '!visible', '!translate-y-0');
			}
		});
		backToTop.addEventListener('click', (e) => {
			e.preventDefault();
			window.scrollTo({ top: 0, behavior: 'smooth' });
		});
	}

	// ============================================================
	// Initialize all Swiper sliders (works for both widget and
	// template-part rendered sections).
	// ============================================================
	function initSwipers() {
		if (typeof Swiper === 'undefined') return;

		// Hero Slider
		document.querySelectorAll('.hero-slider').forEach((el) => {
			if (el.swiper) return; // already initialised
			const progressBar = el.querySelector('.hero-slider-progress');
			new Swiper(el, {
				loop: true,
				autoplay: { delay: 5000, disableOnInteraction: false },
				pagination: { el: el.querySelector('.swiper-pagination'), clickable: true },
				navigation: { nextEl: el.querySelector('.swiper-button-next'), prevEl: el.querySelector('.swiper-button-prev') },
				on: {
					autoplayTimeLeft(swiper, timeLeft, percentage) {
						if (progressBar) progressBar.style.width = `${(1 - percentage) * 100}%`;
					},
				},
			});
		});

		// Product Slider
		document.querySelectorAll('.product-slider').forEach((el) => {
			if (el.swiper) return;
			new Swiper(el, {
				slidesPerView: 2,
				spaceBetween: 12,
				loop: true,
				autoplay: { delay: 4000, disableOnInteraction: false },
				navigation: { nextEl: el.querySelector('.swiper-button-next'), prevEl: el.querySelector('.swiper-button-prev') },
				breakpoints: { 768: { slidesPerView: 4, spaceBetween: 20 } },
			});
		});

		// Coupon Slider
		document.querySelectorAll('.coupon-slider').forEach((el) => {
			if (el.swiper) return;
			new Swiper(el, {
				slidesPerView: 1.15,
				spaceBetween: 12,
				navigation: { nextEl: el.querySelector('.swiper-button-next'), prevEl: el.querySelector('.swiper-button-prev') },
				breakpoints: {
					768: { slidesPerView: 3, spaceBetween: 16 },
					1024: { slidesPerView: 4, spaceBetween: 16 },
				},
			});
		});

		// Brands / Partners Slider
		document.querySelectorAll('.brands-slider').forEach((el) => {
			if (el.swiper) return;
			new Swiper(el, {
				slidesPerView: 2,
				spaceBetween: 16,
				loop: true,
				autoplay: { delay: 3000, disableOnInteraction: false },
				navigation: { nextEl: el.querySelector('.swiper-button-next'), prevEl: el.querySelector('.swiper-button-prev') },
				breakpoints: {
					480: { slidesPerView: 3, spaceBetween: 16 },
					768: { slidesPerView: 4, spaceBetween: 20 },
					1024: { slidesPerView: 6, spaceBetween: 20 },
				},
			});
		});
	}

	initSwipers();

	// ============================================================
	// Product Tab switching (AJAX-powered).
	// ============================================================
	document.querySelectorAll('.product-tab-btn').forEach((btn) => {
		btn.addEventListener('click', () => {
			const section = btn.closest('.section-product-tab');
			const catId = btn.dataset.catId;
			if (!catId || !section) return;

			// Toggle active state.
			section.querySelectorAll('.product-tab-btn').forEach((b) => {
				b.classList.remove('bg-primary', 'text-white');
				b.classList.add('bg-white', 'text-foreground');
			});
			btn.classList.remove('bg-white', 'text-foreground');
			btn.classList.add('bg-primary', 'text-white');

			// AJAX call if nestAjax is available.
			if (typeof nestAjax !== 'undefined') {
				const contentWrap = section.querySelector('.product-tab-content');
				if (!contentWrap) return;

				contentWrap.style.opacity = '0.5';

				const formData = new FormData();
				formData.append('action', 'nest_load_products');
				formData.append('nonce', nestAjax.nonce);
				formData.append('cat_id', catId);

				fetch(nestAjax.ajaxurl, { method: 'POST', body: formData })
					.then((res) => res.text())
					.then((html) => {
						contentWrap.innerHTML = html;
						contentWrap.style.opacity = '1';
						// Re-init slider for the new content.
						initSwipers();
					})
					.catch(() => {
						contentWrap.style.opacity = '1';
					});
			}
		});
	});

	// Coupon copy to clipboard
	document.addEventListener('click', (e) => {
		const btn = e.target.closest('.js-copy-coupon');
		if (!btn) return;
		const code = btn.dataset.code;
		navigator.clipboard.writeText(code).then(() => {
			const orig = btn.textContent;
			btn.textContent = 'Đã copy!';
			setTimeout(() => { btn.textContent = orig; }, 1500);
		});
	});
});
