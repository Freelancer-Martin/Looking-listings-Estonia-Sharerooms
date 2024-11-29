<?php
/**
 * Calls the class on the post edit screen.
 */
function call_someClass() {
    new someClass();
}

if ( is_admin() ) {
    add_action( 'load-post.php',     'call_someClass' );
    add_action( 'load-post-new.php', 'call_someClass' );
}

/**
 * The Class.
 */
class someClass {

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post',      array( $this, 'save'         ) );
    }

    /**
     * Adds the meta box container.
     */
    public function add_meta_box( $post_type ) {
        // Limit meta box to certain post types.
        $post_types = array( 'looking_listing' );

        //if ( in_array( $post_type, $post_types ) ) {
            add_meta_box(
                'some_meta_box_name',
                __( 'Marker Info', 'textdomain' ),
                array( $this, 'render_meta_box_content' ),
                $post_type,
                'advanced',
                'high'
            );
        //}
    }

    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save( $post_id ) {

        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */

        // Check if our nonce is set.
        if ( ! isset( $_POST['myplugin_inner_custom_box_nonce'] ) ) {
            return $post_id;
        }

        $nonce = $_POST['myplugin_inner_custom_box_nonce'];

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' ) ) {
            return $post_id;
        }

        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        // Check the user's permissions.
        if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }

        /* OK, it's safe for us to save the data now. */

        // Sanitize the user input.
        //$mydata = sanitize_text_field( $_POST['myplugin_new_field'] );
        $submitted_occupation = sanitize_text_field( $_POST['submitted_occupation'] );
        $submitted_number = sanitize_text_field( $_POST['submitted_number'] );
        $author_name = sanitize_text_field( $_POST['author_name'] );
        $author_email = sanitize_text_field( $_POST['author_email'] );
        //$submitted_author_email = sanitize_text_field( $_POST['submitted_author_email'] );
        $submitted_address = sanitize_text_field( $_POST['submitted_address'] );
        $submitted_how_many_human = sanitize_text_field( $_POST['submitted_how_many_human'] );

        // Update the meta field.
        //update_post_meta( $post_id, '_my_meta_value_key', $mydata );
        update_post_meta( $post_id, 'submitted_occupation', $submitted_occupation );
        update_post_meta( $post_id, 'submitted_number', $submitted_number );
        update_post_meta( $post_id, 'author_name', $author_name );
        update_post_meta( $post_id, 'author_email', $author_email );
        //update_post_meta( $post_id, 'submitted_author_email', $submitted_author_email );
        update_post_meta( $post_id, 'submitted_address', $submitted_address );
        update_post_meta( $post_id, 'submitted_how_many_human', $submitted_how_many_human );
    }


    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content( $post ) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );

        // Use get_post_meta to retrieve an existing value from the database.
        //$value = get_post_meta( $post->ID, '_my_meta_value_key', true );
        $display_occupation = get_post_meta ( $post->ID, 'submitted_occupation', true );
      	$phone = get_post_meta ( $post->ID, 'submitted_number', true );
      	$author_name = get_post_meta ( $post->ID, 'author_name', true );
      	$author_email = get_post_meta ( $post->ID, 'author_email', true );
        $submitted_author_email = get_post_meta ( $post->ID, 'submitted_author_email', true );
        $submitted_address = get_post_meta ( $post->ID, 'submitted_address', true );
        $address = get_post_meta ( $post->ID, 'address', true );
        $submitted_how_many_human = get_post_meta ( $post->ID, 'submitted_how_many_human', true );

        //print_r( $submitted_address );
        //print_r( $address );



        // Display the form, using the current value.


        ?>
        <style>
            .looking-list-metaboxes {
                width: 100%;
                display: grid;
            }
        </style>    
        <div class="looking-list-metaboxes">
            <label class="alignleft" style="color: black; width: 100%;"  for="submitted_occupation">
                <?php _e( 'Occupation', 'textdomain' ); ?>
            </label>
            <input type="text" id="submitted_occupation" name="submitted_occupation" value="<?php echo esc_attr( $display_occupation ); ?>" size="25" /></br>

            <label class="alignleft" style="color: black; width: 100%;" for="submitted_number">
                <?php _e( 'Phone', 'textdomain' ); ?>
            </label>
            <input type="text" class="alignleft" id="submitted_number" name="submitted_number" value="<?php echo esc_attr( $phone ); ?>" size="25" /></br>

            <label class="alignleft" style="color: black; width: 100%;" for="author_name">
                <?php _e( 'Author Name', 'textdomain' ); ?>
            </label>
            <input type="text" class="alignleft" id="author_name" name="author_name" value="<?php echo esc_attr( $author_name ); ?>" size="25" /></br>

            <label class="alignleft" style="color: black; width: 100%;" for="author_email">
                <?php _e( 'Author Email', 'textdomain' ); ?>
            </label>
            <input type="text" class="alignleft" id="author_email" name="author_email" value="<?php echo esc_attr( $author_email ); ?>" size="25" /></br>

            <label class="alignleft"  style="color: black; width: 100%;" for="author_email">
                <?php _e( 'Aadress', 'textdomain' ); ?>

            </label>
            <input type="text" class="alignleft" id="submitted_address" name="submitted_address" value="<?php echo esc_attr( $submitted_address ); ?>" size="25" /></br>
            <label class="alignleft"  style="color: black; width: 100%;" for="submitted_how_many_human">
                <?php _e( 'How many we are', 'textdomain' ); ?>

            </label>
            <input type="text" class="alignleft" id="submitted_how_many_human" name="submitted_how_many_human" value="<?php echo esc_attr( $submitted_how_many_human ); ?>" size="25" /></br>
        </div>
        <?php
    }
}
