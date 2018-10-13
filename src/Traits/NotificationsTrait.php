<?php namespace BishopJ88\LaraGab\Traits;

use Exception;

Trait NotificationsTrait {

	/**
	 * Returns latest notifications.
	 *
	 * @param array $parameters ['before']
	 *
	 * @return string Returns JSON string with notifications (including HTML).
	 */
	public function getNotifications( $parameters = ['before' => 0] )
	{
		return $this->get('https://api.gab.com/v1.0/notifications/?before=', $parameters['before']);
    }
}