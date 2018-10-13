<?php namespace BishopJ88\LaraGab\Traits;

use Exception;

Trait EngageUserTrait {

	/**
	 * Unfollows given user.
	 *
	 * @param array $parameters username ~ Username of user
	 *
	 * @return string Returns JSON.
	 */
	public function unfollowUser( $parameters = ['username' => ''] )
	{
		return $this->delete('https://api.gab.com/v1.0/users/' .$parameters['username']. '/follow');
    }
	
	/**
	 * Follows given user or creates a follow request if the target user is private.
	 *
	 * @param array $parameters username ~ Username of user
	 *
	 * @return string Returns JSON.
	 */
	public function followUser( $parameters = ['username' => ''] )
	{
		return $this->post('https://api.gab.com/v1.0/users/' .$parameters['username']. '/follow');
    }
}