<?php
/**
 * Template: Archivio Eventi
 * URL automatico: /eventi/
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>

<main class="archivio-eventi-page" id="main-content">

    <header class="archivio-eventi-header" data-usal="fade-u duration-700 once">
        <div class="archivio-eventi-header-inner">
            <span class="eventi-label">Total Femininity</span>
            <h1 class="archivio-eventi-title">Tutti gli eventi</h1>
            <?php
            global $wp_query;
            $total = $wp_query->found_posts;
            if ( $total > 0 ) : ?>
                <p class="archivio-eventi-count">
                    <?php echo $total === 1 ? '1 evento in programma' : $total . ' eventi in programma'; ?>
                </p>
            <?php endif; ?>
        </div>
    </header>

    <div class="archivio-eventi-container">

        <?php if ( have_posts() ) : ?>

            <div class="eventi-grid" data-usal="fade-u duration-700 once">
                <?php while ( have_posts() ) : the_post();
                    $thumb_url   = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
                    $event_date  = get_post_meta( get_the_ID(), 'evento_data', true );
                    $event_luogo = get_post_meta( get_the_ID(), 'evento_luogo', true );
                ?>
                <article class="evento-card" itemscope itemtype="https://schema.org/Event">
                    <a href="<?php the_permalink(); ?>" class="evento-card-media-link" tabindex="-1" aria-hidden="true">
                        <div class="evento-card-media">
                            <?php if ( $thumb_url ) : ?>
                                <img
                                    src="<?php echo esc_url( $thumb_url ); ?>"
                                    alt="<?php echo esc_attr( get_the_title() ); ?>"
                                    class="evento-card-img"
                                    loading="lazy"
                                    decoding="async">
                            <?php else : ?>
                                <div class="evento-card-img-placeholder"></div>
                            <?php endif; ?>
                        </div>
                    </a>
                    <div class="evento-card-body">
                        <span class="evento-card-label">EVENTO</span>
                        <h2 class="evento-card-title" itemprop="name">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <?php if ( $event_date || $event_luogo ) : ?>
                        <p class="evento-card-meta">
                            <?php if ( $event_date )  echo esc_html( $event_date ); ?>
                            <?php if ( $event_date && $event_luogo ) echo ' · '; ?>
                            <?php if ( $event_luogo ) echo esc_html( $event_luogo ); ?>
                        </p>
                        <?php endif; ?>
                        <?php $excerpt = get_the_excerpt(); if ( $excerpt ) : ?>
                        <p class="evento-card-excerpt">
                            <?php echo esc_html( wp_trim_words( $excerpt, 18 ) ); ?>
                        </p>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="evento-card-cta btn btn-dark" itemprop="url">
                            Scopri →
                        </a>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>

            <?php
            // Paginazione
            the_posts_pagination( [
                'mid_size'  => 2,
                'prev_text' => '← Precedenti',
                'next_text' => 'Successivi →',
                'class'     => 'archivio-eventi-pagination',
            ] );
            ?>

        <?php else : ?>

            <div class="archivio-eventi-empty">
                <p>Nessun evento in programma al momento.</p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-dark">
                    Torna alla homepage
                </a>
            </div>

        <?php endif; ?>

    </div>

</main>

<?php get_footer(); ?>