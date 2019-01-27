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

if(is_front_page()){ ?>
    <style>
        .login_register_nav{
            width: auto;
        }
    </style>
<?php 
}
?>
<main class="container hold_login_form">
    <div class="row login_register_nav">
        <div class="col-md-12 login_register_links">
                <a class="btn login_active">Sign in</a>
                <a href="<?php echo $current_url=$_SERVER['REQUEST_URI'] . 'register' ; ?>" class="btn">Sign up </a>
        </div>
        <div class="col-md-12">
            <?php wp_login_form($args);?>
            <div class="hr_container">
            <hr class="login_register_hr">
            </div>
            <div class="forget_pass">
            <a href="<?php echo wp_lostpassword_url(); ?>" title="Lost Password">Forget Password?</a>
            <p>D Y E P I E . C O M</p>
            </div>
        </div>
    </div>
</main>