<div class="page-header header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="tagline"> <?php bloginfo( "description" ); ?> </h3>
                <h1 class="align-self-center display-1 text-center heading">
                    <a href="<?php echo site_url(); ?>"><?php bloginfo( "name" ); ?></a>
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'top-menu',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'list-inline text-center',
					)
				)
				?>
            </div>
        </div>
    </div>
</div>