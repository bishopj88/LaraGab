<?php namespace BishopJ88\LaraGab\Traits;

use Exception;
use Cache;
use Storage;
use Config;

Trait ConnectionTrait {

	/**
	 * Generates a URL that can be used to authenticate.
	 *
	 * @param string $client_id 	~ Client ID
	 * @param string $redirect_uri 	~ Redirect URI
	 * @param string $scope 		~ Scopes string
	 * @param bool 	 $html 			~ HTML link 1:0
	 *
	 * @return string Returns either link or url.
	 */
	public function generateLoginURL( $client_id, $redirect_uri, $scope, $html = 0)
	{
        $url = "https://api.gab.com/oauth/authorize?response_type=code&client_id="
                .$client_id."&redirect_uri=".$redirect_uri."&scope=".$scope."";
        
		if( $html === 0 ){
			return $url;
		}
		else{
			return "<a href='".$url."'>Click here</a>";	
		}
	}
	/**
	 * Retrieving the access tokens.
	 *
	 * @param string $code 	~ Code returned from generated Login URL
	 *
	 * @return string Returns JSON with all tokens.
	 */
    public function get_access_token( $code ){
			             
        $parameters = array(
            'grant_type' => 'authorization_code',
            'code' => $code,
            'client_id' => Config::get('laragab.gab_clientID'),
            'client_secret' => Config::get('laragab.gab_secret'),
            'redirect_uri' => Config::get('laragab.gab_redirect_uri')
        );
		
		return $this->post('https://api.gab.com/oauth/token', $parameters );
    }
}