<?php namespace BishopJ88\LaraGab\Traits;

use Exception;

Trait HelperTrait {
    
    static public $output = false;

	/**
	 * Allows the user to work with the output as an array.
	 *
	 * @return array Returns JSON as array.
	 */
	public function outputAsArray( $output = false ){
        
		if( $output === true ){
			$output = true;
		}
        
        self::$output = $output;
	}
}