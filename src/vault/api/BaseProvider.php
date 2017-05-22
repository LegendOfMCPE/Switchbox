<?php

namespace vault\api;

use vault\Loader;

abstract class BaseProvider {

	private $loader;

	protected $name;
	protected $isEnabled = false;

	public function __construct(Loader $loader) {
		$this->loader = $loader;

		if($this->getLoader()->getServer()->getPluginManager()->getPlugin($this->getName())->isEnabled()) {
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
}