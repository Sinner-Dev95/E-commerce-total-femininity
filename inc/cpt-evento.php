<?php
// Protezione di sicurezza - previene accesso diretto
if (!defined('ABSPATH')) {
    exit;
}

// Registra il Custom Post Type "Evento"
function blocksy_child_register_cpt_evento() {
    $labels = array(
        'name'                  => _x('Eventi', 'Post Type General Name', 'blocksy-child'),
        'singular_name'         => _x('Evento', 'Post Type Singular Name', 'blocksy-child'),
        'menu_name'             => __('Eventi', 'blocksy-child'),
        'name_admin_bar'        => __('Evento', 'blocksy-child'),
        'archives'              => __('Archivio Eventi', 'blocksy-child'),
        'attributes'            => __('Attributi Evento', 'blocksy-child'),
        'parent_item_colon'     => __('Evento Genitore:', 'blocksy-child'),
        'all_items'             => __('Tutti gli Eventi', 'blocksy-child'),
        'add_new_item'          => __('Aggiungi Nuovo Evento', 'blocksy-child'),
        'add_new'               => __('Aggiungi Nuovo', 'blocksy-child'),
        'new_item'              => __('Nuovo Evento', 'blocksy-child'),
        'edit_item'             => __('Modifica Evento', 'blocksy-child'),
        'update_item'           => __('Aggiorna Evento', 'blocksy-child'),
        'view_item'             => __('Visualizza Evento', 'blocksy-child'),
        'view_items'            => __('Visualizza Eventi', 'blocksy-child'),
        'search_items'          => __('Cerca Evento', 'blocksy-child'),
        'not_found'             => __('Non trovato', 'blocksy-child'),
        'not_found_in_trash'    => __('Non trovato nel Cestino', 'blocksy-child'),
        'featured_image'        => __('Immagine in Evidenza', 'blocksy-child'),
        'set_featured_image'    => __('Imposta Immagine in Evidenza', 'blocksy-child'),
        'remove_featured_image' => __('Rimuovi Immagine in Evidenza', 'blocksy-child'),
        'use_featured_image'    => __('Usa come Immagine in Evidenza', 'blocksy-child'),
    );

    $args = array(
        'label'                 => __('Evento', 'blocksy-child'),
        'description'           => __('Custom Post Type per Eventi', 'blocksy-child'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies'            => array(),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-calendar-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'rewrite'               => array(
            'slug'       => 'eventi',
            'with_front' => false,
        ),
    );

    register_post_type('evento', $args);
}
add_action('init', 'blocksy_child_register_cpt_evento', 0);

/**
 * Metabox: Dettagli Evento (Data + Luogo)
 */
