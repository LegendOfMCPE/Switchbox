<?php

namespace switchbox;


class Configuration {

	private $loader;

	private $economyEnabled = true;
	private $economyPlugin = "Dummy";
	private $chatEnabled = true;
	private $chatPlugin = "Dummy";

	public function __construct(Loader $loader) {
		$this->loader = $loader;

		$data = yaml_parse_file($loader->getDataFolder() . "config.yml");
		$this->setUpData($data);
	}
	
	/**
	 * @param array $data
	 */
	public function setUpData(array $data) {
		$this->setEconomyEnabled($data["Economy"]);
		$this->economyPlugin = $data["Economy-Plugin"];
		$this->setChatEnabled($data["Chat"]);
		$this->chatPlugin = $data["Chat-Plugin"];
	}

	/**
	 * @return array
	 */
	public function getPluginPreferences(): array {
		return ["Economy" => $this->getEconomyPlugin()];
	}

	/**
	 * @return bool
	 */
	public function isEconomyEnabled(): bool {
		return $this->economyEnabled;
	}

	/**
	 * @param bool $value
	 */
	public function setEconomyEnabled(bool $value = true) {
		$this->economyEnabled = $value;
	}

	/**
	 * @return string
	 */
	public function getEconomyPlugin(): string {
		return $this->economyPlugin;
	}

	/**
	 * @return bool
	 */
	public function isChatEnabled(): bool {
		return $this->chatEnabled;
	}

	/**
	 * @param bool $value
	 */
	public function setChatEnabled(bool $value = true) {
		$this->chatEnabled = $value;
	}

	/**
	 * @return string
	 */
	public function getChatPlugin(): string {
		return $this->chatPlugin;
	}

	/**
	 * @return Loader
	 */
	public function getLoader(): Loader {
		return $this->loader;
	}
}
