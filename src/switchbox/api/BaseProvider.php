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

namespace switchbox\api;

use pocketmine\plugin\Plugin;
use pocketmine\Server;

abstract class BaseProvider {

	protected function __construct(Server $server) {
		// TODO implement whatever appropriate here
	}

	/**
	 * Returns the name of the current provider.
	 *
	 * @return string
	 */
	public function getName(): string {
		return $this->getPlugin()->getName();
	}

	public abstract function getPlugin(): Plugin;
}
