<?php
/**
 * Customizer Settings - Total Femininity
 *
 * LOGICA MEDIA — Regola d'oro:
 * Tutti i campi media (video, immagini) salvano l'ID dell'attachment nel database.
 * L'URL viene sempre generato dinamicamente via wp_get_attachment_url($id).
 * Questo garantisce che funzioni su qualsiasi dominio (staging, live, futuro).
 *
 * SEZIONI:
 * - Hero Video        → hero_section
 * - Hero Poster       → hero_poster_section  (sezione separata per evitare
 *                                              conflitto frame wp.media)
 * - Hero Testi & CTA  → hero_section
 * - Collections Grid  → collections_section
 * - About Section     → about_section
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'tf_customizer_register' );

function tf_customizer_register( $wp_customize ) {

    // =========================================================
    // PANEL: Total Femininity
    // Raggruppa tutte le sezioni in un panel unico
    // =========================================================

    $wp_customize->add_panel( 'tf_panel', array(
        'title'    => __( 'Total Femininity', 'blocksy-child' ),
        'priority' => 30,
    ) );

    // =========================================================
    // SECTION 1: Hero — Video + Testi + CTA
    // =========================================================

    $wp_customize->add_section( 'hero_section', array(
        'title'       => __( 'Hero — Video & Testi', 'blocksy-child' ),
        'panel'       => 'tf_panel',
        'priority'    => 10,
        'description' => __( 'Video di sfondo, titoli e CTA della hero section', 'blocksy-child' ),
    ) );

    // --- Hero Video ---
    $wp_customize->add_setting( 'hero_video', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'hero_video_control', array(
        'label'       => __( 'Video di sfondo', 'blocksy-child' ),
        'description' => __( 'Carica il video MP4 per la hero section', 'blocksy-child' ),
        'section'     => 'hero_section',
        'settings'    => 'hero_video',
        'mime_type'   => 'video',
        'priority'    => 10,
    ) ) );

    // --- Title Line 1 ---
    $wp_customize->add_setting( 'hero_title_1', array(
        'default'           => 'NUOVA COLLEZIONE',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'hero_title_1_control', array(
        'label'       => __( 'Titolo — Riga 1', 'blocksy-child' ),
        'description' => __( 'Es: PRIMAVERA (in verde accento, uppercase)', 'blocksy-child' ),
        'section'     => 'hero_section',
        'settings'    => 'hero_title_1',
        'type'        => 'text',
        'priority'    => 20,
    ) );

    // --- Title Line 2 ---
    $wp_customize->add_setting( 'hero_title_2', array(
        'default'           => "Vesti chi sei davvero.",
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'hero_title_2_control', array(
        'label'       => __( 'Titolo — Riga 2', 'blocksy-child' ),
        'description' => __( 'Es: L\'essenza femminile veste Total Femininity', 'blocksy-child' ),
        'section'     => 'hero_section',
        'settings'    => 'hero_title_2',
        'type'        => 'text',
        'priority'    => 30,
    ) );

    // --- CTA Text ---
    $wp_customize->add_setting( 'hero_cta_text', array(
        'default'           => 'SCOPRI ORA',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'hero_cta_text_control', array(
        'label'       => __( 'CTA — Testo pulsante', 'blocksy-child' ),
        'section'     => 'hero_section',
        'settings'    => 'hero_cta_text',
        'type'        => 'text',
        'priority'    => 40,
    ) );

    // --- CTA Link ---
    $wp_customize->add_setting( 'hero_cta_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'hero_cta_link_control', array(
        'label'       => __( 'CTA — Link pulsante', 'blocksy-child' ),
        'description' => __( 'Lascia vuoto per usare automaticamente la pagina shop', 'blocksy-child' ),
        'section'     => 'hero_section',
        'settings'    => 'hero_cta_link',
        'type'        => 'url',
        'priority'    => 50,
    ) );

    // =========================================================
    // SECTION 2: Hero Poster
    // Sezione SEPARATA per evitare conflitto frame wp.media
    // con il controllo Hero Video nella sezione precedente.
    // Entrambi salvano ID — wp_get_attachment_url() genera
    // sempre l'URL corretto per il dominio corrente.
    // =========================================================

    $wp_customize->add_section( 'hero_poster_section', array(
        'title'       => __( 'Hero — Immagine Poster', 'blocksy-child' ),
        'panel'       => 'tf_panel',
        'priority'    => 20,
        'description' => __( 'Immagine mostrata durante il caricamento del video e su mobile come sfondo hero + payoff', 'blocksy-child' ),
    ) );

    $wp_customize->add_setting( 'hero_poster', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'hero_poster_control', array(
        'label'       => __( 'Immagine poster', 'blocksy-child' ),
        'description' => __( 'Formato consigliato: WebP, 1920×1080px, max 300KB', 'blocksy-child' ),
        'section'     => 'hero_poster_section',
        'settings'    => 'hero_poster',
        'mime_type'   => 'image',
        'priority'    => 10,
    ) ) );

    // =========================================================
    // SECTION 3: Collections Grid
    // =========================================================

    $wp_customize->add_section( 'collections_section', array(
        'title'       => __( 'Collections Grid', 'blocksy-child' ),
        'panel'       => 'tf_panel',
        'priority'    => 30,
        'description' => __( 'Le due card collezioni (Primavera/Estate e Autunno/Inverno)', 'blocksy-child' ),
    ) );

    // --- Stagione principale (card grande) ---
    $wp_customize->add_setting( 'featured_collection', array(
        'default'           => 'pe',
        'sanitize_callback' => 'sanitize_key',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'featured_collection_control', array(
        'label'       => __( 'Stagione principale (card grande)', 'blocksy-child' ),
        'description' => __( 'La stagione selezionata occupa 2/3 della larghezza', 'blocksy-child' ),
        'section'     => 'collections_section',
        'settings'    => 'featured_collection',
        'type'        => 'select',
        'choices'     => array(
            'pe' => __( 'Primavera / Estate', 'blocksy-child' ),
            'ai' => __( 'Autunno / Inverno', 'blocksy-child' ),
        ),
        'priority'    => 10,
    ) );

    // --- PE Image ---
    $wp_customize->add_setting( 'collection_pe_image', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'collection_pe_image_control', array(
        'label'       => __( 'Primavera/Estate — Immagine', 'blocksy-child' ),
        'section'     => 'collections_section',
        'settings'    => 'collection_pe_image',
        'mime_type'   => 'image',
        'priority'    => 20,
    ) ) );

    // --- PE Link ---
    $wp_customize->add_setting( 'collection_pe_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'collection_pe_link_control', array(
        'label'       => __( 'Primavera/Estate — Link', 'blocksy-child' ),
        'description' => __( 'Lascia vuoto per usare automaticamente il link categoria', 'blocksy-child' ),
        'section'     => 'collections_section',
        'settings'    => 'collection_pe_link',
        'type'        => 'url',
        'priority'    => 30,
    ) );

    // --- AI Image ---
    $wp_customize->add_setting( 'collection_ai_image', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'collection_ai_image_control', array(
        'label'       => __( 'Autunno/Inverno — Immagine', 'blocksy-child' ),
        'section'     => 'collections_section',
        'settings'    => 'collection_ai_image',
        'mime_type'   => 'image',
        'priority'    => 40,
    ) ) );

    // --- AI Link ---
    $wp_customize->add_setting( 'collection_ai_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'collection_ai_link_control', array(
        'label'       => __( 'Autunno/Inverno — Link', 'blocksy-child' ),
        'description' => __( 'Lascia vuoto per usare automaticamente il link categoria', 'blocksy-child' ),
        'section'     => 'collections_section',
        'settings'    => 'collection_ai_link',
        'type'        => 'url',
        'priority'    => 50,
    ) );

    // =========================================================
    // SECTION 4: About
    // =========================================================

    $wp_customize->add_section( 'about_section', array(
        'title'       => __( 'About — Chi Siamo', 'blocksy-child' ),
        'panel'       => 'tf_panel',
        'priority'    => 40,
        'description' => __( 'Sezione Chi Siamo con immagine e testi', 'blocksy-child' ),
    ) );

    // --- About Image ---
    $wp_customize->add_setting( 'about_avatar_image', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'about_avatar_image_control', array(
        'label'       => __( 'Immagine (es: Tiziana e Federica)', 'blocksy-child' ),
        'description' => __( 'Formato consigliato: verticale 3:4, min 600×800px', 'blocksy-child' ),
        'section'     => 'about_section',
        'settings'    => 'about_avatar_image',
        'mime_type'   => 'image',
        'priority'    => 10,
    ) ) );

    // --- About Title ---
    $wp_customize->add_setting( 'about_title', array(
        'default'           => 'Oltre la moda.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'about_title_control', array(
        'label'       => __( 'Titolo sezione', 'blocksy-child' ),
        'section'     => 'about_section',
        'settings'    => 'about_title',
        'type'        => 'text',
        'priority'    => 20,
    ) );

    // --- About Text 1 ---
    $wp_customize->add_setting( 'about_text_1', array(
        'default'           => 'Total Femininity nasce a Torino nel 2026 dalla passione condivisa di Tiziana e Federica — due sorelle con una visione precisa di cosa significa vestirsi da donna oggi. Non solo moda: ogni capo è una scelta consapevole, un modo di raccontare chi sei senza compromessi.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'about_text_1_control', array(
        'label'       => __( 'Paragrafo 1', 'blocksy-child' ),
        'section'     => 'about_section',
        'settings'    => 'about_text_1',
        'type'        => 'textarea',
        'priority'    => 30,
    ) );

    // --- About Text 2 ---
    $wp_customize->add_setting( 'about_text_2', array(
        'default'           => 'La nostra selezione di abbigliamento femminile è disponibile online e nel nostro showroom a Settimo Torinese, dove puoi toccare con mano la qualità e trovare il tuo stile con la nostra guida personale.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'about_text_2_control', array(
        'label'       => __( 'Paragrafo 2', 'blocksy-child' ),
        'section'     => 'about_section',
        'settings'    => 'about_text_2',
        'type'        => 'textarea',
        'priority'    => 40,
    ) );

    // =========================================================
    // SECTION 5: Banner Evento
    // =========================================================

    $wp_customize->add_section( 'banner_evento_section', array(
        'title'       => __( 'Banner Evento', 'blocksy-child' ),
        'panel'       => 'tf_panel',
        'priority'    => 50,
        'description' => __( 'Fascia promozionale sotto il ticker. Attivala solo quando c\'è un evento attivo.', 'blocksy-child' ),
    ) );

    // --- Banner Evento Active ---
    $wp_customize->add_setting( 'banner_evento_active', array(
        'default'           => false,
        'sanitize_callback' => 'tf_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'banner_evento_active_control', array(
        'label'       => __( 'Mostra banner evento', 'blocksy-child' ),
        'section'     => 'banner_evento_section',
        'settings'    => 'banner_evento_active',
        'type'        => 'checkbox',
        'priority'    => 10,
    ) );

    // --- Banner Evento Immagine ---
    $wp_customize->add_setting( 'banner_evento_immagine', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'banner_evento_immagine_control', array(
        'label'       => __( 'Immagine locandina', 'blocksy-child' ),
        'description' => __( 'Locandina o immagine evento. Consigliato: formato verticale 2:3 o quadrato', 'blocksy-child' ),
        'section'     => 'banner_evento_section',
        'settings'    => 'banner_evento_immagine',
        'mime_type'   => 'image',
        'priority'    => 15,
    ) ) );

    // --- Banner Evento Label ---
    $wp_customize->add_setting( 'banner_evento_label', array(
        'default'           => 'EVENTO',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'banner_evento_label_control', array(
        'label'       => __( 'Label categoria', 'blocksy-child' ),
        'description' => __( 'Es: EVENTO / MERCATO / POP-UP', 'blocksy-child' ),
        'section'     => 'banner_evento_section',
        'settings'    => 'banner_evento_label',
        'type'        => 'text',
        'priority'    => 20,
    ) );

    // --- Banner Evento Titolo ---
    $wp_customize->add_setting( 'banner_evento_titolo', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'banner_evento_titolo_control', array(
        'label'       => __( 'Titolo evento', 'blocksy-child' ),
        'section'     => 'banner_evento_section',
        'settings'    => 'banner_evento_titolo',
        'type'        => 'text',
        'priority'    => 30,
    ) );

    // --- Banner Evento Data ---
    $wp_customize->add_setting( 'banner_evento_data', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'banner_evento_data_control', array(
        'label'       => __( 'Data evento', 'blocksy-child' ),
        'description' => __( 'Es: 17 · 18 · 19 APRILE 2026', 'blocksy-child' ),
        'section'     => 'banner_evento_section',
        'settings'    => 'banner_evento_data',
        'type'        => 'text',
        'priority'    => 40,
    ) );

    // --- Banner Evento Luogo ---
    $wp_customize->add_setting( 'banner_evento_luogo', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'banner_evento_luogo_control', array(
        'label'       => __( 'Luogo', 'blocksy-child' ),
        'description' => __( 'Es: Via Italia, Settimo Torinese', 'blocksy-child' ),
        'section'     => 'banner_evento_section',
        'settings'    => 'banner_evento_luogo',
        'type'        => 'text',
        'priority'    => 50,
    ) );

    // --- Banner Evento CTA Testo ---
    $wp_customize->add_setting( 'banner_evento_cta_testo', array(
        'default'           => 'SCOPRI L\'EVENTO',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'banner_evento_cta_testo_control', array(
        'label'       => __( 'CTA — Testo pulsante', 'blocksy-child' ),
        'section'     => 'banner_evento_section',
        'settings'    => 'banner_evento_cta_testo',
        'type'        => 'text',
        'priority'    => 60,
    ) );

    // --- Banner Evento CTA Link ---
    $wp_customize->add_setting( 'banner_evento_cta_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'banner_evento_cta_link_control', array(
        'label'       => __( 'CTA — Link', 'blocksy-child' ),
        'description' => __( 'Link alla pagina evento o agli eventi', 'blocksy-child' ),
        'section'     => 'banner_evento_section',
        'settings'    => 'banner_evento_cta_link',
        'type'        => 'url',
        'priority'    => 70,
    ) );

}

/**
 * Helper: recupera URL da ID attachment
 *
 * Usare questa funzione in front-page.php ovunque serva
 * un URL da un setting media del customizer.
 *
 * Esempio:
 *   $hero_poster_url = tf_get_attachment_url( get_theme_mod('hero_poster', 0) );
 *
 * @param  int    $id      ID attachment salvato dal customizer
 * @param  string $default URL di fallback se ID non valido
 * @return string          URL completo o stringa vuota
 */
function tf_get_attachment_url( $id, $default = '' ) {
    if ( ! absint( $id ) ) return $default;
    $url = wp_get_attachment_url( absint( $id ) );
    return $url ?: $default;
}

/**
 * Helper: sanitizza checkbox
 *
 * @param  mixed $value Valore da sanitizzare
 * @return bool        true se checked, false altrimenti
 */
function tf_sanitize_checkbox( $value ) {
    return (bool) $value;
}
