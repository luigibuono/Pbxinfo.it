<?php
/**
 * The template for displaying all single posts.
 *
 * @package Nisarg
 */

get_header(); 
?>

<div class="container">
    <div class="row">
        <!-- Contenuto principale -->
        <div id="primary" class="col-md-8 content-area">
            <main id="main" role="main">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                <?php endwhile; ?>
            </main><!-- #main -->

            <!-- Commenti -->
            <div class="post-comments">
                <?php
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                elseif ( ! comments_open() ) :
                    echo '<p>' . esc_html__( 'La tua ricerca non ha prodotto risultati', 'nisarg' ) . '</p>';
                endif;
                ?>
            </div><!-- .post-comments -->
        </div><!-- #primary -->

        <!-- Sidebar -->
        <div id="secondary" class="col-md-4 sidebar-area">
            <?php get_sidebar( 'sidebar-1' ); ?>
        </div><!-- #secondary -->
    </div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
