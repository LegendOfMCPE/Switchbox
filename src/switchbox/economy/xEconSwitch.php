<?php

namespace switchbox\economy;

use pocketmine\OfflinePlayer;
use switchbox\api\economy\EconomyProvider;
use switchbox\api\ProviderReply;
use switchbox\Loader;

class xEconSwitch extends EconomyProvider {

	public function __construct(Loader $loader) {
		parent::__construct($loader);
	}

	public function getCurrencySymbol(): string {
		// TODO: Implement getCurrencySymbol() method.
	}

	public function getCurrencyPlural(): string {
		// TODO: Implement getCurrencyPlural() method.
	}

	public function getCurrencySingular(): string {
		// TODO: Implement getCurrencySingular() method.
	}

	public function hasAccount(OfflinePlayer $player): bool {
		// TODO: Implement hasAccount() method.
	}

	public function createAccount(OfflinePlayer $player): ProviderReply {
		// TODO: Implement createAccount() method.
	}

	public function get(OfflinePlayer $player): int {
		// TODO: Implement get() method.
	}

	public function has(OfflinePlayer $player, int $balance): bool {
		// TODO: Implement has() method.
	}

	public function withdraw(OfflinePlayer $player, int $amount): ProviderReply {
		// TODO: Implement withdraw() method.
	}

	public function deposit(OfflinePlayer $player, int $amount): ProviderReply {
		// TODO: Implement deposit() method.
	}

	public function createBank(OfflinePlayer $player, string $name = ""): ProviderReply {
		// TODO: Implement createBank() method.
	}

	public function hasBank(OfflinePlayer $player): bool {
		// TODO: Implement hasBank() method.
	}

	public function deleteBank(OfflinePlayer $player, string $name = ""): ProviderReply {
		// TODO: Implement deleteBank() method.
	}

	public function bankGet(OfflinePlayer $player): int {
		// TODO: Implement bankGet() method.
	}

	public function bankHas(OfflinePlayer $player, int $amount): bool {
		// TODO: Implement bankHas() method.
	}

	public function bankWithdraw(OfflinePlayer $player, int $amount): ProviderReply {
		// TODO: Implement bankWithdraw() method.
	}

	public function bankDeposit(OfflinePlayer $player, int $amount): ProviderReply {
		// TODO: Implement bankDeposit() method.
	}

	public function isBankOwner(OfflinePlayer $player, string $bankName): bool {
		// TODO: Implement isBankOwner() method.
	}

	public function isBankMember(OfflinePlayer $player, string $bankName): bool {
		// TODO: Implement isBankMember() method.
	}

	public function getAllBanks(): array {
		// TODO: Implement getAllBanks() method.
	}
}