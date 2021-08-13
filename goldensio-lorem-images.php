<?php

/*
* @package: goldensio goldensio-lorem-images
*/
/**
 * Plugin Name: Goldensio Lorem & Images
 * Plugin URI: https://www.goldensio.com/plugin-goldensio-lorem-images
 * Description: Shows Lorem Ipsum text or random images to fill temporary content.
 * Version: 1.0.0
 * Author: goldensio
 * Author URI: http://www.goldensio.com
 * License: GPL-2.0+
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
**/
 
defined('ABSPATH') or die('no access');
 
// define variable for path to this plugin file.
define( 'goldensio_goldensio-lorem-images_LOCATION', dirname( __FILE__ ) );
define( 'goldensio_goldensio-lorem-images_HD_ESPW_LOCATION_URL', plugins_url( '', __FILE__ ) );
 
 
function goldensio_lorem_images ( $atts) {

    //shortcode: gld-lorem -> [gld-lorem type="image"]
   
    //in base allo shortcode inserisco testo o immagine
    $lorem="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
    $tag_i="<p>";
    $tag_f="</p>";

    $type="text";
    $repetition=1;
    $image="https://picsum.photos/";
    $w=200;

    //prendo le opzioni
    $attr=shortcode_atts(
        array(
            'type' => $type,
            'repetition' => $repetition,
            'lorem'  => $lorem,
            'tag_i' => $tag_i,
            'tag_f' => $tag_f,
            'image' => $image,
            'w' => $w,
        ),
        $atts
    );


    if ($attr['type']=="text") {
        $text=$attr['tag_i'] . $attr['lorem'] . $attr['tag_f'];
        return str_repeat($text, $attr['repetition']);
    }

    if ($attr['type']=="image") {
        $img= $attr['image'] .  $attr['w'] . "?rand=".rand();
        return "<img src='$img'>";
    }

}

add_shortcode('gld-lorem', 'goldensio_lorem_images');
 
// PLUGIN MENU
add_action( 'admin_menu', 'my_plugin_menu' );
 
function my_plugin_menu() {
   add_options_page( 'Lorem & Images by goldensio', 'Lorem & Images', 'manage_options', 'goldensio_goldensio-lorem-images', 'goldensio_lorem_images_options_page');
}

function goldensio_lorem_images_options_page() {
   if ( !current_user_can( 'manage_options' ) )  {
    wp_die(__('You do not have sufficient permissions to access this page.'));
   }
   echo '<div class="wrap">';
   echo '<h2>Goldensio Lorem & Images</h2>';
   echo "<p>This free plugin shows random images or Lorem Ipsum text to fill out content missing spaces, use it while creating your awesome website to evaluate spaces!<br><br>
        The image type will show a random image from the website: https://picsum.photos/.</p>";
   echo "
        <h3>Use this shortcode: <strong>[gld-lorem]</strong></h3>
        <hr>
        <p>There are a lot of <strong>options</strong> you can set:
        <ul>
            <li><strong>type</strong> -> can be 'text' or 'image', default if empty: text - i.e. [gld-lorem type=\"image\"]</li>
            <li><strong>repetition</strong> -> the number of times you want the text (not image) to be repeated, default is 1</li>
            <li><strong>lorem</strong> -> custom text, default is all the Lorem Ipsum paragraph - i.e. [gld-lorem type=\"your custom text\"]</li>
            <li><strong>w</strong> -> width (of the image), default is 200</li>
        </ul>
        </p>
        ";
    echo "<hr><p><div style='float:left;margin-right:10px;'>";
    echo get_avatar("goldensio@gmail.com");
    echo "</div>Hi! I'm goldensio!<br><br>Do you like my plugin? Want to offer me a coffee?<br>
    Feel free to show your appreciation to my<br>
    <strong><a href='https://paypal.me/goldensio' target='_blank'>PayPal account</a></strong></p>";
   echo '</div>';
 
}