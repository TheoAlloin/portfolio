<?php 
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
        <table border="1" cellspacing="4" class="widefat options-table">
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
            }else{?>

                <div class="alert alert-info">
                    <p> Pas de contenu trouvé pour votre CV ! </p>
                </div>

            <?php }?>
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
        $cv_field_file = str_replace(' ', '-', $_POST['cv_field_file']);
        $cv_field_color = $_POST['cv_field_color'];

        //insert dans la bdd data
        $wpdb->insert(
            'wp_timeline',
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
        <h2>Ajoutez du contenu à votre cv !</h2>
    </div>
    <div class="wrap">
        <form action="" method="post">
            <table border="0" class="widefat options-table form-table">
                <tr><td><input type="text" id="cv_field_title" name="cv_field_title" placeholder="Titre"/></td></tr>
                <tr><td><input type="date" id="cv_field_date" name="cv_field_date" placeholder="Date"/></td></tr>
                <tr><td><input type="textarea" id="cv_field_content" name="cv_field_content" placeholder="Contenu"/></td></tr>
                <tr><td><input type="text" id="cv_field_file" name="cv_field_file" placeholder="shortcode Glyphon"/></td></tr>
                <tr><td><input type="color" id="cv_field_color" name="cv_field_color" /> Ajouter un couleur de fond à votre glyphon !</td></tr>
                <tr><td><input type="submit" class='button-primary autowidth' /></td></tr>
            </table>
        </form>
        <p>Pour les couleurs : <a href="http://coolors.co">coolors.co</a></p>
    </div>
<?php
}

function get_cv_fields(){
    global $wpdb;    
    $sql = 'SELECT * FROM `wp_timeline` ORDER BY date asc';
    $results = $wpdb->get_results($sql);
    return $results;
}