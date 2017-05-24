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

namespace switchbox;

use pocketmine\plugin\Plugin;
use switchbox\api\economy\EconomyProvider;

/**
 * Only for internal use. Other plugins should not find this class interesting.
 */
class ProviderRegistry {

	/** @var Plugin */
	public $plugin;
	/** @var string */
	public $class;

	public function validate(string $type) {
		static $superPproviders = [
			Switchbox::TYPE_ECONOMY => EconomyProvider::class,
			Switchbox::TYPE_CHAT => EconomyProvider::class
		];
		if(!is_subclass_of($this->class, $super = $superPproviders[$type])) {
			throw new \RuntimeException("$this->class is a $type provider but does not extend $super");
		}
		// TODO validate constructor
	}

	public function instantiate() {
		$class = $this->class;
		return new $class($this->plugin);
	}
}
