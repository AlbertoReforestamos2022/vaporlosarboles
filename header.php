<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Va por los árboles </title>
    <!-- leafleat -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <?php # Google Fonts ?>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    
    <?php wp_head(); ?>

    <style>
        .logo-rm-nav-bottom img {
            width: 90px;
        }

        .logo-sc-nav-bottom img {
            width: 140px;
        }

        .logo-imperfect-nav-bottom img {
            width: 110px;
        }

        .font-size-25 {
            font-size: 15px;
        }

        /* Carrusel solo en móvil */
        @media (max-width: 767px) {
            .carousel-mobile {
                display: block !important;
            }
            
            .desktop-layout {
                display: none !important;
            }

            .carousel-control-prev,
            .carousel-control-next {
                width: 40px;
            }

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                width: 20px;
                height: 20px;
            }

            .logo-rm-nav-bottom img {
                width: 90px;
            }

            .logo-sc-nav-bottom img {
                width: 140px;
            }

            .logo-imperfect-nav-bottom img {
                width: 100px;
            }

            .font-size-25 {
                font-size: 13px;
            }

            .container-mail {
                width: 100%;
            }

        }

        /* Layout normal en escritorio */
        @media (min-width: 768px) {
            .carousel-mobile {
                display: none !important;
            }
            
            .desktop-layout {
                display: flex !important;
                height: 80px;
            }

            .content-nav-rrss {
                height: 100px;
            }

        }

        /* Ajustes generales */
        .social-section {
            min-height: 80px;
        }

        .nav.fixed-bottom {
            z-index: 1030;
        }
    </style>

</head>
<body>

<!-- Menú Header -->
<nav class="navbar navbar-expand-md fixed-top shadow" id="navegacion">
    <!-- Container navegador -->
    <div class="container d-flex justify-content-between justify-content-md-center">
        <a href="#" class="navbar-brand d-flex justify-content-center">
            <img src="<?php echo get_template_directory_uri(); ?>/src/imgs/logotipo_va_por_los_arboles.png" class="img-fluid logo" width="100" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- collapse navbar -->
         <div class="collapse navbar-collapse justify-content-md-center"  id="navbarNav">
            <div class="row justify-content-between">
                <div class="col">
                    <ul class="navbar-nav">
                        <li class="nav-item text-md-center">
                            <a href="" class="nav-link">¿Qué es Va x Los Árboles?</a>
                        </li>
                        <li class="nav-item text-md-center">
                            <a href="#actions-section" class="nav-link">Acciones</a>
                        </li>
                        <li class="nav-item text-md-center">
                            <a href="#events-section" class="nav-link">Eventos</a>
                        </li>
                        <li class="nav-item text-md-center">
                            <a href="#tools-section" class="nav-link"> Herramientas</a>
                        </li>
                        <li class="nav-item text-md-center">
                            <a href="#sponsors-section" class="nav-link"> Aliados </a>
                        </li>
                        <li class="nav-item text-md-center">
                            <a href="#report-section" class="nav-link"> Reporta </a>
                        </li>
                        <li class="nav-item text-md-center">
                            <a href="#recognize-section" class="nav-link"> Reconoce </a>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="row row-cols-auto d-md-flex align-items-center d-md-none">


                <div class="d-none justify-content-center p-3 p-md-2">
                   
                </div>
            </div>
         </div>

        <div class="row row-cols-auto d-md-flex align-items-center d-none d-md-block">
            <div class="d-none justify-content-center p-3 p-md-2">
                
            </div>
        </div>

    </div>
</nav>

