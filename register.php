<?php 
/* Template Name: Register Page */
get_header('login-register'); ?>
<main class="container hold_login_form">
    <div class="row login_register_nav">
        <div class="col-md-12 login_register_links">
                <a href="/log-in" class="btn">Sign in</a>
                <a class="btn signup_active">Sign up </a>
        </div>
        <div class="col-md-12">
            <?php custom_registration_function(); ?>
            <div class="hr_container">
            <hr class="login_register_hr">
            </div>
            <div class="forget_pass">
            Already A User ?
            <a href="/log-in" title="Lost Password">SIGN IN</a>
            <p>
            <a href="<?php echo home_url() ?>">D Y E P I E . C O M</a>
            </p>
            </div>
        </div>
    </div>
</main>
<?php 
get_footer('login-register'); ?>


<?php 
if(is_user_logged_in()){ ?>
    <div class="loggedin_user">
        you are logged in click to back home 
        <a href="<?php echo home_url() ?>">dyepie.com</a>
        or
        <a href="<?php echo wp_logout_url(get_the_permalink()); ?>">Logout</a>
    </div>
    <?php
} 
if(is_page('register')){ ?>
<style>
    body{
        background: rgba(66, 89, 83, 0.69);
        min-height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .logged-in .signup{
    display: none;
    }
    html{
    background-size: cover;
    background-image: url(/wp-content/themes/dyepie/images/login-bg.jpg);
    background-repeat: no-repeat;
    background-position: center center;
    height: 100%;
  }

  .login-submit {
    position: relative;
    top: 1em;
}
</style>
<?php 
}
?>