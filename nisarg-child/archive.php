<?php
/**
 * The template for displaying archive pages.
 *
 * @package Nisarg
 */
get_header(); 
$posts_nav_style = get_theme_mod( 'nisarg_posts_nav','old-new-posts');
?>
<div class="container">
    <div class="row">
        <?php if ( have_posts() ) : ?>
			<!-- .page-header
            <header class="archive-page-header">
                                    the_archive_title( '<h3 class="archive-page-title">'.__( 'Browsed by', 'nisarg' ).'<br>', '</h3>' );
                    the_archive_description( '<div class="taxonomy-description">', '</div>' );
                ?>
            </header> -->

            <!-- Colonna per il contenuto principale -->
            <div id="primary" class="col-md-8 content-area">
                <main id="main" class="site-main" role="main">

                <?php 
                    // Custom WP Query per limitare a 5 post iniziali
                    $args = array(
                        'posts_per_page' => 5, // Mostra 5 articoli per pagina
                    );
                    $query = new WP_Query($args);

                    // Loop per i post
                    if ( $query->have_posts() ) :
                        while ( $query->have_posts() ) : $query->the_post();
                            $post_display_option = get_theme_mod( 'post_display_option', 'post-excerpt' );

                            if ( 'post-excerpt' === $post_display_option ) {
                                get_template_part( 'template-parts/content', 'excerpt' );
                            } else {
                                get_template_part( 'template-parts/content', get_post_format() );
                            }
                        endwhile;
                    endif;
                ?>

                </main><!-- #main -->

                <!-- Bottone "Carica altri articoli" sotto gli articoli -->
                <div class="read-more text-center">
                    <button id="load-more-articles" class="btn btn-danger">Carica altri articoli</button>
                </div>

            </div><!-- #primary -->

            <!-- Colonna per la Sidebar -->
            <div id="secondary" class="col-md-4">
                <?php get_sidebar(); ?> <!-- Sidebar 1, se presente -->
            </div><!-- #secondary -->

        <?php else : ?>
            <div id="primary" class="col-md-12 content-area">
                <main id="main" class="site-main" role="main">
                    <?php get_template_part( 'template-parts/content', 'none' ); ?>
                </main><!-- #main -->
            </div><!-- #primary -->
        <?php endif; ?>
    </div> <!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>

<script>
jQuery(function($) {
    var page = 2; // La pagina successiva è 2, poiché la prima è già stata caricata
    var loading = false; // Variabile per evitare richieste multiple
    var loadMoreBtn = $('#load-more-articles'); // Bottone "Carica altri articoli"

    // Funzione per caricare gli articoli
    loadMoreBtn.on('click', function() {
        if (loading) return; // Se è già in corso una richiesta, non fare nulla
        loading = true;

        // Invia una richiesta AJAX
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'GET',
            data: {
                action: 'load_more_articles', // Nuovo nome dell'azione AJAX
                page: page, // La pagina successiva
            },
            success: function(response) {
                if (response) {
                    // Aggiungi i nuovi articoli alla fine del contenitore
                    $('#primary .site-main').append(response);
                    page++; // Incrementa la pagina per il prossimo caricamento
                    // Rimetti il pulsante sotto gli articoli appena caricati
                    $('#primary').append(loadMoreBtn); 
                } else {
                    loadMoreBtn.prop('disabled', true).text('Non ci sono altri articoli.'); // Disabilita il bottone se non ci sono altri articoli
                }
                loading = false; // Rimuovi lo stato di caricamento
            }
        });
    });
});
</script>

<style>
    #load-more-articles {
        display: block;
        margin: 40px auto;
        background-color: red;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    #load-more-articles:hover {
        background-color: darkred;
    }

    .post-item {
        margin-bottom: 30px; /* Spazio tra i post */
    }

    /* Stile per il formato grande degli articoli */
    .post-item .post-box {
        display: block;
        width: 100%; /* Un articolo per riga */
    }

    .post-item .post-thumbnail img {
        width: 100%;
        height: auto;
    }

    .post-item .post-title {
        font-size: 24px;
    }

    .post-item .post-excerpt {
        font-size: 18px;
    }

    /* Sidebar stile */
    #secondary {
        padding-top: 30px; /* Aggiungi un po' di spazio sopra la sidebar */
    }

	.post-content, .single-post-content, .post-comments, .comments-area {
    background-color: lightgray;
}
</style>
