<?php

//die(site_url());

if (site_url() == "http://demo-wp.local") {
	define("VERSION", time());
} else {
	define("VERSION", wp_get_theme()->get("Version"));
}

function alpha_bootstrapping()
{
	load_theme_textdomain("alpha");
	add_theme_support("post-thumbnails");
	$alpha_custom_header_details = array(
		'header-text'        => true,
		'default-text-color' => '#222',
		'width'              => '1200',
		'height'             => '600',
		'flex-width'         => true,
		'flex-height'        => true
	);
	add_theme_support("custom-header", $alpha_custom_header_details);
	$alpha_custom_logo_details = array(
		"width"  => '100',
		"height" => '100',
	);
	add_theme_support("custom-logo", $alpha_custom_logo_details);
	add_theme_support("custom-background");
	add_theme_support("title-tag");
	register_nav_menu("top-menu", _("Top Menu", "alpha"));
	register_nav_menu("footer-menu", _("Footer Menu", "alpha"));
	add_theme_support("post-formats", array('audio', 'image', 'video', 'link', 'quote'));
}

add_action("after_setup_theme", "alpha_bootstrapping");


function alpha_assets()
{
	wp_enqueue_style("bootstrap", "//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css");
	wp_enqueue_style("featherlight-css", "//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css");
	wp_enqueue_style("dashicons");
	wp_enqueue_style("alpha", get_stylesheet_uri(), array(), VERSION);
	wp_enqueue_script("featherlight-js", "//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js", array("jquery"), "0.0.1", true);

	// first way to get js file inside wordpress
	//	wp_enqueue_script("alpha-main", get_template_directory_uri() . "/assets/js/main.js", array(), "1.0.0", true);

	// second way to get js file inside wordpress
	wp_enqueue_script("alpha-main", get_theme_file_uri("/assets/js/main.js"), array(), VERSION, true);
}

add_action("wp_enqueue_scripts", "alpha_assets");

function alpha_sidebar()
{
	register_sidebar(array(
		"name"          => "Sidebar",
		"id"            => "sidebar",
		"description"   => "This is the sidebar",
		"before_widget" => '<aside id="%1$s" class="widget %2$s">',
		"after_widget"  => "</aside>",
		"before_title"  => "<h3>",
		"after_title"   => "</h3>"
	));

	register_sidebar(array(
		"name"          => "Footer Left",
		"id"            => "footer-left",
		"description"   => "This is the footer left",
		"before_widget" => '<aside id="%1$s" class="widget %2$s">',
		"after_widget"  => "</aside>",
		"before_title"  => "",
		"after_title"   => ""
	));

	register_sidebar(array(
		"name"          => "Footer Right",
		"id"            => "footer-right",
		"description"   => "This is the footer right",
		"before_widget" => '<aside id="%1$s" class="widget %2$s">',
		"after_widget"  => "</aside>",
		"before_title"  => "",
		"after_title"   => ""
	));
}

add_action("widgets_init", "alpha_sidebar");


// second way to get password form
function alpha_the_excerpt($excerpt)
{
	if (!post_password_required()) {
		return $excerpt;
	} else {
		echo get_the_password_form();
	}
}

add_filter("the_excerpt", "alpha_the_excerpt");


function alpha_protected_title_format()
{
	return "%s";
	//	return "Locked: %s"; use to set any text in locked post
}

add_filter("protected_title_format", "alpha_protected_title_format");

function alpha_protected_title_format_class($classes, $item)
{
	$classes[] = "list-inline-item";

	return $classes;
}

add_filter("nav_menu_css_class", "alpha_protected_title_format_class", 10, 2);

function alpha_about_page_template_banner()
{
	if (is_page()) {
		$alpha_post_thumb = get_the_post_thumbnail_url(null, "large");
?>
		<style>
			.page-header {
				background-image: url(<?php echo $alpha_post_thumb ?>);
			}
		</style>
		<?php
	}
	if (is_front_page()) {
		if (current_theme_supports("custom-header")) {
		?>
			<style>
				.header {
					background-image: url(<?php echo header_image(); ?>);
					background-repeat: no-repeat;
					background-size: cover;
					margin-bottom: 100px;
				}

				.header h1.heading a,
				h3.tagline {
					color: #<?php echo get_header_textcolor(); ?>;
					<?php
					if (!display_header_text()) {
						echo "display: none";
					}
					?>
				}
			</style>
<?php
		}
	}
}

add_action("wp_head", "alpha_about_page_template_banner", 11);
