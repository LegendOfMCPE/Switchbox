<?php

namespace vault\api\economy;

use pocketmine\OfflinePlayer;
use vault\api\BaseProvider;
use vault\api\ProviderReply;
use vault\Loader;

abstract class EconomyProvider extends BaseProvider {

	private $bankSupport = false;

	public function __construct(Loader $loader) {
		parent::__construct($loader);
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
	 * Takes the given amount of money from the given OFFLINE player, and returns the return value from the economy plugin.
	 *
	 * @param OfflinePlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public abstract function take(OfflinePlayer $player, int $amount): ProviderReply;

	/**
	 * Adds the given amount of money to the given OFFLINE player, and returns the return value from the economy plugin.
	 *
	 * @param OfflinePlayer $player
	 * @param int           $amount
	 *
	 * @return ProviderReply
	 */
	public abstract function add(OfflinePlayer $player, int $amount): ProviderReply;
}