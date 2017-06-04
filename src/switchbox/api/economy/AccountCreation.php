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

class AccountCreation extends SwitchQuery {

	public $param_playerName;
	public $param_defaultBalance;
	public $param_otherAccounts;

	public $success;

	/**
	 * Creates an account for the player of the given name with the given balance, and optionally creates other accounts
	 * in addition to those created implicitly.
	 *
	 * @param string        $playerName     the name of the player to create account for
	 * @param float|null    $defaultBalance the default balance
	 * @param array         $otherAccounts  other accounts to create, in the syntax <code>["accountName" => 100]</code> or
	 *                                      <code>["accountName" => ["balance" => 100, "other" => "specific", "data" => "here"]]</code>
	 * @param callable|null $callback
	 */
	public function __construct(string $playerName, $defaultBalance = null, $otherAccounts = [], callable $callback = null) {
		parent::__construct($callback);
		$this->param_playerName = $playerName;
		$this->param_defaultBalance = $defaultBalance;
		$this->param_otherAccounts = $otherAccounts;
	}

	/**
	 * Returns whether the account was successfully created
	 *
	 * @return bool
	 */
	public function isSuccessful(): bool {
		return $this->success;
	}
	// TODO return default money
}
