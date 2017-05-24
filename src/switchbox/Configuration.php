<?php

namespace switchbox;


class Configuration {

	private $economyPluginName;
	private $economyPrefs;
	private $chatPluginName;
	private $chatPrefs;

	public function __construct(Switchbox $loader) {
		$data = yaml_parse_file($loader->getDataFolder() . "config.yml");
		$this->setUpData($data);
	}

	/**
	 * @param array $data
	 */
	private function setUpData(array $data) {
		$this->economyPluginName = (string) ($data["Economy-Plugin"] ? : "Dummy");
		$this->economyPrefs = array_change_key_case((array) ($data["Economy-Economy-Providers"] ? : []), CASE_LOWER);
		$this->chatPluginName = (string) ($data["Chat-Plugin"] ? : "Dummy");
		$this->chatPrefs = array_change_key_case((array) ($data["Special-Chat-Providers"] ? : []), CASE_LOWER);
	}

	/**
	 * @return string
	 */
	public function getEconomyPluginName(): string {
		return $this->economyPluginName;
	}

	public function getEconomyPrefs(): array {
		return $this->economyPrefs;
	}

	/**
	 * @return string
	 */
	public function getChatPluginName(): string {
		return $this->chatPluginName;
	}

	public function getChatPrefs(): array {
		return $this->chatPrefs;
	}
}
