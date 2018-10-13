<?php namespace BishopJ88\LaraGab\Traits;

use Exception;

Trait ReadTrait {

	/**
	 * Returns the information about logged-in user.
	 *
	 * @return string Returns JSON.
	 */
	public function getMe()
	{
		return $this->get('https://api.gab.com/v1.0/me/');
    }
	/**
	 * Returns the information about a user with given username.
	 *
	 * @param array $parameters username ~ Username of user
	 *
	 * @return string Returns JSON.
	 */
    public function getUser( $parameters = ['username' => ''] )
    {
        return $this->get('https://api.gab.com/v1.0/users/'.$parameters['username']);
    }
	/**
	 * Returns followers of given user.
	 *
	 * @param array $parameters username ~ Username of user
	 * @param array $parameters before ~ Pagination
	 *
	 * @return string Returns JSON.
	 */
    public function getUserFollowers( $parameters = ['username' => '', 'before' => 0] )
    {
        return $this->get('https://api.gab.com/v1.0/users/'.$parameters['username'].'/followers?before='.$parameters['before']);
    }
	/**
	 * Returns the users that given user is following. 
	 *
	 * @param array $parameters username ~ Username of user
	 * @param array $parameters before ~ Number of users to skip
	 *
	 * @return string Returns JSON.
	 */
    public function getUserFollowing( $parameters = ['username' => '', 'before' => 0] )
    {
        return $this->get('https://api.gab.com/v1.0/users/'.$parameters['username'].'/following?before='.$parameters['before']);
    }
	/**
	 * Returns the main feed of the authenticated user.
	 *
	 * @param array $parameters before ~ Example: ['before' => '2018-10-03T19:35:47+00:00']
	 * Only parameter requires a date in ISO8601 datetime to load older posts.
	 *
	 * @return string Returns JSON.
	 */
    public function getFeed( $parameters = ['before' => ''] )
    {
        return $this->get('https://api.gab.com/v1.0/feed/?before='.$parameters['before']);
    }
	/**
	 * Returns the feed of given user.
	 *
	 * @param array $parameters username ~ Username of user
	 * @param array $parameters before ~ Example: ['before' => '2018-10-03T19:35:47+00:00']
	 * Only parameter requires a date in ISO8601 datetime to load older posts.
	 *
	 * @return string Returns JSON.
	 */
    public function getUserFeed( $parameters = ['username' => '', 'before' => 0] )
    {
        return $this->get('https://api.gab.com/v1.0/users/'.$parameters['before'].'/feed/?before='.$parameters['before']);
    }
	/**
	 * Returns the popular feed.
	 *
	 * @param array $parameters void
	 *
	 * @return string Returns JSON.
	 */
    public function getPopularFeed()
    {
        return $this->get('https://api.gab.com/v1.0/popular/feed/');
    }
	/**
	 * Returns popular users.
	 *
	 * @param array $parameters void
	 *
	 * @return string Returns JSON.
	 */
    public function getPopularUsers()
    {
        return $this->get('https://api.gab.com/v1.0/popular/users/');
    }
	/**
	 * Returns a list of groups with more activities recently.
	 *
	 * @param array $parameters void
	 *
	 * @return string Returns JSON.
	 */
    public function getPopularGroups()
    {
        return $this->get('https://api.gab.com/v1.0/groups');
    }
	/**
	 * Returns details of given group.
	 *
	 * @param array $parameters group_id ['group_id' => 'f8f914da-4423-4f0b-abb0-9e289cad8413']
	 * First parameter requires the Group ID.
	 *
	 * @return string Returns JSON.
	 */
    public function getGroupDetails( $parameters = ['group_id' => ''] )
    {
        return $this->get('https://api.gab.com/v1.0/groups/'.$parameters['group_id']);
    }
	/**
	 * Returns a list of given group's members.
	 *
	 * @param array $parameters group_id ~ ID of Group
	 * @param array $parameters before ~ Pagination of users
	 *
	 * @return string Returns JSON.
	 */
    public function getGroupUsers( $parameters = ['group_id' => '', 'before' => 0] )
    {
        return $this->get('https://api.gab.com/v1.0/groups/'.$parameters['group_id'].'/users?before='.$parameters['before']);
    }
	/**
	 * Returns a list of given group's moderation logs.
	 *
	 * @param array $parameters group_id ~ ID of Group
	 *
	 * @return string Returns JSON.
	 */
    public function getGroupModerationLogs( $parameters = ['group_id' => ''] )
    {
        return $this->get('https://api.gab.com/v1.0/groups/'.$parameters['group_id'].'/moderation-logs');
    }
}