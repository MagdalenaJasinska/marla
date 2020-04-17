<?php
/*
Plugin Name: Adventurewithin
Plugin URI: www.adventurewithin.com
description: Get adventurewithin pages content and functionality
Author: Mr Sanjay Singh
Author URI: www.adventurewithin.com
Text Domain: adventurewithin
Domain Path: /languages/
License: GPL2
*/


add_action('admin_menu', 'adventure_menu_pages');
function adventure_menu_pages(){
    add_menu_page('Personal Profile Users', 'Personal Profile Users', 'manage_options', 'personal_users', 'get_personal_users_data','dashicons-admin-users', 5  );
    //add_submenu_page('my-menu', 'Submenu Page Title', 'Whatever You Want', 'manage_options', 'my-menu' );
    //add_submenu_page('my-menu', 'Submenu Page Title2', 'Whatever You Want2', 'manage_options', 'my-menu2' );
}

function get_personal_users_data(){
	if(isset($_REQUEST['page'])){
		switch ($_REQUEST['page']) {
			case 'personal_users':
				require_once dirname( __FILE__ ).'/admin/adventure-list.php';
				break;
		}
	}
}

function get_user_profile_page(){
	if(is_user_logged_in()){
		$user_id = get_current_user_id();
		$user_data = get_userdata($user_id);
		$p_user_id = $user_id;
		if ( in_array( 'administrator', (array) $user_data->roles ) && array_key_exists('id', $_GET)) {
		    $p_user_id = $_GET['id'];
		}
		$user_metadata = get_personal_profile_data($p_user_id);
		require dirname(__FILE__).'/template/edit-user-profile.php';
	}else{
		require dirname(__FILE__).'/template/user-profile.php';
	}
}
add_shortcode('user_profile_page', 'get_user_profile_page');

function get_adventure_media_page(){
	require dirname(__FILE__).'/template/adventure-media.php';
}
add_shortcode('adventure_media', 'get_adventure_media_page');

function get_adventure_spotlight_page(){
   require dirname(__FILE__).'/template/adventure-spotlight.php';
}
add_shortcode('adventure_spotlight', 'get_adventure_spotlight_page');

function add_home_page_content(){ 
	$content_html = '';
	$content_html .= '<div class="main-box-content">';
	$content_html .= '<img class="come_explore_home_page" src="https://marla.fishbane.net/wp-content/uploads/2020/02/come_explore_home_page.jpg">';
	$content_html .= ''.do_shortcode("[print_responsive_thumbnail_slider]").'';
	$content_html .= '<div class="middle-box-img">';
	$content_html .= '<img src="'.content_url('/uploads/2020/02/balance.png').'">';
	$content_html .= '</div>';
	$content_html .= '</div>';
	return $content_html;
}
add_shortcode('home_page_content', 'add_home_page_content');

//Save personal profile data
function save_personal_profile(){
	if(isset($_POST['submit-personal-profile']) && wp_verify_nonce($_POST['personal_register_nonce'], 'personal-register-nonce')) {
		$user_login = $_POST['uname'];
		$up_uemail 	= $_POST['uemail'];
		$userdata = get_user_by('email', $up_uemail);
		if(!empty($userdata)){
			adventure_errors()->add('email_used', __('Email already registered'));
		}else{
			$password 	= 12345678;
			$up_user_id = wp_insert_user(array(
					'user_login'		=> $user_login,
					'user_pass'	 		=> $password,
					'user_email'		=> $up_uemail,
					'first_name'		=> $user_login,
					'last_name'			=> '',
					'user_registered'	=> date('Y-m-d H:i:s'),
					'role'				=> 'subscriber'
				)
			);
			
			if($up_user_id){
				update_profile_meta_data($up_user_id);
				// send an email to the admin alerting them of the registration
				//wp_new_user_notification($up_user_id);
				// log the new user in
				$creds = array();
				$creds['user_login'] = $user_login;
				$creds['user_password'] = $password;
				$creds['remember'] = true;
				$user = wp_signon( $creds, false );
				ob_start();
				$userID = $user->ID;

				wp_set_current_user( $userID, $user_login );
				wp_set_auth_cookie( $userID, true, false );
				do_action( 'wp_login', $user_login );
				// send the newly created user to the home page after logging them in
				wp_redirect(home_url('personal-profile/')); exit;
		    }
		}
	}
	if(isset($_POST['update-personal-profile']) && wp_verify_nonce($_POST['personal_update_nonce'], 'personal-update-nonce')) {
		$user_id = get_current_user_id();
		$up_uname 	= $_POST['uname'];
		$up_uemail 	= $_POST['uemail'];
		global $wpdb;
		$wpdb->update($wpdb->users, array('user_email' => $up_uemail), array('ID' => $user_id));
		wp_update_user( array ( 'ID' => $user_id, 'first_name' => $up_uname ));
		update_profile_meta_data($user_id);
	}
}
add_action('init', 'save_personal_profile');

