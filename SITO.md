# Total Femininity — Documentazione Brand & Design

## Brand

- **Nome:** Total Femininity
- **Slogan:** Perché lo stile non è quello che indossi. È quello che sei già.
- **Nasce:** Torino, 2026 — da due sorelle con una visione
- **Missione:** Valorizzare il mondo femminile attraverso capi pensati per ogni occasione

### Target
- **Fascia:** 25-45 anni
- **Stile:** Elegante, Raffinato, Editoriale
- **Interessi:** Moda sostenibile, Design contemporaneo, Lifestyle premium
- **Posizionamento:** Premium

### Personalità
1. **Femminile** — celebra la donna
2. **Elegante** — mai gridato, sempre curato
3. **Autentico** — vera, non filtrata

---

## Design System

### Palette Colori

Tono caldo con accento verde menta. Fonte: `assets/design-system.css`

| Token | Hex | Uso |
|-------|-----|-----|
| `--colore-sfondo` | `#FAFAF8` | Avorio — card prodotti |
| `--colore-sfondo-caldo` | `#EDE8DF` | Crema — About, Testimonials |
| `--colore-sfondo-scuro` | `#0F0F0F` | Inchiostro — Hero, Footer, Banner |
| `--colore-accento` | `#8fcb9b` | Verde menta — CTA, hover, label |
| `--colore-bordo` | `#E2DDD6` | Bordi card, separatori caldi |
| `--colore-testo-principale` | `#0F0F0F` | Su sfondi chiari |
| `--colore-testo-chiaro` | `#FAFAF8` | Su sfondi scuri |
| `--colore-testo-muted` | `#6B6B6B` | Meta, prezzi secondari, caption |
| `--colore-prezzo` | `#0F0F0F` | Prezzo standard |
| `--colore-saldo` | `#D94F3D` | Prezzo scontato |
| `--colore-disponibile` | `#2D6A4F` | Verde scuro — in stock |
| `--colore-esaurito` | `#6B6B6B` | Grigio — out of stock |

### Tipografia

**Font:** Syne (titoli + corpo) + Pacifico (script decorativo)

| Token | Valore | Uso |
|-------|--------|-----|
| `--testo-xs` | `0.75rem` | Label, badge, meta |
| `--testo-sm` | `0.875rem` | UI, menu, caption |
| `--testo-base` | `clamp(1rem, 2vw, 1.125rem)` | Corpo testo |
| `--testo-md` | `clamp(1.125rem, 2.5vw, 1.375rem)` | Sottotitoli, intro |
| `--testo-lg` | `clamp(1.375rem, 3vw, 1.75rem)` | H3, titoli card |
| `--testo-h2` | `clamp(2rem, 4.5vw, 2.75rem)` | H2 sezioni |
| `--testo-h1` | `clamp(2.75rem, 8vw, 5.61rem)` | Hero headline |

### Spaziature

| Token | Valore | Uso |
|-------|--------|-----|
| `--spazio-xs` | `0.5rem` | Micro gap |
| `--spazio-s` | `1rem` | Interno componenti |
| `--spazio-m` | `2rem` | Separazione standard |
| `--spazio-l` | `4rem` | Separazione macro |
| `--spazio-xl` | `6rem` | Extra-large |
| `--spazio-xxl` | `8rem` | XXL |
| `--spazio-sezione` | `clamp(4rem, 10vw, 8rem)` | Padding sezioni |
| `--padding-laterale` | `clamp(1.25rem, 5vw, 3rem)` | Safe area mobile → desktop |
| `--container-width` | `1290px` | Max width |

### UI Base

| Token | Valore |
|-------|--------|
| `--raggio-bordo` | `0px` (angoli netti) |
| `--transizione-base` | `0.2s ease-out` |

---

## Architettura Homepage

Ordine sezioni in `front-page.php`:

