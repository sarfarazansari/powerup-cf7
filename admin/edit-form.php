<?php 
  if($_POST['sokt_hidden'] == 'Y') {
    //Form data sent
    $sokt_url = $_POST['sokt_store_url'];
    update_option('sokt_store_url', $sokt_url);
    ?>
    <div class="updated"><p><strong><?php _e('URL saved.' ); ?></strong></p></div>
    <?php
  } 
  else {
    //Normal page display
    $sokt_url = get_option('sokt_store_url');
  }
?>
<div class="wrap">
  <?php    echo "<h2>" . __( 'Powerup CF7 Configure', 'sokt_trdom' ) . "</h2>"; ?>
   
  <form class="sokt_form" name="sokt_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <input type="hidden" name="sokt_hidden" value="Y">
    <div>
        <label class="sokt-label"><?php _e("Socket URL: " ); ?></label>
        <input class="sokt-input"  type="text" name="sokt_store_url" 
        value="<?php echo $sokt_url; ?>">
        <label class="sokt-input-help"><?php _e(" ex: https://viasocket.com/" ); ?></label>
    </div>
    <div class="submit">
        <input class="sokt-btn" type="submit" name="Submit" value="<?php _e('Save', 'sokt_trdom' ) ?>" />
    </div>
  </form>
</div>