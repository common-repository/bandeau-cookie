<?php
add_action( 'admin_menu','bandeau_cookie_add_to_menu_admin');

/**
* function for add plugin setting in personalisation  
*/
function bandeau_cookie_add_to_menu_admin(){
    add_options_page(__('Bandeau Cookie : RGPD/GPDR Cookie Consent','bandeau-cookie'),__('Bandeau Cookie : RGPD/GPDR Cookie Consent','bandeau-cookie'),'manage_options','bandeau-cookie','bandeau_cookie_admin_parametrage');
}

/**
* function for create setting window 
*/
function bandeau_cookie_admin_parametrage(){
    $plug_dir=plugin_dir_url( __DIR__ );
    $logo=$plug_dir.'img/logo_BC_v02_SA.png';
    ?>
    <div class="wrap" >
        <div class="bandeau-cookie-form">
            <img id="logo_bandeau_cookie" class="logo_bandeau_cookie"  alt="Logo bandeau cookie" src="<?php echo esc_attr($logo)?>" />
            <h1><?php _e( 'Configuration du bandeau cookie' ,'bandeau-cookie') ?>  </h1>
            <p>Rendez-vous sur <a target="_blank" href="https://www.bandeau-cookie.com/page/comment-mettre-en-place-un-bandeau-cookie">bandeau-cookie.com</a> afin de récupérer votre identifiant.</p>
            <?php
                if ( isset( $_POST['updated'] ) && $_POST['updated'] === 'true' && check_admin_referer( 'update-cookie-key_'.get_current_user_id() ) ) {
                    bandeau_cookie_admin_save_form();
                }
                bandeau_cookie_admin_form_identifiant();
            ?>
        </div>
    </div>
    <style type="text/css">

        /**
        * #.bandeau-cookie# Personalisation for form
        */
        .bandeau-cookie-form{
            text-align: center;
        }

        .bandeau-cookie-center{
            text-align: center;
            margin-top: 25px;
        }
        
        .bandeau-cookie-submit{
           
            height: 45px;
            margin-bottom: 15px;
            box-sizing: border-box;
            background-color: #1a67c3;
            border: 0;
            border-radius: 4px;
            color: #fff;
            text-transform: uppercase;
            font-weight: 400;
            font-size: 18px;
            outline: 0;
            line-height: 1.5;
            cursor: pointer;
        }

        .bandeau-cookie-submit:hover{
            background-color: #0c4488 ;
        }

        .bandeau-cookie-success{
            padding: 6px;
            width: 325px;
            margin-left: auto;
            margin-right: auto;
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            border-radius: 5px;
        }

        .bandeau-cookie-error{
            padding: 6px;
            width: 325px;
            margin-left: auto;
            margin-right: auto;
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            border-radius: 5px;
        }

        .bandeau-cookie-success p{
            margin: unset;
        }

        .bandeau-cookie-error p{
            margin: unset;
        }

    </style>
    <?php
}

/**
* function for create form 
*/
function bandeau_cookie_admin_form_identifiant(){
    
    $bandeauCookieIdKey= get_option( 'bandeauCookieIdKey' );
    ?>
        <form method="post" action="">
            <?php
                wp_nonce_field( 'update-cookie-key_'.get_current_user_id());
            ?>
            <input type="hidden" name="updated" value="true" />
            <h4><?php _e( 'Identifiant du bandeau' ,'bandeau-cookie') ?></h4>
            <input style="width: 300px;" type="text" class="bandeau_cookie_key" name="bandeauCookieIdKey" value="<?php echo esc_attr($bandeauCookieIdKey)?>" />
            <div class="bandeau-cookie-center" >
                <input class="bandeau-cookie-submit" type="submit" value="Sauvegarder" />
            </div>
        </form>
    <?php
}

/**
* function if form is submit for save data
*/
function bandeau_cookie_admin_save_form(){
    if ( isset( $_POST['bandeauCookieIdKey'] ) && check_admin_referer( 'update-cookie-key_'.get_current_user_id() )) {
        update_option( 'bandeauCookieIdKey', sanitize_text_field( $_POST['bandeauCookieIdKey'] ) );
        ?>
            <div class="bandeau-cookie-success">
                <p><?php _e( 'Modification réussie avec succès','bandeau-cookie' ) ?></p>
            </div>
        <?php
    } else {
        ?>
            <div class="bandeau-cookie-error">
                <p><?php _e( 'Modification échouée' ,'bandeau-cookie') ?></p>
            </div>
        <?php
    }
}


