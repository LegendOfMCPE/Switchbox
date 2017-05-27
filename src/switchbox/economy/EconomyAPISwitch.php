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

namespace switchbox\economy;

use onebone\economyapi\EconomyAPI;
use pocketmine\IPlayer;
use switchbox\api\economy\EconomyProvider;
use switchbox\api\ProviderReply;
use switchbox\Switchbox;

class EconomyAPISwitch extends EconomyProvider {

	protected $name = "EconomyAPI";
	protected $bankSupport = false;

	/** @var EconomyAPI */
	private $plugin;

	public function __construct(Switchbox $loader) {
		parent::__construct($loader->getServer());
		if($this->getPlugin() instanceof EconomyAPI) {
			$this->plugin = $this->getPlugin();
		}
	}

	/**
	 * @return string
	 */
	public function getCurrencySymbol(): string {
		if($this->plugin->isEnabled()) {
			return $this->plugin->getMonetaryUnit();
		}
		return "$";
	}

	/**
	 * @param IPlayer $player
	 *
	 * @return bool
	 */
	public function hasAccount(IPlayer $player): bool {
		if($this->plugin->isEnabled()) {
			return $this->plugin->accountExists($player->getName());
		}
		return false;
	}

	/**
	 * @param IPlayer $player
	 *
	 * @return ProviderReply
	 */
	public function createAccount(IPlayer $player): ProviderReply {
		if($this->plugin->isEnabled()) {
			return new ProviderReply($this->plugin->createAccount($player->getName()));
		}
		return new ProviderReply(false);
	}

	/**
	 * @param IPlayer $player
	 *
	 * @return int
	 */
	public function get(IPlayer $player): int {
		if($this->plugin->isEnabled()) {
			return $this->plugin->myMoney($player->getName());
		}
		return 0;
	}

	/**
	 * @param IPlayer $player
	 * @param int           $balance
	 *
	 * @return bool
	 */
	public function has(IPlayer $player, int $balance): bool {
		if($this->plugin->isEnabled()) {
			return $this->plugin->myMoney($player->getName()) >= $balance;
		}
		return false;
	}

	/**
	 * @param IPlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public function withdraw(IPlayer $player, int $amount): ProviderReply {
		if($this->plugin->isEnabled()) {
			return new ProviderReply($this->plugin->reduceMoney($player->getName(), $amount));
		}
		return new ProviderReply(false);
	}

	/**
	 * @param IPlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public function deposit(IPlayer $player, int $amount): ProviderReply {
		if($this->plugin->isEnabled()) {
			return new ProviderReply($this->plugin->addMoney($player->getName(), $amount));
		}
		return new ProviderReply(false);
	}

	/**
	 * @param IPlayer $player
	 * @param string        $name
	 *
	 * @return ProviderReply
	 */
	public function createBank(IPlayer $player, string $name = ""): ProviderReply {
		return new ProviderReply(false);
	}

	/**
	 * @param IPlayer $player
	 *
	 * @return bool
	 */
	public function hasBank(IPlayer $player): bool {
		return false;
	}

	/**
	 * @param IPlayer $player
	 * @param string        $name
	 *
	 * @return ProviderReply
	 */
	public function deleteBank(IPlayer $player, string $name = ""): ProviderReply {
		return new ProviderReply(false);
	}

	/**
	 * @param IPlayer $player
	 *
	 * @return int
	 */
	public function bankGet(IPlayer $player): int {
		return 0;
	}

	/**
	 * @param IPlayer $player
	 * @param int           $amount
	 *
	 * @return bool
	 */
	public function bankHas(IPlayer $player, int $amount): bool {
		return false;
	}

	/**
	 * @param IPlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public function bankWithdraw(IPlayer $player, int $amount): ProviderReply {
		return new ProviderReply(false);
	}

	/**
	 * @param IPlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public function bankDeposit(IPlayer $player, int $amount): ProviderReply {
		return new ProviderReply(false);
	}

	/**
	 * @param IPlayer $player
	 * @param string        $bankName
	 *
	 * @return bool
	 */
	public function isBankOwner(IPlayer $player, string $bankName): bool {
		return false;
	}

	/**
	 * @param IPlayer $player
	 * @param string        $bankName
	 *
	 * @return bool
	 */
	public function isBankMember(IPlayer $player, string $bankName): bool {
		return false;
	}

	/**
	 * @return array
	 */
	public function getAllBanks(): array {
		return [];
	}

	/**
	 * @return array
	 */
	public function getAllMoney(): array {
		if($this->plugin->isEnabled()) {
			return $this->plugin->getAllMoney();
		}
		return [];
	}
}
