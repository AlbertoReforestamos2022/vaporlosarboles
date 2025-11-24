<!-- section Hero -->
<style>
    .item-carrusel {
        color: rgba(33, 137, 30, 1);
    }

    .item-carrusel i {
        font-size: 2rem;
    }



</style>

<?php
    // printf('<pre>%s</pre>', var_export( get_post_custom( get_the_ID() ), true ));
    $texto_hero = get_post_meta( get_the_ID(), 'texto_uno_hero', true);
    $img_arturo_hero = get_post_meta( get_the_ID(), 'img_arturo_hero', true);
    $imagen_fondo_centinelas = get_post_meta( get_the_ID(), 'imagen_fondo_centinelas', true);
    $autor_fondo_centinelas = get_post_meta( get_the_ID(), 'autor_fondo_centinelas', true);


    /* Condicionales */

    // Texto hero
    $condicional_texto_hero = !empty($texto_hero) ? $texto_hero : '
        <p class="h5 text-white fw-light"> 
            <span class="text-white fw-semibold">VaXlosÁrboles</span> es una iniciativa de <span class="text-white fw-semibold">Supercívicos</span>, <span class="text-white fw-semibold">Reforestamos</span> e <span class="text-white fw-semibold">Imperfect Project</span>, diseñada para crear conciencia y movilizar acciones que protejan el arbolado y bosques urbanos de México. 
        </p>

        <br>

        <p class="h5 text-white fw-light">
            La campaña busca empoderar a la ciudadanía, a las autoridades y al sector privado para que reconozcan la importancia de estos espacios en el entorno urbano, así como su relación con la salud, la resiliencia climática y la calidad de vida.
        </p>                  
    ';

    // Imagen arturo
    $condicional_img_arturo = !empty($img_arturo_hero) ? '<img src="'. $img_arturo_hero .'" class="img-fluid" width="300"alt="">' : '<img src="'. get_template_directory_uri() .'/src/imgs/imagen-arturo.png" class="img-fluid" width="300"alt="">';

    // fotografía centinelas (fondo hero)
    $condicional_imagen_fondo_centinelas = !empty($imagen_fondo_centinelas) ? $imagen_fondo_centinelas : get_template_directory_uri();'/src/imgs/5490_urbano_isaacEsquivelMonroy_2707_2022-08-31_original.jpeg';

    // Autor fotgrafía Centinelas
    $condicional_autor_fondo_centinelas = !empty($autor_fondo_centinelas) ? $autor_fondo_centinelas : '
        <p>Autor: Isaac Esquivel Monroy</p>
        <p>Fotografía participante del <span class="span-credits"> Concurso visión Forestal y Centinela del Tiempo 2022 </span> </p>
    ' ; 

?>

