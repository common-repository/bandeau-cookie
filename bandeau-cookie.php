<?php

/*
* Plugin Name: Bandeau Cookie : RGPD/GPDR Cookie Consent
* Plugin URI: https://www.bandeau-cookie.com
* Description: Gestion des cookies conforme au RGPD/GPDR. Configurez en 2 min votre bandeau de cookies, consentement aux cookies avec une bannière conforme au RGPD.
* Version: 1.2
* Author: Alfanet Technologies
* Text Domain: bandeau-cookie
*/

add_action( 'init', 'wpdocs_load_textdomain' );
add_action('wp_head', 'bandeau_cookie_script_to_head');

if ( is_admin() ) {
	require_once __DIR__ . '/inc/admin-bandeau-cookie.php';
}

function wpdocs_load_textdomain() {
	load_plugin_textdomain( 'bandeau-cookie', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
/**
* function for add script to head if option bandeauCookieIdKey is defined
*/
function bandeau_cookie_script_to_head(){

    $bandeauCookieIdKey=  get_option( 'bandeauCookieIdKey' );
    if($bandeauCookieIdKey){
        ?>
        <script>
            window.cookie_widget || (function () {
                var c = cookie_widget = function (f) {
                    c._.push(f)
                };
                c._ = [];
                window.cookies_rgpd = {
                    "id" : "<?php echo esc_attr($bandeauCookieIdKey); ?>"
                }
                var u="https://www.bandeau-cookie.com/";
                var d=document, g=d.createElement("script"),s=d.getElementsByTagName("script")[0]; 
                g.async=true; g.src=u+"v1/cookies.js"; 
                s.parentNode.insertBefore(g,s);
            })();
        </script>
    <?php
    }
}

?>
