<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Nisarg
 */
?>
<div id="secondary" class="col-md-2 sidebar widget-area" role="complementary">
	<?php do_action( 'before_sidebar' ); ?>
	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
		<aside id="search" class="widget widget_search">
			<?php get_search_form(); ?>
		</aside>
		<aside id="archives" class="widget">
		    <h3 class="widget-title"><?php esc_html_e( 'Archives', 'nisarg' ); ?></h3>
		    <ul>
		        <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
		    </ul>
		</aside>
		<aside id="meta" class="widget">
		    <h3 class="widget-title"><?php esc_html_e( 'Meta', 'nisarg' ); ?></h3>
		    <ul>
		        <?php wp_register(); ?>
		        <li><?php wp_loginout(); ?></li>
		        <?php wp_meta(); ?>
		    </ul>
		</aside>
	<?php endif; // end sidebar widget area ?>
</div><!-- #secondary .widget-area -->

<style>

@media (min-width: 992px) {
    .col-md-2 {
        width: 100%;
    }
}

button, input, optgroup, select, textarea {
    color:white; 
}

.widget ul ,.wp-block-latest-comments{
    list-style: none;
    padding: 0em!important; 
}

#secondary {
    padding-top: 0px!important;
}

.post-edit-link ,.customize-unpreviewable,.entry-footer{
	display:none;
}

.wp-block-search__input {
    appearance: none;
    border: 1px solid #949494;
    flex-grow: 1;
    margin-left: 0;
    margin-right: 0;
    min-width: 3rem;
    padding: 8px;
    text-decoration: unset !important;
    color: black!important;
}
</style>


