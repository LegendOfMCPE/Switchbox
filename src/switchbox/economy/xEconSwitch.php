<?php

namespace switchbox\economy;

use pocketmine\OfflinePlayer;
use switchbox\api\economy\EconomyProvider;
use switchbox\api\ProviderReply;
use switchbox\Loader;
use xecon\account\Account;
use xecon\entity\Entity;
use xecon\entity\PlayerEnt;
use xecon\XEcon;

class xEconSwitch extends EconomyProvider {

	protected $name = "xEcon";
	protected $bankSupport = true;
	private $plugin;

	public function __construct(Loader $loader) {
		parent::__construct($loader);
		$this->plugin = $this->getPlugin();
	}

	/**
	 * @return string
	 */
	public function getCurrencySymbol(): string {
		if($this->plugin instanceof XEcon) {
			// Need a way to check... Can't find one.
		}
		return "$";
	}

	/**
	 * @param OfflinePlayer $player
	 *
	 * @return bool
	 */
	public function hasAccount(OfflinePlayer $player): bool {
		if($this->plugin instanceof XEcon) {
			// Need a way to check... Can't find one.
		}
		return false;
	}

	/**
	 * @param OfflinePlayer $player
	 *
	 * @return ProviderReply
	 */
	public function createAccount(OfflinePlayer $player): ProviderReply {
		if($this->plugin instanceof XEcon) {
			// Accounts get created (semi) automatically... Not sure about this one.
		}
		return new ProviderReply(false);
	}

	/**
	 * @param OfflinePlayer $player
	 *
	 * @return int
	 */
	public function get(OfflinePlayer $player): int {
		if($this->plugin instanceof XEcon) {
			round($this->plugin->getPlayerEnt($player->getName())->getAccount(PlayerEnt::ACCOUNT_CASH)->getAmount());
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
		if($this->plugin instanceof XEcon) {
			return $this->plugin->getPlayerEnt($player->getName())->getAccount(PlayerEnt::ACCOUNT_CASH)->canPay($balance);
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
		if($this->plugin instanceof XEcon) {
			return new ProviderReply($this->plugin->getPlayerEnt($player->getName())->getAccount(PlayerEnt::ACCOUNT_CASH)->take($amount));
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
		if($this->plugin instanceof XEcon) {
			return new ProviderReply($this->plugin->getPlayerEnt($player->getName())->getAccount(PlayerEnt::ACCOUNT_CASH)->take($amount));
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
		if($this->plugin instanceof XEcon) {
			// Accounts get created (semi) automatically... Not sure about this one...
		}
		return new ProviderReply(false);
	}

	/**
	 * @param OfflinePlayer $player
	 *
	 * @return bool
	 */
	public function hasBank(OfflinePlayer $player): bool {
		if($this->plugin instanceof XEcon) {
			// Accounts get created (semi) automatically... Not sure about this one...
		}
		return false;
	}

	/**
	 * @param OfflinePlayer $player
	 * @param string        $name
	 *
	 * @return ProviderReply
	 */
	public function deleteBank(OfflinePlayer $player, string $name = ""): ProviderReply {
		if($this->plugin instanceof XEcon) {
			// Accounts get created (semi) automatically... Not sure about this one...
		}
		return new ProviderReply(false);
	}

	/**
	 * @param OfflinePlayer $player
	 *
	 * @return int
	 */
	public function bankGet(OfflinePlayer $player): int {
		if($this->plugin instanceof XEcon) {
			return $this->plugin->getPlayerEnt($player->getName())->getAccount(PlayerEnt::ACCOUNT_BANK)->getAmount();
		}
		return 0;
	}

	/**
	 * @param OfflinePlayer $player
	 * @param int           $amount
	 *
	 * @return bool
	 */
	public function bankHas(OfflinePlayer $player, int $amount): bool {
		if($this->plugin instanceof XEcon) {
			return $this->plugin->getPlayerEnt($player->getName())->getAccount(PlayerEnt::ACCOUNT_BANK)->canPay($amount);
		}
		return false;
	}

	/**
	 * @param OfflinePlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public function bankWithdraw(OfflinePlayer $player, int $amount): ProviderReply {
		if($this->plugin instanceof XEcon) {
			return new ProviderReply($this->plugin->getPlayerEnt($player->getName())->getAccount(PlayerEnt::ACCOUNT_BANK)->take($amount));
		}
		return new ProviderReply(false);
	}

	/**
	 * @param OfflinePlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public function bankDeposit(OfflinePlayer $player, int $amount): ProviderReply {
		if($this->plugin instanceof XEcon) {
			return new ProviderReply($this->plugin->getPlayerEnt($player->getName())->getAccount(PlayerEnt::ACCOUNT_BANK)->add($amount));
		}
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
		return [];
	}
}