<div class="hero-index first-content-after-menu d-grid align-items-center shadow" style="background: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('<?php echo $condicional_imagen_fondo_centinelas; ?>'); background-size: cover; background-position: 14% 25%; background-repeat: no-repeat; background-attachment: fixed; ">
    <div class="container hero-index-about" style="padding-top: 50px;">
        <div class="row row-cols-1 row-cols-lg-2 flex-row-reverse justify-content-end align-items-center">
            <div class="col in-right hero_text">
                <div class="px-4 py-5 text-justify text-white" > 
                    <?php echo wpautop($condicional_texto_hero); ?>
                </div>
            </div>

            <div class="col d-flex justify-content-center in-left hero_img-arturo">
                <?php echo $condicional_img_arturo; ?> 
            </div>           
        </div>

        <!-- Créditos de la foto -->
            <div class="card-creditos">
                <div class="card-creditos-header text-white">
                    <?php echo wpautop($condicional_autor_fondo_centinelas); ?>
                </div>
            </div>

    </div>

    <!-- Logos of member´s proyect -->
    <?php
        $reforestamos_logo = get_post_meta( get_the_ID(), 'reforestamos_logo', true);
        $supercivicos_logo = get_post_meta( get_the_ID(), 'supercivicos_logo', true);
        $imperfect_proyect_logo = get_post_meta( get_the_ID(), 'imperfect_proyect_logo', true);

        /** Condicionales  */
        // Condicional logo Reforestamos México 
        $condicional_reforestamos_logo = !empty($reforestamos_logo) ? $reforestamos_logo : get_template_directory_uri();'/src/imgs/LOGO-REFORESTAMOS-FONDO-TRANSPARENTE.png';

        // Condicional logo Supercivicos
        $condicional_supercivicos_logo = !empty($supercivicos_logo) ? $supercivicos_logo : get_template_directory_uri();'/src/imgs/logo-suuper-civicos.png';

        #Condicional logo Imperfect Proyect 
        $condicional_imperfect_proyect = !empty($imperfect_proyect_logo) ? $imperfect_proyect_logo : get_template_directory_uri(); '/src/imgs/logo-imperfect-project.png';

    ?>

    <div class="hero-logos shadow" style="">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 justify-content-lg-between justify-content-center">
                <div class="col d-grid align-items-center justify-content-center p-3 p-md-auto in-left-three">
                    <img src="<?php echo $condicional_reforestamos_logo ?>" width="140" class="img-fluid" alt="Logo Reforestamos México">   
                </div>
                <div class="col d-grid align-items-center justify-content-center p-3 p-md-auto in-left-two"> 
                    <img src="<?php echo $condicional_supercivicos_logo; ?>" width="200" class="img-fluid" alt="Logo Supercívicos">                  
                </div>
                <div class="col d-grid align-items-center justify-content-center p-3 p-md-auto in-left-one">
                    <img src="<?php echo $condicional_imperfect_proyect; ?>" width="150" class="img-fluid" alt="Logo Imperfect Proyect">               
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Action sections (Videos YT - Tik-Tok (Videos) - btn twitter(X)) -->
<div class="hero-actions" id="actions-section">
    <div class="text-acciones" style="margin-top: 50px; margin-bottom: 50px;">
        <h2 class="text-center verde-primary display-4 fw-bold"> 
         Acciones
        </h2>
    </div>

    <div class="container">
        <?php $videos_acciones_yt = get_post_meta( get_the_ID(), 'seccion_plugin_yt', true); ?>

        <?php echo do_shortcode($videos_acciones_yt);  ?>

    </div>

    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <?php $video_mas_reciente = get_post_meta( get_the_ID(), 'video_reciente', true); ?>
        <?php $videos_tik_tok = get_post_meta( get_the_ID(), 'vpla_group_videos_feed_tik_tok', true)?>

        <div class="row row-cols-1 row-cols-lg-2 justify-content-center">
            <div class="col">
                <div class="carousel slide" id="tiktok_feed_carrusel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="card border-0 shadow">
                                    <?php
                                        if(!empty($video_mas_reciente)) {
                                            echo $video_mas_reciente ; 
                                        }
                                    ?>
                            </div>
                        </div>

                        <?php 
                            foreach($videos_tik_tok as $video) { ?>
                                <div class="carousel-item">
                                    <div class="card border-0 shadow">
                                        <?php
                                            echo $video['video_id']; 
                                        ?>
                                    </div>
                                </div>
                            <?php
                            }

                        ?>                        
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#tiktok_feed_carrusel" data-bs-slide="prev">
                        <span class="item-carrusel">
                            <i class="bi bi-arrow-left-circle-fill"></i>
                        </span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#tiktok_feed_carrusel" data-bs-slide="next">
                        <span class="item-carrusel">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </span>
                    </button>
                </div>

            </div>
               
        </div> 
    </div>

    <!-- Incorporar mapa de acciones -->
    <!-- Mapa de resultados 2da etapa (trabajarlo) -->
    <div class="container d-none" style="margin-top: 40px;">
        <p class="text-start h2" style="color: #2C8E2A!important;" >Conoce los lugares </br> donde se está tomando acción </p>

        <div class="row row-cols-1 row-cols-lg-2 flex-row-reverse justify-content-center align-items-center">
            <!-- cards acciones -->
            <div class="col-12 col-lg-4 d-flex justify-content-center">
                <div class="card border-0 bg-transparent">
                    <p class="text-center h3 text-secondary">Mapa de acciones </p>
                    <div class="row row-cols-1 gap-3 bg-white actions-content-map" id="acciones_map">
   

                    </div> 
                </div>               
            </div>

            <!-- Mapa acciones-->
            <div class="col-12 col-lg-8 py-3">
                <div class="card d-flex justify-content-center border-0">
                    <div class="shadow" id="actionsMap" style="height: 600px; max-width:800px; border-radius: 20px;">

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Video Próximante  -->



