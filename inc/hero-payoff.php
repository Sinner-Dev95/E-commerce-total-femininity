<?php
/**
 * Template Part: Hero + Payoff
 * File: template-parts/hero-payoff.php
 *
 * Includere in front-page.php con:
 * get_template_part('template-parts/hero-payoff');
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// — Video
$hero_video_id  = get_theme_mod( 'hero_video', 0 );
$hero_video_url = '';
if ( $hero_video_id ) {
    $base_url = tf_get_attachment_url( $hero_video_id );
    if ( $base_url ) {
        // Cache buster leggero — usa versione tema, non filemtime
        $hero_video_url = $base_url . '?v=' . wp_get_theme()->get( 'Version' );
    }
}

// — Poster: solo background-image sul wrapper, niente attributo poster sul video
$hero_poster_id  = get_theme_mod( 'hero_poster', 0 );
$hero_poster_url = tf_get_attachment_url( $hero_poster_id );

// — Testi
$hero_line_1   = get_theme_mod( 'hero_title_1', 'NUOVA COLLEZIONE' );
$hero_line_2   = get_theme_mod( 'hero_title_2', 'Vesti chi sei davvero.' );
$hero_cta_text = get_theme_mod( 'hero_cta_text', 'SCOPRI ORA' );
$hero_cta_link = get_theme_mod( 'hero_cta_link' ) ?: get_permalink( wc_get_page_id( 'shop' ) );
?>

<a href="#main-content" class="skip-link">
    <?php esc_html_e( 'Vai al contenuto principale', 'blocksy-child' ); ?>
</a>

<div class="hero-payoff-wrapper"
    <?php if ( $hero_poster_url ) : ?>
        style="background-image: url('<?php echo esc_url( $hero_poster_url ); ?>');"
    <?php endif; ?>>

    <?php if ( $hero_video_url ) : ?>
        <video
            class="hero-video"
            playsinline
            webkit-playsinline
            autoplay
            muted
            loop
            preload="metadata"
            aria-label="<?php echo esc_attr( $hero_line_1 . ' — ' . $hero_line_2 ); ?>"
            role="img">
            <source src="<?php echo esc_url( $hero_video_url ); ?>" type="video/mp4">
        </video>
    <?php endif; ?>

    <!-- HERO -->
    <!-- HERO -->
    <section
        class="hero-section-container"
        role="banner"
        aria-label="<?php esc_attr_e( 'Hero section', 'blocksy-child' ); ?>">

        <!-- Badge FUORI dal wrapper, dentro la section -->
        <div class="hero-badge" aria-label="<?php esc_attr_e( 'Promozione', 'blocksy-child' ); ?>">
            <span class="hero-badge-percent">10% DI SCONTO</span>
            <span class="hero-badge-sub">SUI PRIMI ACQUISTI</span>
        </div>

        <div class="hero-section-wrapper">

            <h1 class="hero-heading" itemprop="headline">
                <span class="hero-line-1"><?php echo esc_html( $hero_line_1 ); ?></span>
                <span class="hero-line-2"><?php echo esc_html( $hero_line_2 ); ?></span>
            </h1>

            <?php if ( $hero_video_url ) : ?>
                <button class="hero-play-btn" aria-label="<?php esc_attr_e( 'Guarda il video', 'blocksy-child' ); ?>">
                    <span class="hero-play-icon" aria-hidden="true"></span>
                    <span class="hero-play-label">PLAY VIDEO</span>
                </button>
            <?php endif; ?>

            <div class="hero-cta">
                <a href="<?php echo esc_url( $hero_cta_link ); ?>"
                    class="cta-button"
                    aria-label="<?php echo esc_attr( $hero_cta_text ); ?>">
                    <?php echo esc_html( $hero_cta_text ); ?>
                </a>
            </div>

        </div>

    </section>
    <!-- PAYOFF -->
    <section class="payoff-container" id="main-content" role="main">
        <div class="payoff-wrapper">
            <h2 itemprop="name">
                <em>
                    <span class="payoff-span-h2" data-usal="fade-u blur duration-1000">
                        Total Femininity
                    </span>
                </em>
            </h2>
            <p itemprop="description" data-usal="fade-u blur-2 delay-400">
                Boutique di abbigliamento femminile nata a Torino nel 2026.
                Due sorelle, una visione: la moda come definizione di identità.
                Ogni capo è una scelta — la tua scelta.
            </p>
        </div>
    </section>

</div>