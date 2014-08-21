<?php
/* Define the custom box */
add_action( 'add_meta_boxes', 'lnik_metabox' );

/* Do something with the data entered */
add_action( 'save_post', 'link_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function lnik_metabox() {
    $posttypes = array( 'fancyheader');
    foreach ($posttypes as $post_types) {
        add_meta_box(
            'link_sectionid',
            __( 'Link Section', 'link_textdomain' ),
            'link_inner_custom_box',
            $post_types
        );
    }
}

/* Prints the box content */
function link_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'link_noncename' );
  global $wpdb;
  global $wp;
  // The actual fields for data entry
  // Use get_post_meta to retrieve an existing value from the database and use the value for the form
  $sliderlink = get_post_meta( $post->ID, '_fancyheader_slider_link', true );
  ?>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="38%"><label for="AVI_gallery_id"><?php _e("Link url", 'link_textdomain' ) ?></label></td>
    <td width="2%"><div align="center"><b>:</b></div></td>
    <td width="60%">
    <input type="url" placeholder="http://" name="slider_link_url" id="slider_link_url" value="<?php echo  $sliderlink ?>">
    </td>
  </tr>
   </table>

  
  <?php
}

/* When the post is saved, saves our custom data */
function link_save_postdata( $post_id ) {

  // First we need to check if the current user is authorised to do this action. 
  if ( 'page' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) )
        return;
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // Secondly we need to check if the user intended to change this value.
  if ( ! isset( $_POST['link_noncename'] ) || ! wp_verify_nonce( $_POST['link_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  // Thirdly we can save the value to the database

  //if saving in a custom table, get post_ID
  $post_ID = $_POST['post_ID'];
  //sanitize user input
  $slider_link_url = sanitize_text_field( $_POST['slider_link_url'] );
  
  // Do something with $mydata 
  // either using 
    add_post_meta($post_ID, '_fancyheader_slider_link', $slider_link_url, true) or
    update_post_meta($post_ID, '_fancyheader_slider_link', $slider_link_url);

  // or a custom table (see Further Reading section below)
}
?>