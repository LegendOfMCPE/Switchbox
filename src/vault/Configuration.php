<?php

namespace vault;


class Configuration {

	private $loader;

	private $economyEnabled = true;
	private $economyPlugin = "Dummy";

	public function __construct(Loader $loader) {
		$this->loader = $loader;

		$data = yaml_parse_file($loader->getDataFolder() . "config.yml");
		$this->setUpData($data);
	}

	public function setUpData(array $data) {
		$this->economyEnabled = $data["Economy"];
		$this->economyPlugin = $data["Economy-Plugin"];
	}

	/**
	 * @return bool
	 */
	public function isEconomyEnabled(): bool {
		return $this->economyEnabled;
	}

	/**
	 * @return string
	 */
	public function getEconomyPlugin(): string {
		return $this->economyPlugin;
	}

	/**
	 * @return Loader
	 */
	public function getLoader(): Loader {
		return $this->loader;
	}
}