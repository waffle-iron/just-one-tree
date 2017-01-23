<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Just_One_Tree
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Page not found', 'justonetree' ); ?></h1>
				</header>
				<div class="page-content">
					<p><?php esc_html_e( 'Oops! We couldn&rsquo;t find the page you were looking for. Please try a search and contact us if you can&rsquo;t find what you&rsquo;re after.', 'justonetree' ); ?></p>

					<?php
						the_widget( 'WP_Widget_Recent_Posts' );

						// Only show the widget if site has multiple categories.
						if ( justonetree_categorized_blog() ) :
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'justonetree' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div>
					<?php
						endif;

						the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div>
			</section>
		</main>
	</div>
<?php
get_sidebar();
get_footer();
