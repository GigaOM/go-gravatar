<?php
/**
 * Plugin Name: Gigaom Gravatar
 * Plugin URI: http://gigaom.com
 * Description: Allows you to retrieve gravatar account info in WP.
 * Version: 1.0
 * Author: Gigaom
 * Author URI: http://gigaom.com
 */

/**
 * Singleton
 */
function go_gravatar()
{
	global $go_gravatar;

	if ( ! isset( $go_gravatar ) || ! $go_gravatar )
	{
		require_once __DIR__ . '/components/class-go-gravatar.php';
		$go_gravatar = new GO_Gravatar();
	}//end if

	return $go_gravatar;
} // END go_gravatar