| # | Sezione | Background | Template / CSS |
|---|---------|------------|----------------|
| 1 | **Hero** | Scuro + video | `hero-payoff.css` |
| 2 | **Editorial Ticker** | Scuro | `home-page.css` |
| 3 | **Collections Grid** | Caldo | `home-page.css` |
| 4 | **Curated Selection** | Caldo | `home-page.css` |
| 5 | **About Us** | Caldo | `home-page.css` |
| 6 | **Testimonials** | Caldo | `home-page.css` |
| 7 | **Banner Evento** | Scuro | `banner-evento.php` |
| 8 | **Sezione Eventi** | Scuro | `sezione-eventi.php` |
| 9 | **USP Bar** | Scuro | `usp-bar.php` |
| 10 | **Contact** | Scuro | `home-page.css` |

---

## Stati Interattivi

### Bottoni `.btn`

3 varianti con microinterazione fill dal basso:

| Variante | Default | Hover |
|----------|---------|-------|
| `.btn-light` | Trasparente, bordo bianco | Fill bianco, testo scuro |
| `.btn-dark` | Nero pieno | Fill verde, testo scuro |
| `.btn-accent` | Trasparente, bordo verde | Fill verde, testo scuro |

**Effetti hover:**
- `::before` fill dal basso con `cubic-bezier(0.22, 1, 0.36, 1)`
- Lift `translateY(-1px)` + shadow soffice
- `.btn--arrow` → freccia nudge `translateX(3px)`

**Accessibilità:**
- `:focus-visible` → ring `--colore-accento`, offset 3px
- `prefers-reduced-motion` → nessuna animazione

### Showroom Card

| Stato | Sfondo | Testo | Freccia | Underline |
|-------|--------|-------|---------|-----------|
| Default | `#0F0F0F` | Bianco/bordo | Verde accento | — |
| Hover | `#8fcb9b` (verde) | Scuro | Scuro, +6px dx | Cresce da sinistra |

### Collection Cards (768px+)

- Hover → zoom immagine `scale(1.05)` + titolo slide-in
- Small items → overlay fade

### Evento Cards

- Hover → lift `translateY(-4px)` + shadow + immagine zoom `scale(1.04)`

---

## CPT Evento

- **Registro:** `inc/cpt-evento.php`
- **Template:** `single-evento.php`, `archive-evento.php`
- **Banner:** `template-parts/banner-evento.php` (homepage)
- **Grid:** `template-parts/sezione-eventi.php` (homepage)
- **Archivio:** 2 colonne tablet, 3 colonne desktop
- **Singolo:** Hero full-width + contenuto 780px centrato

---

## Linee Guida Immagini

| Tipo | Aspect Ratio | Note |
|------|-------------|------|
| Hero | Auto (90svh) | Video poster + fallback |
| Collection | 3:4 | Moda standard |
| Evento card | 4:3 | Landscape |
| Prodotto | 3:4 | Abbigliamento |
| Banner evento | Contain | Side-by-side 768px+ |

- **Formato:** WebP (fallback JPEG)
- **Lazy loading:** Nativo WordPress/Blocksy
- **Object-fit:** `cover` con `object-position: center top`

---

## Stato del Progetto

### Completato ✅
- [x] Struttura child theme + enqueue condizionale
- [x] Design system CSS completo
- [x] Homepage 10 sezioni
- [x] CPT Evento + template
- [x] Microinterazioni hover (bottoni + showroom)
- [x] Accessibilità (skip-link, focus-visible, reduced-motion)
- [x] Header trasparente + sticky + menu attivo

### Da definire 🔲
- [ ] Photography style guideline
- [ ] WooCommerce shop + single product override
- [ ] Cart + checkout styling
- [ ] Email transactionali
- [ ] Performance optimization (Core Web Vitals)
- [ ] SEO meta dinamico (OG tags, JSON-LD)

---

**Ultimo aggiornamento:** Aprile 2026  
**Versione:** 0.3  
**Stato:** In sviluppo attivo