function tf_evento_metabox_register() {
    add_meta_box(
        'tf_evento_dettagli',
        'Dettagli Evento',
        'tf_evento_metabox_render',
        'evento',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'tf_evento_metabox_register' );

function tf_evento_metabox_render( $post ) {
    wp_nonce_field( 'tf_evento_save', 'tf_evento_nonce' );
    $data       = get_post_meta( $post->ID, 'evento_data', true );
    $luogo      = get_post_meta( $post->ID, 'evento_luogo', true );
    $start_date = get_post_meta( $post->ID, 'evento_start_date', true );
    $end_date   = get_post_meta( $post->ID, 'evento_end_date', true );
    $indirizzo  = get_post_meta( $post->ID, 'evento_indirizzo', true );
    $citta      = get_post_meta( $post->ID, 'evento_citta', true );
    $provincia  = get_post_meta( $post->ID, 'evento_provincia', true );
    ?>
    <table class="form-table" style="width:100%">
        <tr>
            <th style="width:140px; padding:10px 0">
                <label for="evento_data"><strong>Data evento</strong></label>
            </th>
            <td style="padding:6px 0">
                <input
                    type="text"
                    id="evento_data"
                    name="evento_data"
                    value="<?php echo esc_attr( $data ); ?>"
                    placeholder="Es: 17 · 18 · 19 APRILE 2026"
                    style="width:100%; max-width:400px">
            </td>
        </tr>
        <tr>
            <th style="padding:10px 0">
                <label for="evento_luogo"><strong>Luogo</strong></label>
            </th>
            <td style="padding:6px 0">
                <input
                    type="text"
                    id="evento_luogo"
                    name="evento_luogo"
                    value="<?php echo esc_attr( $luogo ); ?>"
                    placeholder="Es: Settimo Torinese (TO)"
                    style="width:100%; max-width:400px">
            </td>
        </tr>
    </table>

    <hr style="margin:16px 0; border:none; border-top:1px solid #ccd0d4">
    <p style="font-weight:600; margin:0 0 8px 0; color:#1d2327">SEO / Google (Schema.org)</p>
    <p style="color:#646970; margin:0 0 12px 0; font-size:13px">Dati per i <em>rich snippet</em> di Google. Campi obbligatori per apparire nei risultati di ricerca.</p>

    <table class="form-table" style="width:100%">
        <tr>
            <th style="width:140px; padding:10px 0">
                <label for="evento_start_date"><strong>Data inizio</strong> <span style="color:#d63638">*</span></label>
            </th>
            <td style="padding:6px 0">
                <input
                    type="date"
                    id="evento_start_date"
                    name="evento_start_date"
                    value="<?php echo esc_attr( $start_date ); ?>"
                    required
                    style="width:100%; max-width:400px">
            </td>
        </tr>
        <tr>
            <th style="padding:10px 0">
                <label for="evento_end_date">Data fine</label>
            </th>
            <td style="padding:6px 0">
                <input
                    type="date"
                    id="evento_end_date"
                    name="evento_end_date"
                    value="<?php echo esc_attr( $end_date ); ?>"
                    style="width:100%; max-width:400px">
            </td>
        </tr>
        <tr>
            <th style="padding:10px 0">
                <label for="evento_indirizzo"><strong>Indirizzo</strong> <span style="color:#d63638">*</span></label>
            </th>
            <td style="padding:6px 0">
                <input
                    type="text"
                    id="evento_indirizzo"
                    name="evento_indirizzo"
                    value="<?php echo esc_attr( $indirizzo ); ?>"
                    placeholder="Es: Corso Vittorio Emanuele II, 120"
                    required
                    style="width:100%; max-width:400px">
            </td>
        </tr>
        <tr>
            <th style="padding:10px 0">
                <label for="evento_citta"><strong>Città</strong> <span style="color:#d63638">*</span></label>
            </th>
            <td style="padding:6px 0">
                <input
                    type="text"
                    id="evento_citta"
                    name="evento_citta"
                    value="<?php echo esc_attr( $citta ); ?>"
                    placeholder="Es: Torino"
                    required
                    style="width:100%; max-width:400px">
            </td>
        </tr>
        <tr>
            <th style="padding:10px 0">
                <label for="evento_provincia">Provincia</label>
            </th>
            <td style="padding:6px 0">
                <input
                    type="text"
                    id="evento_provincia"
                    name="evento_provincia"
                    value="<?php echo esc_attr( $provincia ); ?>"
                    placeholder="Es: TO"
                    maxlength="5"
                    style="width:100%; max-width:400px">
            </td>
        </tr>
    </table>
    <?php
}

function tf_evento_metabox_save( $post_id ) {
    if ( ! isset( $_POST['tf_evento_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['tf_evento_nonce'], 'tf_evento_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['evento_data'] ) ) {
        update_post_meta( $post_id, 'evento_data', sanitize_text_field( $_POST['evento_data'] ) );
    }
    if ( isset( $_POST['evento_luogo'] ) ) {
        update_post_meta( $post_id, 'evento_luogo', sanitize_text_field( $_POST['evento_luogo'] ) );
    }
    if ( isset( $_POST['evento_start_date'] ) ) {
        update_post_meta( $post_id, 'evento_start_date', sanitize_text_field( $_POST['evento_start_date'] ) );
    }
    if ( isset( $_POST['evento_end_date'] ) ) {
        update_post_meta( $post_id, 'evento_end_date', sanitize_text_field( $_POST['evento_end_date'] ) );
    }
    if ( isset( $_POST['evento_indirizzo'] ) ) {
        update_post_meta( $post_id, 'evento_indirizzo', sanitize_text_field( $_POST['evento_indirizzo'] ) );
    }
    if ( isset( $_POST['evento_citta'] ) ) {
        update_post_meta( $post_id, 'evento_citta', sanitize_text_field( $_POST['evento_citta'] ) );
    }
    if ( isset( $_POST['evento_provincia'] ) ) {
        update_post_meta( $post_id, 'evento_provincia', sanitize_text_field( $_POST['evento_provincia'] ) );
    }
}
add_action( 'save_post_evento', 'tf_evento_metabox_save' );
