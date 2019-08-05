<?php

class PotterApi {

	private $apiKey;

	public function __construct( $apiKey ) {
		$this->apiKey = $apiKey;
	}

	/**
	 * @param array $options Filter options using the available params at potterapi.com.
	 *
	 * @return array The characters.
	 * @throws Exception On HTTP error
	 */
	public function getCharacters( $options = array() ) {
		$options['key'] = $this->apiKey;

		$req = curl_init( POTTER_API_PREFIX . POTTER_API_CHARACTERS_ROUTE . "?" . http_build_query( $options ) );
		curl_setopt( $req, CURLOPT_RETURNTRANSFER, 1 );

		$response = curl_exec( $req );
		$httpcode = curl_getinfo( $req, CURLINFO_HTTP_CODE );

		if ( $httpcode != 200 ) {
			throw new Exception( "An unexpected error occurred while getting the characters from Potter API: " . $response );
		}

		return json_decode( $response, true );

	}

}