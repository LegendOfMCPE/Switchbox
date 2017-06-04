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

class BalanceReduction extends SwitchQuery {

	public $param_playerName;
	public $param_amount;
	public $param_account;
	public $param_recipient;
	public $param_reason;

	public $success;

	/**
	 * Reduce an amount from the given account
	 *
	 * @param string        $playerName the name of the player owning the account
	 * @param float         $amount     the amount to withdraw
	 * @param string|null   $account    the name of the account to
	 * @param string        $recipient  the name of the party that received the reduced amount, i.e. a player name or
	 *                                  "server:${party_name}"
	 * @param string        $reason     the reason for this reduction, e.g. "buying diamond sword", "penalty for pvp
	 *                                  logging", etc.
	 * @param callable|null $callback
	 */
	public function __construct(string $playerName, float $amount, string $account = null, string $recipient = "server:unknown", string $reason = "external plugin reason", callable $callback = null) {
		parent::__construct($callback);
		$this->param_playerName = $playerName;
		$this->param_amount = $amount;
		$this->param_account = $account;
		$this->param_recipient = $recipient;
		$this->param_reason = $reason;
	}

	public function isSuccessful(): bool {
		return $this->success;
	}
}
