<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$usp_items = [
    [
        'stat'  => '48H',
        'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256" fill="none"><path fill="currentColor" d="M255.42,117l-14-35A15.93,15.93,0,0,0,226.58,72H192V64a8,8,0,0,0-8-8H32A16,16,0,0,0,16,72V184a16,16,0,0,0,16,16H49a32,32,0,0,0,62,0h50a32,32,0,0,0,62,0h17a16,16,0,0,0,16-16V120A7.94,7.94,0,0,0,255.42,117ZM192,88h34.58l9.6,24H192ZM32,72H176v64H32ZM80,208a16,16,0,1,1,16-16A16,16,0,0,1,80,208Zm81-24H111a32,32,0,0,0-62,0H32V152H176v12.31A32.11,32.11,0,0,0,161,184Zm31,24a16,16,0,1,1,16-16A16,16,0,0,1,192,208Zm48-24H223a32.06,32.06,0,0,0-31-24V128h48Z"/></svg>',
        'label' => 'Spedizione Espresso',
        'desc'  => 'Corriere espresso in tutta Italia. Ordini confermati entro le 14:00 spediti in giornata.',
    ],
    [
        'stat'  => '30 GG',
        'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256" fill="none"><path fill="currentColor" d="M223.68,66.15,135.68,18a15.88,15.88,0,0,0-15.36,0l-88,48.17a16,16,0,0,0-8.32,14v95.64a16,16,0,0,0,8.32,14l88,48.17a15.88,15.88,0,0,0,15.36,0l88-48.17a16,16,0,0,0,8.32-14V80.18A16,16,0,0,0,223.68,66.15ZM128,32l80.34,44-29.77,16.3-80.35-44ZM128,120,47.66,76l33.9-18.56,80.34,44ZM40,90l80,43.78v85.79L40,175.82Zm176,85.78h0l-80,43.79V133.82l32-17.51V152a8,8,0,0,0,16,0V107.55L216,90v85.77Z"/></svg>',
        'label' => 'Reso Facile',
        'desc'  => 'Rimborso garantito entro 30 giorni dalla ricezione. Senza domande, senza stress.',
    ],
    [
        'stat'  => 'WP',
        'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256" fill="none"><path fill="currentColor" d="M187.58,144.84l-32-16a8,8,0,0,0-8,.5l-14.69,9.8a40.55,40.55,0,0,1-16-16l9.8-14.69a8,8,0,0,0,.5-8l-16-32A8,8,0,0,0,104,64a40,40,0,0,0-40,40,88.1,88.1,0,0,0,88,88,40,40,0,0,0,40-40A8,8,0,0,0,187.58,144.84ZM152,176a72.08,72.08,0,0,1-72-72A24,24,0,0,1,99.29,80.46l11.48,23L101,118a8,8,0,0,0-.73,7.51,56.47,56.47,0,0,0,30.15,30.15A8,8,0,0,0,138,155l14.61-9.74,23,11.48A24,24,0,0,1,152,176ZM128,24A104,104,0,0,0,36.18,176.88L24.83,210.93a16,16,0,0,0,20.24,20.24l34.05-11.35A104,104,0,1,0,128,24Zm0,192a87.87,87.87,0,0,1-44.06-11.81,8,8,0,0,0-6.54-.67L40,216,52.47,178.6a8,8,0,0,0-.66-6.54A88,88,0,1,1,128,216Z"/></svg>',
        'label' => 'Assistenza WhatsApp',
        'desc'  => 'Tiziana e Federica rispondono entro poche ore. Consulenza taglie gratuita e personalizzata.',
    ],
    [
        'stat'  => 'TO',
        'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256" fill="none"><path fill="currentColor" d="M112,80a16,16,0,1,1,16,16A16,16,0,0,1,112,80ZM64,80a64,64,0,0,1,128,0c0,59.95-57.58,93.54-60,94.95a8,8,0,0,1-7.94,0C121.58,173.54,64,140,64,80Zm16,0c0,42.2,35.84,70.21,48,78.5,12.15-8.28,48-36.3,48-78.5a48,48,0,0,0-96,0Zm122.77,67.63a8,8,0,0,0-5.54,15C213.74,168.74,224,176.92,224,184c0,13.36-36.52,32-96,32s-96-18.64-96-32c0-7.08,10.26-15.26,26.77-21.36a8,8,0,0,0-5.54-15C29.22,156.49,16,169.41,16,184c0,31.18,57.71,48,112,48s112-16.82,112-48C240,169.41,226.78,156.49,202.77,147.63Z"/></svg>',
        'label' => 'Showroom a Settimo T.se',
        'desc'  => 'Vieni a trovarci a Settimo Torinese. Prova i capi dal vivo e ricevi una consulenza personale.',
    ],
];
?>

<section class="usp-bar"
    role="region"
    aria-labelledby="usp-title"
    data-usal="fade-u duration-800 once threshold-5">

    <h2 class="sr-only" id="usp-title">Perché scegliere Total Femininity</h2>

    <ul class="usp-bar-list">
        <?php foreach ( $usp_items as $item ) : ?>
            <li class="usp-bar-item">
                <div class="usp-bar-top">
                    <div class="usp-bar-icon" aria-hidden="true">
                        <?php echo $item['icon']; ?>
                    </div>
                    <span class="usp-bar-stat" aria-hidden="true">
                        <?php echo esc_html( $item['stat'] ); ?>
                    </span>
                </div>

                <div class="usp-bar-body">
                    <strong class="usp-bar-label">
                        <?php echo esc_html( $item['label'] ); ?>
                    </strong>
                    <p class="usp-bar-desc">
                        <?php echo esc_html( $item['desc'] ); ?>
                    </p>
                </div>

            </li>
        <?php endforeach; ?>
    </ul>

</section>