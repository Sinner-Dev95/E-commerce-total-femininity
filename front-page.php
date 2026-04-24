<?php
if (! defined('ABSPATH')) exit;

/*
Template: front-page.php
*/

$hero_video_id = get_theme_mod('hero_video', 0);
$hero_video_url = '';

if ($hero_video_id) {
    $base_video_url = tf_get_attachment_url($hero_video_id);
    if ($base_video_url) {
        $cache_buster   = get_post_modified_time('U', false, $hero_video_id) ?: wp_get_theme()->get('Version');
        $hero_video_url = $base_video_url . '?v=' . $cache_buster;
    }
}

$hero_poster_id  = get_theme_mod('hero_poster', 0);
$hero_poster_url = $hero_poster_id ? tf_get_attachment_url($hero_poster_id) : '';

$hero_title_line_1 = get_theme_mod('hero_title_1', 'PRIMAVERA');
$hero_title_line_2 = get_theme_mod('hero_title_2', "L'essenza femminile veste Total Femininity");

$hero_cta_text = get_theme_mod('hero_cta_text', 'SCOPRI LA COLLEZIONE');

// Shop URL sicura — funziona anche se WooCommerce è disattivato
$shop_url = home_url('/shop/');
if (function_exists('wc_get_page_id')) {
    $shop_id = wc_get_page_id('shop');
    if ($shop_id && $shop_id > 0) {
        $shop_url = get_permalink($shop_id);
    }
}

$hero_cta_link = get_theme_mod('hero_cta_link', $shop_url);

get_header();
?>

<a href="#main-content" class="skip-link">Vai al contenuto principale</a>

<div class="hero-payoff-wrapper">

    <section class="hero-section-container" role="banner" aria-label="Hero section">
        <div class="hero-media-layer">

            <?php if ($hero_poster_url) : ?>
                <img
                    class="hero-poster"
                    src="<?php echo esc_url($hero_poster_url); ?>"
                    alt="<?php echo esc_attr(trim($hero_title_line_1 . ' ' . $hero_title_line_2)); ?>"
                    fetchpriority="high"
                    decoding="async">
            <?php endif; ?>

            <?php if ($hero_video_url) : ?>
                <video
                    class="hero-video"
                    playsinline
                    webkit-playsinline
                    muted
                    loop
                    preload="none"
                    poster="<?php echo esc_url($hero_poster_url); ?>"
                    aria-hidden="true">
                    <source src="<?php echo esc_url($hero_video_url); ?>" type="video/mp4">
                </video>
            <?php endif; ?>

            <div class="hero-gradient"></div>
        </div>

        <div class="hero-badge">
            <span class="hero-badge-percent">10% DI SCONTO</span>
            <span class="hero-badge-sub">SUI PRIMI ACQUISTI</span>
        </div>

        <div class="hero-section-wrapper">
            <div class="hero-content">
                <h1 class="hero-heading" itemprop="headline">
                    <span class="hero-line-1"><?php echo esc_html($hero_title_line_1); ?></span>
                    <span class="hero-line-2"><?php echo esc_html($hero_title_line_2); ?></span>
                </h1>

                <?php if ($hero_video_url) : ?>
                    <button class="hero-play-btn" type="button" aria-label="Guarda il video">
                        <span class="hero-play-label">GUARDA IL VIDEO</span>
                    </button>
                <?php endif; ?>

                <div class="hero-cta">
                    <a
                        href="<?php echo esc_url($hero_cta_link); ?>"
                        class="btn btn-light"
                        aria-label="<?php echo esc_attr($hero_cta_text); ?>">
                        <?php echo esc_html($hero_cta_text); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="payoff-container" id="main-content" role="main">
        <div class="payoff-wrapper">
            <h2 itemprop="name">
                <em>
                    <span class="payoff-span-h2" data-usal="fade-u blur duration-1000">Total Femininity</span>
                </em>
            </h2>
            <p itemprop="description" data-usal="fade-u blur-2 delay-400">
                Boutique di abbigliamento femminile nata a Torino nel 2026,
                fondata da due sorelle con una visione precisa: la moda come
                atto di identità. Acquista online con spedizione rapida in
                tutta Italia o vieni nel nostro showroom a Settimo Torinese.
            </p>
        </div>
    </section>

</div>

<?php get_template_part('template-parts/banner-evento'); ?>

<!-- Ticker Editoriale -->
<div class="editorial-ticker" aria-label="Promozioni e novità" role="region">
    <div class="ticker-track">
        <span class="ticker-item">✦ 10% SUL PRIMO ACQUISTO</span>
        <span class="ticker-separator">—</span>
        <span class="ticker-item">✦ SPEDIZIONE GRATUITA SOPRA 100€</span>
        <span class="ticker-separator">—</span>
        <span class="ticker-item">✦ NUOVA COLLEZIONE DISPONIBILE</span>
        <span class="ticker-separator">—</span>
        <span class="ticker-item">✦ 10% SUL PRIMO ACQUISTO</span>
        <span class="ticker-separator">—</span>
        <span class="ticker-item">✦ SPEDIZIONE GRATUITA SOPRA 100€</span>
        <span class="ticker-separator">—</span>
        <span class="ticker-item">✦ NUOVA COLLEZIONE DISPONIBILE</span>
        <span class="ticker-separator">—</span> 
    </div>
