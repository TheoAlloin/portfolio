<?php


//Add thumbnail, automatic feed links and title tag support
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );

//Add content width (desktop default)
if ( ! isset( $content_width ) ) {
	$content_width = 768;
}

//Add menu support and register main menu
if ( function_exists( 'register_nav_menus' ) ) {
  	register_nav_menus(
  		array(
  		  'main_menu' => 'Main Menu'
  		)
  	);
}


// filter the Gravity Forms button type
add_filter('gform_submit_button', 'form_submit_button', 10, 2);
function form_submit_button($button, $form){
    return "<button class='button btn' id='gform_submit_button_{$form["id"]}'><span>{$form['button']['text']}</span></button>";
}

// Register sidebar
add_action('widgets_init', 'theme_register_sidebar');
function theme_register_sidebar() {
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'id' => 'sidebar-1',
		    'before_widget' => '<div id="%1$s" class="widget %2$s">',
		    'after_widget' => '</div>',
		    'before_title' => '<h4>',
		    'after_title' => '</h4>',
		 ));
	}
}

// Bootstrap_Walker_Nav_Menu setup

add_action( 'after_setup_theme', 'bootstrap_setup' );

if ( ! function_exists( 'bootstrap_setup' ) ):

	function bootstrap_setup(){

		add_action( 'init', 'register_menu' );

		function register_menu(){
			register_nav_menu( 'top-bar', 'Bootstrap Top Menu' ); 
		}

		class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {


			function start_lvl( &$output, $depth = 0, $args = array() ) {

				$indent = str_repeat( "\t", $depth );
				$output	   .= "\n$indent<ul class=\"dropdown-menu\">\n";

			}

			function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

				if (!is_object($args)) {
					return; // menu has not been configured
				}

				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$li_attributes = '';
				$class_names = $value = '';

				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = ($args->has_children) ? 'dropdown' : '';
				$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
				$classes[] = 'menu-item-' . $item->ID;


				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
				$class_names = ' class="' . esc_attr( $class_names ) . '"';

				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
				$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

				$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$attributes .= ($args->has_children) 	    ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= ($args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
				$item_output .= $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}

			function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

				if ( !$element )
					return;

				$id_field = $this->db_fields['id'];

				//display this element
				if ( is_array( $args[0] ) )
					$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
				else if ( is_object( $args[0] ) )
					$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'start_el'), $cb_args);

				$id = $element->$id_field;

				// descend only when the depth is right and there are childrens for this element
				if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

					foreach( $children_elements[ $id ] as $child ){

						if ( !isset($newlevel) ) {
							$newlevel = true;
							//start the child delimiter
							$cb_args = array_merge( array(&$output, $depth), $args);
							call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
						}
						$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
					}
						unset( $children_elements[ $id ] );
				}

				if ( isset($newlevel) && $newlevel ){
					//end the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
				}

				//end this element
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'end_el'), $cb_args);
			}
		}
 	}
endif;


// START THEME OPTIONS
// custom theme options for user in admin area - Appearance > Theme Options
function pu_theme_menu()
{
  add_theme_page( 'Theme Option', 'Theme Options', 'manage_options', 'pu_theme_options.php', 'pu_theme_page');  
}
add_action('admin_menu', 'pu_theme_menu');

function pu_theme_page()
{
?>
    <div class="section panel">
      <h1>Custom Theme Options</h1>
      <form method="post" enctype="multipart/form-data" action="options.php">
      <hr>
        <?php 

          settings_fields('pu_theme_options'); 
        
          do_settings_sections('pu_theme_options.php');
          echo '<hr>';
        ?>
            <p class="submit">  
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  
            </p>
      </form>
    </div>
    <?php
}

add_action( 'admin_init', 'pu_register_settings' );

/**
 * Function to register the settings
 */