<!-- Nav con Redes Sociales -->
 <div class="container">
    <div class="row row-cols-3 nav fixed-bottom shadow bg-dark d-flex align-items-center justify-content-between p-2 content-nav-rrss">
        
        <?php #VERSIÓN MÓVIL: Carrusel ?>
        <div id="socialCarousel" class="carousel slide carousel-mobile w-100" data-bs-ride="false">
            <div class="carousel-inner">
                <!-- Slide 1: Reforestamos México -->
                <div class="carousel-item active">
                    <div class="d-grid align-items-center social-section">
                        <div class="d-flex justify-content-center p-2 logo-rm-nav-bottom">
                            <img src="<?php echo get_template_directory_uri(); ?>/src/imgs/LOGO REFORESTAMOS VECTORES-01.png" class="img-fluid" alt="Reforestamos México">
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            <ul class="d-flex list-unstyled gap-3 m-0">
                                <li class="nav-item">
                                    <a href="https://www.facebook.com/ReforestamosMexico/" target="_blank" class="font-size-25 text-white">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://twitter.com/ReforestamosMx" target="_blank" class="font-size-25 text-white">
                                        <i class="bi bi-twitter-x"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.instagram.com/reforestamosmexico/" target="_blank" class="font-size-25 text-white">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.linkedin.com/company/reforestamos-mexico/" target="_blank" class="font-size-25 text-white">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.youtube.com/ReforestamosMex" target="_blank" class="font-size-25 text-white">
                                        <i class="bi bi-youtube"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.tiktok.com/@reforestamosmx?lang=es" target="_blank" class="font-size-25 text-white">
                                        <i class="bi bi-tiktok"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Slide 2: Supercívicos -->
                <div class="carousel-item">
                    <div class="d-grid align-items-center social-section">
                        <div class="d-flex justify-content-center p-2 logo-sc-nav-bottom">
                            <img src="<?php echo get_template_directory_uri(); ?>/src/imgs/logo-suuper-civicos.png" class="img-fluid" alt="Supercívicos">
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            <ul class="d-flex list-unstyled gap-3 m-0">
                                <li class="nav-item">
                                    <a href="https://www.facebook.com/Supercivicos" target="_blank" class="font-size-25 text-white">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.youtube.com/@LosSupercivicos" target="_blank" class="font-size-25 text-white">
                                        <i class="bi bi-youtube"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://x.com/supercivicosmx" target="_blank" class="font-size-25 text-white">
                                        <i class="bi bi-twitter-x"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Slide 3: Imperfect Project -->
                <div class="carousel-item">
                    <div class="d-grid align-items-center social-section">
                        <div class="d-flex justify-content-center p-2 logo-imperfect-nav-bottom">
                            <img src="<?php echo cmb2_get_option('opciones_del_tema', 'logo_imperfectproyect'); ?>" class="img-fluid" alt="Imperfect Project">
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            <ul class="d-flex list-unstyled gap-3 m-0">
                                <li class="nav-item">
                                    <a href="https://www.linkedin.com/company/imperfect-project/" target="_blank" class="font-size-25 text-white">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.instagram.com/imperfectprojectmx/" target="_blank" class="font-size-25 text-white">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controles del carrusel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#socialCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#socialCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>

        </div>

        <?php #VERSIÓN ESCRITORIO: Layout normal ?>
        <div class="row row-cols-3 align-items-center justify-content-start desktop-layout flex-grow-1">
            <?php #Reforestamos México ?>
            <div class="col-3 col-md-4 col-lg-3 d-grid align-items-center">
                <div class="d-flex justify-content-center p-2 logo-rm-nav-bottom">
                    <img src="<?php echo get_template_directory_uri(); ?>/src/imgs/LOGO REFORESTAMOS VECTORES-01.png" class="img-fluid" alt="Reforestamos México">
                </div>
                
                <div class="d-flex justify-content-center">
                    <ul class="d-flex list-unstyled gap-3 m-0">
                        <li class="nav-item">
                            <a href="https://www.facebook.com/ReforestamosMexico/" target="_blank" class="font-size-25 text-white">
                                <i class="bi bi-facebook"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://twitter.com/ReforestamosMx" target="_blank" class="font-size-25 text-white">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.instagram.com/reforestamosmexico/" target="_blank" class="font-size-25 text-white">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.linkedin.com/company/reforestamos-mexico/" target="_blank" class="font-size-25 text-white">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.youtube.com/ReforestamosMex" target="_blank" class="font-size-25 text-white">
                                <i class="bi bi-youtube"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.tiktok.com/@reforestamosmx?lang=es" target="_blank" class="font-size-25 text-white">
                                <i class="bi bi-tiktok"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <?php #Supercívicos ?>
            <div class="col-3 col-md-4 col-lg-3 d-grid align-items-center">
                <div class="d-flex justify-content-center p-2 logo-sc-nav-bottom">
                    <img src="<?php echo get_template_directory_uri(); ?>/src/imgs/logo-suuper-civicos.png" class="img-fluid" alt="Supercívicos">
                </div>
                
                <div class="d-flex justify-content-center">
                    <ul class="d-flex list-unstyled gap-3 m-0">
                        <li class="nav-item">
                            <a href="https://www.facebook.com/Supercivicos" target="_blank" class="font-size-25 text-white">
                                <i class="bi bi-facebook"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.youtube.com/@LosSupercivicos" target="_blank" class="font-size-25 text-white">
                                <i class="bi bi-youtube"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://x.com/supercivicosmx" target="_blank" class="font-size-25 text-white">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <?php #Imperfect Project ?>
            <div class="col-3 col-md-4 col-lg-3 d-grid align-items-center">
                <div class="d-flex justify-content-center p-2 logo-imperfect-nav-bottom">
                    <img src="<?php echo cmb2_get_option('opciones_del_tema', 'logo_imperfectproyect'); ?>" class="img-fluid" alt="Imperfect Project">
                </div>
                
                <div class="d-flex justify-content-center">
                    <ul class="d-flex list-unstyled gap-3 m-0">
                        <li class="nav-item">
                            <a href="https://www.linkedin.com/company/imperfect-project/" target="_blank" class="font-size-25 text-white">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.instagram.com/imperfectprojectmx/" target="_blank" class="font-size-25 text-white">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <?php #Correo (visible siempre) ?>
        <div class="text-white d-flex d-lg-none align-items-center justify-content-center me-3 container-mail">
            <a href="mailto:comunidad@vaporlosarboles.mx" class="text-white">
                <i class="bi bi-envelope-at" style="font-size:20px;"></i>
            </a>
            <a href="mailto:comunidad@vaporlosarboles.mx" class="text-white font-size-25 text-decoration-none ms-2">
                comunidad@vaporlosarboles.mx
            </a>
        </div>

        <div class="text-white d-none d-lg-flex align-items-center justify-content-end me-3 container-mail">
            <a href="mailto:comunidad@vaporlosarboles.mx" class="text-white">
                <i class="bi bi-envelope-at" style="font-size:20px;"></i>
            </a>
            <a href="mailto:comunidad@vaporlosarboles.mx" class="text-white font-size-25 text-decoration-none ms-2">
                comunidad@vaporlosarboles.mx
            </a>
        </div>
    </div>
 </div>
