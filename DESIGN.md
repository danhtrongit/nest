# Nest Design System

> Theme WordPress WooCommerce cho **Lucky Life Care** — sản phẩm chăm sóc sức khỏe thiên nhiên.
> Tailwind CSS 4.x · Swiper 11 · GLightbox 3 · esbuild · PHP 8.x

---

## Colors

Source of truth: `theme.json` → `tailwind/tailwind-theme.css`

| Token | Hex | Dùng khi |
|---|---|---|
| **primary** | `#053024` | Nền header/footer, nút CTA chính, tiêu đề section, border nhấn |
| **secondary** | `#fdc97d` | Accent vàng — badge, separator, btn-frame, search button, icon circle |
| **hover** | `#d0a73c` | Mọi `:hover` state của primary và secondary |
| **price** | `#d31100` | Giá bán, flash sale badge, Hot Deal |
| **foreground** | `#333333` | Body text mặc định |
| **background** | `#ffffff` | Nền trang, nền card |

Quy tắc:
- MUST dùng `hover:bg-hover` cho hover button, KHÔNG dùng `hover:bg-primary/80` hay opacity.
- Overlay trên ảnh nền: `bg-primary/70` (hero) hoặc `bg-primary/80` (section tối).
- Glassmorphism trên nền tối: `bg-white/10 backdrop-blur-sm border border-white/10`.
- Gray scale: `gray-50` (section bg xen kẽ), `gray-100` (border nhẹ), `gray-400` (placeholder), `gray-500` (caption), `gray-600` (mô tả phụ).

---

## Typography

| Token | Font | Áp dụng |
|---|---|---|
| `font-sans` | **Montserrat** | `body` — mọi text mặc định |
| `font-heading` | **Roboto Slab** | `h1–h6` — section titles, logo, footer titles |

MUST khai báo `font-heading` cho mọi heading. KHÔNG để heading dùng `font-sans`.

### Kích thước thường dùng

- Section title chính: `font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase`
- Hero title: `font-heading font-extrabold text-4xl md:text-5xl lg:text-[3.5rem]`
- Card title: `font-heading font-bold text-lg` hoặc `text-xl`
- Footer column title: `font-heading text-[1.1rem] font-bold uppercase`
- Body: `text-base` (1rem) · Descriptions: `text-sm` (0.875rem)
- Topbar/label nhỏ: `text-xs` hoặc `text-[10px]`

### Weight

`font-medium` (nav) → `font-semibold` (buttons) → `font-bold` (card titles) → `font-extrabold` (section h2)

### Line height & Prose

`leading-tight` (headings) · `leading-snug` (tagline) · `leading-relaxed` (body paragraphs)

Content vùng mô tả sản phẩm dùng:
```
NEST_TYPOGRAPHY_CLASSES = 'prose prose-neutral max-w-none prose-a:text-primary'
```

---

## Spacing

### Container

```html
<div class="container mx-auto px-4">
```

Luôn dùng `container mx-auto px-4`. Content width: `40rem`, wide: `60rem` (từ `theme.json`).

### Section padding

| Ngữ cảnh | Classes |
|---|---|
| Homepage sections | `py-[30px] max-md:py-[25px]` |
| Content pages | `py-16 max-md:py-10` |
| Hero / CTA lớn | `py-20 max-md:py-12` hoặc `py-24 max-lg:py-14` |

### Gaps thường gặp

Nhỏ `gap-2`–`gap-2.5` (inline items) → Trung bình `gap-4`–`gap-6` (card grid, buttons) → Lớn `gap-8`–`gap-16` (2-col content layout)

### Section title → nội dung

Homepage: `mb-6` · About/content pages: `mb-10`

---

## Layout

### Breakpoints

Mobile-first. Breakpoints chính: `md:` (768), `lg:` (1024), `xl:` (1280).
Max-width: `max-md:` (<768), `max-lg:` (<1024).

### Grid patterns

```
2 cột đều:     grid-cols-1 md:grid-cols-2
2 cột content: grid-cols-1 lg:grid-cols-2        (product page)
3 cột + side:  grid-cols-1 lg:grid-cols-3         (tabs + sidebar)
4 cột cards:   grid-cols-1 sm:grid-cols-2 lg:grid-cols-4
```

