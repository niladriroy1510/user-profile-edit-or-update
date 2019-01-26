<?php
// add contact information authour
function extra_contact_info($contactmethods) {
	unset($contactmethods['aim']);
	unset($contactmethods['yim']);
	unset($contactmethods['jabber']);
	$contactmethods['facebook'] = 'Facebook';
	$contactmethods['twitter'] = 'Twitter';
	$contactmethods['linkedin'] = 'LinkedIn';
	$contactmethods['googleplus'] = 'Google+';
return $contactmethods;
}
add_filter('user_contactmethods', 'extra_contact_info');	
	
	
// Without Login Security

function check_page_security() {
	if( !is_user_logged_in() ) {
		wp_redirect( home_url() );
		exit();
	}
}	

// Page editting support

function ecs_add_post_state( $post_states, $post ) {
	if( $post->post_name == 'edit-profile' ) {
		$post_states[] = 'Profile edit page';
	}
	return $post_states;
}
add_filter( 'display_post_states', 'ecs_add_post_state', 10, 2 );	
	

// Add notice to the profile edit page

function ecs_add_post_notice() {
	global $post;
	if( isset( $post->post_name ) && ( $post->post_name == 'edit-profile' ) ) {
	  /* Add a notice to the edit page */
		add_action( 'edit_form_after_title', 'ecs_add_page_notice', 1 );
		/* Remove the WYSIWYG editor */
		remove_post_type_support( 'page', 'editor' );
	}	
}
function ecs_add_page_notice() {
	echo '<div class="notice notice-warning inline"><p>' . __( 'You are currently editing the profile edit page. Do not edit the title or slug of this page!', 'textdomain' ) . '</p></div>';
}
add_action( 'admin_notices', 'ecs_add_post_notice' );	

