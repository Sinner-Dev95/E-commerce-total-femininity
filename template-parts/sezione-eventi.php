<?php
/**
 * Template Part: Sezione News / Eventi — Homepage
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$eventi_query = new WP_Query( [
    'post_type'      => 'evento',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'no_found_rows'  => true,
] );

if ( ! $eventi_query->have_posts() ) {
    wp_reset_postdata();
    return;
}
?>
<section class="eventi-section" role="region" aria-labelledby="eventi-section-title" data-usal="fade-u duration-1000 once threshold-10">
    <header class="eventi-header">
        <div class="eventi-header-inner">
            <span class="eventi-label">Prossimi Appuntamenti</span>
            <h2 class="eventi-title" id="eventi-section-title">In agenda</h2>
        </div>
        <a href="<?php echo esc_url( home_url( '/eventi/' ) ); ?>"
           class="btn btn-light eventi-view-all"
           aria-label="Vedi tutti gli eventi">Vedi tutti →</a>
    </header>
    <div class="eventi-grid">
        <?php $card_index = 0; while ( $eventi_query->have_posts() ) : $eventi_query->the_post();
            $thumb_url   = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
            $event_date  = get_post_meta( get_the_ID(), 'evento_data', true );
            $event_luogo = get_post_meta( get_the_ID(), 'evento_luogo', true );
            $delay       = $card_index * 200;
        ?>
        <article class="evento-card" itemscope itemtype="https://schema.org/Event" data-usal="fade-u duration-1000 once delay-<?php echo $delay; ?> threshold-10">
            <a href="<?php the_permalink(); ?>" class="evento-card-media-link" tabindex="-1" aria-hidden="true">
                <div class="evento-card-media">
                    <?php if ( $thumb_url ) : ?>
                        <img src="<?php echo esc_url( $thumb_url ); ?>"
                             alt="<?php echo esc_attr( get_the_title() ); ?>"
                             class="evento-card-img"
                             loading="lazy" decoding="async">
                    <?php else : ?>
                        <div class="evento-card-img-placeholder"></div>
                    <?php endif; ?>
                </div>
            </a>
            <div class="evento-card-body">
                <span class="evento-card-label">EVENTO</span>
                <h3 class="evento-card-title" itemprop="name">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <?php if ( $event_date || $event_luogo ) : ?>
                <p class="evento-card-meta">
                    <?php if ( $event_date )  echo esc_html( $event_date ); ?>
                    <?php if ( $event_date && $event_luogo ) echo ' · '; ?>
                    <?php if ( $event_luogo ) echo esc_html( $event_luogo ); ?>
                </p>
                <?php endif; ?>
                <?php $excerpt = get_the_excerpt(); if ( $excerpt ) : ?>
                <p class="evento-card-excerpt"><?php echo esc_html( wp_trim_words( $excerpt, 18 ) ); ?></p>
                <?php endif; ?>
                <a href="<?php the_permalink(); ?>" class="evento-card-cta btn btn-accent" itemprop="url">
                    Scopri →
                </a>
            </div>
        </article>
        <?php $card_index++; endwhile; wp_reset_postdata(); ?>
    </div>
</section>
