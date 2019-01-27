<?php 
function registration_form( $username, $password, $email, $first_name, $last_name ) {
    
    echo '
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post" class="loginform_class">
    <div>
    <input class="input" type="text" name="fname" value="' . ( isset( $_POST['fname']) ? $first_name : null ) . '" placeholder="First Name">
    <input class="input" type="text" name="lname" value="' . ( isset( $_POST['lname']) ? $last_name : null ) . '" placeholder="Last Name">
    </div>
    <div>
    <input class="input" type="text" name="username" value="' . ( isset( $_POST['username'] ) ? $username : null ) . '" placeholder="Username">
    </div>   
    <div>
    <input class="input" type="text" name="email" value="' . ( isset( $_POST['email']) ? $email : null ) . '" placeholder="Email">
    </div>
    <div>
    <input class="input" type="password" name="password" value="' . ( isset( $_POST['password'] ) ? $password : null ) . '" placeholder="Password">
    </div>
    <div class="login-submit">
        <input class="button button-primary" type="submit" name="submit" value="Register"/>
    </div>
    </form>
    ';
}
function registration_validation( $username, $password, $email, $first_name, $last_name )  {
    global $reg_errors;
    $reg_errors = new WP_Error;
    if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
        $reg_errors->add('field', 'Required form field is missing');
    }
    if ( 4 > strlen( $username ) ) {
        $reg_errors->add( 'username_length', 'Username too short. At least 4 characters is required' );
    }

    if ( username_exists( $username ) ){
    $reg_errors->add('user_name', 'Sorry, that username already exists!');
    }
    if ( ! validate_username( $username ) ) {
        $reg_errors->add( 'username_invalid', 'Sorry, the username you entered is not valid' );
    }
    if ( 5 > strlen( $password ) ) {
        $reg_errors->add( 'password', 'Password length must be greater than 5' );
    }
    if ( !is_email( $email ) ) {
        $reg_errors->add( 'email_invalid', 'Email is not valid' );
    }
    if ( email_exists( $email ) ) {
        $reg_errors->add( 'email', 'Email Already in use' );
    }
    if ( is_wp_error( $reg_errors ) ) {
 
        foreach ( $reg_errors->get_error_messages() as $error ) {
         
            echo '<div>';
            echo '<strong>ERROR</strong>:';
            echo $error . '<br/>';
            echo '</div>';
             
        }
     
    }
    
}
function complete_registration() {
    global $reg_errors, $username, $password, $email, $first_name, $last_name;
    if ( 1 > count( $reg_errors->get_error_messages() ) ) {
        $userdata = array(
        'user_login'    =>   $username,
        'user_email'    =>   $email,
        'user_pass'     =>   $password,
        'first_name'    =>   $first_name,
        'last_name'     =>   $last_name,
        );
        $user = wp_insert_user( $userdata );
        echo '<h5 class="com_register">Registration complete, <br>
        welcome " '. $username .' "
         click
         <a href="' . get_site_url() . '/log-in">login</a>
         </h5>';
        ?>
        <style>
        .loginform_class,
        .forget_pass,
        .login_register_hr{
            display: none;
        }
        .login_register_links {
            text-align: center !important;
        }
        h5.com_register {
            color: #89aa9a !important;
            text-shadow: 0px 0px 2px #000;
            font-weight: 900;
            font-size: 25px;
            line-height: 2em;
        }

        .com_register a {
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        </style>
        <?php 
    }
}
function custom_registration_function() {
    global $username, $password, $email, $first_name, $last_name;

    if ( isset($_POST['submit'] ) ) {
        registration_validation(
        $_POST['username'],
        $_POST['password'],
        $_POST['email'],
        $_POST['fname'],
        $_POST['lname']
        );
         
        // sanitize user form input
        $username   =   sanitize_user( $_POST['username'] );
        $password   =   esc_attr( $_POST['password'] );
        $email      =   sanitize_email( $_POST['email'] );
        $first_name =   sanitize_text_field( $_POST['fname'] );
        $last_name  =   sanitize_text_field( $_POST['lname'] );
 
        // call @function complete_registration to create the user
        // only when no WP_error is found
        complete_registration(
        $username,
        $password,
        $email,
        $first_name,
        $last_name
        );
    }
    registration_form(
        $username,
        $password,
        $email,
        $first_name,
        $last_name
        );
    }
?>