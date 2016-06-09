<?php 
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
        <h2>Ajoutez une nouvelle compétence : ( cf: <a href="www.devicon.com">devicon</a>)</h2>
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
