<?php get_header(); ?>

<?php

if ((get_theme_mod('dav_breadcrumb') != false) && (get_theme_mod('dav_breadcrumb') == 1)) {

    if (function_exists('nav_breadcrumb')) nav_breadcrumb();
}

?>


<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


<?php

    $tour_type = preg_replace('#<a.*?>(.*?)</a>#i', '\1', get_the_term_list($post->ID,'tourtype','',', '));
    $tour_category = preg_replace('#<a.*?>(.*?)</a>#i', '\1', get_the_term_list($post->ID,'tourcategory','',', '));
    $tour_technic = preg_replace('#<a.*?>(.*?)</a>#i', '\1', get_the_term_list($post->ID,'tourtechnic','',', '));
    $tour_condition = preg_replace('#<a.*?>(.*?)</a>#i', '\1', get_the_term_list($post->ID,'tourcondition','',', '));


    $tour_meta = get_post_meta($post->ID);

    $persona = get_post($tour_meta['acf_tourpersona'][0]);

    $persona_meta = get_post_meta($tour_meta['acf_tourpersona'][0]);

    ?>

    <div class="container">
        <div class="container-content">

        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <h1 style="margin-bottom: 5px;"><?php the_title(); ?></h1>
                <span class="tour-data">

                    <?php
                    if ($tour_type != '') {echo '<strong>'.$tour_type.'</strong>';}
                    if ($tour_category != '') {echo ' | '.'<strong>'.$tour_category.'</strong>';}
                    ?>

                </span>
            </div>
        </div>
        <div class="row" style="margin-top: 15px;">
            <div class="col-xs-12 col-sm-8" id="content">
                <p class="lead text-primary"><?php echo $tour_meta['acf_tourcompact'][0]; ?></p>
                <?php the_content(); ?>
            </div>
            <div class="col-sm-4">

                <div class="card card-price bg-light mb-3">
                    <div class="card-header bg-dark pt-1">
                        <h2>Tourendetails</h2>
                    </div>
                    <div class="card-body">
                        <div class="price-body pt-2">

                            <p class="lead text-right"><strong><?php echo substr(get_field('acf_tourstartdate'),0,2).'.'.substr(get_field('acf_tourstartdate'),3,2).'.'.substr(get_field('acf_tourstartdate'),6,4);

                                if((get_field('acf_tourstartdate') != '') && (get_field('acf_tourallday') == 1)) {

                                    echo ' - ';
                                    echo substr(get_field('acf_tourenddate'),0,2).'.'.substr(get_field('acf_tourenddate'),3,2).'.'.substr(get_field('acf_tourenddate'),6,4);
                                }
                                ?>
                                
                                </strong></p>

                            <div class="d-flex flex-sm-column">
                                <div class="p-1 flex-grow-1">Dauer: </div>
                                <div class="p-1 text-right"><strong><?php echo get_field('acf_tourtime'); ?></strong></div>
                            </div>
                            <div class="d-flex flex-sm-column">
                                <div class="p-1 flex-grow-1">Kilometer: </div>
                                <div class="p-1 text-right"><strong><?php echo get_field('acf_tourkilometer'); ?></strong></div>
                            </div>
                            <div class="d-flex flex-sm-column">
                                <div class="p-1 flex-grow-1">Höhenmeter: </div>
                                <div class="p-1 text-right"><strong><?php echo get_field('acf_tourhohenmeter'); ?></strong></div>
                            </div>
                            <div class="d-flex flex-sm-column">
                                <div class="p-1 flex-grow-1">Kondition: </div>
                                <div class="p-1 text-right"><strong><?php echo $tour_condition; ?></strong></div>
                            </div>
                            <div class="d-flex flex-sm-column">
                                <div class="p-1 flex-grow-1">Technik: </div>
                                <div class="p-1 text-right"><strong><?php echo $tour_technic; ?></strong></div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

                if(get_field('acf_tourpersona') != '') {

                    echo '
                    <div class="card card-touren bg-dark">
                        <div class="row m-3 align-self-stretch">
                            <div class="col-12 p-0">'.
                                get_the_post_thumbnail($persona->ID, 'post-thumbnail', array('class' => 'img-fluid rounded-circle'))
                            .'</div>
                            <div class="col-12 p-0 pt-3 text-center">
                                <span class="person-name">'.$persona->post_title.'</span>
                                <span class="person-title">'.$persona_meta['persona_daten_funktion'][0].'</span>
                                <hr>
                            </div>
                        </div>
                        <div class="row m-3" style="margin-top: 0 !important;">
                            <div class="col-12 p-0 p-lg-0">
                                <p>'.$persona->post_content.'</p>

                            </div>
                        </div>
                    </div>
                </div>';

                }

                ?>

        </div>
        </div>
    </div>

<?php endwhile; else : ?>

    <div class="container pt-5">
        <div class="row">
            <div class="col-12">
                <h1>Entschuldigung!</h1>
                <p>Leider gibt es hier nicht den gewünschten Inhalt.</p>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