function pu_register_settings()
{
    // Register the settings with Validation callback
    register_setting( 'pu_theme_options', 'pu_theme_options' );

    // Add settings section
    add_settings_section( 'pu_text_section', 'Social Links', 'pu_display_section', 'pu_theme_options.php' );

    // Create textbox field
    $field_args = array(
      'type'      => 'text',
      'id'        => 'twitter_link',
      'name'      => 'twitter_link',
      'desc'      => 'Twitter Link - Example: http://twitter.com/username',
      'std'       => '',
      'label_for' => 'twitter_link',
      'class'     => 'css_class'
    );

    // Add twitter field
    add_settings_field( 'twitter_link', 'Twitter', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section', $field_args );   

    $field_args = array(
      'type'      => 'text',
      'id'        => 'facebook_link',
      'name'      => 'facebook_link',
      'desc'      => 'Facebook Link - Example: http://facebook.com/username',
      'std'       => '',
      'label_for' => 'facebook_link',
      'class'     => 'css_class'
    );

    // Add facebook field
    add_settings_field( 'facebook_link', 'Facebook', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section', $field_args );

    $field_args = array(
      'type'      => 'text',
      'id'        => 'gplus_link',
      'name'      => 'gplus_link',
      'desc'      => 'Google+ Link - Example: http://plus.google.com/user_id',
      'std'       => '',
      'label_for' => 'gplus_link',
      'class'     => 'css_class'
    );

    // Add Google+ field
    add_settings_field( 'gplus_link', 'Google+', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section', $field_args );

    $field_args = array(
      'type'      => 'text',
      'id'        => 'youtube_link',
      'name'      => 'youtube_link',
      'desc'      => 'Youtube Link - Example: https://www.youtube.com/channel/channel_id',
      'std'       => '',
      'label_for' => 'youtube_link',
      'class'     => 'css_class'
    );

    // Add youtube field
    add_settings_field( 'youtube_ink', 'Youtube', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section', $field_args );

    $field_args = array(
      'type'      => 'text',
      'id'        => 'linkedin_link',
      'name'      => 'linkedin_link',
      'desc'      => 'LinkedIn Link - Example: http://linkedin.com/in/username',
      'std'       => '',
      'label_for' => 'linkedin_link',
      'class'     => 'css_class'
    );

    // Add LinkedIn field
    add_settings_field( 'linkedin_link', 'LinkedIn', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section', $field_args );

    $field_args = array(
      'type'      => 'text',
      'id'        => 'instagram_link',
      'name'      => 'instagram_link',
      'desc'      => 'Instagram Link - Example: http://instagram.com/username',
      'std'       => '',
      'label_for' => 'instagram_link',
      'class'     => 'css_class'
    );

    // Add Instagram field
    add_settings_field( 'instagram_link', 'Instagram', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section', $field_args );

    // Add settings section title here
    add_settings_section( 'section_name_here', 'Section Title Here', 'pu_display_section', 'pu_theme_options.php' );
    
    // Create textarea field
    $field_args = array(
      'type'      => 'textarea',
      'id'        => 'settings_field_1',
      'name'      => 'settings_field_1',
      'desc'      => 'Setting Description Here',
      'std'       => '',
      'label_for' => 'settings_field_1'
    );

    // section_name should be same as section_name above (line 116)
    add_settings_field( 'settings_field_1', 'Setting Title Here', 'pu_display_setting', 'pu_theme_options.php', 'section_name_here', $field_args );   


    // Copy lines 118 through 129 to create additional field within that section
    // Copy line 116 for a new section and then 118-129 to create a field in that section
}


// allow wordpress post editor functions to be used in theme options
function pu_display_setting($args)
{
    extract( $args );

    $option_name = 'pu_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {  
          case 'text':  
              $options[$id] = stripslashes($options[$id]);  
              $options[$id] = esc_attr( $options[$id]);  
              echo "<input class='regular-text$class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";  
              echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
          break;
          case 'textarea':  
              $options[$id] = stripslashes($options[$id]);  
              //$options[$id] = esc_attr( $options[$id]);
              $options[$id] = esc_html( $options[$id]); 

              printf(
              	wp_editor($options[$id], $id, 
              		array('textarea_name' => $option_name . "[$id]",
              			'style' => 'width: 200px'
              			)) 
				);
              // echo "<textarea id='$id' name='" . $option_name . "[$id]' rows='10' cols='50'>".$options[$id]."</textarea>";  
              // echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
          break; 
    }
}

function pu_validate_settings($input)
{
  foreach($input as $k => $v)
  {
    $newinput[$k] = trim($v);
    
    // Check the input is a letter or a number
    if(!preg_match('/^[A-Z0-9 _]*$/i', $v)) {
      $newinput[$k] = '';
    }
  }

  return $newinput;
}

// Add custom styles to theme options area
add_action('admin_head', 'custom_style');

function custom_style() {
  echo '<style>
    .appearance_page_pu_theme_options .wp-editor-wrap {
      width: 75%;
    }
    .regular-textcss_class {
    	width: 50%;
    }
    .appearance_page_pu_theme_options h3 {
    	font-size: 2em;
    	padding-top: 40px;
    }
  </style>';
}

// END THEME OPTIONS


/**
 * Load site scripts.
 */
function bootstrap_theme_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// Bootstrap
	wp_enqueue_script( 'bootstrap-script', $template_url . '/js/bootstrap.min.js', array( 'jquery' ), null, true );

	wp_enqueue_style( 'bootstrap-style', $template_url . '/css/bootstrap.min.css' );

	//Main Style
	wp_enqueue_style( 'main-style', get_stylesheet_uri() );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'bootstrap_theme_enqueue_scripts', 1 );


/***************************  add skill menu admin **********************************/
function my_menu_skill(){
	add_menu_page( 
		'Ajout competence', 
		'Mes compétences', 
		'administrator', 
		'my_skill_page', 
		'my_skill_page'
		);

	add_submenu_page(
		'my_skill_page',
		'Ajouter une compétence',
		'Nouvelle compétence',
		'administrator',
		'new_skill',
		'new_skill'
		);
}

function new_skill(){
	global $wpdb;
	if(isset($_POST) && !empty($_POST)){
		$link = $_POST['link'];
		$title = $_POST['title'];
        $desc = stripslashes($_POST['desc']);
        var_dump($desc);
		$wpdb->insert(
			'wp_competence',
			array(
				'id' => $wpdb->insert_id,
				'link' => $link,
				'title' => $title,
				'skill_desc' => $desc
                ),
			array(
				'%d',
				'%s',
				'%s',
				'%s'
				)
			);
	}
	?>
	<div class="wrap">
		<h2>Ajoutez une nouvelle compétence : </h2>
	</div>
	<div class="wrap">
		<form method="post" action="">
			<table cellspacing='0' class="widefat options-table">
				<tr><td><input type='text' name="link" id="link"/> <b>Inserez le lien de l'image de la nouvelle compétence </b></td></tr>
				<tr><td><input type='text' name="title" id="title"/> <b>Libellé de la compétence</b></td></tr>
			     <tr><td><input type='text' name='desc' id='desc' /><b>Description</b></td></tr>
			</table>
			<p type="submit">
				<input type="submit" name='pannel_update' class='button-primary autowidth' />
			</p>
		</form>
	</div>

<?php
}

function my_skill_page() {
	global $wpdb;
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'Droit inssufisants' ) );
	} 
	if (isset($_POST)){
		echo "string";
		var_dump($_POST);
	}
	?>
	<div class="wrap">
		<h2>Voici ici la liste des compétences :</h2>
	</div>
<?php
	$results = getSkills();
	if($results){ ?>
<div>
		<table border='1' width='75%' class='widefat options-table' align='center'>
			<tr>
				<th><b>ID</b></th>
				<th><b>Titre</b></th>
				<th><b>Image correspondante</b></th>
				<th><b>Description</b></th>
			</tr>
			<?php foreach ($results as $result) {
				$result->link = stripslashes($result->link);?>
				<tr>
					<td><?php echo $result->id; ?></td>
					<td><?php echo $result->title; ?></td>
					<td><?php echo $result->link; ?></td>
					<td><?php echo $result->skill_desc; ?></td>
				</tr>
				<?php } ?>
		</table>
</div>	
	<?php
	}else{
		echo "Pas de compétences trouvées";
	}?>

	<br /> 
	<p>En savoir plus : <a href="http://devicon.fr/">devicon</a></p>
<?php	
}
add_action('admin_menu', 'my_menu_skill');

function getSkills(){
	global $wpdb;
	$sql = 'select * from wp_competence';
	$results = $wpdb->get_results($sql);
	return $results;
}
/*************** add cv field ******************************************/

# BDD (table->wp_cv): id->int, title->varchar, date->date, file_link->varchar

function add_cv_fields(){
    add_menu_page ( 'Les évenements sur le CV', 'CV', 'manage_options', 'cv_fields', 'cv_fields');
    add_submenu_page ( 'cv_fields', 'ajouter un champ sur le CV', 'ajouter un champ sur le CV', 'manage_options', 'add_new_cv_field', 'add_new_cv_field' );
}
add_action( 'admin_menu', 'add_cv_fields' );

function cv_fields(){
	global $wpdb;
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'Droit inssufisants' ) );
	} 
	?>
    <h2>Voici la liste du contenu de votre cv !</h2>
    <div id="wrap">
    <?php $results = get_cv_fields(); 
    if($results){ ?>
        <table border="1" cellspacing="4">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Date</th>
                <th>Image</th>
            </tr>
            <tr>
            <?php
                foreach ($results as &$result) { ?>
                    <td><?php echo $result->id; ?></td>
                    <td><?php echo $result->title; ?></td>
                    <td><?php echo $result->date; ?></td>
                    <td><?php echo $result->file_link; ?></td>
                <?php }
            }else{
                echo 'Pas de contenu trouvé pour votre CV !';
            }?>
            </tr>
        </table>
   </div>