</div>

<?php
$collection_ai_image = get_theme_mod('collection_ai_image', 0);
$collection_pe_image = get_theme_mod('collection_pe_image', 0);

$ai_link = get_term_link('autunno-inverno', 'product_cat');
$ai_link = get_theme_mod('collection_ai_link') ?: (!is_wp_error($ai_link) ? $ai_link : $shop_url);

$pe_link = get_term_link('primavera-estate', 'product_cat');
$pe_link = get_theme_mod('collection_pe_link') ?: (!is_wp_error($pe_link) ? $pe_link : $shop_url);

$featured = get_theme_mod('featured_collection', 'pe');

$collections = [
    'pe' => [
        'title' => "Primavera / Estate '26",
        'image' => $collection_pe_image,
        'link'  => $pe_link,
        'label' => "Primavera Estate '26"
    ],
    'ai' => [
        'title' => "Autunno / Inverno '26",
        'image' => $collection_ai_image,
        'link'  => $ai_link,
        'label' => "Autunno Inverno '26"
    ],
];

$secondary = ($featured === 'pe') ? 'ai' : 'pe';
?>

<?php get_template_part('template-parts/usp-bar'); ?>

<section class="collections-grid" data-usal="fade-l duration-1450 once threshold-10">
    <div class="collections-wrapper">
        <?php foreach ([$secondary => 'small', $featured => 'large'] as $key => $size):
            $col = $collections[$key];
        ?>
            <a href="<?php echo esc_url($col['link']); ?>"
                class="collection-item <?php echo esc_attr($size); ?>"
                aria-label="<?php echo esc_attr($col['label']); ?>">
                <div class="collection-bg"
                    style="background-image: url('<?php echo esc_url(tf_get_attachment_url($col['image'])); ?>');">
                    <div class="collection-content">
                        <h3><?php echo esc_html($col['title']); ?></h3>
                        <span class="collection-link">Scopri la collezione →</span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>



<section class="curated-selection-section" data-usal="fade-u duration-1000 once threshold-10">
    <header class="curated-header">
        <h2 class="curated-title">I Nostri Preferiti</h2>
        <a href="<?php echo esc_url($shop_url); ?>"
            class="btn btn-dark curated-view-all"
            aria-label="Vedi tutti i prodotti nello shop">
            Vedi tutto →
        </a>
    </header>
    <div class="woocommerce">
        <?php echo do_shortcode('[products limit="9" columns="3" visibility="featured"]'); ?>
    </div>
</section>

<?php get_template_part('template-parts/sezione-eventi'); ?>

<?php
$about_avatar_id  = get_theme_mod('about_avatar_image', 0);
$about_avatar_url = tf_get_attachment_url($about_avatar_id);
$about_title      = get_theme_mod('about_title', 'Oltre la moda.');
$about_text_1     = get_theme_mod('about_text_1', 'Total Femininity nasce a Torino nel 2026 dalla passione condivisa di Tiziana e Federica — due sorelle con una visione precisa di cosa significa vestirsi da donna oggi. Non solo moda: ogni capo è una scelta consapevole, un modo di raccontare chi sei senza compromessi.');
$about_text_2     = get_theme_mod('about_text_2', 'La nostra selezione di abbigliamento femminile è disponibile online e nel nostro showroom a Settimo Torinese, dove puoi toccare con mano la qualità e trovare il tuo stile con la nostra guida personale.');
$showroom_map_url = 'https://maps.google.com/maps?q=Via+Roma+14+Settimo+Torinese+TO';
?>

