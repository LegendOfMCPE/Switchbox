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

use pocketmine\IPlayer;
use switchbox\api\BaseProvider;
use switchbox\api\ProviderReply;

abstract class EconomyProvider extends BaseProvider {

	/**
	 * Returns whether the current economy plugin supports banks.
	 *
	 * @return bool
	 */
	public abstract function hasBankSupport(): bool;

	/**
	 * Returns the currency symbol used in the current economy plugin.
	 *
	 * @return string
	 */
	public abstract function getCurrencySymbol(): string;

	/**
	 * Checks whether the player of the given name has an economy account with this economy plugin.
	 *
	 * @param AccountExistsQuery $query
	 *
	 * @return bool If $callback has been called before this method returns, returns true. If $callback shall be
	 *              called some time after this method returns, returns false.
	 */
	public abstract function existsAccount(AccountExistsQuery $query): bool;

	/**
	 * Creates a new economy account for the player of the given name.
	 *
	 * @param AccountCreation $query
	 *
	 * @return bool If $callback has been called before this method returns, returns true. If $callback shall be
	 *              called some time after this method returns, returns false.
	 *
	 */
	public abstract function createAccount(AccountCreation $query): bool;

	/**
	 * Checks the balance of a player.
	 *
	 * @param BalanceQuery $query
	 *
	 * @return bool If $callback has been called before this method returns, returns true. If $callback shall be
	 *              called some time after this method returns, returns false.
	 *
	 */
	public abstract function checkBalance(BalanceQuery $query): bool;

	/**
	 * Withdraws the given amount of money from the given account.
	 *
	 * @param BalanceReduction $query
	 *
	 * @return bool If $callback has been called before this method returns, returns true. If $callback shall be
	 *              called some time after this method returns, returns false.
	 *
	 */
	public abstract function reduceBalance(BalanceReduction $query): bool;

	/**
	 * Deposits the given amount of money to the given OFFLINE player.
	 * Returns the return value from the economy plugin.
	 *
	 * @param IPlayer $player
	 * @param int     $amount
	 *
	 * @return ProviderReply
	 */
	public abstract function increaseBalance(IPlayer $player, int $amount): ProviderReply;

	/**
	 * Creates a new bank for the given OFFLINE player with the given name.
	 * Most economy providers do not have support for banks with names. $name can be left empty in this case.
	 * Returns the return value from the economy plugin.
	 *
	 * @param IPlayer $player
	 * @param string  $name
	 *
	 * @return ProviderReply
	 */
	public abstract function createBank(IPlayer $player, string $name = ""): ProviderReply;

	/**
	 * Returns whether the given OFFLINE player has a bank opened or not.
	 *
	 * @param IPlayer $player
	 *
	 * @return bool
	 */
	public abstract function hasBank(IPlayer $player): bool;

	/**
	 * Deletes a bank from the given OFFLINE player with the given name.
	 * Most economy providers do not have support for banks with names. $name can be left empty in this case.
	 * Returns the return value from the economy plugin.
	 *
	 * @param IPlayer $player
	 * @param string  $name
	 *
	 * @return ProviderReply
	 */
	public abstract function deleteBank(IPlayer $player, string $name = ""): ProviderReply;

	/**
	 * Returns the amount of money an OFFLINE player has in their bank.
	 *
	 * @param IPlayer $player
	 *
	 * @return int
	 */
	public abstract function bankGet(IPlayer $player): int;

	/**
	 * Returns whether the given OFFLINE player has equal to or more than the given amount of money.
	 *
	 * @param IPlayer $player
	 * @param int     $amount
	 *
	 * @return bool
	 */
	public abstract function bankHas(IPlayer $player, int $amount): bool;

	/**
	 * Withdraws the given amount of money from the given OFFLINE player.
	 * Returns the return value from the economy plugin.
	 *
	 * @param IPlayer $player
	 * @param int     $amount
	 *
	 * @return ProviderReply
	 */
	public abstract function bankWithdraw(IPlayer $player, int $amount): ProviderReply;

	/**
	 * Deposits the given amount of money to the given OFFLINE player.
	 * Returns the return value from the economy plugin.
	 *
	 * @param IPlayer $player
	 * @param int     $amount
	 *
	 * @return ProviderReply
	 */
	public abstract function bankDeposit(IPlayer $player, int $amount): ProviderReply;

	/**
	 * Returns whether the given OFFLINE player is owner of the given bank name or not.
	 * This method is not used for economy plugins that don't support banks with names.
	 *
	 * @param IPlayer $player
	 * @param string  $bankName
	 *
	 * @return bool
	 */
	public abstract function isBankOwner(IPlayer $player, string $bankName): bool;

	/**
	 * Returns whether the given OFFLINE player is a member of the given bank name or not.
	 * This method is not used for economy plugins that don't support banks with names.
	 *
	 * @param IPlayer $player
	 * @param string  $bankName
	 *
	 * @return bool
	 */
	public abstract function isBankMember(IPlayer $player, string $bankName): bool;

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
