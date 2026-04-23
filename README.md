# Blocksy Child Theme

Tema child per [Nome del Tuo Brand] costruito su Blocksy + WooCommerce.

##  Indice

- [Requisiti](#requisiti)
- [Installazione](#installazione)
- [Struttura dei File](#struttura-dei-file)
- [Guida Rapida](#guida-rapida)
- [Best Practices](#best-practices)

---

##  Requisiti

- WordPress 6.0+
- Blocksy (tema genitore) - versione più recente
- WooCommerce (per e-commerce)
- PHP 7.4 o superiore

---

##  Installazione

### Metodo 1: Tramite FTP/SFTP

1. Carica la cartella `blocksy-child` in `wp-content/themes/`
2. Vai in **WordPress Admin > Aspetto > Temi**
3. Attiva "Blocksy Child"
4. Importa le configurazioni Blocksy se richiesto

### Metodo 2: Tramite Git (Development)

```bash
cd wp-content/themes/
git clone [tuo-repo-url] blocksy-child
```

---

##  Struttura dei File

```
blocksy-child/
├── functions.php                    # Hooks e enqueue scripts/styles
├── style.css                        # Header tema + import moduli CSS
├── assets/
│   ├── design-system.css           # Design system (colori, tipografia, spaziatura)
│   ├── home-page.css               # CSS specifico per homepage
│   └── woo-commerce-layout.css     # Override WooCommerce
├── scripts/
│   └── main.js                     # JavaScript personalizzato
├── .gitignore                      # File esclusi dal version control
├── README.md                       # Documentazione tecnica (questo file)
└── SITO.md                         # Documentazione sito (brand, design system)
```

---

##  Guida Rapida

### Modificare il CSS

1. **Design System** → Modifica `assets/design-system.css`
   - Variabili CSS (colori, tipografia, spaziatura)
   - Reset e base styles

2. **Homepage** → Modifica `assets/home-page.css`
   - Hero section
   - Sezioni specifiche
   - Componenti custom

3. **WooCommerce** → Modifica `assets/woo-commerce-layout.css`
   - Layout prodotti
   - Cart e checkout
   - Override plugin

### Modificare il JavaScript

Tutto il JavaScript custom va in `scripts/main.js`

### Aggiungere Funzionalità PHP

Usa sempre l'hook `wp_enqueue_scripts` per caricare asset:

```php
// functions.php
add_action('wp_enqueue_scripts', 'blocksy_child_enqueue_scripts');
function blocksy_child_enqueue_scripts() {
    wp_enqueue_script('child-main', get_stylesheet_directory_uri() . '/scripts/main.js', array(), '1.0.0', true);
}
```

### Aggiungere Hooks/Filters Blocksy

Blocksy usa filtri standard WordPress e propri. Consulta [documentazione Blocksy](https://creativethemes.com/blocksy/docs/) per filtri disponibili.

Esempio:

```php
// Rimuovere feature del parent
add_filter('blocksy:some-feature', '__return_false');
```

---

## ⚡ Best Practices

### CSS
- Usa sempre le **variabili CSS** definite in `design-system.css`
- Evita `!important` (usa specificità corretta)
- Commenta le sezioni con `/* === Nome Sezione === */`
- Usa **mobile-first** approccio

### PHP
- **Sempre** verifica `ABSPATH` per sicurezza
- Usa escaping per output: `esc_html()`, `esc_url()`, `esc_attr()`
- Sanitize input: `sanitize_text_field()`, `sanitize_email()`
- Usa `wp_enqueue_scripts` per caricare asset
- Prefissa tutte le funzioni con `blocksy_child_`

### JavaScript
- Usa `document.addEventListener('DOMContentLoaded', ...)`
- Evita conflitti con Blocksy e WooCommerce
- Usa delegazione eventi per elementi dinamici

### Git
- Commits piccoli e atomici
- Messaggi chiari (es. "feat: add hero section styles")
- Mai commitare file in `.gitignore`
- Branch naming: `feature/*`, `fix/*`, `refactor/*`

---

## SEO Guidelines

### Meta Tags (Header PHP)

Il meta tag description deve essere aggiunto via `functions.php`:

```php
// Aggiunge meta description per ogni pagina
add_action('wp_head', 'blocksy_child_add_meta_description');
function blocksy_child_add_meta_description() {
    if (is_singular()) {
        $description = get_post_meta(get_the_ID(), '_blocksy_page_description', true);
        if ($description) {
            echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        }
    }
}
```

### Schema.org Markup

Il tema include già markup schema.org in `front-page.php`:
- `itemprop="headline"` - Titolo principale (H1)
- `itemprop="description"` - Descrizione del brand
- `role="banner"` - Identifica area hero/header
- `role="main"` - Identifica contenuto principale

Per aggiungere markup WooCommerce:

```php
// Aggiunge Product schema per singolo prodotto
add_action('woocommerce_before_single_product', 'blocksy_child_product_schema');
function blocksy_child_product_schema() {
    global $product;
    // Implementare markup JSON-LD per prodotto
}
```

### Open Graph / Twitter Cards

Per social media preview:

```php
add_action('wp_head', 'blocksy_child_add_og_tags');
function blocksy_child_add_og_tags() {
    if (is_single() || is_page()) {
        $title = get_the_title();
        $url = get_permalink();
        $image = get_the_post_thumbnail_url(null, 'large');
        
        echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
        if ($image) {
            echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
        }
        echo '<meta property="og:type" content="website">' . "\n";
    }
}
```

### SEO Best Practices

- **Titoli**: H1 unico per pagina, H2-H6 gerarchici
- **URL**: URL leggibili, keyword nella slug
- **Immagini**: Alt text sempre presente, nomi descrittivi
- **Contenuto**: Testo sufficiente, keyword naturali
- **Performance**: Core Web Vitals sotto soglia (LCP < 2.5s, CLS < 0.1)

---

## Accessibility Guidelines

### WCAG 2.1 Compliance

Il tema segue le linee guida WCAG 2.1 AA:

### Contrast Ratio

- Testo normale: minimo 4.5:1 (nero su bianco: 19:1)
- Testo grande (>18px): minimo 3:1
- UI components: minimo 3:1
- Verifica con: [WebAIM Contrast Checker](https://webaim.org/resources/contrastchecker/)

### Keyboard Navigation

- **Skip-to-content link**: Implementato in `front-page.php`
  - Hidden by default (`top: -100px`)
  - Visible on focus (`top: 10px`)
  - High contrast (black background, white text)

- **Focus states**: Tutti gli elementi interattivi devono avere focus visible
```css
:focus-visible {
    outline: 2px solid #333333;
    outline-offset: 2px;
}
```

### ARIA Labels & Roles

Il tema include già:
- `role="banner"` - Hero section
- `role="main"` - Contenuto principale
- `aria-label` - CTA buttons, collection cards
- Video: `role="img"` + `aria-label` descrittivo

### Screen Reader Support

```php
// Per contenuti solo visivi
echo '<span class="screen-reader-only">' . esc_html($text) . '</span>';
```

CSS associato:
```css
.screen-reader-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border-width: 0;
}
```

### Semantic HTML

- `<header>` per header navigazione
- `<main>` per contenuto principale
- `<nav>` per menu di navigazione
- `<section>` per sezioni tematiche
- `<article>` per contenuti autonomi
- `<footer>` per footer

### Image Alt Text

```php
// In template
the_post_thumbnail('large', array(
    'alt' => get_the_title_attribute(array('echo' => false)),
    'loading' => 'lazy'
));
```

### Form Accessibility

```php
// Labels associati
<label for="email">Email</label>
<input type="email" id="email" name="email" required aria-required="true">
```

### Testing Tools

- [WAVE Browser Extension](https://wave.webaim.org/)
- [Lighthouse Accessibility Audit](https://developers.google.com/web/tools/lighthouse)
- [axe DevTools](https://www.deque.com/axe/)
- [Keyboard only navigation testing]

### Required Before Go-Live

- [ ] Test con solo tastiera (Tab, Enter, Escape)
- [ ] Test screen reader (NVDA, JAWS, VoiceOver)
- [ ] Verifica contrasti tutti i colori
- [ ] Verifica zoom 200% (content must be readable)
- [ ] Test skip-to-content link
- [ ] Verifica tutti i focus states
- [ ] Test form validation messages
- [ ] Verifica mobile touch targets (min 44x44px)

---

##  Sicurezza

- Tutti i file PHP hanno controllo `ABSPATH`
- Input sempre sanitizzati
- Output sempre escaped
- Non esporre dati sensibili via API/public

---

##  Performance

- CSS caricato solo dove necessario
- Versioning dinamico per cache busting
- Nessuna dipendenza non necessaria
- Lazy loading immagini (Blocksy native)

---

##  Debugging

Abilita `WP_DEBUG` in `wp-config.php`:

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

Il log si trova in `wp-content/debug.log`

---

##  Risorse Utili

- [Documentazione Blocksy](https://creativethemes.com/blocksy/docs/)
- [Documentazione WooCommerce](https://woocommerce.com/documentation/)
- [WordPress Codex](https://developer.wordpress.org/)
- [WordPress Block Editor](https://developer.wordpress.org/block-editor/)

---

##  Changelog

### 1.0.0 (In Development)
- Setup struttura tema child
- Design system base
- Homepage layout
- WooCommerce override base

---

##  License

Questo tema child segue la stessa licenza di Blocksy: GNU General Public License v2 o successiva.