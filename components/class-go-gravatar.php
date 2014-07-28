<?php

class GO_Gravatar
{
	public $cache_time = 86400; // 24 hours

	/**
	 * Get gravatar img
	 */
	public function get_img( $email, $size = 96, $default = '', $alt = FALSE )
	{
		return get_avatar( $email, $size, $default, $alt );
	} // END get_img

	/**
	 * Get the gravatar img URL
	 */
	public function get_img_url( $email, $size = 96, $default = '', $alt = FALSE )
	{
		$html = $this->get_img( $email, $size, $default, $alt );

		$doc = new DOMDocument();
		$doc->loadHTML( $html );

		$xpath = new DOMXPath( $doc );
		$imgs  = $xpath->query( '//img' );

		if ( $imgs->item( 0 ) )
		{
			return $imgs->item( 0 )->getAttribute( 'src' );
		} // END if
	} // END get_img_url

	/**
	 * Get gravatar profile
	 */
	public function get_profile( $email )
	{
		if ( ! is_email( $email ) )
		{
			return;
		} // END if

		// Build gravatar hash out of email
		$gravatar_hash = md5( strtolower( trim( $email ) ) );

		// Check for existing cache
		if ( ! $response = wp_cache_get( $gravatar_hash, 'go-gravatar' ) )
		{
			// Attempt to retrieve profile as JSON
			$response = wp_remote_get( 'http://www.gravatar.com/' . $gravatar_hash . '.json' );

			wp_cache_set( $gravatar_hash, $response, 'go-gravatar', $this->cache_time );
		} // END if

		// Did we find a profile?
		// sanitization via http://kitchen.gigaom.com/2014/06/30/quickly-sanitizing-api-feedback/
		$profile = json_decode( sanitize_text_field( wp_remote_retrieve_body( $response ) ) );

		if ( ! isset( $profile->entry[0]->id ) )
		{
			return;
		} // END if

		return $profile->entry[0];
	} // END get_profile
}// END GO_Gravatar