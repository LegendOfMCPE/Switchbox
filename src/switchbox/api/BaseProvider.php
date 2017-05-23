<?php

namespace switchbox\api;

use pocketmine\plugin\Plugin;
use switchbox\Loader;

abstract class BaseProvider {

	private $loader;

	protected $name = "";
	protected $isEnabled = false;
	protected $empty = false;

	public function __construct(Loader $loader) {
		$this->loader = $loader;

		if($this->getPlugin()->isEnabled()) {
			$this->isEnabled = true;
		}
	}

	/**
	 * @return Loader
	 */
	private function getLoader(): Loader {
		return $this->loader;
	}

	/**
	 * Returns the name of the current provider.
	 *
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * Checks if the current provider is enabled.
	 *
	 * @return boolean
	 */
	public function isEnabled(): bool {
		return $this->isEnabled;
	}

	/**
	 * Returns the plugin of the provider.
	 *
	 * @return Plugin
	 */
	public function getPlugin(): Plugin {
		return $this->getLoader()->getServer()->getPluginManager()->getPlugin($this->getName());
	}

	/**
	 * @return bool
	 */
	public function isEmpty(): bool {
		return $this->empty;
	}
}