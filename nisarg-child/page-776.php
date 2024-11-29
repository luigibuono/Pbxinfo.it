<?php
/* Template Name: Pagina Telefoni */

get_header(); // Carica l'header
?>
<div class="container">
    <h2 id="t1">Verifica la tua connessione ed esplora tutti i nostri articoli!</h2>
    <p id="p1">Le tue informazioni personali sono riportate qui sotto:</p>
    <div class="row">
        <!-- Visualizza le informazioni dell'utente -->
        <div class="col-md-12">
            <?php echo do_shortcode('[user_info]'); ?>
        </div>
    </div>
    <div class="row">
        <!-- Colonna articoli -->
        <div id="primary" class="col-md-8 content-area">
            <main id="main" class="site-main" role="main">
                <div class="row">
                    <?php
                    // Query per ottenere gli articoli della categoria 'telefoni'
                    $args = array(
                        'category_name' => 'telefoni', // Usa lo slug della categoria
                        'posts_per_page' => 5,       // Numero di post da visualizzare
                        'orderby' => 'date',         // Ordina per data
                        'order' => 'DESC',           // Ordine discendente
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                    ?>
                    <div class="col-md-6 post-item">
                        <div class="post-box">
                            <div class="post-thumbnail">
                                <!-- Mostra l'immagine in evidenza -->
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="post-details">
                                <!-- Titolo del post -->
                                <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php $title = get_the_title(); 
                                echo mb_strimwidth($title,0,50,'...'); ?></a></h2>
                                <!-- Estratto del post con limite di caratteri -->
                                <div class="post-excerpt">
                                    <?php 
                                    $excerpt = get_the_excerpt();
                                    echo mb_strimwidth($excerpt, 0, 120, '...'); // Limita a 120 caratteri
                                    ?>
                                </div>
                                <!-- Pulsante Leggi di più -->
                                <div class="read-more">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Leggi di più</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                    else :
                        echo '<p>Nessun articolo trovato nella categoria Telefoni.</p>';
                    endif;

                    wp_reset_postdata(); // Ripristina i dati globali di post
                    ?>

                </div><!-- .row -->
                            <!-- Pulsante per caricare altri articoli -->
            <div id="load-more-container" class="text-center">
                <button id="load-more-btn" class="btn btn-danger">Carica Altri Articoli</button>
            </div>
            </main><!-- #main -->
        </div><!-- #primary -->

        <!-- Sidebar -->
        <div class="col-md-4 widget-area">
            <?php get_sidebar(); ?> <!-- Carica la sidebar -->
        </div><!-- .col-md-4 -->
    </div><!-- .row -->
</div><!-- .container -->

<?php
get_footer(); // Carica il footer
?>
<script>
jQuery(function($) {
    var page = 1; // La pagina iniziale è 1
    var loading = false; // Variabile per evitare richieste multiple
    var loadMoreBtn = $('#load-more-btn'); // Bottone "Carica Altri Articoli"

    // Funzione per caricare gli articoli
    loadMoreBtn.on('click', function() {
        if (loading) return; // Se è già in corso una richiesta, non fare nulla
        loading = true;

        // Incrementa la pagina
        page++;

        // Invia una richiesta AJAX
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'GET',
            data: {
                action: 'load_more_telefoni', // Nome dell'azione AJAX
                page: page, // La pagina corrente
            },
            success: function(response) {
                if (response) {
                    // Aggiungi i nuovi articoli alla fine del contenitore
                    $('#primary .site-main .row').append(response);
                } else {
                    loadMoreBtn.prop('disabled', true);
                }
                loading = false; // Rimuovi lo stato di caricamento
            }
        });
    });
});
</script>


<style>
    #p1{
        display: flex;
        justify-content:center;
        font-size: 2rem;
    }

    #t1{
        display: flex;
        justify-content:center;
        font-weight:bold;
    }

    .post-thumbnail img {
    width: 100%;
    height: 300px!important;
    margin-bottom: 15px;
    border-radius: 5px;
}
    /* Stile per il pulsante rosso */
#load-more-btn {
    background-color: #dc3545; /* Rosso */
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-bottom:2rem;
}

#load-more-btn:hover {
    background-color: #c82333; /* Rosso scuro */
}

/* Stile generale per il layout */
.post-item {
    margin-bottom: 30px;
}

/* Stile del box articolo */
.post-box {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    background-color: #fff;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between; 
    overflow: hidden;  /* Nasconde il contenuto in eccesso */
}

/* Immagine del post */
.post-thumbnail img {
    width: 100%;
    height: auto;
    margin-bottom: 15px;
    border-radius: 5px;
}

/* Titolo del post */
.post-title {
    font-size: 18px;
    font-weight: bold;
    margin: 0 0 10px;
    color: #333;
}

.post-title a {
    text-decoration: none;
    color: #007bff;
}

.post-title a:hover {
    color: #0056b3;
}

/* Estratto del post */
.post-excerpt {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
    text-align: justify;
    max-height: 80px; /* Limita l'altezza dell'estratto */
    overflow: hidden; /* Nasconde il contenuto in eccesso */
}

/* Pulsante Leggi di più */
.read-more {
    text-align: right;
    margin-top: auto; /* Spinge il pulsante verso il basso */
}

.read-more .btn {
    background-color: #007bff;
    color: #fff;
    padding: 8px 12px;
    font-size: 14px;
    text-transform: uppercase;
    font-weight: bold;
    border-radius: 5px;
    text-decoration: none;
}

.read-more .btn:hover {
    background-color: #0056b3;
    color: #fff;
}
/* Stile per le informazioni dell'utente */
.user-info-container {
    background-color: #f4f4f4;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
    margin-bottom: 20px;
}

.user-info-container p {
    font-size: 3rem;
    line-height: 1.5;
}

.user-ip {
    font-size: 5rem;
    color: green;

}

.user-ip-value {
    font-weight: bold;
    font-size: 28px;
    color: #28a745; /* Verde chiaro */
}

.user-info-container strong {
    font-weight: bold;
    color: #333;
}

.user-ip-value {
    font-weight: bold;
    font-size: 5rem;
    color: white;
    background: #51bb6c;
    border-radius: 10px;
    padding: 5px;
}
</style>



