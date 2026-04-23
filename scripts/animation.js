/**
 * Animations
 *
 * File: scripts/animations.js
 * Descrizione: Lenis smooth scroll + USAL inizializzazione
 * Dipendenze: lenis, usal
 * Tema: Blocksy Child - Total Femininity
 */

document.addEventListener("DOMContentLoaded", function () {

  // ============================================================
  // LENIS SMOOTH SCROLL - DESKTOP ONLY
  // ============================================================

  function initLenis() {
    const isDesktop = window.matchMedia("(min-width: 769px)").matches;

    if (!isDesktop) {
      if (window.TF_DEBUG) console.log("[Lenis] Mobile detected - using native scroll");
      return;
    }

    if (typeof Lenis === "undefined") {
      if (window.TF_DEBUG) console.error("[Lenis] Lenis library not loaded");
      return;
    }

const lenis = new Lenis({
  autoRaf: false,
  lerp: 0.12,
  smoothTouch: false,
  anchors: true,
});

    function raf(time) {
      lenis.raf(time);
      requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    if (window.TF_DEBUG) console.log("[Lenis] Smooth scroll initialized on desktop");
  }

  initLenis();

  // ============================================================
  // USAL - SCROLL ANIMATIONS
  // FIX: once va a top-level, non dentro defaults
  // FIX: retry pattern per race condition con defer
  // ============================================================

  function initUSAL() {
    if (typeof window.USAL === 'undefined') {
      // USAL non ancora caricato (defer) — riprova tra 50ms
      if (!initUSAL.retryCount) {
        initUSAL.retryCount = 0;
      }
      
      initUSAL.retryCount++;
      
      // Limite massimo: 100 tentativi = 5 secondi (100 * 50ms)
      if (initUSAL.retryCount > 100) {
        if (window.TF_DEBUG) console.error('[USAL] Timeout: USAL non caricato dopo 100 tentativi');
        return;
      }
      
      setTimeout(initUSAL, 50);
      return;
    }

    window.USAL.config({
      defaults: {
        duration: 1350,
        easing: 'cubic-bezier(0.22, 1, 0.36, 1)',
        threshold: 8
      },
      once: true  // ← top-level, non dentro defaults
    });

    if (window.TF_DEBUG) console.log("[USAL] Initialized");
  }

  initUSAL();

});