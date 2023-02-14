<?php
/*
Plugin Name: Sincronización de Usuarios en la Red
Description: Sincroniza la información de los usuarios en todos los sitios de la red al momento de iniciar sesión.
Version: 1.0
Author: Marco Hurtado
*/

function add_user_to_all_blogs( $user_id ) {
  $user = get_userdata( $user_id );

  // Obtener todos los sitios en la instalación multisitio
  $sites = get_sites();
  foreach ( $sites as $site ) {
    switch_to_blog( $site->blog_id );

    // Agregar usuario a cada sitio
    add_user_to_blog( $site->blog_id, $user_id, $user->roles[0] );

    restore_current_blog();
  }
}
add_action( 'user_register', 'add_user_to_all_blogs' );

function update_user_roles_on_all_blogs( $user_id, $role, $old_roles ) {
  // Obtener todos los sitios en la instalación multisitio
  $sites = get_sites();
  foreach ( $sites as $site ) {
    switch_to_blog( $site->blog_id );

    // Actualizar el rol del usuario en cada sitio
    $user = get_userdata( $user_id );
    $user->set_role( $role );

    restore_current_blog();
  }
}
add_action( 'set_user_role', 'update_user_roles_on_all_blogs', 10, 3 );