<?php }

function add_new_cv_field(){
	global $wpdb;
    if(isset($_POST) && !empty($_POST)){
            
        $cv_field_title = $_POST['cv_field_title'];
        $cv_field_date = $_POST['cv_field_date'];
        $cv_field_content = $_POST['cv_field_content'];
        $cv_field_file = $_POST['cv_field_file'];
        $cv_field_file = str_replace(' ', '-', $cv_field_file);
        $path = __DIR__ . '/uploads/';
        $name = $_FILES[$cv_field_file]['name'];
        $tmp_name = $_FILES[$cv_field_file]['tmp_name'];
        
        if( isset($cv_field_file)){
            error_reporting(E_ALL | E_STRICT);
        }
        var_dump($path_file = $path . basename($name));
        
        //upload l'image
        if(!empty($_FILES[$cv_field_file])){
            if (move_uploaded_file($tmp_name, $path)) {
                echo "Le fichier ". basename( $_FILES[$cv_field_file]["name"]). " a bien été uploader.";
            } else {
                echo "Erreur lors de l'upload.";
            }
        }else{
            echo 'file empty';
        }    
        
        
        //insert dans la bdd data
        $wpdb->insert(
            'wp_cv',
            array(
                'id' => $wpdb->insert_id,
                'title' => $cv_field_title,
                'date' => $cv_field_date,
                'file_link' => $cv_field_file
                ),
            array(
                '%d',
                '%s',
                '%s',
                '%s'
                )
            );
    }
	?>
    <div class="wrap">
    	<h2>Ajoutez un contenu a votre cv !</h2>
    </div>
    <div class="wrap">
	    <form action="" method="post">
		    <table border="0">
		    	<tr><td><input type="text" id="cv_field_title" name="cv_field_title" placeholder="Titre"/></td></tr>
		    	<tr><td><input type="date" id="cv_field_date" name="cv_field_date" placeholder="Date"/></td></tr>
		    	<tr><td><input type="textarea" id="cv_field_content" name="cv_field_content" placeholder="Contenu"/></td></tr>
		 	   	<tr><td><input type="file" id="cv_field_file" name="cv_field_file" /></td></tr>
		   		<tr><td><input type="submit" /></td></tr>
	    	</table>
	    </form>
    </div>
<?php
}

function get_cv_fields(){
    global $wpdb;    
    $sql = 'select * from wp_cv';
    $results = $wpdb->get_results($sql);
    return $results;
}
?>
