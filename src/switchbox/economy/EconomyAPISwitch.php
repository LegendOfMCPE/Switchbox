<?php

namespace switchbox\economy;

use onebone\economyapi\EconomyAPI;
use pocketmine\OfflinePlayer;
use pocketmine\plugin\Plugin;
use switchbox\api\economy\EconomyProvider;
use switchbox\api\ProviderReply;
use switchbox\Loader;

class EconomyAPISwitch extends EconomyProvider {

	protected $name = "EconomyAPI";
	protected $bankSupport = false;

	/** @var EconomyAPI */
	private $plugin;

	public function __construct(Loader $loader) {
		parent::__construct($loader);
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
	 * @param OfflinePlayer $player
	 *
	 * @return bool
	 */
	public function hasAccount(OfflinePlayer $player): bool {
		if($this->plugin->isEnabled()) {
			return $this->plugin->accountExists($player->getName());
		}
		return false;
	}

	/**
	 * @param OfflinePlayer $player
	 *
	 * @return ProviderReply
	 */
	public function createAccount(OfflinePlayer $player): ProviderReply {
		if($this->plugin->isEnabled()) {
			return new ProviderReply($this->plugin->createAccount($player->getName()));
		}
		return new ProviderReply(false);
	}

	/**
	 * @param OfflinePlayer $player
	 *
	 * @return int
	 */
	public function get(OfflinePlayer $player): int {
		if($this->plugin->isEnabled()) {
			return $this->plugin->myMoney($player->getName());
		}
		return 0;
	}

	/**
	 * @param OfflinePlayer $player
	 * @param int           $balance
	 *
	 * @return bool
	 */
	public function has(OfflinePlayer $player, int $balance): bool {
		if($this->plugin->isEnabled()) {
			return $this->plugin->myMoney($player->getName()) >= $balance;
		}
		return false;
	}

	/**
	 * @param OfflinePlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public function withdraw(OfflinePlayer $player, int $amount): ProviderReply {
		if($this->plugin->isEnabled()) {
			return new ProviderReply($this->plugin->reduceMoney($player->getName(), $amount));
		}
		return new ProviderReply(false);
	}

	/**
	 * @param OfflinePlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public function deposit(OfflinePlayer $player, int $amount): ProviderReply {
		if($this->plugin->isEnabled()) {
			return new ProviderReply($this->plugin->addMoney($player->getName(), $amount));
		}
		return new ProviderReply(false);
	}

	/**
	 * @param OfflinePlayer $player
	 * @param string        $name
	 *
	 * @return ProviderReply
	 */
	public function createBank(OfflinePlayer $player, string $name = ""): ProviderReply {
		return new ProviderReply(false);
	}

	/**
	 * @param OfflinePlayer $player
	 *
	 * @return bool
	 */
	public function hasBank(OfflinePlayer $player): bool {
		return false;
	}

	/**
	 * @param OfflinePlayer $player
	 * @param string        $name
	 *
	 * @return ProviderReply
	 */
	public function deleteBank(OfflinePlayer $player, string $name = ""): ProviderReply {
		return new ProviderReply(false);
	}

	/**
	 * @param OfflinePlayer $player
	 *
	 * @return int
	 */
	public function bankGet(OfflinePlayer $player): int {
		return 0;
	}

	/**
	 * @param OfflinePlayer $player
	 * @param int           $amount
	 *
	 * @return bool
	 */
	public function bankHas(OfflinePlayer $player, int $amount): bool {
		return false;
	}

	/**
	 * @param OfflinePlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public function bankWithdraw(OfflinePlayer $player, int $amount): ProviderReply {
		return new ProviderReply(false);
	}

	/**
	 * @param OfflinePlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public function bankDeposit(OfflinePlayer $player, int $amount): ProviderReply {
		return new ProviderReply(false);
	}

	/**
	 * @param OfflinePlayer $player
	 * @param string        $bankName
	 *
	 * @return bool
	 */
	public function isBankOwner(OfflinePlayer $player, string $bankName): bool {
		return false;
	}

	/**
	 * @param OfflinePlayer $player
	 * @param string        $bankName
	 *
	 * @return bool
	 */
	public function isBankMember(OfflinePlayer $player, string $bankName): bool {
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