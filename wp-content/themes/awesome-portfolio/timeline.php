<?php 
/*************** add cv field ******************************************/

function add_cv_fields(){
    add_menu_page ( 'CV events', 'My CV', 'manage_options', 'cv_fields', 'cv_fields');
    add_submenu_page ( 'cv_fields', 'Add new CV field', 'Add new CV field', 'manage_options', 'add_new_cv_field', 'add_new_cv_field' );
}
add_action( 'admin_menu', 'add_cv_fields' );

function cv_fields(){
    global $wpdb;
    $prefix = $wpdb->prefix;
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'Droit inssufisants' ) );
    } 
    ?>
    <h2>Your CV fields :</h2>
    <div id="wrap">
    <?php $results = get_cv_fields(); 
    if($results){ ?>
        <table border="1" id='timeline' cellspacing="4" class="widefat options-table" align='center'>
            <tr>
                <thead>
                    <th><b>ID</b></th>
                    <th><b>Title</b></th>
                    <th><b>Content</b></th>
                    <th><b>Date</b></th>
                    <th><b>Icon</b></th>
                    <th><b>Color</b></th>
                </thead>
            </tr>
            <?php
                foreach ($results as &$result) { ?>
                    <tr>
                        <td><?php echo $result->id; ?></td>
                        <td contenteditable="true" id='<?php echo($result->id); ?>' class='titre'><?php echo $result->titre; ?></td>
                        <td contenteditable="true" id='<?php echo($result->id); ?>' class='contenu'><?php echo $result->contenu; ?></td>
                        <td contenteditable="true" id='<?php echo($result->id); ?>' class='date'><?php echo $result->date; ?></td>
                        <td contenteditable="true" id='<?php echo($result->id); ?>' class='glyphon'><?php echo $result->glyphon; ?></td>
                        <td contenteditable="true" id='<?php echo($result->id); ?>' class='color'><?php echo $result->color; ?></td>
                    </tr>
                <?php }
            }else{?>

                <div class="alert alert-info">
                    <p> No content for your CV! </p>
                </div>

            <?php }?>
        </table>
        <br />
        Library : <a href='http://fontawesome.io/icons/'>Font Awesome</a>
   </div>
<?php }

function add_new_cv_field(){
    global $wpdb;
    $prefix = $wpdb->prefix;
    if(isset($_POST) && !empty($_POST)){
        
        $cv_field_title = $_POST['cv_field_title'];
        $cv_field_date = $_POST['cv_field_date'];
        $cv_field_content = stripcslashes($_POST['cv_field_content']);
        $cv_field_content = $_POST['cv_field_content'];
        $cv_field_file = str_replace(' ', '-', $_POST['cv_field_file']);
        $cv_field_color = $_POST['cv_field_color'];

        //insert dans la bdd data
        $wpdb->insert(
            $prefix.'timeline',
            array(
                'id' => $wpdb->insert_id,
                'titre' => $cv_field_title,
                'contenu' => $cv_field_content,
                'date' => $cv_field_date,
                'glyphon' => $cv_field_file,
                'color' => $cv_field_color
                ),
            array(
                '%d',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s'
                )
            );
    }
    ?>
    <div class="wrap">
        <h2>Add new content to your CV !</h2>
    </div>
    <div class="wrap">
        <form action="" method="post">
            <table border="0" class="widefat options-table form-table">
                <tr><td><input type="text" id="cv_field_title" name="cv_field_title" placeholder="Titre"/></td></tr>
                <tr><td><input type="date" id="cv_field_date" name="cv_field_date" placeholder="Date"/></td></tr>
                <tr><td><input type="textarea" id="cv_field_content" name="cv_field_content" placeholder="Contenu"/></td></tr>
                <tr><td><input type="text" id="cv_field_file" name="cv_field_file" placeholder="shortcode Glyphon/Font awesome"/></td></tr>
                <tr><td><input type="text" id="cv_field_file" name="cv_field_file" placeholder="shortcode Glyphon"/></td></tr>
                <tr><td><input type="color" id="cv_field_color" name="cv_field_color" /> Add new icon !</td></tr>
                <tr><td><input type="submit" class='button-primary autowidth' /></td></tr>
            </table>
        </form>
        <p>Link for colors : <a href="http://coolors.co">coolors.co</a></p>
    </div>
<?php
}

function get_cv_fields(){
    global $wpdb;  
    $prefix = $wpdb->prefix;  
    $sql = "SELECT id, titre, contenu, color, date, glyphon FROM `" . $prefix . "timeline` ORDER BY date ASC";
    $results = $wpdb->get_results($sql);
    return $results;
}


/*************************************** AJAX **********************************************/

function updateTimeline()
{
    $id = $_POST['id'];
    $colomn = $_POST['colomn'];
    $value = $_POST['value'];

    global $wpdb;
    $prefix = $wpdb->prefix;
    $wpdb->update(
        $prefix.'timeline',
        array(
            $colomn => $value
            ),
        array(
            'id' => $id
            ),
        array(
            '%s'
            ),
        array(
            '%d'
            )
        );

    // important, pour bien récupérer la valeur de retour
    exit;
}

// Hook exécuté pour les utilisateurs connectés
add_action("wp_ajax_updateTimeline", "updateTimeline");
// Hook exécuté pour les utilisateurs non connectés
add_action("wp_ajax_nopriv_updateTimeline", "updateTimeline");

function deleteTimeline(){
     $id = $_POST['id'];
     global $wpdb;
     $prefix = $wpdb->prefix;
     $wpdb->delete(
        $prefix.'timeline',
        array('id' => $id),
        array('%d')
        );

    exit;
}
// Hook exécuté pour les utilisateurs connectés
add_action("wp_ajax_deleteTimeline", "deleteTimeline");
// Hook exécuté pour les utilisateurs non connectés
add_action("wp_ajax_nopriv_deleteTimeline", "deleteTimeline");