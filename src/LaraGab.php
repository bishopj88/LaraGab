<?php
namespace BishopJ88\LaraGab;
use SessionStore;
use Config;
use Cache;
use Redirect;
use Exception;

/* Traits */
use BishopJ88\LaraGab\Traits\ConnectionTrait;
use BishopJ88\LaraGab\Traits\ReadTrait;
use BishopJ88\LaraGab\Traits\NotificationsTrait;
use BishopJ88\LaraGab\Traits\EngageUserTrait;
use BishopJ88\LaraGab\Traits\EngagePostTrait;
use BishopJ88\LaraGab\Traits\WritePostTrait;

 /**
  * LaraGab - Gab Laravel API package.
  *
  * LaraGab is a package for Laravel that will allow
  * developers to easily integrate Gab features into
  * their own Laravel projects.
  *
  * This package will evolve and improve over time,
  * also based on Gab's own development.
  *
  * The section after the description contains the tags; which provide
  * structured meta-data concerning the given element.
  *
  * @author  Jeffrey Bishop <info@pynex.nl>
  * @copyright 2018- Pynex
  * @since 1.0
  */
class LaraGab
{
    
    use ReadTrait,
        ConnectionTrait,
        NotificationsTrait,
        EngageUserTrait,
        WritePostTrait,
        EngagePostTrait;
    
    private $access_token;
    
    public function __construct(){
        
		// Check for the existence of a config file
        if ( Config::has('laragab') )
		{
            // Checking if access_token property is set
            if( !$this->access_token )
			{
				// Setting access_token if found in config.
				if( Config::get('laragab.gab_access_token') ){
					$this->access_token = Config::get('laragab.gab_access_token');
				}				
            }
			
		} else {
            throw new Exception('No LaraGab Config File found!');
        }
    }
    
	public function get( $call, $parameters = [] )
	{
		return $this->query( $call, 'GET', $parameters );
	}

	public function post( $call, $parameters = [] )
	{
		return $this->query( $call, 'POST', $parameters );
	}
    
	public function delete( $call, $parameters = [] )
	{
		return $this->query( $call, 'DELETE', $parameters );
	}
    
    public function query( $call, $requestMethod = 'GET', $parameters = [] ){
        
		$headers = array("Authorization: Bearer " . $this->access_token);
		if( !is_array($parameters) ){
			$headers = array(
				"Authorization: Bearer " . $this->access_token,
				"Content-Type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
				"content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
			);
		}
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $call,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $requestMethod,
            CURLOPT_POSTFIELDS => $parameters,
            CURLOPT_HTTPHEADER => $headers
        ));
        
        $response = curl_exec($curl);
        
        $err = curl_error($curl);
        curl_close($curl);
        
        if ($err) {
            throw new Exception('cURL Error #:" . $err');
        } else {
            return $response;
        }
    }  
}