Product grid (shop): CSS class `ul.products` → 4col/3col/2col tại 1199/767px.

### Mobile scroll

```html
<div class="flex flex-nowrap overflow-x-auto snap-x snap-mandatory -mx-4 px-4 gap-4">
    <div class="flex-none w-[65%] snap-start">...</div>
</div>
```

### Z-index

`z-[1]` (content trên bg-image) → `z-10` (badge/zoom) → `z-50` (dropdown) → `z-[99]` (back-to-top) → `z-[100]` (mobile menu)

---

## Radius & Shadows

### Border radius

- `rounded-full` — icons, badges, pills, avatar
- `rounded-lg` — search input, gallery, dropdown, cards lớn
- `rounded-md` — thumbnails, sale badge
- **(none)** — product cards, btn-frame, btn-buyNow (cạnh vuông cố ý)

### Shadows

- Card mặc định: `shadow-sm`
- Card hover: `shadow-md` hoặc `shadow-lg`
- Dropdown: `shadow-lg`
- Product card: custom `box-shadow` trong `components.css`
- Text trên nền tối: `drop-shadow-md`

---

## Section Title

MUST dùng pattern này cho mọi section có heading:

```html
<div class="section-title text-center relative mb-6">
    <span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs">
        <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
    </span>
    <h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0">
        {Title}
    </h2>
    <div class="section-separator flex justify-center relative mt-2.5">
        <div class="relative w-8 h-3
            before:content-[''] before:absolute before:top-0 before:left-2
            before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45
            after:content-[''] after:absolute after:top-0 after:right-2
            after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45">
        </div>
    </div>
</div>
```

**Biến thể Light** (trên nền tối): subtitle `text-white`, h2 `text-secondary drop-shadow-md`, separator thêm class `section-separator--light`.

---

## Buttons

### Global class: `.nest-btn`

**`.nest-btn` là style mặc định bắt buộc cho MỌI nút trong dự án** — bg-secondary, SVG trang trí 2 bên (flex items), `::before` decorative border, box-shadow. Tương đương style "Xem chi tiết" ở section-about homepage.

SVG trang trí dùng class `.nest-btn__deco` (flex item, KHÔNG phải absolute) → hoạt động đúng cả inline lẫn full-width.

### CSS (components.css)

```css
.nest-btn {
    /* relative inline-flex items-center h-10 px-1
       bg-secondary text-primary font-semibold text-base
       transition-all duration-300 cursor-pointer border-0 */
    box-shadow: #333 0px 15px 20px -15px;
}
.nest-btn::before  { /* decorative border inside */ }
.nest-btn:hover    { /* bg-hover text-white */ }

.nest-btn__deco    { /* w-3.5 h-8 shrink-0 — bám sát mép nút */ }
.nest-btn__text    { /* flex-1 text-center px-4 — text căn giữa */ }
```

### Cách dùng trong HTML

```html
<a href="/path" class="nest-btn" title="Label">
    <svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
    <span class="nest-btn__text">Label</span>
    <svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
</a>
```

Full-width: thêm `w-full` — SVG bám sát 2 mép, text căn giữa khoảng còn lại.

```html
<a href="/checkout" class="nest-btn w-full">
    <svg class="nest-btn__deco">...</svg>
    <span class="nest-btn__text">Thanh toán ngay</span>
    <svg class="nest-btn__deco -scale-x-100">...</svg>
</a>
```

### Cách dùng qua button component

```php
get_template_part( 'template-parts/components/button', null, array(
    'text'    => __( 'Label', 'nest' ),
    'url'     => '/path',
    'variant' => 'frame',    // Dùng nest-btn style (mặc định)
    'full'    => true,       // Optional: w-full
) );
```

### Variants khác (chỉ dùng khi có lý do cụ thể)