<?php # Directorio Verde ?>
<div class="container" style="margin-top: 40px;" >
    <p class="text-start h2" style="color: #2C8E2A!important;" >Conoce nuestro </br> Directorio Verde </p>

    <div class="row row-cols-1 row-cols-lg-2 flex-row-reverse justify-content-center align-items-center "  id="directorio_content"> 
        <?php # Cards especialistas content?>
        <div class="col col-lg-4">
            <div class="row row-cols-1">
                <?php ## Filtros de busqueda ?>
                <div class="col">
                    <div class="row">
                        <?php ## Seleccionar por estado ?>
                        <div class="col-6 select-option" stye="margin-top: 5px; margin-bottom: 5px;">
                            <h4 class="text-secondary"> Selecciona por estado </h4>
                            <select class="bg-primary border-0 rounded text-white p-2" value="Filtro por estado" name="states-option" id="states-option">
                            </select>
                        </div>
                        
                        <?php ## Seleccionar por especialidada ?> 
                        <div class="col-6 select-option" stye="margin-top: 5px; margin-bottom: 5px;">
                            <h4 class="text-secondary"> Selecciona por especialidad </h4>
                            <select class="bg-primary border-0 rounded text-white p-2" value="Filtro por especialidad" name="speciality-option" id="speciality-option">
                            </select>
                        </div>
                    </div>
                
                </div> 
                
                <?php # Resultados ?>
                <div class="col-12">
                    <div class="resultados" id="resultados_encontrados">
                    </div>
                </div>

                <!-- cards acciones -->
                <div class="col d-flex justify-content-center">
                    <div class="card border-0 bg-transparent">
                        <div class="row justify-content-center bg-white actions-content-map" id="directorio_cards">
                            <?php ## Llenado de cards con la especialidad ?>

                        </div> 
                    </div>               
                </div>            
            </div>
        </div>

        <?php # Mapa acciones ?>
        <div class="col col-lg-8 py-3">
            <div class="card d-flex justify-content-center border-0">
                <div class="shadow" id="map" style="height: 600px; max-width:800px; border-radius: 20px;">

                </div>
            </div>
        </div>

        <?php # Contenido formulario ?>
        <div class="formulario_content" id="formulario_content">
            <h2 class="text-center text-primary">Conoce nuestro Directorio verde </h2>
            <div id="formulario-directorio" class="formulario-directorio">
                <?php # Agregar formaulario?>
                <form id="content-formulario" class="content-formulario" method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
                    <?php wp_nonce_field('submit_directorio_verde_form', 'formulario_directorio_verde'); ?>

                    <input class="form-label" type="text" name="nombre" placeholder="Nombre completo" require>
                    <input class="form-label" type="email" name="correo" placeholder="Correo electrónico" required>
                    <button class="btn btn-primary btn-formulario-directorio-verde" type="submit">Ver especialistas</button>
                </form>

                <div id="mensaje-directorio-verde">

                </div>

                <div class="loading-content">
                        <span class="dot-loading"></span>
                        <span class="dot-loading"></span>
                        <span class="dot-loading"></span>
                        <span class="dot-loading"></span>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Calendario de eventos -->
