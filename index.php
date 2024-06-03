<?php get_header(); ?>

<body <?php body_class(); ?>>
<?php get_template_part( "hero" ); ?>
    <div class="posts">
		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( "post-formet/content", get_post_format() );
		}
		?>
        <div class="container post-pagination">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8">
					<?php
					the_posts_pagination( array(
						"screen_reader_text" => ' ',
						"prev_text"          => "new post",
						"next_text"          => "old post"
					) );
					?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>