<?php 
// login form
$args = array(
    'echo'              => true,
    'remember'       => true,
    'redirect'          => get_the_permalink(),
    'form_id'           => 'loginform',
    'label_username'    => 'اسم البائع أو البريد الاليكترونى',
    'value_remember'    => true,
	'id_username'    => 'user_login',
	'id_password'    => 'user_pass',
	'id_remember'    => 'rememberme',
	'id_submit'      => 'wp-submit',
	'label_password' => __( 'Password' ),
	'label_remember' => __('KEEP ME SIGNED IN'),
	'label_log_in'   => __( 'SIGN IN' ),
    'value_username' => '',
);
    wp_login_form($args);