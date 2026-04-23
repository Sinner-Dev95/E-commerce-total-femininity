<?php
/**
 * Template: Singolo Evento
 * URL automatico: /eventi/nome-evento/
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

while ( have_posts() ) : the_post();

    $thumb_url   = get_the_post_thumbnail_url( get_the_ID(), 'full' );
    $thumb_alt   = get_the_title();
    $event_date  = get_post_meta( get_the_ID(), 'evento_data', true );
    $event_luogo = get_post_meta( get_the_ID(), 'evento_luogo', true );

?>

<main class="single-evento-page" id="main-content" itemscope itemtype="https://schema.org/Event">

    <?php if ( $thumb_url ) : ?>
    <div class="single-evento-hero">
        <img
            src="<?php echo esc_url( $thumb_url ); ?>"
            alt="<?php echo esc_attr( $thumb_alt ); ?>"
            class="single-evento-hero-img"
            fetchpriority="high"
            decoding="async">
        <div class="single-evento-hero-overlay"></div>
    </div>
    <?php endif; ?>

    <div class="single-evento-container">

        <header class="single-evento-header">
            <span class="evento-card-label">EVENTO</span>
            <h1 class="single-evento-title" itemprop="name">
                <?php the_title(); ?>
            </h1>
            <?php if ( $event_date || $event_luogo ) : ?>
            <p class="single-evento-meta">
                <?php if ( $event_date )  echo esc_html( $event_date ); ?>
                <?php if ( $event_date && $event_luogo ) echo ' · '; ?>
                <?php if ( $event_luogo ) echo esc_html( $event_luogo ); ?>
            </p>
            <?php endif; ?>
        </header>

        <div class="single-evento-content" itemprop="description">
            <?php the_content(); ?>
        </div>

        <footer class="single-evento-footer">
            <a
                href="<?php echo esc_url( home_url( '/eventi/' ) ); ?>"
                class="btn btn-dark">
                ← Tutti gli eventi
            </a>
        </footer>

    </div>

</main>

<?php endwhile; ?>

<?php get_footer(); ?>
