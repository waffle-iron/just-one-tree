		<div class="site-branding">

			<?php if ( get_custom_logo() ) :
					// Show the custom logo if one's been uploaded via wp-admin.
					the_custom_logo();
				else :
					// Otherwise, show our logo in SVG format.
					?>
					<a class="custom-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo file_get_contents( esc_url( get_template_directory_uri() ) . '/assets/svg/just-one-tree.svg' ); ?></a>
			<?php endif; ?>

			<div class="justonetree-title-text">

			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>

			</div><!-- .justonetree-title-text -->
		</div><!-- .site-branding -->
