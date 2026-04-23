<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$banner_active = get_theme_mod( 'banner_evento_active', false );

if ( ! $banner_active ) {
	return;
}

$label = get_theme_mod( 'banner_evento_label', '' );
$titolo = get_theme_mod( 'banner_evento_titolo', '' );
$data = get_theme_mod( 'banner_evento_data', '' );
$luogo = get_theme_mod( 'banner_evento_luogo', '' );
$cta_link = get_theme_mod( 'banner_evento_cta_link', '' );
$cta_testo = get_theme_mod( 'banner_evento_cta_testo', '' );
$immagine_id  = get_theme_mod( 'banner_evento_immagine', 0 );
$immagine_url = $immagine_id ? tf_get_attachment_url( $immagine_id ) : '';
?>

<section class="banner-evento" role="region" aria-label="Evento in corso" data-usal="fade-u duration-1000 once threshold-10">
	<div class="banner-evento-inner">
		<div class="banner-evento-content">
			<?php if ( $label ) : ?>
				<span class="banner-evento-label">
					<?php echo esc_html( $label ); ?>
				</span>
			<?php endif; ?>
			<div class="banner-evento-info">
				<strong class="banner-evento-titolo">
					<?php echo esc_html( $titolo ); ?>
				</strong>
				<span class="banner-evento-meta">
					<?php if ( $data ) : ?>
						<?php echo esc_html( $data ); ?>
					<?php endif; ?>
					<?php if ( $data && $luogo ) : ?>
						·
					<?php endif; ?>
					<?php if ( $luogo ) : ?>
						<?php echo esc_html( $luogo ); ?>
					<?php endif; ?>
				</span>
			</div>
			<?php if ( $cta_link ) : ?>
				<a class="btn btn-accent banner-evento-cta" href="<?php echo esc_url( $cta_link ); ?>">
					<?php echo esc_html( $cta_testo ?: __('SCOPRI L\'EVENTO', 'blocksy-child') ); ?>
				</a>
			<?php endif; ?>
		</div>

		<?php if ( $immagine_url ) : ?>
			<div class="banner-evento-media">
				<img
					src="<?php echo esc_url( $immagine_url ); ?>"
					alt="<?php echo esc_attr( $titolo ); ?>"
					class="banner-evento-img"
					loading="lazy"
					decoding="async">
			</div>
		<?php endif; ?>

	</div>
</section>
