<?php
// Carica gli stili del tema parent e child
function nisarg_child_enqueue_styles() {
    // Carica lo stile del tema parent
    wp_enqueue_style( 'nisarg-style', get_template_directory_uri() . '/style.css' );

    // Carica lo stile del tema child
    wp_enqueue_style( 'nisarg-child-style', get_stylesheet_uri(), array('nisarg-style'), wp_get_theme()->get('Version') );
}
add_action( 'wp_enqueue_scripts', 'nisarg_child_enqueue_styles' );


function load_more_telefoni() {
    // Imposta i parametri della query per caricare i post successivi
    $paged = isset($_GET['page']) ? $_GET['page'] : 1;
    $args = array(
        'category_name' => 'telefoni', // Usa lo slug della categoria
        'posts_per_page' => 5,         // Numero di post da visualizzare
        'orderby' => 'date',           // Ordina per data
        'order' => 'DESC',             // Ordine discendente
        'paged' => $paged              // Numero di pagina corrente
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            ?>
            <div class="col-md-6 post-item">
                <div class="post-box">
                    <div class="post-thumbnail">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="post-details">
                        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?></a></h2>
                        <div class="post-excerpt">
                            <?php echo mb_strimwidth(get_the_excerpt(), 0, 120, '...'); ?>
                        </div>
                        <div class="read-more">
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Leggi di più</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile;

    else :
        echo '';
    endif;

    wp_reset_postdata();
    die();
}
add_action('wp_ajax_load_more_telefoni', 'load_more_telefoni');
add_action('wp_ajax_nopriv_load_more_telefoni', 'load_more_telefoni');

function enqueue_child_styles() {
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array(), time());
}
add_action('wp_enqueue_scripts', 'enqueue_child_styles');


function remove_edit_post_link() {
    if (!current_user_can('edit_posts')) {
        remove_action('wp_footer', 'wp_edit_post_link');
    }
}
add_action('wp', 'remove_edit_post_link');


function load_more_articles() {
    $paged = isset($_GET['page']) ? $_GET['page'] : 1;

    // Impostiamo la query per caricare i post successivi
    $args = array(
        'posts_per_page' => 5, // Numero di post da visualizzare
        'paged' => $paged,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/content', get_post_format()); // Mostra il contenuto del post
        endwhile;
    else :
        echo ''; // Non c'è altro da caricare
    endif;

    wp_reset_postdata();
    die();
}

add_action('wp_ajax_load_more_articles', 'load_more_articles');
add_action('wp_ajax_nopriv_load_more_articles', 'load_more_articles');


function filter_search_results( $query ) {
    if ( $query->is_search() && !is_admin() ) {
        // Limita la ricerca ai post, escludendo le pagine
        $query->set( 'post_type', 'post' );
    }
    return $query;
}
add_filter( 'pre_get_posts', 'filter_search_results' );



    // Funzione per ottenere l'IP dell'utente
function get_user_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Funzione per ottenere la posizione dell'utente (geo-IP)
function get_user_location() {
    $ip = get_user_ip(); // Ottieni l'IP dell'utente
    $access_key = '6cbd2a0b450203'; // Sostituisci con la tua chiave API di ipinfo.io
    $url = "http://ipinfo.io/{$ip}/json?token={$access_key}"; // API ipinfo.io per ottenere la posizione

    // Esegui la richiesta
    $response = wp_remote_get($url);
    $data = wp_remote_retrieve_body($response);
    $location_info = json_decode($data);

    if ($location_info) {
        $city = $location_info->city;
        $region = $location_info->region;
        $country = $location_info->country;
        $hostname = gethostbyaddr($ip);
        $org = isset($location_info->org) ? $location_info->org : 'Sconosciuto';
        return array(
            'location' => "$city, $region, $country",
            'hostname' => "$hostname",
            'operator' => "$org"
        );
    }
    return array(
        'location' => 'Posizione non trovata',
        'hostname' => 'Hostname sconosciuto',
        'operator' => 'Operatore sconosciuto'
    );
}

// Funzione per ottenere informazioni su browser e sistema operativo
function get_browser_info() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser = "Unknown Browser";
    $os = "Unknown OS";
    $mobile = "No";

    if (strpos($user_agent, 'Chrome') !== false) {
        $browser = 'Chrome';
    } elseif (strpos($user_agent, 'Firefox') !== false) {
        $browser = 'Firefox';
    } elseif (strpos($user_agent, 'Safari') !== false) {
        $browser = 'Safari';
    } elseif (strpos($user_agent, 'Edge') !== false) {
        $browser = 'Edge';
    }

    if (strpos($user_agent, 'Windows') !== false) {
        $os = 'Windows';
    } elseif (strpos($user_agent, 'Mac') !== false) {
        $os = 'Mac OS';
    } elseif (strpos($user_agent, 'Linux') !== false) {
        $os = 'Linux';
    } elseif (strpos($user_agent, 'Android') !== false) {
        $os = 'Android';
        $mobile = "Yes";
    } elseif (strpos($user_agent, 'iPhone') !== false) {
        $os = 'iOS';
        $mobile = "Yes";
    }

    return array(
        'browser' => "$browser",
        'os' => "$os",
        'mobile' => "$mobile"
    );
}

// Funzione per visualizzare le informazioni utente (IP, Posizione, Browser, etc.)
function display_user_info() {
    $ip = get_user_ip();
    $location_info = get_user_location();
    $browser_info = get_browser_info();

    // Restituisce le informazioni come HTML
    return "
    <div id='user-info' class='user-info-container'>
        <p><strong>Il tuo IP:</strong> <span class='user-ip-value'>$ip</span></p>
        <p><strong>Posizione:</strong> <span class='location-value'>{$location_info['location']}</span></p>
        <p><strong>Hostname:</strong> <span class='hostname-value'>{$location_info['hostname']}</span></p>
        <p><strong>Operatore:</strong> <span class='operator-value'>{$location_info['operator']}</span></p>
        <p><strong>Browser:</strong> <span class='browser-value'>{$browser_info['browser']}</span></p>
        <p><strong>Sistema Operativo:</strong> <span class='os-value'>{$browser_info['os']}</span></p>
        <p><strong>Mobile:</strong> <span class='mobile-value'>{$browser_info['mobile']}</span></p>
    </div>";
}

// Registrare uno shortcode per visualizzare le informazioni dell'utente
add_shortcode('user_info', 'display_user_info');