<div class="container" style=" padding-top: 70px; padding-bottom: 100px;" id="events-section">
    <h2 class="text-center verde-primary fw-bold"> Calendario de Actividades </h2>

    <?php $shortcode_calendario = !empty(get_post_meta( get_the_ID(), 'shorcode_calendario', true)) ? get_post_meta( get_the_ID(), 'shorcode_calendario', true) : ''; ?>   
    

    <div class="row justify-content-center">
        <div class="col">
            <?php echo do_shortcode($shortcode_calendario); ?>
        </div>
    </div>
        
</div>

<!-- Guides tools  --> 
<?php
    #sección Naturalista
    # Array sección naturalist
    $array_Naturalist = [
        'titulo' => get_post_meta( get_the_ID(), 'naturalist_titulo_logo', true),
        'icono' => get_post_meta( get_the_ID(), 'naturalist_icono', true),
        'logo_color' => get_post_meta( get_the_ID(), 'naturalist_logo_color', true),
        'logo_blanco' => get_post_meta( get_the_ID(), 'naturalist_logo_blanco', true),
        'descripcion' => get_post_meta( get_the_ID(), 'descripcion_naturalist', true),
        'link' => get_post_meta( get_the_ID(), 'link_sitio_naturalist', true),
    ];
    
    # Sección IDÁrbol
    $array_IDArbol = [
        'titulo' => get_post_meta(get_the_ID(), 'idarbol_titulo', true),
        'logo'   => get_post_meta(get_the_ID(), 'idarbol_logo', true),
        'descripcion' => get_post_meta(get_the_ID(), 'descripcion_idarbol', true),
        'link_dscarga_ios' => get_post_meta(get_the_ID(), 'link_descarga_ios_idarbol', true),
        'link_descarga_android' => get_post_meta(get_the_ID(), 'link_descarga_android_idarbol', true),
    ]; 

    # Sección Mi Policia
    $array_MiPolicia_App = [
        'titulo' => get_post_meta(get_the_ID(), 'mi_policia_titulo', true),
        'logo'  => get_post_meta(get_the_ID(), 'mi_policia_logo', true),
        'descripcion' => get_post_meta(get_the_ID(), 'descripcion_mi_policia', true),
        'link_sitio_web' => get_post_meta(get_the_ID(), 'link_sitio_mi_policia', true),
    ]; 

    # Sección Guia sobre el arbolado urbano (Sin pop-up)
    $array_guia_arbolado = [
        'titulo' => get_post_meta(get_the_ID(), 'titulo_guia', true), 
        'link' => get_post_meta(get_the_ID(), 'documento_guia_arbolado', true),
    ];

    # Sección Capacitación para el manejo del arbolado urbano
    $array_capacitacion_arbolado_urbano = [
        'titulo' => get_post_meta(get_the_ID(), 'titulo_capactitacion_arbolado', true), 
        'link' => get_post_meta(get_the_ID(), 'documento_capacitacion_arbolado', true),
    ]; 

    # Sección directorio verde (con pop-up, formulario para descarga)
    $array_directorio_verde = [
        'titulo' => get_post_meta(get_the_ID(), 'directorio_verde_titulo', true),
        'logo'   => get_post_meta(get_the_ID(), 'directorio_verde_logo', true),
        'descripcion' => get_post_meta(get_the_ID(), 'descripcion_directorio_verde', true),
        'link' => get_post_meta(get_the_ID(), 'link_directorio_verde', true),
    ]; 

    ## Meter los valores en un array 

    ## funcion para la lista de los arrays
    function lista_herramientas($lista_arrays) { ?>

        <?php ## Lista porp-ups ?>   

        <?php  ## lista con pop-ups  
            if($lista_arrays['descripcion'] || !empty($lista_arrays['descripcion']) && !$coincidencia_naturalista ) { ?>
                <?php 
                    # !Naturalist
                    $titulos_naturalista = [
                        'naturalist', '!Naturalist', 'Naturalist', 'NATURALIST', '!NATURALIST',
                        'naturalista', '!Naturalista', 'Naturalista', 'NATURALISTA', '!NATURALISTA',
                        '¡Naturalist', 'Naturalist', 'NATURALIST', '¡NATURALIST',
                        'naturalista', '¡Naturalista', 'Naturalista', 'NATURALISTA', '¡NATURALISTA'
                    ];

                    $coincidencia_naturalista = in_array($lista_arrays['titulo'], $titulos_naturalista); 

                    if($coincidencia_naturalista) { ?>
                        <li class="list-group-item border-0" >
                            <button type="button" class="btn btn-outline-success m-2 text-center w-100 " id="btn<?php echo sanitize_title($lista_arrays['titulo']);?>">
                                <img src="<?php echo $lista_arrays['icono']; ?>" width="30" class="img-fluid" style="border-radius: 10px;" alt=""> 

                                <img src="<?php echo $lista_arrays['logo_blanco']; ?>" width="90" class="img-fluid img-white" alt=""> 
                                <img src="<?php echo $lista_arrays['logo_color']; ?>" width="90" class="img-fluid img-black" alt=""> 

                            </button> 
                                                            
                        </li>       
                    <?php        
                    } else {
                    ?>
                        <li class="list-group-item border-0" >
                            <button type="button" class="btn btn-outline-success m-2 text-center w-100 d-flex align-items-center justify-content-center" id="btn<?php echo sanitize_title($lista_arrays['titulo']);?>">
                                <img src="<?php echo $lista_arrays['logo']; ?>" class="img-fluid " width="30" alt="">   
                                <p class="text-success m-0 ms-3 p-0 h6"> <?php echo $lista_arrays['titulo'];?></p>
                            </button>

                        </li>
                    <?php
                    }
                ?>            

        <?php } ?> 


       <?php  
            # lista link directo (Sin pop up)
            if(!$lista_arrays['descripcion'] || empty($lista_arrays['descripcion'])) { ?>
                <li class="list-group-item border-0">
                    <a href="<?php echo $lista_arrays['link']?>" target="_blank" class="btn btn-outline-success m-2 text-center w-100">
                        <p class="vere-primary h6">👉 <?php echo $lista_arrays['titulo']?></p>
                    </a>

                </li>

        <?php
            }
    }

    function pop_up_herramientas($lista_arrays) { 
        ## función para los pop-ups de la herramientas
        ## se pueden meter todos los arrays dentro de uno general...... o hacer funciones individuales para cada caso...... 
        ## Ve la posibilidad de hacerlo dinámico
        if(!empty($lista_arrays['descripcion']) || !$lista_arrays['descripcion']) {
        ?> 
        <?php # Directorio verde ?>
            <div class="custom-modal" id="modal<?php echo sanitize_title($lista_arrays['titulo']); ?>">
                <div class="custom-modal-content">
                    <div class="d-flex justify-content-center align-items-start" style="margin-bottom: 50px;">
                        <img src="<?php echo $lista_arrays['logo']; ?>" width="40" class="img-fluid" alt=""> 
                        <h3 class="text-primary"> <?php echo $lista_arrays['titulo'] ?></h3>
                    </div>
                    
                    <div class="container" style="text-align: justify;">
                        <?php echo $lista_arrays['descripcion']; ?> 
                    </div>
                    <?php 
                    if($lista_arrays['titulo'] == 'Directorio Verde'){ ?>
                        <div class="container">
                            <h1 class="text-center text-primary">En mantenimiento</h1>
                        </div>
                    <?php 
                    } ?>


                    <div class="d-flex justify-content-between " style="margin-top: 50px;">
                        <button type="button" class="btn btn-danger" id="closeModal<?php echo sanitize_title($lista_arrays['titulo']); ?>"> Cerrar</button>
                        <?php 
                            if($lista_arrays['titulo'] !== 'Directorio Verde'){ ?>
                                <a class="btn btn-success" target="_blank" href="<?php echo $lista_arrays['link'];?>">Conoce más</a>
                        <?php    
                        } else { 
                            echo '';    
                        }
                        ?>

                    </div>
                </div>
            </div>            
        <?php
        }         
    }

    function contenido_herramientsa($array_Naturalist, $array_IDArbol, $array_MiPolicia_App, $array_guia_arbolado, $array_capacitacion_arbolado_urbano, $array_directorio_verde) {
        ## Lista de opciones
        ?>
        <?php 
            pop_up_herramientas($array_Naturalist);
            pop_up_herramientas($array_IDArbol); 
            pop_up_herramientas($array_MiPolicia_App); 
            # pop_up_herramientas($array_guia_arbolado); 
            pop_up_herramientas($array_directorio_verde); 
        ?>

        <ul class="list-group border-0" style="position: absolute; bottom: -260px; ">
            <?php lista_herramientas($array_Naturalist);  ?>
            <?php lista_herramientas($array_IDArbol);  ?>
            <?php lista_herramientas($array_MiPolicia_App);  ?>
            <?php lista_herramientas($array_guia_arbolado);  ?>
            <?php lista_herramientas($array_capacitacion_arbolado_urbano);  ?>
            <?php lista_herramientas($array_directorio_verde);  ?> 

        </ul>

        <?php

        #Agregar condicional para el botón 2 del sitio

        #Agregar el script con los nuevos pop-ups

        #Agregar el formulario para poder descargar el directorio.

        # Agregar los scripts
        ?>
            <script>
                document.addEventListener('DOMContentLoaded', ()=> {
                    /* custom modals tools */
                    function openModal(btnOpen, modal, btnClose) {
                        const backdropContent = document.querySelector("#customBackdrop");

                        document.getElementById(btnOpen).addEventListener("click", function () {
                            document.getElementById(modal).style.display = "block";
                            backdropContent.classList.remove('d-none'); 
                        }); 

                        document.getElementById(btnClose).addEventListener("click", function () {
                            document.getElementById(modal).style.display = "none";
                            backdropContent.classList.add('d-none'); 
                        });

                    }
    
                    /** Modal Nauralist */
                    openModal("btn<?php echo sanitize_title($array_Naturalist['titulo']); ?>", "modal<?php echo sanitize_title($array_Naturalist['titulo']); ?>", "closeModal<?php echo sanitize_title($array_Naturalist['titulo']); ?>");
                    openModal("btn<?php echo sanitize_title($array_IDArbol['titulo']); ?>", "modal<?php echo sanitize_title($array_IDArbol['titulo']); ?>", "closeModal<?php echo sanitize_title($array_IDArbol['titulo']); ?>"); 
                    openModal("btn<?php echo sanitize_title($array_MiPolicia_App['titulo']); ?>", "modal<?php echo sanitize_title($array_MiPolicia_App['titulo']); ?>", "closeModal<?php echo sanitize_title($array_MiPolicia_App['titulo']); ?>");
                    openModal("btn<?php echo sanitize_title($array_directorio_verde['titulo']); ?>", "modal<?php echo sanitize_title($array_directorio_verde['titulo']); ?>", "closeModal<?php echo sanitize_title($array_directorio_verde['titulo']); ?>");
                    // openModal("btnArbolEncolonia", "modalArbolEncolonia", "closeModalArbolEncolonia"); 
                    // openModal("btnPlantarArbol", "modalPlantarArbol", "closeModalPlantarArbol"); 


                    // Cambiar img cuando pasemos el mouse sobre la imágen de Naturalist
                    const btnNaturalist = document.querySelector('#btn<?php echo sanitize_title($array_Naturalist['titulo']); ?>');
                    const naturalistImgWhite = document.querySelector('#btn<?php echo sanitize_title($array_Naturalist['titulo']); ?> .img-white');
                    const naturalistImgBlack = document.querySelector('#btn<?php echo sanitize_title($array_Naturalist['titulo']); ?> .img-black');

                    naturalistImgWhite.classList.add('d-none');

                    btnNaturalist.addEventListener('mouseover', ()=>{
                        naturalistImgWhite.classList.remove('d-none');
                        naturalistImgBlack.classList.add('d-none');

                    })

                    btnNaturalist.addEventListener('mouseout', ()=>{
                        naturalistImgWhite.classList.add('d-none');
                        naturalistImgBlack.classList.remove('d-none');
                    })                    
                })
            </script>

            <style>
                .custom-backdrop  {
                    top: -330px!important;
                }
            </style>
        <?php
    
    }

