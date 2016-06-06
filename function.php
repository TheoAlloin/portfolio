<?php
function add_cv_fields(){
    add_menu_page ( 'Les évenements sur le CV', 'CV', 'manage_options', 'cv_fields', 'cv_fields');
    add_submenu_page ( 'cv_fields', 'ajouter un champ sur le CV', 'ajouter un champ sur le CV', 'manage_options', 'add_new_cv_field', 'add_new_cv_field' );
}
add_action( 'admin_menu', 'add_cv_fields' );

function cv_fields(){
    echo "<h1>hello page 1</h1>";
    
} 
function add_new_cv_field(){
    echo "<h1>hello page 2</h1>";
}
