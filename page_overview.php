<?php /* Template Name: Übersichtsseite */ ?>

<?php get_header(); ?>

<?php

if ((get_theme_mod('dav_breadcrumb') != false) && (get_theme_mod('dav_breadcrumb') == 1)) {

    if (function_exists('nav_breadcrumb')) nav_breadcrumb();
}

?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="container">
        <div class="container-content">

            <div class="row content-divider">
                <div class="col-12">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="col-12 col-sm-10 offset-sm-1 mt-5">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php

                $pages_sort = get_field("dav_sortorder_pages");


                switch ($pages_sort) {

                    case "s" : $sortorder = 'menu_order'; break;
                    case 'a' : $sortorder = 'post_title'; break;
                    default: $sortorder = 'post_title'; break;
                }


                $pages = get_pages(array('parent' => $post->ID, 'sort_column' => $sortorder, 'post_status' => 'publish', 'sort_order' => 'asc', 'hierarchical' => 0));

                $pagelist = array();

                foreach ($pages as $page) {

                    $pageelem = array('page_id' => $page->ID,'page_title' => $page->post_title,'page_img' => get_the_post_thumbnail_url($page->ID,'thumbnail'));

                    array_push($pagelist,$pageelem);

                }

                if ($pagelist != null) {

                    $imageview = get_field('dav_imageview_pages');

                        if($imageview == true) {

                            $card_images = 'card-noimage';

                        } else {

                            $card_images = '';

                        }




                    foreach ($pagelist as $page) {


                        $pagelink = get_permalink($page["page_id"]);

                        if($page['page_img'] == null) {
                            $img = get_template_directory_uri().'/images/placeholder_page.png';
                        } else {$img = $page['page_img'];}

                        echo '<div class="col-sm-6 col-lg-4 pt-4" id="content-list">
                    <div class="card '.$card_images.'">';

                        if($imageview != true) {
                            echo '<a href="' . $pagelink . '"><img class="card-img-top" src="' . $img . '" alt="Artikelbild zu Artikel ' . get_the_title() . '"></a>';
                        }

                        echo '
                        <div class="card-body card-page-overview">
                            <a href="'.$pagelink.'"><h2 class="news-head">'.$page["page_title"].'</h2></a>
                            <a href="'.$pagelink.'"><button class="btn btn-news"><i class="fas fa-chevron-right"></i></button> </a>
                        </div>
                    </div>
                </div>';

                    }

                } else {}


                ?>
            </div>
        </div>
    </div>

<?php endwhile; else : ?>





    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Entschuldigung!</h1>
                <p>Leider gibt es hier nicht den gewünschten Inhalt.</p>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php get_footer(); ?>
