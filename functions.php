<?php
// Protezione di sicurezza - previene accesso diretto
if (!defined('ABSPATH')) {
    exit;
}

// Carica Google Fonts in modo asincrono (performance optimization)
add_action('wp_head', 'blocksy_child_async_fonts', 1);
function blocksy_child_async_fonts() {
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;700&family=Pacifico&display=swap&subset=latin"
          media="print"
          onload="this.media='all'">
    <noscript>
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;700&family=Pacifico&display=swap&subset=latin">
    </noscript>
    <?php
}

// Carica gli stili e script del child theme
add_action('wp_enqueue_scripts', 'blocksy_child_enqueue_styles');
function blocksy_child_enqueue_styles()
{
    // Carica lo stile del parent theme
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    // Carica USAL (Universal Scroll Animation Library)
    // Uso jsDelivr diretto per evitare redirect e doppio caricamento
    wp_enqueue_script(
        'usal-js',
        'https://cdn.jsdelivr.net/npm/usal@1.3.1/usal.min.js',
        array(),
        null,
        true // carica nel footer — USAL si auto-inizializza, non serve nell'<head>
    );

    // Versione dinamica per cache busting (usa timestamp file)
    $theme_version = wp_get_theme()->get('Version') . '.' . filemtime( get_stylesheet_directory() . '/assets/home-page.css' );

    // Carica il design system
    wp_enqueue_style(
        'blocksy-child-design-system',
        get_stylesheet_directory_uri() . '/assets/design-system.css',
        array('parent-style'),
        $theme_version
    );

    // Carica CSS specifico per homepage (solo in homepage)
    if (is_front_page() || is_home() || is_post_type_archive( 'evento' ) || is_singular( 'evento' )) {
        wp_enqueue_style(
            'blocksy-child-home-page',
            get_stylesheet_directory_uri() . '/assets/home-page.css',
            array('blocksy-child-design-system'),
            $theme_version
        );
   
    }

    // Carica override WooCommerce (solo se WooCommerce è attivo)
    if (class_exists('WooCommerce')) {
        wp_enqueue_style(
            'blocksy-child-woocommerce',
            get_stylesheet_directory_uri() . '/assets/woo-commerce-layout.css',
            array('blocksy-child-design-system'),
            $theme_version
        );
    }

    // Carica Lenis CSS
    wp_enqueue_style(
        'lenis-css',
        get_stylesheet_directory_uri() . '/assets/vendor/lenis.css',
        array(), '1.3.17'
    );

    // Carica Lenis Smooth Scroll (locale) - dipendenza per animation.js
    wp_enqueue_script(
        'lenis-smooth-scroll',
        get_stylesheet_directory_uri() . '/scripts/vendor/lenis.js',
        array(), '1.3.17', true
    );

    // Carica JavaScript personalizzato
    wp_enqueue_script(
        'blocksy_child_main',
        get_stylesheet_directory_uri() . '/scripts/main.js',
        array(),
        $theme_version,
        true // Carica nel footer
    );

    // Carica CSS per animazioni
    wp_enqueue_style(
        'blocksy-child-animation',
        get_stylesheet_directory_uri() . '/assets/animation.css',
        array('blocksy-child-design-system'),
        $theme_version
    );

    // Carica JavaScript per animazioni (dipende da Lenis)
    wp_enqueue_script(
        'blocksy-child-animation',
        get_stylesheet_directory_uri() . '/scripts/animation.js',
        array('lenis-smooth-scroll', 'usal-js'),
        $theme_version,
        true
    );

}

// Disabilita Forminator assets su tutte le pagine tranne homepage
add_action('wp_enqueue_scripts', 'tf_dequeue_forminator_globally', 999);
function tf_dequeue_forminator_globally() {
    if (is_front_page() || is_home()) return;
    wp_dequeue_script('forminator-front-scripts');
    wp_dequeue_script('forminator-jquery-validate');
    wp_dequeue_style('forminator-ui-base');
    wp_dequeue_style('forminator-ui-icons');
    wp_dequeue_style('forminator-ui-forms');
    wp_dequeue_style('forminator-ui-buttons');
}

// Carica le impostazioni del Customizer per la Hero Section
require_once get_stylesheet_directory() . '/inc/customizer.php';

// Carica il Custom Post Type Evento
require_once get_stylesheet_directory() . '/inc/cpt-evento.php';
