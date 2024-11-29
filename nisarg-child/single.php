<?php
/**
 * The template for displaying all single posts.
 *
 * @package Nisarg
 */

get_header(); ?>

<div class="container">
    <div class="row">
        <!-- Contenuto principale -->
        <div id="primary" class="col-md-8 content-area">
            <main id="main" role="main">

                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                </main><!-- #main -->


                <div class="post-comments">
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                    if ( ! comments_open() ) {
                        esc_html_e( 'Comments are closed.', 'nisarg' );
                    }
                    ?>
                </div>
                <?php endwhile; // End of the loop. ?>
            </div><!-- #primary -->
        
        <!-- Sidebar -->
        <div id="secondary" class="col-md-4 sidebar-area">
            <?php get_sidebar( 'sidebar-1' ); ?>
        </div><!-- #secondary -->
    </div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
<style>
.post-edit-link{
	display:none;
}

.entry-footer{
	display:none;
}

.logged-in-as{
	display:none;
}

.comment-edit-link{
	display:none;
}
</style>