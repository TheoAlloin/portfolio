<?php
require_once (__DIR__ . '/skill.php');
require_once (__DIR__ . '/timeline.php');
//Add content width (desktop default)
if (!isset($content_width)) {
	$content_width = 768;
}
//Add menu support and register main menu
if (function_exists('register_nav_menus')) {
	register_nav_menus(array('main_menu' => 'Main Menu'));
}
// filter the Gravity Forms button type
add_filter('gform_submit_button', 'form_submit_button', 10, 2);

function form_submit_button($button, $form) {
	return "<button class='button btn' id='gform_submit_button_{$form["id"]}'><span>{$form['button']['text']}</span></button>";
}

// Register sidebar
add_action('widgets_init', 'theme_register_sidebar');
function theme_register_sidebar() {
	if (function_exists('register_sidebar')) {
		register_sidebar(array(
			'id' => 'sidebar-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>',
		));
	}
}

/**
 * Load site scripts.
 */
function theme_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// jQuery.
	wp_enqueue_script('jquery');
    wp_enqueue_script('script', $template_url . '/js/jquery.js', array('jquery'), null, true);

	// Bootstrap
	wp_enqueue_script('bootstrap-script', $template_url . '/js/bootstrap.min.js', array('jquery'), null, true);
	wp_enqueue_script('bootstrap-script', $template_url . 'js/jquery.bootstrap-autohidingnavbar.js"', array('jquery'), null, true);
    
	wp_enqueue_style('bootstrap-style', $template_url . '/css/bootstrap.min.css');
	wp_enqueue_style('font-awesome', $template_url . '/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style('magnific-popup', $template_url . '/css/magnific-popup.css');
	wp_enqueue_style('creative', $template_url . '/css/creative.css');
	//Script
	wp_enqueue_script('script', $template_url . '/js/scrollreveal.min.js', array('jquery'), null, true);
	wp_enqueue_script('script', $template_url . '/js/jquery.easing.min.js', array('jquery'), null, true);
	wp_enqueue_script('script', $template_url . '/js/jquery.fittext.js', array('jquery'), null, true);
	wp_enqueue_script('script', $template_url . '/js/jquery.magnific-popup.min.js', array('jquery'), null, true);
	wp_enqueue_script('script', $template_url . '/js/creative.js', array('jquery'), null, true);
	wp_enqueue_script('script', $template_url . '/js/js.js', array('jquery'), null, true);
	wp_enqueue_script('script', $template_url . '/js/bootstrap.min.js', array('jquery'), null, true);
    wp_enqueue_script('script', $template_url . '/js/editSkill.js', array('jquery'), null, true);
    wp_enqueue_script('script', $template_url . '/js/scroll-timeline-effects.js', array('jquery'), null, true);
    
	//Main Style
	wp_enqueue_style('main-style', get_stylesheet_uri());

	// pass Ajax Url to script.js
	wp_localize_script('script', 'ajaxurl', admin_url('admin-ajax.php'));

	if (is_singular() && get_option('thread_comments')) {

		wp_enqueue_style('bootstrap-style', $template_url . '/css/bootstrap.min.css');

		//Main Style
		wp_enqueue_style('main-style', get_stylesheet_uri());

		// Load Thread comments WordPress script.
		if (is_singular() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts', 1);
add_action('admin_enqueue_scripts', 'theme_enqueue_scripts');


/********************************************* THEME ACTIVATION ****************************************/
add_action('after_switch_theme', 'create_table');

function create_table() {
	global $wpdb;
	$prefix = $wpdb->prefix;

	$sql = array(
		'CREATE TABLE IF NOT EXISTS ' . $prefix . 'timeline(
        id int(11) AUTO_INCREMENT,
        titre text,
        contenu text,   
        date date,  
        glyphon text,
        color text, 
        PRIMARY KEY (id)
        )',
		'CREATE TABLE IF NOT EXISTS ' . $prefix . 'competence(
        id int(11) AUTO_INCREMENT,
        link text,
        title text,
        skill_desc text,
        PRIMARY KEY (id)
        )'
	);

	foreach ($sql as $s) {
		$wpdb->query($s);
	}
}