function update_profile_meta_data($up_user_id){
	$up_uname 								= $_POST['uname'];
	$up_uemail 								= $_POST['uemail'];
	$up_hphone 								= $_POST['uhphone'];
	$up_uaddress							= $_POST['uaddress'];
	$up_ucphone 							= $_POST['ucphone'];
	$up_ucity 								= $_POST['ucity'];
	$up_ustate 								= $_POST['ustate'];
	$up_uzipcode 							= $_POST['uzipcode'];
	
	$up_udate_of_birth 						= $_POST['udate_of_birth'];
	$up_uage 								= $_POST['uage'];
	$up_umarital_status 					= $_POST['umarital_status'];
	$up_uis_previously_experienced_healing 	= $_POST['uis_previously_experienced_healing'];

	$up_with_whom				         	= $_POST['uwith_whom'];
	$up_upresent_physician_health         	= $_POST['upresent_physician_health'];
	$up_u_list_medication_drugs      	  	= $_POST['u_list_medication_drugs'];
	$up_u_list_illnesses_surgeries        	= $_POST['u_list_illnesses_surgeries'];
	$up_u_is_any_residual_effects         	= $_POST['u_is_any_residual_effects'];
	$up_u_specific_problems        		  	= $_POST['u_specific_problems'];
	$up_u_goals_expectations              	= $_POST['u_goals_expectations'];
	$up_living_under_stress              	= array_key_exists('u_living_under_stress', $_POST)?$_POST['u_living_under_stress']:'';
	$up_u_do_you_exercise                	= $_POST['u_do_you_exercise'];
	$up_u_how_often                 	  	= $_POST['u_how_often'];
	$up_u_do_you_smoke                 	  	= $_POST['u_do_you_smoke'];
	$up_u_how_much                 	  	  	= $_POST['u_how_much'];
	$up_u_do_you_meditate                 	= $_POST['u_do_you_meditate'];
	$up_spiritual_practice                 	= $_POST['u_spiritual_practice'];
	$up_u_date              				= $_POST['u_date'];
	$up_u_signature              			= $_POST['u_signature'];
	if(!empty($up_udate_of_birth)){
		$up_udate_of_birth = date('Y-m-d', strtotime($up_udate_of_birth));
	}

	if(!empty($up_u_date)){
		$up_u_date = date('Y-m-d', strtotime($up_u_date));
	}

	update_user_meta($up_user_id, 'first_name', $up_uname);
	update_user_meta($up_user_id, '_personal_profile_email', $up_uemail);
	update_user_meta($up_user_id, '_personal_profile_phone', $up_hphone);
	update_user_meta($up_user_id, '_personal_profile_address', $up_uaddress);
	update_user_meta($up_user_id, '_personal_profile_cellphone', $up_ucphone);
	update_user_meta($up_user_id, '_personal_profile_city', $up_ucity);
	update_user_meta($up_user_id, '_personal_profile_state', $up_ustate);
	update_user_meta($up_user_id, '_personal_profile_zipcode', $up_uzipcode);
	update_user_meta($up_user_id, '_personal_profile_date_of_birth', $up_udate_of_birth);
	update_user_meta($up_user_id, '_personal_profile_age', $up_uage);
	update_user_meta($up_user_id, '_personal_marital_status', $up_umarital_status);
	update_user_meta($up_user_id, '_personal_marital_is_previously_experienced_healing', $up_uis_previously_experienced_healing);
	update_user_meta($up_user_id, '_personal_with_whom', $up_with_whom);
	update_user_meta($up_user_id, '_personal_profile_present_physician_health', $up_upresent_physician_health);
	update_user_meta($up_user_id, '_personal_profile_list_medication_drugs', $up_u_list_medication_drugs);
	update_user_meta($up_user_id, '_personal_profile_list_illnesses_surgeries', $up_u_list_illnesses_surgeries);
	update_user_meta($up_user_id, '_personal_profile_is_any_residual_effects', $up_u_is_any_residual_effects);
	update_user_meta($up_user_id, '_personal_profile_specific_problems', $up_u_specific_problems);
	update_user_meta($up_user_id, '_personal_profile_goals_expectations', $up_u_goals_expectations);
	update_user_meta($up_user_id, '_personal_living_under_stress', $up_living_under_stress);
	update_user_meta($up_user_id, '_personal_profile_do_you_exercise', $up_u_do_you_exercise);
	update_user_meta($up_user_id, '_personal_profile_how_often', $up_u_how_often);
	update_user_meta($up_user_id, '_personal_profile_do_you_smoke', $up_u_do_you_smoke);
	update_user_meta($up_user_id, '_personal_profile_how_much', $up_u_how_much);
	update_user_meta($up_user_id, '_personal_profile_do_you_meditate', $up_u_do_you_meditate);
	update_user_meta($up_user_id, '_personal_profile_spiritual_practice', $up_spiritual_practice);
	update_user_meta($up_user_id, '_personal_profile_sign_date', $up_u_date);
	update_user_meta($up_user_id, '_personal_profile_signature', $up_u_signature);
}

