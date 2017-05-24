<?php

namespace switchbox\switcher;

use switchbox\api\BaseProvider;
use switchbox\api\economy\ChatProvider;
use switchbox\api\economy\EconomyProvider;
use switchbox\api\EmptySwitch;
use switchbox\economy\EconomyAPISwitch;
use switchbox\economy\xEconSwitch;
use switchbox\Loader;
use vault\chat\EssentialsPESwitch;

class PluginSwitcher {

	private $economySwitches = [
		"EconomyAPI" => EconomyAPISwitch::class,
		"xEcon" => xEconSwitch::class
	];
	private $chatSwitches = [
		"EssentialsPE" => EssentialsPESwitch::class
	];

	private $economy;

	public function __construct(Loader $loader, array $preferredPlugins) {
		$ecoPlugin = $preferredPlugins["Economy"];
		$chatPlugin = $preferredPlugins["Chat"];

		$this->economy = $this->selectEconomy($loader, $ecoPlugin);
		if($this->economy instanceof EmptySwitch) {
			$loader->getLogger()->alert("No economy plugin could be found. Disabling economy support.");
			$loader->getConfiguration()->setEconomyEnabled(false);
		}

		$this->chat = $this->selectChat($loader, $chatPlugin);
		if($this->chat instanceof EmptySwitch) {
			$loader->getLogger()->alert("No chat plugin could be found. Disabling economy support.");
			$loader->getConfiguration()->setEconomyEnabled(false);
		}
	}

	/**
	 * @param Loader $loader
	 * @param string $ecoPlugin
	 *
	 * @return BaseProvider
	 */
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

	/**
	 * @param Loader $loader
	 * @param string $chatPlugin
	 *
	 * @return BaseProvider
	 */
	public function selectChat(Loader $loader, string $chatPlugin): BaseProvider {
		$error = [];
		if($chatPlugin !== "Dummy") {
			if(($chatPlugin = $loader->getServer()->getPluginManager()->getPlugin($chatPlugin)) === null) {
				$error[] = "The given chat plugin is not installed";
			}
			if($chatPlugin->isDisabled()) {
				$error[] = "The given chat plugin was disabled during startup.";
			}
			if(!in_array($chatPlugin->getName(), $this->chatSwitches)) {
				$error[] = "The given chat plugin is not supported by Switchbox.";
			}
			if(!empty($error)) {
				foreach($error as $errorMessage) {
					$loader->getLogger()->alert($errorMessage);
				}
				return $this->selectChat($loader, "Dummy");
			}
			$chatSwitch = $this->chatSwitches[$chatPlugin->getName()];
			return new $chatSwitch($loader, $chatPlugin);
		}
		foreach($loader->getServer()->getPluginManager()->getPlugins() as $plugin) {
			if(in_array($plugin->getName(), array_keys($this->chatSwitches))) {
				$chatSwitch = $this->chatSwitches[$plugin->getName()];
				return new $chatSwitch($loader, $plugin);
			}
		}
		return new EmptySwitch($loader);
	}

	/**
	 * @return bool|ChatProvider
	 */
	public function getChat() {
		if(!$this->chat instanceof ChatProvider) {
			return false;
		}
		return $this->chat;
	}
}