| Variant | Khi nào dùng |
|---|---|
| **`frame`** | **Mặc định — dùng `.nest-btn` style cho mọi CTA** |
| `primary` | Nút `.btn-buyNow` single product (CSS riêng) |
| `secondary` | Nút `.btn-cart.btn-extent` single product (CSS riêng) |
| `outline` | Nút toggle Xem thêm/Thu gọn |
| `ghost` | Link nhẹ |
| `danger` | Xóa |

### Ngoại lệ (có CSS class riêng, KHÔNG dùng `.nest-btn`)

| Class | Mô tả |
|---|---|
| `.btn-buyNow` | "Mua ngay" single product — bg-primary, flex-1 |
| `.btn-cart.btn-extent` | "Thêm vào giỏ" single product — bg-secondary, flex-1 |
| `.btn-cart` | Add-to-cart trong product grid — bg-primary, h-9 |
| `.qty-btn` | Quantity +/- buttons |
| Text link `text-red-500` | Link "Xóa" sản phẩm trong giỏ hàng |

---

## Cards

### Product Card (shop)

```
.item_product_main > .product-action
├── .product-thumbnail  (aspect-1:1)
├── .tag-promo          (gift badge, absolute)
├── .flash-sale         (sale %, absolute)
└── .product-info       (border-top: 2px solid primary)
    ├── .name-price
    └── .product-button (hidden, slides up -58px on desktop hover)
```

### Banner Card

`aspect-[382/574]` · inner border `inset-1 border-white/50` · info bar `bg-black/70 backdrop-blur-sm border-t-2 border-secondary` · hover: image `scale(1.03)`, bar slides up.

### Info Card (gioi-thieu)

`bg-white rounded-lg shadow-sm p-8 border-t-4 border-{primary|secondary}` + gradient icon circle `from-secondary to-hover`.

### Service Card

`border border-primary` · icon `w-10 h-10` + `bg-[#fff3e1]` circle backdrop.

### Why-Choose Card

Gradient icon circle `from-secondary to-hover` · hover: `rotateY(180deg)` (desktop) · 3-col layout: left items – center image – right items.

---

## Icons

### Chiến lược

1. **Inline SVG** (ưu tiên) — UI icons, dùng `fill-current` hoặc `stroke="currentColor"`
2. **SVG files** (`assets/images/`) — social icons, ticket mask, promo tag
3. **PNG files** (`assets/images/`) — service, why-choose, category, payment icons

### Kích thước chuẩn

`w-3 h-3` (arrows) → `w-4 h-4` (search, social) → `w-5 h-5` (header actions) → `w-6 h-6` (hamburger) → `w-7 h-7` (card features) → `w-8 h-8` (large features)

### Decorative SVGs

- Diamond nav buttons: `58x58` viewBox — dùng cho Swiper prev/next
- btn-frame ornaments: `14x32` viewBox — cặp SVG trái/phải
- Back-to-top: diamond + arrow

---

## Animation

### Transitions mặc định

- Hover chung: `transition-all duration-300`
- Link/nav: `transition-colors duration-200`
- Icon flip: `transition-all duration-500`

### Hover effects thường dùng

- Button: `hover:bg-hover`
- Header link: `hover:text-secondary`
- Dropdown item: `hover:bg-gray-50 hover:text-primary`
- Card lift: `hover:shadow-md` hoặc `hover:shadow-lg`
- Image zoom: `group-hover:scale-[1.03]`
- Icon flip: `group-hover:[transform:rotateY(180deg)]`
- Reveal: `opacity-0 group-hover:opacity-100`

### Animations

`animate-pulse` (Hot Deal button) · Product card: `.product-info translateY(-58px)` on hover (CSS).

---

## Forms

### Search

```
Desktop: h-11 rounded-lg bg-white pl-4 pr-12 text-sm focus:ring-2 focus:ring-secondary
Mobile:  h-10 rounded-lg pl-4 pr-11
Button:  bg-secondary text-primary rounded-r-lg (cùng height)
```

### Quantity

```
[-] input [+] — inline-flex
.qty-btn: h-10 w-[30px] bg-[#f3f3f3] border: 1px solid #ddd
.qty:     h-10 w-[50px] text-center border-0 (no spin buttons)
```

