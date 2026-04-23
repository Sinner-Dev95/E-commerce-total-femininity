# Documentazione del Sito

## Indice

- [Identità del Brand](#identità-del-brand)
- [Design System](#design-system)
- [Linee Guida Immagini](#linee-guida-immagini)
- [Stati Interattivi](#stati-interattivi)
- [Architettura delle Pagine](#architettura-delle-pagine)

---

## Identità del Brand

### Informazioni Base
- **Nome Brand:** Total Femininity
- **Slogan:** Perché lo stile non è quello che indossi. È quello che sei già.
- **Missione:** Valorizzare il mondo femminile attraverso capi pensati per accompagnare in ogni occasione
- **Storia:** Nasce a Torino nel 2026, da due sorelle con una visione: celebrare la femminilità

### Target Audience
- **Fascia d'età:** 25-45 anni
- **Stile:** Elegante, Raffinato, Editoriale
- **Interessi:** Moda sostenibile, Design contemporaneo, Lifestyle premium
- **Livello economico:** Premium

### Personalità del Brand
- **3 Aggettivi chiave:**
  1. Femminile
  2. Elegante
  3. Autentico

---

## Design System

### 1. Palette Colori (Monocromatico Premium)

```css
/* === COLORI === */
:root {
    /* Primari */
    --colore-sfondo: #FDFDFD;           /* Bianco carta premium */
    --colore-testo: #111111;            /* Nero carbone */
    --colore-testo-mute: #666666;       /* Per descrizioni e info secondarie */
    --colore-bordo: #E5E5E5;            /* Linee sottili editoriali */
    
    /* Accenti */
    --colore-accento: #111111;          /* Coerenza totale */
    --colore-errore: #BC2525;           /* Unico tocco di colore per errori/saldi */
    --colore-lilla: #E6E0F8;            /* Lilla/Lavanda per sezioni */
    
    /* Stati E-commerce (DA DEFINIRE) */
    --colore-prezzo: #111111;           /* Prezzo standard */
    --colore-prezzo-scontato: #BC2525;  /* Prezzo scontato */
    --colore-disponibile: #4CAF50;      /* Verde per in-stock */
    --colore-esaurito: #999999;         /* Grigio per out-of-stock */
    
    /* Grigi (DA DEFINIRE - necessari?) */
    /* --grigio-50: #F9F9F9; */
    /* --grigio-100: #F0F0F0; */
    /* --grigio-200: #E5E5E5; */
    /* --grigio-300: #CCCCCC; */
}
```

**Note:**
- Palette monocromatica = look luxury/editoriale
- Solo il rosso per errori e saldi = funzionale e d'impatto
- Nero su bianco = contrasto eccellente (19:1) ✅
- Grigio #666666 su bianco = contrasto buono (7.6:1) ✅

---

### 2. Tipografia

```css
/* === TIPOGRAFIA === */
:root {
    --font-titoli: 'Manrope', sans-serif;
    --font-corpo: 'Manrope', sans-serif;
    --font-script: 'Pacifico', cursive;  /* Per arricchire payoff */
    
    /* Scale Fluide (Zero Media Queries) */
    --testo-h1: clamp(3.15rem, 8vw, 5.61rem);  /* ~50px -> 90px (Hero) */
    --testo-h2: clamp(2.36rem, 5vw, 3.15rem);  /* ~37px -> 50px (Titoli sezioni) */
    --testo-lg: 1.777rem;               /* 28px (H3) */
    --testo-base: 1rem;                 /* 16px (Body standard) */
    --testo-sm: 0.875rem;               /* 14px (UI/Menu) */
    --testo-xs: 0.75rem;                /* 12px (Dettagli) */
    
    /* Dettagli Editoriali */
    --interlinea-stretta: 1.1;          /* Titoli (Manrope ha x-height ottima) */
    --interlinea-base: 1.6;             /* Corpo (Ottimo per lettura prolungata) */
    
    /* Pesi Font */
    --fw-regular: 400;
    --fw-bold: 700;
}
```

**Font Caricati:**
- ✅ **Manrope** (Regular 400, Medium 500, Bold 700) - Google Fonts
  - Uso: Font principale per titoli e corpo
  - URL: https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700
  
- ✅ **Pacifico** (Regular 400) - Google Fonts
  - Uso: Font script per arricchire payoff
  - URL: https://fonts.googleapis.com/css2?family=Pacifico&display=swap

---

### 3. Spaziatura

```css
/* === SPAZIATURA === */
:root {
    /* Scala Proporzionale (rem-based) */
    --spazio-xs: 0.5rem;   /* 8px - margin/padding piccoli */
    --spazio-s: 1rem;      /* 16px - spacing standard */
    --spazio-m: 2rem;      /* 32px - spacing medio */
    --spazio-l: clamp(4rem, 8vw, 6rem);   /* Margini tra sezioni */
    --spazio-xl: clamp(6rem, 12vw, 12rem); /* Spazi macro per respiro premium */
    
    /* Componenti */
    --spazio-card: var(--spazio-s);
    --spazio-sezione: var(--spazio-l);
    --spazio-container: clamp(1rem, 5vw, 25px);
}
```

---

### 4. Elementi UI

```css
/* === ELEMENTI UI === */
:root {
    /* Layout */
    --max-width: 1290px;
    --container-p: clamp(1rem, 5vw, 25px);
    
    /* Bordi e Angoli */
    --radius: 0px;        /* Angoli netti = look più lussuoso ed editoriale */
    --border-thin: 1px solid var(--colore-bordo);
    --border-thick: 2px solid var(--colore-testo);
    
    /* Ombre */
    --shadow-soft: 0 4px 20px rgba(0,0,0,0.03); /* Ombre quasi invisibili */
    --shadow-medium: 0 8px 30px rgba(0,0,0,0.06);
    --shadow-hover: 0 12px 40px rgba(0,0,0,0.1);
    
    /* Proporzioni */
    --aspect-ratio-fashion: 3 / 4; /* Standard abbigliamento */
    --aspect-ratio-hero: 16 / 9;   /* Hero images */
    
    /* Transizioni (DA DEFINIRE) */
    --transition-fast: 0.2s ease;
    --transition-normal: 0.3s ease;
    --transition-slow: 0.5s ease;
    
    /* Opacity (DA DEFINIRE?) */
    --opacity-disabled: 0.5;
    --opacity-hover: 0.8;
}
```

---

### 5. Z-Index Stack

```css
/* === Z-INDEX STACK === */
:root {
    --z-dropdown: 100;
    --z-sticky: 200;
    --z-modal: 1000;
    --z-tooltip: 2000;
    --z-notification: 3000;
}
```

---

## Stati Interattivi

### Hover States

**DA DEFINIRE:** Come reagisce l'hover?

**Opzione A - Inversione Colori:**
```css
/* Bottone nero → bianco */
.button:hover {
    background-color: var(--colore-sfondo);
    color: var(--colore-testo);
    border-color: var(--colore-testo);
}
```

**Opzione B - Sfondo Nero:**
```css
/* Bottone trasparente → nero */
.button:hover {
    background-color: var(--colore-testo);
    color: var(--colore-sfondo);
}
```

**Opzione C - Sottolineatura:**
```css
/* Link con linea sotto */
a:hover {
    text-decoration: underline;
}
```

### Focus States (Accessibilità)

```css
:root {
    --colore-focus: #333333; /* Per accessibilità WCAG */
}

:focus-visible {
    outline: 2px solid var(--colore-focus);
    outline-offset: 2px;
}
```

---

## Linee Guida Immagini

### Photography Style

- **Stile fotografico:** [ES. Studio clean, Lifestyle naturale, Editorial]
- **Atmosfera:** [ES. Minimal, Colorato, Mood specifico]
- **Illuminazione:** [ES. Soft, High contrast, Natural]

### Formato Immagini

| Tipo | Aspect Ratio | Note |
|------|--------------|------|
| Hero | 16:9 o 3:2 | Full width, impatto |
| Prodotti | 3:4 | Standard abbigliamento |
| Thumbnail | 1:1 | Per grid prodotto |
| Banner | 21:9 o 4:1 | Wide banners |

### Compressione
- Formato: WebP (fallback JPEG/PNG)
- Dimensione max: [ES. 500KB per immagine]
- Lazy loading: Attivo (nativo Blocksy)

---

## Architettura delle Pagine

### 1. Homepage

**Sezioni:**
- [ ] Hero Section (grande impatto)
- [ ] Best Sellers / Featured
- [ ] Nuovi Arrivi
- [ ] Categorie / Collections
- [ ] Brand Story / About
- [ ] Newsletter signup
- [ ] Footer

### 2. Shop / Archivio Prodotti

**Componenti:**
- [ ] Filtri laterali
- [ ] Grid prodotti
- [ ] Ordinamento
- [ ] Pagination / Infinite scroll

### 3. Single Product

**Sezioni:**
- [ ] Immagini prodotto (gallery)
- [ ] Info prodotto (titolo, prezzo, descrizione)
- [ ] Varianti (taglia, colore)
- [ ] Add to cart
- [ ] Related products
- [ ] Recensioni

### 4. Cart & Checkout

**Flusso:**
- [ ] Carrello con modifiche quantità
- [ ] Checkout one-page (se possibile Blocksy)
- [ ] Payment options
- [ ] Order summary

### 5. Pagine Informative

- [ ] About Us
- [ ] Contact
- [ ] Shipping & Returns
- [ ] FAQ
- [ ] Privacy Policy
- [ ] Terms & Conditions

---

## Componenti UI

### Bottoni

```css
/* Primary Button */
.btn-primary {
    background: var(--colore-testo);
    color: var(--colore-sfondo);
    padding: var(--spazio-s) var(--spazio-m);
    border: none;
    transition: all var(--transition-normal);
}

/* Secondary Button (Outline) */
.btn-secondary {
    background: transparent;
    color: var(--colore-testo);
    border: var(--border-thick);
}
```

### Card Prodotto

```css
.product-card {
    background: var(--colore-sfondo);
    border: var(--border-thin);
    padding: var(--spazio-card);
    transition: all var(--transition-normal);
}
```

---

## Note e TODO

### Da Definire
- [x] Hover state style definito (Opzione C: Sottolineatura)
- [x] Transizioni fast/normal/slow definite
- [x] Palette colori estesa (Syne + lilla)
- [x] Tipografia completa (Syne + monospace)
- [ ] Loading Manrope - Google Fonts o Self-hosted?
- [x] Nome brand e missione definiti
- [x] Target audience specifico
- [ ] Photography style

### Completati
- [x] Font Syne e Monospace aggiunti al backend WordPress
- [x] Colore lilla #E6E0F8 documentato nel design system
- [x] Design System SITO.md allineato con assets/design-system.css

### Next Steps
1. Definire photography style
2. Definire loading Manrope (Google Fonts o Self-hosted?)
3. Mappare funzionalità WooCommerce necessarie
4. Definire tipi di prodotti

---

## Riferimenti

- Siti di ispirazione: [LISTA LINK]
- Competitors: [LISTA]
- Moodboard: [LINK FIGMA/DOCS]

---

## Versione

- **Ultimo aggiornamento:** [DATA]
- **Versione Design System:** 1.0
- **Stato:** In definizione