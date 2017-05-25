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

	protected static $superProviders = [
		Switchbox::TYPE_ECONOMY => EconomyProvider::class,
		Switchbox::TYPE_CHAT => EconomyProvider::class
	];

	public function validate(string $type) {
		if(!is_subclass_of($this->class, $super = self::$superProviders[$type])) {
			throw new \RuntimeException("$this->class is a $type provider but does not extend $super");
		}

		$reflect = new \ReflectionClass($this->class);
		$params = $reflect->getConstructor()->getParameters();
		if($reflect->getConstructor()->getNumberOfRequiredParameters() > 1 || $params[0]->getType() === null || !is_subclass_of($params[0]->getType(), Plugin::class)) {
			throw new \RuntimeException("$this->class is a $type provider, but does not have a familiar constructor");
		}
	}

	public function instantiate() {
		$class = $this->class;
		return new $class($this->plugin);
	}
}
