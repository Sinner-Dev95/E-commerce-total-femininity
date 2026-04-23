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
      console.log("[Lenis] Mobile detected - using native scroll");
      return;
    }

    if (typeof Lenis === "undefined") {
      console.error("[Lenis] Lenis library not loaded");
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

    console.log("[Lenis] Smooth scroll initialized on desktop");
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
        console.error('[USAL] Timeout: USAL non caricato dopo 100 tentativi');
        return;
      }
      
      setTimeout(initUSAL, 50);
      return;
    }

    window.USAL.config({
      defaults: {
        duration: 1000,
        easing: 'ease-out',
        threshold: 10
      },
      once: true  // ← top-level, non dentro defaults
    });

    console.log("[USAL] Initialized");
  }

  initUSAL();

});