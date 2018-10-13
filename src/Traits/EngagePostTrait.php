<?php namespace BishopJ88\LaraGab\Traits;

use Exception;

Trait EngagePostTrait {

	/**
	 * Upvotes given post.
	 *
	 * @param array $parameters postID ~ Post ID
	 *
	 * @return string Returns JSON.
	 */
	public function postUpvote( $parameters = ['postID' => ''] )
	{
		return $this->post('https://api.gab.com/v1.0/posts/' .$parameters['postID']. '/upvote');
    }
	/**
	 * Removes the upvote for given post.
	 *
	 * @param array $parameters postID ~ Post ID
	 *
	 * @return string Returns JSON.
	 */
	public function removeUpvote( $parameters = ['postID' => ''] )
	{
		return $this->delete('https://api.gab.com/v1.0/posts/' .$parameters['postID']. '/upvote');
    }
	/**
	 * Removes the downvote for given post.
	 *
	 * @param array $parameters postID ~ Post ID
	 *
	 * @return string Returns JSON.
	 */
	public function removeDownvote( $parameters = ['postID' => ''] )
	{
		return $this->delete('https://api.gab.com/v1.0/posts/' .$parameters['postID']. '/downvote');
    }
	/**
	 * Downvotes given post.
	 *
	 * @param array $parameters postID ~ Post ID
	 *
	 * @return string Returns JSON.
	 */
	public function postDownvote( $parameters = ['postID' => ''] )
	{
		return $this->post('https://api.gab.com/v1.0/posts/' .$parameters['postID']. '/downvote');
    }
	/**
	 * Reposts given post.
	 *
	 * @param array $parameters postID ~ Post ID
	 *
	 * @return string Returns JSON.
	 */
	public function postRepost( $parameters = ['postID' => ''] )
	{
		return $this->post('https://api.gab.com/v1.0/posts/' .$parameters['postID']. '/repost');
    }
	/**
	 * Remove repost record for given post.
	 *
	 * @param array $parameters postID ~ Post ID
	 *
	 * @return string Returns JSON.
	 */
	public function removeRepost( $parameters = ['postID' => ''] )
	{
		return $this->delete('https://api.gab.com/v1.0/posts/' .$parameters['postID']. '/repost');
    }
	/**
	 * Returns the details of given post.
	 *
	 * @param array $parameters postID ~ Post ID
	 *
	 * @return string Returns JSON.
	 */
	public function getPostDetails( $parameters = ['postID' => ''] )
	{
		return $this->get('https://api.gab.com/v1.0/posts/' .$parameters['postID']);
    }
}