<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Nisarg
 */

get_header(); ?>
<div class="container">
    <div class="row">
        <div id="primary" class="col-md-9 content-area">
            <main id="main" class="site-main" role="main">
                <section class="error-404 not-found">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'nisarg' ); ?></h1>
                    </header><!-- .page-header -->
                    
                    <?php get_search_form(); ?>

                </section><!-- .error-404 -->
            </main><!-- #main -->
        </div><!-- #primary -->
    </div> <!-- .row -->
</div><!-- .container -->
<?php get_footer(); ?>
<style>
.search-submit:before {
    content: "\f002";
    font-family: FontAwesome;
    font-size: 16px;
    line-height: 0px;
    position: relative;
    width: 40px;
	color: white;
}
@media (max-width: 900px) {
    #submit, .search-submit {
        width: 7%!important; 
    }
}
.site-content{
height:300px;
}

</style>