<section class="about-us-section" data-usal="fade-u duration-1000 once threshold-10"
    role="region"
    aria-labelledby="about-title"
    itemscope
    itemtype="https://schema.org/AboutPage">

    <div class="about-grid-wrapper">

        <div class="about-image-side" data-usal="fade-r duration-1200 once threshold-10">
            <div class="about-image-figure">
                <img
                    src="<?php echo esc_url($about_avatar_url); ?>"
                    alt="Tiziana e Federica, fondatrici di Total Femininity — abbigliamento femminile Torino"
                    class="about-image"
                    loading="lazy"
                    decoding="async"
                    width="600"
                    height="800"
                    itemprop="image">
            </div>
            <p class="about-caption">
                Tiziana &amp; Federica &middot; Torino 2026
            </p>
        </div>

        <div class="about-text-side" data-usal="fade-l duration-1000 once delay-400 threshold-10">
            <div class="about-text-content" itemprop="description">

                <header class="about-header">
                    <span class="about-label">Chi siamo</span>
                    <h2 class="about-title" id="about-title">
                        <span class="about-title-script"><?php echo esc_html($about_title); ?></span>
                    </h2>
                </header>

                <div class="about-body">
                    <p class="about-paragraph"><?php echo esc_html($about_text_1); ?></p>
                    <p class="about-paragraph"><?php echo esc_html($about_text_2); ?></p>
                </div>

                <div class="about-showroom-card">
                    <div class="showroom-card-header">
                        <span class="showroom-icon" aria-hidden="true">📍</span>
                        <span class="showroom-label">Showroom</span>
                    </div>
                    <a href="<?php echo esc_url($showroom_map_url); ?>"
                        class="showroom-link"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Vieni a trovarci: Via Roma 14, Settimo Torinese">
                        <span class="showroom-address">Via Roma 14, Settimo Torinese</span>
                        <span class="showroom-arrow" aria-hidden="true">→</span>
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>

<?php
$testimonials = [
    [
        'quote'    => 'Ho trovato esattamente quello che cercavo. La qualità dei capi è incredibile e il servizio impeccabile.',
        'author'   => 'Giulia M.',
        'location' => 'Torino'
    ],
    [
        'quote'    => "Un'esperienza di shopping unica. Le sorelle ti fanno sentire a casa e ti aiutano a trovare il tuo stile.",
        'author'   => 'Martina R.',
        'location' => 'Milano'
    ],
    [
        'quote'    => "Abbigliamento curato, selezione raffinata e un'atmosfera che ti rapisce subito. Tornerò sicuramente.",
        'author'   => 'Chiara B.',
        'location' => 'Roma'
    ],
    [
        'quote'    => "Finalmente un negozio dove la moda incontra l'autenticità. Tiziana e Federica sono delle professioniste.",
        'author'   => 'Sofia L.',
        'location' => 'Firenze'
    ],
    [
        'quote'    => 'Ho scoperto questo showroom per caso ed è stato amore a prima vista. Consigliatissimo!',
        'author'   => 'Valentina G.',
        'location' => 'Bologna'
    ]
];
?>

<section class="home-testimonials" data-usal="fade-u duration-1000 once threshold-14"
    role="region"
    aria-label="Dicono di noi"
    itemscope
    itemtype="https://schema.org/ItemList">
    <div class="testimonials-container">
        <header class="testimonials-header">
            <h2>Dicono di noi</h2>
        </header>
        <div class="testimonials-carousel" aria-live="polite">
            <div class="testimonials-track">
                <?php foreach ($testimonials as $index => $testimonial): ?>
                    <div class="testimonial-item"
                        role="listitem"
                        itemprop="itemListElement"
                        itemscope
                        itemtype="https://schema.org/Review">
                        <div itemprop="itemReviewed"
                            itemscope
                            itemtype="https://schema.org/Organization"
                            style="display:none">
                            <span itemprop="name">Total Femininity</span>
                            <span itemprop="url">https://totalfemininity.it</span>
                        </div>
                        <blockquote class="testimonial-quote" itemprop="reviewBody">
                            "<?php echo esc_html($testimonial['quote']); ?>"
                        </blockquote>
                        <footer class="testimonial-footer">
                            <cite class="testimonial-author"
                                itemprop="author"
                                itemscope
                                itemtype="https://schema.org/Person">
                                <span class="testimonial-name" itemprop="name">
                                    <?php echo esc_html($testimonial['author']); ?>
                                </span>
                                <span class="testimonial-location"
                                    itemprop="address"
                                    itemscope
                                    itemtype="https://schema.org/PostalAddress">
                                    <?php echo esc_html($testimonial['location']); ?>
                                </span>
                            </cite>
                        </footer>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="testimonials-dots" aria-label="Navigazione testimonianze">
            <?php foreach ($testimonials as $index => $testimonial): ?>
                <button
                    class="testimonial-dot <?php echo esc_attr($index === 0 ? 'active' : ''); ?>"
                    tabindex="0"
                    aria-label="Vai alla testimonianza <?php echo esc_attr($index + 1); ?>"
                    aria-current="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                    data-slide="<?php echo esc_attr($index); ?>">
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="contact-section" id="contact-section" role="region" aria-label="Contattaci" data-usal="fade-u duration-800 once threshold-10">
    <div class="contact-container">
        <header class="contact-header">
            <h2 class="contact-title">Scrivici</h2>
             <p class="contact-intro">
        Hai una domanda su taglie, spedizioni o vuoi prenotare 
        una visita allo showroom di Settimo Torinese? 
        Rispondiamo entro 24 ore.
    </p>
        </header>
        <?php echo do_shortcode('[forminator_form id="252"]'); ?>
    </div>
</section>

<?php get_footer(); ?>