<?php

namespace switchbox\api\economy;

use pocketmine\OfflinePlayer;
use pocketmine\Server;
use switchbox\api\BaseProvider;
use switchbox\api\ProviderReply;

abstract class EconomyProvider extends BaseProvider {

	protected $bankSupport = false;

	public function __construct(Server $server) {
		parent::__construct($server);
	}

	/**
	 * Returns whether the current economy plugin supports banks.
	 *
	 * @return bool
	 */
	public function hasBankSupport(): bool {
		return $this->bankSupport;
	}

	/**
	 * Returns the currency symbol used in the current economy plugin.
	 *
	 * @return string
	 */
	public abstract function getCurrencySymbol(): string;

	/**
	 * Returns whether the given OFFLINE player has an economy account with the current economy plugin.
	 *
	 * @param OfflinePlayer $player
	 *
	 * @return bool
	 */
	public abstract function hasAccount(OfflinePlayer $player): bool;

	/**
	 * Creates a new economy account for the given OFFLINE player.
	 *
	 * @param OfflinePlayer $player
	 *
	 * @return ProviderReply
	 */
	public abstract function createAccount(OfflinePlayer $player): ProviderReply;

	/**
	 * Returns the balance of an OFFLINE player.
	 *
	 * @param OfflinePlayer $player
	 *
	 * @return int
	 */
	public abstract function get(OfflinePlayer $player): int;

	/**
	 * Returns whether the given OFFLINE player has a balance higher or equal to the given balance.
	 *
	 * @param OfflinePlayer $player
	 * @param int           $balance
	 *
	 * @return bool
	 */
	public abstract function has(OfflinePlayer $player, int $balance): bool;

	/**
	 * Withdraws the given amount of money from the given OFFLINE player.
	 * Returns the return value from the economy plugin.
	 *
	 * @param OfflinePlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public abstract function withdraw(OfflinePlayer $player, int $amount): ProviderReply;

	/**
	 * Deposits the given amount of money to the given OFFLINE player.
	 * Returns the return value from the economy plugin.
	 *
	 * @param OfflinePlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public abstract function deposit(OfflinePlayer $player, int $amount): ProviderReply;

	/**
	 * Creates a new bank for the given OFFLINE player with the given name.
	 * Most economy providers do not have support for banks with names. $name can be left empty in this case.
	 * Returns the return value from the economy plugin.
	 *
	 * @param OfflinePlayer $player
	 * @param string        $name
	 *
	 * @return ProviderReply
	 */
	public abstract function createBank(OfflinePlayer $player, string $name = ""): ProviderReply;

	/**
	 * Returns whether the given OFFLINE player has a bank opened or not.
	 *
	 * @param OfflinePlayer $player
	 *
	 * @return bool
	 */
	public abstract function hasBank(OfflinePlayer $player): bool;

	/**
	 * Deletes a bank from the given OFFLINE player with the given name.
	 * Most economy providers do not have support for banks with names. $name can be left empty in this case.
	 * Returns the return value from the economy plugin.
	 *
	 * @param OfflinePlayer $player
	 * @param string        $name
	 *
	 * @return ProviderReply
	 */
	public abstract function deleteBank(OfflinePlayer $player, string $name = ""): ProviderReply;

	/**
	 * Returns the amount of money an OFFLINE player has in their bank.
	 *
	 * @param OfflinePlayer $player
	 *
	 * @return int
	 */
	public abstract function bankGet(OfflinePlayer $player): int;

	/**
	 * Returns whether the given OFFLINE player has equal to or more than the given amount of money.
	 *
	 * @param OfflinePlayer $player
	 * @param int           $amount
	 *
	 * @return bool
	 */
	public abstract function bankHas(OfflinePlayer $player, int $amount): bool;

	/**
	 * Withdraws the given amount of money from the given OFFLINE player.
	 * Returns the return value from the economy plugin.
	 *
	 * @param OfflinePlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public abstract function bankWithdraw(OfflinePlayer $player, int $amount): ProviderReply;

	/**
	 * Deposits the given amount of money to the given OFFLINE player.
	 * Returns the return value from the economy plugin.
	 *
	 * @param OfflinePlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public abstract function bankDeposit(OfflinePlayer $player, int $amount): ProviderReply;

	/**
	 * Returns whether the given OFFLINE player is owner of the given bank name or not.
	 * This method is not used for economy plugins that don't support banks with names.
	 *
	 * @param OfflinePlayer $player
	 * @param string        $bankName
	 *
	 * @return bool
	 */
	public abstract function isBankOwner(OfflinePlayer $player, string $bankName): bool;

	/**
	 * Returns whether the given OFFLINE player is a member of the given bank name or not.
	 * This method is not used for economy plugins that don't support banks with names.
	 *
	 * @param OfflinePlayer $player
	 * @param string        $bankName
	 *
	 * @return bool
	 */
	public abstract function isBankMember(OfflinePlayer $player, string $bankName): bool;

	/**
	 * Returns an array containing all banks.
	 *
	 * @return array
	 */
	public abstract function getAllBanks(): array;

	/**
	 * Returns an array containing all money.
	 *
	 * @return array
	 */
	public abstract function getAllMoney(): array;
}
