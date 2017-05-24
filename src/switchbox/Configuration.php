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
		$this->economyPrefs = array_change_key_case((array) ($data["Special-Economy-Providers"] ? : []), CASE_LOWER);
		$this->chatPluginName = (string) ($data["Chat-Plugin"] ? : "Dummy");
		$this->chatPrefs = array_change_key_case((array) ($data["Special-Chat-Providers"] ? : []), CASE_LOWER);
	}

	/**
	 * @return string
	 */
	public function getEconomyPluginName(): string {
		return $this->economyPluginName;
	}

	/**
	 * @return array
	 */
	public function getEconomyPrefs(): array {
		return $this->economyPrefs;
	}

	/**
	 * @return string
	 */
	public function getChatPluginName(): string {
		return $this->chatPluginName;
	}

	/**
	 * @return array
	 */
	public function getChatPrefs(): array {
		return $this->chatPrefs;
	}
}
