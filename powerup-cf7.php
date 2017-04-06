<?php
/**
* Plugin Name: Powerup CF7
* Plugin URI: http://viasocket.com/
* Description: Post your contact form 7 data to Socket.
* Version: 1.0
* Author: Sarfaraz Ansari
* Author URI: https://sarfarazansari.github.io/
* License: MIT
*/
// wpcf7_mail_sent
// wpcf7_submit
//powerup_cf7
//POWERUP_CF7
add_action( 'wpcf7_mail_sent', 'powerup_cf7_post_form_data' );

function powerup_cf7_post_form_data( $contact_form ) {
  $title = $contact_form->title;
  $submission = WPCF7_Submission::get_instance();
  if ( $submission ) {
  	$posted_data = $submission->get_posted_data();
  }

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => get_option('sokt_store_url'),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($posted_data),
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
      "content-type: application/json",
      "zpm_hello: 1"
    ),
  ));
  curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
}


define( 'POWERUP_CF7_VERSION', '1.0' );
define( 'POWERUP_CF7_PLUGIN', __FILE__ );
define( 'POWERUP_CF7_PLUGIN_DIR',
  untrailingslashit( dirname( POWERUP_CF7_PLUGIN ) ) );

require_once POWERUP_CF7_PLUGIN_DIR . '/includes/capabilities.php';
require_once POWERUP_CF7_PLUGIN_DIR . '/admin/admin.php';