?> 

    <?php # Herramientas ?>
    <div class="hero-tools" style=" padding-top: 70px; padding-bottom: 100px;" id="tools-section">
        <div class="text-acciones" style="margin-bottom: 100px;">
            <h2 class="text-center display-4 verde-primary fw-bold"> Herramientas </h2>
        </div>


        <div class="subhero-tools" style="background: rgba(33, 137, 30, .8);" >
            <!-- Contenedor  -->
            <div class="container container-tools ">
                <div class="row row-cols-1 row-cols-lg-2 justify-content-center justify-content-md-evenly sections-tools">

                    <!-- Información de la sección -->
                    <div class="col d-grid align-items-center info-section">
                        <div class="card d-grid align-items-center bg-transparent border-0">
                            <div class="card-body bg-transparent">               

                                <h2 class="text-center text-white fw-light">
                                    Conoce las herramientas disponibles para ciudar y registrar los árboles de tu ciudad
                                </h2>
                            </div>

                        </div>

                    </div>

                    <?php #sección celular ?>  
                    <div class="col d-flex justify-content-center">

                        <?php # card telefono  ?>
                        <div class="card border-0 bg-transparent container-movil-tool">
                            <img src="<?php echo get_template_directory_uri(); ?>/src/imgs/movil_15.png" class="img-fluid img-content-tool" alt="">

                            <div class="letter-content-tool">

                                <div class="custom-backdrop d-none" id="customBackdrop"></div>
                                <?php #Modales dentro del celular ?>

                                    <?php echo contenido_herramientsa($array_Naturalist, $array_IDArbol, $array_MiPolicia_App, $array_guia_arbolado, $array_capacitacion_arbolado_urbano, $array_directorio_verde); ?>

                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>

    <?php # Sponsor Section ?>
    <div class="container" id="sponsors-section">
        <div class="text-acciones" style="margin-top: 50px;">
            <h2 class="text-center display-4 verde-primary fw-bold"> 
                Aliados
            </h2>
        </div>

        <div class="row row-cols-1 row-cols-md-auto justify-content-evenly align-items-center my-5 p-4 p-md-0 content_sponsors_logo" style="margin-top: 80px; margin-bottom: 80px;">
            <div class="col shadow d-flex justify-content-center my-3">
                <div class="card d-grid align-items-center justify-content-center border-0"> 
                    <img src="<?php echo get_template_directory_uri(); ?>/src/imgs/LOGO_BIMBO_2025.png" class="img-fluid" width="200" alt="Logo Grupo Bimbo">
                </div>
                
            </div>

            <div class="col shadow my-3">
                <div class="card d-grid align-items-center border-0 ">
                    <div class="card-body">
                        <h2 class="fw-bold text-center">Fundación Pepe</h2>
                    </div>
                
                </div>
                
            </div>        
        </div>
    </div>

    <?php # Sección reporta ?>
    <div class="hero-reporta" id="report-section" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo get_template_directory_uri(); ?>/src/imgs/Centinelas_Dinamos_CDMX_BrandonTovar_2016_Centinelas_ArbolUrbano.jpg'); background-size: cover; background-position: 10% 80%; background-repeat: no-repeat; background-attachment: fixed; padding-top: 20px; padding-bottom:20px;">
        <div class="container" style="margin-top: 130px; margin-bottom: 80px;">
            <div class="text-acciones" style="margin-top: 50px; margin-bottom: 50px;">
                <h2 class="text-center text-white h1 fw-bold">
                    ¿Has sido testigo de alguna mala práctica o irregularidad en el arbolado urbano? 
                </h2>

            </div>


            <div class="row row-cols-1 justify-content-evenly ">

                <div class="col d-grid align-items-center justify-content-center" >
                    <div class="card border-0 bg-transparent">

                        <p class="text-center h5 text-white fw-light">
                            Tu participación es muy importante para mejorar nuestro entorno. Si has observado alguna mala práctica o irregularidad en el arbolado de la Ciudad de México, puedes hacer tu reporte directamente a la PAOT.
                            
                        </p>
                        <p class="text-center h5 text-white fw-light" style="margin-top:20px; margin-bottom:20px;">Haz tu reporte a la PAOT a través del siguiente botón:</p>
                    </div>
                    
                </div>

                <div class="col-12 d-flex justify-content-center" style="margin-top: 50px; margin-bottom: 50px;">

                    <button class="btn btn-success" style="width: 300px;padding: 15px; border-radius: 50px!important; font-size: 22px;">
                        <a class="text-white text-center text-decoration-none" target="_blank" href="https://paot.org.mx/denunciantes/inicia-tu-denuncia.php">Reporta</a>
                    </button>
                        
                </div>
                
            </div>
            
        </div>
    </div>

    <?php # Sección donativo ?>
    <div class="container d-none" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="text-acciones" style="margin-top: 50px; margin-bottom: 50px;">
            <h2 class="text-center display-4 verde-primary fw-bold">
                ¡Súmate y obtén una recompensa!
            </h2>
        </div>

        <div class="row justify-content-center">
            <div class="col d-flex justify-content-center">
                   
            </div>
        </div>
    </div>


    <?php # Sección Formulario ?>
    <div class="container container_contacto-ac" id="recognize-section" style="margin-top: 200px; margin-bottom: 200px;">
        <h1 class="text-center display-4 verde-primary fw-bold">Reconoce </h1>

        <div class="row justify-content-center text-formulario"> 
            <div class="col-7">
                <p class="text-center h5 text-secondary">
                    Texto para para explicar lo del reconocimiento de árboles.
                </p>
            </div>
        </div>

        <!-- Agregar las categorias del reconocimiento  -->
        <form class="container formulario_reconoce" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">
            <?php wp_nonce_field('submit_contact_form', 'formulario_reconoce'); ?>
            
            <div class="row justify-content-center my-4">
                <div class="col-12 col-md-8 col-lg-6">
                    <label class="form-label text-secondary h5" for="name">Nombre completo:</label>
                    <input class="form-control" type="text" id="name" name="name" required>
                </div>
            </div>

            <div class="row justify-content-center my-4">
                <div class="col-12 col-md-8 col-lg-6">
                    <label class="form-label text-secondary h5" for="email">Correo:</label>
                    <input class="form-control" type="email" id="email" name="email" >
                </div>
            </div>
            
            <div class="row justify-content-center my-4">
                <div class="col-12 col-md-8 col-lg-6">
                    <label class="form-label text-secondary h5" for="afterPhoto">Foto del después:</label>
                    <input class="form-control" type="file" id="afterPhoto" accept="image/*" name="afterPhoto" required>
                </div>
            </div>

            <div class="row justify-content-center my-4">
                <div class="col-12 col-md-8 col-lg-6">
                    <label class="form-label text-secondary h5" for="message">Describe la acción realizada:</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
            </div>

            <div class="row justify-content-center my-4">
                <div class="col-12 col-md-8 col-lg-6">
                    <input class="btn btn-success text-white w-100 " type="submit" name="formulario_reconoce" value="Enviar reconocimiento">
                </div>
            </div>
        </form>

        <!-- Mensaje  -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 my-5">
                    <div class="mensaje-formulario card border-0 p-3 text-white text-center" id="mensaje-formulario" style="opacity: 0; transition: opacity 0.5s ease-out;">

                    </div>
                </div>
            </div>
        </div>

    </div>
