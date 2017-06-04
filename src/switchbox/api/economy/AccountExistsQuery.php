<?php

/*
 *
 * Switchbox
 *
 * Copyright (C) 2017 LegendsOfMCPE Team
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
*/


namespace switchbox\api\economy;


use switchbox\api\SwitchQuery;

class AccountExistsQuery extends SwitchQuery {

	public $param_playerName;
	public $param_account;

	public $existence;

	/**
	 * Creates a query for checking whether a player has registered an account.
	 *
	 * @param string        $playerName the (case-insensitive) name of the player to check
	 * @param string|int    $account    pass 0 to check if the player has ANY accounts, 1 to check for the DEFAULT
	 *                                  account (logically, usually leads to the same result as 0), or a string for the
	 *                                  account name
	 * @param callable|null $callback
	 */
	public function __construct(string $playerName, $account = 0, callable $callback = null) {
		parent::__construct($callback);
		$this->param_playerName = $playerName;
		$this->param_account = $account;
	}

	/**
	 * Returns
	 *
	 * @return bool
	 */
	public function exists(): bool {
		return $this->existence;
	}

	protected function mustHandle(): bool {
		return true;
	}
}
