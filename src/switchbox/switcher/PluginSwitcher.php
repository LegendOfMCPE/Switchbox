<?php

namespace switchbox\switcher;

use switchbox\api\BaseProvider;
use switchbox\api\economy\EconomyProvider;
use switchbox\api\EmptySwitch;
use switchbox\economy\EconomyAPISwitch;
use switchbox\economy\xEconSwitch;
use switchbox\Loader;

class PluginSwitcher {

	private $economySwitches = [
		"EconomyAPI" => EconomyAPISwitch::class,
		"xEcon" => xEconSwitch::class
	];

	private $economy;

	public function __construct(Loader $loader, array $preferredPlugins) {
		$ecoPlugin = $preferredPlugins["Economy"];
		$this->economy = $this->selectEconomy($loader, $ecoPlugin);
		if($this->economy instanceof EmptySwitch) {
			$loader->getLogger()->alert("No economy plugin could be found. Disabling economy support.");
			$loader->getConfiguration()->setEconomyEnabled(false);
		}
	}

	public function selectEconomy(Loader $loader, string $ecoPlugin): BaseProvider {
		$error = [];
		if($ecoPlugin !== "Dummy") {
			if(($ecoPlugin = $loader->getServer()->getPluginManager()->getPlugin($ecoPlugin)) === null) {
				$error[] = "The given economy plugin is not installed";
			}
			if($ecoPlugin->isDisabled()) {
				$error[] = "The given economy plugin was disabled during startup.";
			}
			if(!in_array($ecoPlugin->getName(), $this->economySwitches)) {
				$error[] = "The given economy plugin is not supported by Switchbox.";
			}
			if(!empty($error)) {
				foreach($error as $errorMessage) {
					$loader->getLogger()->alert($errorMessage);
				}
				return $this->selectEconomy($loader, "Dummy");
			}
			$ecoSwitch = $this->economySwitches[$ecoPlugin->getName()];
			return new $ecoSwitch($loader, $ecoPlugin);
		}
		foreach($loader->getServer()->getPluginManager()->getPlugins() as $plugin) {
			if(in_array($plugin->getName(), array_keys($this->economySwitches))) {
				$ecoSwitch = $this->economySwitches[$plugin->getName()];
				return new $ecoSwitch($loader, $plugin);
			}
		}
		return new EmptySwitch($loader);
	}

	/**
	 * @return bool|EconomyProvider
	 */
	public function getEconomy() {
		if(!$this->economy instanceof EconomyProvider) {
			return false;
		}
		return $this->economy;
	}
}