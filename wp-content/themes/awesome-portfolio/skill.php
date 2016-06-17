<?php 
/***************************  add skill menu admin **********************************/
function my_menu_skill(){
    add_menu_page( 
        'Add new skill', 
        'My skills', 
        'administrator', 
        'my_skill_page', 
        'my_skill_page'
        );

    add_submenu_page(
        'my_skill_page',
        'Ajouter une compétence',
        'Add new skill',
        'administrator',
        'new_skill',
        'new_skill'
        );
}

function new_skill(){
    global $wpdb;
    $prefix = $wpdb->prefix;
    if(isset($_POST) && !empty($_POST)){
        $link = $_POST['link'];
        $title = $_POST['title'];
        $desc = stripslashes($_POST['desc']);
        $wpdb->insert(
            $prefix.'competence',
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
        <h2>Add new skill :</h2>
    </div>
    <div class="wrap">
        <form method="post" action="">
            <table cellspacing='0' border="0" class="widefat options-table">
                <tr><td><input placeholder='New icon' type='text' name="link" id="link"/></td></tr>
                <tr><td><input placeholder='Title' type='text' name="title" id="title"/></td></tr>
                <tr><td><input placeholder='Description' type='text' name='desc' id='desc' /></td></tr>
                <tr><td>
                <p type="submit">
                    <input type="submit" name='pannel_update' class='button-primary autowidth center' />
                </p>
                </td></tr>
           </table>
        </form>
    Skill's icon: <a href="www.devicon.com">devicon</a>
    </div>
    

<?php
}

function my_skill_page() {
    global $wpdb;
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'Droit inssufisants' ) );
    }
    ?>
    <div class="wrap">
        <h2>List of your skills :</h2>
    </div>
<?php
    $results = getSkills();
    if($results){ ?>
<div>
        <table border='1' width='75%'  id='skills' class='widefat options-table' align='center'>
            <tr>
                <thead>
                    <th><b>ID</b></th>
                    <th><b>Title</b></th>
                    <th><b>Icon</b></th>
                    <th><b>Description</b></th>
                    <th><b>Action</b></th>
                </thead>
            </tr>
            <?php foreach ($results as $result) {
                $result->link = stripslashes($result->link);?>
                <tr>
                    <td><?php echo $result->id; ?></td>
                    <td contenteditable="true" id='<?php echo($result->id); ?>' class='title'><?php echo $result->title; ?></td>
                    <td contenteditable="true" id='<?php echo($result->id); ?>' class='link'><?php echo $result->link; ?></td>
                    <td contenteditable="true" id='<?php echo($result->id); ?>' class='skill_desc'><?php echo $result->skill_desc; ?></td>
                    <td><button type="submit" id='<?php echo($result->id); ?>' class='delete button-primary autowidth'/>Delete</td>
                </tr>
                <?php } ?>
        </table>
</div>  
    <?php
    }else{ ?>
        <p>No Skills, add new !</p>
    <?php } ?>

    <br /> 
    <p>More here for your icon : <a href="http://devicon.fr/">devicon</a></p>
<?php   
}
add_action('admin_menu', 'my_menu_skill');

function getSkills(){
    global $wpdb;
    $prefix = $wpdb->prefix;
    $sql = 'select * from '.$prefix.'competence';
    $results = $wpdb->get_results($sql);
    return $results;
}


/*************************************** AJAX **********************************************/

function updateSkill()
{
    $id = $_POST['id'];
    $colomn = $_POST['colomn'];
    $value = $_POST['value'];

    global $wpdb;
    $wpdb->update(
        $prefix.'competence',
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
add_action("wp_ajax_updateSkill", "updateSkill");
// Hook exécuté pour les utilisateurs non connectés
add_action("wp_ajax_nopriv_updateSkill", "updateSkill");

function deleteSkill(){
    $id = $_POST['id'];
    global $wpdb;
    $prefix = $wpdb->prefix;
    
    $wpdb->delete(
        $prefix.'competence',
        array('id' => $id),
        array('%d')
        );

    exit;
}
// Hook exécuté pour les utilisateurs connectés
add_action("wp_ajax_deleteSkill", "deleteSkill");
// Hook exécuté pour les utilisateurs non connectés
add_action("wp_ajax_nopriv_deleteSkill", "deleteSkill");