function get_personal_profile_data($user_id){
	$profile_data = new stdClass();
	$profile_data->profile_name = get_user_meta($user_id, 'first_name', true);
	$profile_data->profile_phone = get_user_meta($user_id, '_personal_profile_phone', true);
	$profile_data->profile_address = get_user_meta($user_id, '_personal_profile_address', true);
	$profile_data->profile_cellphone = get_user_meta($user_id, '_personal_profile_cellphone', true);
	$profile_data->profile_city = get_user_meta($user_id, '_personal_profile_city', true);
	$profile_data->profile_state = get_user_meta($user_id, '_personal_profile_state', true);
	$profile_data->profile_zipcode = get_user_meta($user_id, '_personal_profile_zipcode', true);
	$profile_data->profile_date_of_birth = get_user_meta($user_id, '_personal_profile_date_of_birth', true);
	$profile_data->profile_age = get_user_meta($user_id, '_personal_profile_age', true);
	$profile_data->profile_marital_status = get_user_meta($user_id, '_personal_marital_status', true);
	$profile_data->profile_marital_is_previously_experienced_healing = get_user_meta($user_id, '_personal_marital_is_previously_experienced_healing', true);
	$profile_data->with_whom = get_user_meta($user_id, '_personal_with_whom', true);
	$profile_data->profile_present_physician_health = get_user_meta($user_id, '_personal_profile_present_physician_health', true);
	$profile_data->profile_list_medication_drugs = get_user_meta($user_id, '_personal_profile_list_medication_drugs', true);
	$profile_data->profile_list_illnesses_surgeries = get_user_meta($user_id, '_personal_profile_list_illnesses_surgeries', true);
	$profile_data->profile_is_any_residual_effects = get_user_meta($user_id, '_personal_profile_is_any_residual_effects', true);
	$profile_data->profile_specific_problems = get_user_meta($user_id, '_personal_profile_specific_problems', true);
	$profile_data->profile_goals_expectations = get_user_meta($user_id, '_personal_profile_goals_expectations', true);
	$profile_data->profile_living_under_stress = get_user_meta($user_id, '_personal_living_under_stress', true);
	$profile_data->profile_do_you_exercise = get_user_meta($user_id, '_personal_profile_do_you_exercise', true);
	$profile_data->profile_how_often = get_user_meta($user_id, '_personal_profile_how_often', true);
	$profile_data->profile_do_you_smoke = get_user_meta($user_id, '_personal_profile_do_you_smoke', true);
	$profile_data->profile_how_much = get_user_meta($user_id, '_personal_profile_how_much', true);
	$profile_data->profile_do_you_meditate = get_user_meta($user_id, '_personal_profile_do_you_meditate', true);
	$profile_data->spiritual_practice = get_user_meta($user_id, '_personal_profile_spiritual_practice', true);
	$profile_data->profile_sign_date = get_user_meta($user_id, '_personal_profile_sign_date', true);
	$profile_data->profile_signature = get_user_meta($user_id, '_personal_profile_signature', true);
	return $profile_data;
}

//Add Css And Js
function add_css_and_scripts() {
    wp_register_style( 'adventure-style', plugins_url('assets/css/style.css?v=10', __FILE__), array(), null, 'all'  );
	wp_enqueue_style( 'adventure-style' );
    
    wp_register_script( 'adventure-swfobject', plugins_url('assets/media/swfobject/swfobject/src/swfobject.js', __FILE__), array( 'jquery' ), 'all' );
    wp_enqueue_script('adventure-swfobject');
    wp_register_script( 'adventure-script', plugins_url('assets/js/adventure-script.js', __FILE__), array( 'jquery' ), null, 'all' );
    wp_enqueue_script('adventure-script');
    wp_localize_script( 'adventure-script', 'adventure_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('wp_enqueue_scripts', 'add_css_and_scripts');
add_action('admin_enqueue_scripts', 'add_css_and_scripts');

// used for tracking error messages
function adventure_errors(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

// displays error messages from form submissions
function adventure_show_error_messages() {
	if($codes = adventure_errors()->get_error_codes()) {
		echo '<div class="pippin_errors">';
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = adventure_errors()->get_error_message($code);
		        echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		    }
		echo '</div>';
	}	
}