# Total Femininity — Child Theme

Child theme Blocksy + WooCommerce per e-commerce fashion premium.

**Stack:** WordPress 6.x · Blocksy · WooCommerce · Syne + Pacifico  
**Repo:** `git@github.com:Sinner-Dev95/Ecommerce-total-femininity.git`

---

## Struttura File

```
total-femininity/
├── style.css                          # Header tema child
├── functions.php                      # Enqueue, CPT, hooks
├── front-page.php                     # Homepage template
├── single-evento.php                  # Singolo evento
├── archive-evento.php                 # Archivio eventi
│
├── assets/
│   ├── design-system.css              # Token: colori, font, spazi, componenti base (.btn)
│   ├── home-page.css                  # Homepage: hero, collections, about, testimonials, contact, eventi, USP
│   ├── hero-payoff.css                # Payoff section (se usato)
│   ├── animation.css                  # Animazioni CSS
│   ├── woo-commerce-layout.css        # Override WooCommerce
│   └── blocksy-child-*.min.css        # Build minificati
│
├── scripts/
│   ├── main.js                        # JS principale
│   └── animation.js                   # Animazioni JS
│
├── inc/
│   ├── cpt-evento.php                 # Custom Post Type Evento
│   ├── customizer.php                 # WordPress Customizer
│   └── hero-payoff.php                # Hero/Payoff logic
│
├── template-parts/
│   ├── banner-evento.php              # Banner evento (homepage)
│   ├── sezione-eventi.php             # Grid eventi (homepage)
│   └── usp-bar.php                    # USP bar stats
│
├── README.md                          # Questo file
└── SITO.md                            # Documentazione brand + design system
```

---

## Design Tokens (quick ref)

Solo i valori usati. Fonte: `assets/design-system.css`

| Token | Valore | Uso |
|-------|--------|-----|
| `--colore-sfondo` | `#FAFAF8` | Avorio — sfondo chiaro |
| `--colore-sfondo-caldo` | `#EDE8DF` | Crema sabbia — About, Testimonials |
| `--colore-sfondo-scuro` | `#0F0F0F` | Inchiostro — Hero, Footer |
| `--colore-accento` | `#8fcb9b` | Verde menta — CTA, hover, label |
| `--colore-bordo` | `#E2DDD6` | Bordi caldi |
| `--colore-testo-principale` | `#0F0F0F` | Testo su chiaro |
| `--colore-testo-chiaro` | `#FAFAF8` | Testo su scuro |
| `--colore-testo-muted` | `#6B6B6B` | Meta, caption |
| `--font-titoli` | `'Syne', sans-serif` | Titoli e corpo |
| `--font-script` | `'Pacifico', cursive` | Payoff, accenti |
| `--raggio-bordo` | `0px` | Angoli netti |
| `--transizione-base` | `0.2s ease-out` | Transizione standard |

### Breakpoints

| Nome | Valore | Uso |
|------|--------|-----|
| Mobile | `< 640px` | Base |
| Tablet | `640px – 767px` | Transizione |
| Desktop | `768px – 1023px` | Layout row |
| Large | `1024px – 1289px` | Grid 3 col |
| XL | `1290px+` | Container centrato |

---

## Convenzioni CSS

- **Mobile-first** — base = mobile, `@media (min-width)` per tablet/desktop
- **Nessun `!important`** — se serve, aumentare specificità
- **Variabili** — usare sempre token da `design-system.css`
- **Sezioni** — commento header `/* === NOME SEZIONE === */`
- **Prefisso** — classi componenti: `.about-*`, `.showroom-*`, `.banner-evento-*`
- **Accessibilità** — `prefers-reduced-motion: reduce` per ogni animazione

### Componente Bottone `.btn`

Base in `design-system.css`, varianti colore in `home-page.css`:

| Classe | Sfondo | Su |
|--------|--------|-----|
| `.btn-light` | Trasparente → bordo bianco | Sfondo scuro |
| `.btn-dark` | Nero → verde accento | Sfondo chiaro |
| `.btn-accent` | Trasparente → verde | Sfondo scuro |

Microinterazioni: fill dal basso (`::before`), lift 1px, focus-visible ring.

---

## Comandi Utili

```bash
# Avvio sviluppo locale (se ambiente configurato)
wp-env start

# Build CSS minificati (se pipeline configurata)
# Non ancora automatizzato — aggiornare manualmente i file .min.css
```

---

## Changelog

### v0.3 — Microinterazioni & Fix (Aprile 2026)
- Aggiunto hover microinterazioni a `.btn` (fill dal basso + lift)
- Aggiunto hover microinterazioni a showroom card (sfondo verde + testo scuro)
- Fix `@media` annidato in banner-evento
- Aggiunto gap tra testo e foto nel banner evento (768px+)
- `prefers-reduced-motion` per tutte le animazioni

### v0.2 — Sezioni Homepage (Marzo 2026)
- Hero con video poster + badge sconto
- Payoff editoriale (Pacifico)
- Collections grid (3/4 ratio, hover zoom)
- Curated Selection (carousel mobile, arrows desktop)
- About Us (60/40 grid, showroom card)
- Testimonials carousel
- Contact section (Forminator override)
- Banner Evento + Sezione Eventi
- USP Bar (4 stats)
- CPT Evento + archivio + singolo

### v0.1 — Setup (Febbraio 2026)
- Struttura child theme Blocksy
- Design system CSS (palette, tipografia, spaziature)
- Enqueue condizionale per pagina
- Header trasparente + sticky

---

## Licenza

GNU General Public License v2 — come Blocksy parent.