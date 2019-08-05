<?php

include_once "PotterApi.php";
include_once "Constants.php";
include_once "PotterUtil.php";

//Define and get the command line arguments
$longopts = array(
	"house:",
	"name:",
	"key:"
);
$options  = getopt( "", $longopts );


if ( ! isset( $options['key'] ) ) {
	echo "You must specify an API key with --key <key>!";

	return;
}

$key = $options['key'];
$api = new PotterApi( $key );

try {
	if ( isset( $options['house'] ) ) {
		$chars = $api->getCharacters( array( 'house' => ucfirst( $options['house'] ) ) ); //Get characters by house (also make the first letter of the house uppercase)
	} else {
		$chars = $api->getCharacters();
	}
} catch ( Exception $e ) {
	echo $e->getMessage();

	return;
}

if ( isset( $options['name'] ) ) {
	$chars = findCharactersByName( $options['name'], $chars );
}

if ( sizeof( $chars ) == 0 ) {
	echo "No characters matched your query!";
}

foreach ( $chars as $char ) {
	echo $char['name'] . "\n";
}