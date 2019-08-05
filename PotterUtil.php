<?php

/**
 * Filter characters by $name, returning the found characters.
 *
 * @param $name string The name of the character
 *
 * @param $characters array The array of characters, as returned by PotterApi.
 *
 * @return array The filtered characters found
 */
function findCharactersByName( $name, $characters ) {
	$charactersFound = array();

	foreach ( $characters as $character ) {
		if ( ! isset( $character['name'] ) ) {
			throw new RuntimeException( "Invalid characters array (missing 'name')!" );
		}
		if ( strpos( strtolower( $character['name'] ), strtolower( $name ) ) !== false ) {
			$charactersFound[] = $character;
		}
	}

	return $charactersFound;
}