---

## Navigation

### Header (3-tier)

```
TOPBAR    bg-primary text-white text-xs — promo + hotline
MAIN      bg-primary + header_pattent.png — logo (140/200px) | search | actions
NAV BAR   bg-primary border-t border-white/10 — category dropdown (260px) | menu | Hot Deal
```

- Header actions: `flex-col items-center` · icon `w-5 h-5` + label `text-[10px]`
- Cart badge: `absolute -top-2 -right-2 bg-secondary text-primary text-[10px] w-4 h-4 rounded-full`
- Desktop nav links: `text-sm font-medium text-white uppercase tracking-wide hover:text-secondary`
- Active: `[&>a]:text-secondary`

### Mobile menu

`fixed inset-0 z-[100]` · overlay `bg-black/50` · panel `w-[300px] max-w-[85vw] bg-white -translate-x-full → 0`

### Footer

```
MAIN        bg-primary + footer_pattent.png · border-t-4 border-hover
            4 cols: Logo+Contact (30%) | Policy (20%) | Guide (20%) | Payment (30%)
COPYRIGHT   bg-[#031913] text-center text-sm text-white
```

- Footer title: `font-heading text-[1.1rem] font-bold uppercase` + double diamond decorator (before/after pseudo-elements)
- Footer menu: `text-sm text-[#f1f1f1] hover:text-hover`
- Social: `w-[35px] h-[35px] rounded-full hover:brightness-130`
- Back-to-top: `fixed bottom-[100px] right-4 z-[99] w-10 h-10` diamond SVG

---

## Blog / News

### Archive (grid listing)

Layout: `container mx-auto px-4` → section-title pattern → grid 3-col (`grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6`).

### Post Card (`content-card.php`)

```
article.group
└── div.bg-white.border.border-gray-100.shadow-sm.hover:shadow-md
    ├── a (thumbnail — aspect-[16/10], group-hover:scale-[1.03])
    └── div.p-4
        ├── category badge (text-xs bg-secondary/20 text-primary)
        ├── h3 (font-heading font-bold, line-clamp-2)
        ├── p (text-sm text-gray-600, line-clamp-2)
        └── meta bar (date + "Xem thêm" link)
```

### Single Post

Layout: `max-w-4xl mx-auto`. Sections:
1. Breadcrumb: `Trang chủ / Category / Title` — `text-sm text-gray-500`
2. Header: `font-heading font-extrabold text-2xl md:text-3xl` + meta (author, date, category, comments) with inline SVG icons
3. Featured image: `rounded-lg overflow-hidden`
4. Content: `nest_content_class( 'entry-content max-w-none' )` — prose typography
5. Tags: `.post-tags a` — bg-gray-100 hover:bg-primary hover:text-white
6. Share: social buttons (Facebook, X, LinkedIn) — `w-8 h-8 rounded-full`
7. Post navigation: prev/next cards — `border border-gray-100 hover:border-primary/30`
8. Related posts: 3-col grid of `content-card.php`
9. Comments

### Pagination (CSS in components.css)

`.nav-links .page-numbers` — `w-10 h-10 border border-gray-200`, active/hover: `bg-primary text-white`.

---

## WooCommerce

### Template overrides (`theme/woocommerce/`)

| File | Mô tả |
|---|---|
| `content-product.php` | Product card (item_product_main) |
| `content-single-product.php` | 2-col images+summary → 3-col tabs+sidebar |
| `single-product/product-image.php` | Swiper gallery + GLightbox lightbox |
| `single-product/add-to-cart/simple.php` | btn-buyNow + btn-cart.btn-extent |
| `single-product/tabs/description.php` | Show more/less toggle |
| `cart/cart.php` | Custom cart table |
| `cart/cart-totals.php` | Order summary sidebar |
| `cart/cart-empty.php` | Empty cart page |
| `cart/proceed-to-checkout-button.php` | nest-btn--primary checkout CTA |
| `checkout/form-checkout.php` | 2-col layout: billing left, order review right |
| `checkout/form-billing.php` | Billing fields with Tailwind styling |
| `checkout/form-shipping.php` | Shipping fields + order notes |
| `checkout/form-login.php` | Login prompt for returning customers |
| `checkout/review-order.php` | Cart items + totals summary |
| `checkout/payment.php` | Payment methods + "Đặt hàng" nest-btn--primary |
| `checkout/payment-method.php` | Radio-style payment method card |
| `checkout/thankyou.php` | Order confirmation (success/failed states) |
| `global/quantity-input.php` | Custom qty -/+ buttons |
| `loop/orderby.php` | Radio-style sort bar |

