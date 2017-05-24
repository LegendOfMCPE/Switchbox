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

/*
 *
 * Switchbox
 *
 * Copyright (C) 2017 SOFe
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
*/

namespace switchbox\economy;

use pocketmine\plugin\Plugin;
use switchbox\api\economy\EconomyProvider;
use switchbox\Switchbox;

class DummyEconomySwitch extends EconomyProvider {

	/** @var Switchbox */
	private $plugin;

	public function __construct(Switchbox $switchbox) {
		$this->plugin = $switchbox;
		parent::__construct($switchbox->getServer());
	}

	public function getPlugin(): Plugin {
		return $this->plugin;
	}

	// TODO implement other methods
}
