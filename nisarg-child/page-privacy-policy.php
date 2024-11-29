<?php
/**
 * Template for Privacy Policy Page
 *
 * @package Nisarg
 */

get_header(); 
?>

<div class="container">
    <div class="row">
        <!-- Contenuto principale senza sidebar -->
        <div id="primary" class="col-md-12 content-area">
            <main id="main" role="main">
                <?php
                // Verifica se è la pagina Privacy Policy
                if ( is_page( 'privacy-policy' ) ) :
                    while ( have_posts() ) : the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-content' ); ?>>
                            <header class="entry-header">
                                <h1 class="entry-title"><?php the_title(); ?></h1>
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div><!-- .entry-content -->
                        </article><!-- #post-## -->
                    <?php
                    endwhile;
                endif;
                ?>
            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
