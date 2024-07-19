<section class="bottom bg-dark">
    <article class="container">
        <div class="row">
            <div class="col-lg-3 mb-5 mb-lg-0 bottom-column">
                <h4>Rocha</h4>
                <a><i class="me-3 fa-solid fa-location-dot"></i> Dr. Nicolás Corbo 1485 - Lascano</a>
                <a href="tel:+59844567865"><i class="me-3 fa-solid fa-phone"></i> 4456 7865</a>
                <a href="tel:+59899856005"><i class="me-3 fa-solid fa-mobile"></i> 099 856 005</a>
                <a><i class="me-3 fa-solid fa-envelope"></i> administracion <br>@carlosbachino.com</a>
            </div>
            <div class="col-lg-3 mb-5 mb-lg-0 bottom-column">
                <h4>Maldonado</h4>
                <a><i class="me-3 fa-solid fa-location-dot"></i> 25 de Agosto 640, Aiguá</a>
                <a href="tel:+59844462723"><i class="me-3 fa-solid fa-phone"></i> 4446 2723</a>
                <a href="tel:+59891365860"><i class="me-3 fa-solid fa-mobile"></i> 091 365 860</a>
                <a><i class="me-3 fa-solid fa-envelope"></i> administracion <br>@carlosbachino.com</a>
            </div>
            <div class="col-lg-3 mb-5 mb-lg-0 bottom-column">
                <h4>Treinta y Tres</h4>
                <a><i class="me-3 fa-solid fa-location-dot"></i> Dionisio Coronel 1760 - Vergara</a>
                <a href="tel:+59844583524"><i class="me-3 fa-solid fa-phone"></i> 4458 3524</a>
                <a href="tel:+59891339957"><i class="me-3 fa-solid fa-mobile"></i> 091 339 957</a>
                <a><i class="me-3 fa-solid fa-envelope"></i> administracion <br>@carlosbachino.com</a>
            </div>
            <div class="col-lg-3 mb-5 mb-lg-0 bottom-column">
                <?php
                if (function_exists('the_custom_logo')) {
                    $custom_logo_id = get_theme_mod('custom_logo');
                }
                ?>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo de Carlos Bachino">
                </a>
                <p>“Trabajar espalda con espalda con el productor agropecuario”</p>
                <div class="d-flex">
                    <a href="https://web.facebook.com/carlosbachinoagronegocios" target="_blank"><i class="fa-brands me-3 fa-facebook"></i></a>
                    <a href="https://www.instagram.com/carlosbachinoagronegocios" target="_blank"><i class="fa-brands me-3 fa-instagram"></i></a>
                    <a href="https://twitter.com/carlos_bachino" target="_blank"><i class="fa-brands me-3 fa-x-twitter"></i></a>
                </div>
            </div>
        </div>
    </article>
</section>