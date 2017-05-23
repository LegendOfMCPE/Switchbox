<?php

namespace switchbox;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use switchbox\switcher\PluginSwitcher;

class Loader extends PluginBase {

	private $configuration;
	private $economy;

	private $economyEnabled = true;

	public function onEnable() {
		$this->saveResource("config.yml");
		$this->configuration = new Configuration($this);

		$this->setUpEconomy();
	}
	
	/**
	 * @return bool
	 */
	public function setUpEconomy(): bool {
		if(!$this->getConfiguration()->isEconomyEnabled()) {
			$this->economyEnabled = false;
			return false;
		}
		$pluginSwitcher = new PluginSwitcher($this, $this->getConfiguration()->getPluginPreferences());
		if($pluginSwitcher->getEconomy() === false) {
			$this->economyEnabled = false;
		}
		$this->economy = $pluginSwitcher->getEconomy();
		return true;
	}

	/**
	 * @return Configuration
	 */
	public function getConfiguration(): Configuration {
		return $this->configuration;
	}

	/**
	 * @return bool
	 */
	public function isEconomyEnabled(): bool {
		return $this->economyEnabled;
	}
}
