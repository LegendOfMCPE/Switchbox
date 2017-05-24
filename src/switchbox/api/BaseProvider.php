<?php

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