### Disabled defaults

`wc-product-gallery-zoom`, `lightbox`, `slider` → replaced by Swiper + GLightbox.
`woocommerce-general`, `layout`, `smallscreen` CSS → replaced by Tailwind.

### Custom hooks

| Hook | Ở đâu |
|---|---|
| `nest_single_product_sidebar` | Sidebar: specs + recently viewed |
| `nest_after_single_product_tabs` | Related products (Swiper) |

---

## Assets

`theme/assets/images/`

| Nhóm | Files |
|---|---|
| Backgrounds | `header_pattent.png`, `footer_pattent.png`, `section_about_bg.jpg`, `section_about_bg_mb.jpg` |
| Branding | `logo.png`, `logo_footer.png` |
| Sliders | `slider_1..2.jpg` |
| Banners | `img_4banner_1..4.jpg`, `banner_choise.png`, `section_about_product_1.png` |
| Services | `ser_1..4.png` |
| Why-choose | `why_choise_1..6_icon.png` |
| Categories | `index-cate-icon-1..7.png` |
| Coupons | `img_coupon_1..4.jpg`, `ticket5.svg` |
| Social | `facebook.svg`, `instagram.svg`, `shopee.svg`, `lazada.svg`, `tiktok.svg` |
| Payment | `payment_1..6.png` (63x29) |
| Certs | `certifi_1..2.png` |
| UI | `heart.png`, `btn_promotion_icon.png`, `tag_pro_icon.svg` |

---

## File Structure

```
theme/
├── functions.php              # Core setup, enqueue scripts, WooCommerce config
├── header.php / footer.php    # Wrappers (#page > #content)
├── front-page.php             # Homepage (7 template-part sections)
├── page.php                   # Default page
├── page-gioi-thieu.php        # About page (Template Name: Giới thiệu)
├── woocommerce.php            # Shop/archive wrapper
├── archive.php                # Blog archive (grid 3-col cards)
├── single.php                 # Single post (max-w-4xl, breadcrumb, share, related)
├── index.php                  # Blog listing fallback (grid 3-col cards)
├── search.php                 # Search results (grid 3-col cards)
├── theme.json                 # WP design tokens (colors, layout widths)
│
├── inc/
│   ├── woocommerce-single-product.php   # Single product hooks, Swiper, GLightbox
│   ├── class-nest-nav-walker.php        # Primary nav walker
│   └── class-nest-category-walker.php   # Category dropdown walker
│
├── template-parts/
│   ├── components/button.php            # Reusable button component
│   ├── content/content-card.php         # Post card for grid layouts
│   ├── content/content-none.php         # Empty state (search, no posts)
│   ├── home/section-{name}.php          # 7 homepage sections
│   ├── layout/header-content.php        # Full header markup
│   ├── layout/footer-content.php        # Full footer markup
│   └── woocommerce/single-product-*.php # Single product partials
│
├── woocommerce/               # WooCommerce template overrides
├── assets/images/             # All theme images & icons
└── js/                        # Compiled JS output (esbuild)

Build root (parent of theme/):
├── tailwind.css                        # PostCSS entry
├── tailwind/tailwind-theme.css         # Design tokens
├── tailwind/custom/base.css            # body & heading defaults
├── tailwind/custom/components/*.css    # Component styles
├── javascript/script.js                # Main frontend JS
└── package.json                        # Tailwind 4.x, esbuild, PostCSS
```

### Build

```bash
npm run dev     # Development build (Tailwind + esbuild)
npm run watch   # Watch mode
npm run prod    # Production build (minified)
```
