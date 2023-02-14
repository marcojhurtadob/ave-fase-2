<?php
/*
Plugin Name: Entradas de la red
Description: Comparte las entradas de los diferentes sitios en la red de WordPress Multisite
Version: 1.0
Author: Marco Hurtado
*/

add_action( 'admin_menu', 'share_posts_menu' );

function share_posts_menu() {
  add_menu_page( 'Entradas de la red', 'Entradas de la red', 'manage_options', 'share_posts', 'share_posts_page', 'dashicons-admin-post', 6 ); 
}

function share_posts_page() {
  if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( '<div style="padding: 20px; text-align: center;">
              <h1 style="font-size: 2em;">Acceso restringido</h1>
              <p style="font-size: 1.2em;">Lo sentimos, no tienes permisos suficientes para ver esta página.</p>
            </div>' );
  }
  
  global $wpdb;
  $blogs = $wpdb->get_results( "SELECT blog_id, path FROM $wpdb->blogs WHERE site_id = '{$wpdb->siteid}' AND spam = '0' AND deleted = '0' AND archived = '0'", OBJECT );
  
  if ( $blogs ) {
    echo '<div style="padding: 20px;">';
    echo '<h1 style="font-size: 2em;">Entradas de la red</h1>';
    echo '<hr style="margin-bottom: 2em;">';
    foreach ( $blogs as $blog ) {
      switch_to_blog( $blog->blog_id );
      $posts = get_posts( array( 'numberposts' => -1 ) );
      echo '<div style="background-color: #f9f9f9; padding: 20px; margin-bottom: 2em;">';
      echo '<h2 style="margin-bottom: 1em;">
              <a href="' . get_admin_url( $blog->blog_id ) . 'edit.php">Entradas de ' . get_bloginfo( 'name' ) . '</a>
            </h2>';
      echo '<ul style="list-style: none; padding-left: 0;">';
      foreach ( $posts as $post ) {
        echo '<li style="margin-bottom: 1em;">
                <a href="' . get_admin_url( $blog->blog_id ) . 'post.php?post=' . $post->ID . '&action=edit">' . $post->post_title . '</a>
              </li>';
      }
      echo '</ul>';
      echo '</div>';
      restore_current_blog();
    }
    echo '</div>';
  }
}


function allow_admin_access_to_other_sites($user_login, $user) {
  // Si el usuario es un administrador en su sitio actual
  if (user_can($user->ID, 'administrator')) {
    // Obtenemos la lista de todos los blogs de la red
    $blogs = get_blogs_of_user($user->ID);
    foreach ($blogs as $blog) {
      // Asignamos el rol de administrador en cada uno de los otros sitios
      add_user_to_blog($blog->userblog_id, $user->ID, 'administrator');
    }
  }
}

// Añadimos la función de arriba a la acción de inicio de sesión
add_action('wp_login', 'allow_admin_access_to_other_sites', 10, 2);


