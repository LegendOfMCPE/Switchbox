<?php

namespace switchbox;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use switchbox\api\economy\ChatProvider;
use switchbox\api\economy\EconomyProvider;
use switchbox\switcher\PluginSwitcher;

class Loader extends PluginBase {

	private $configuration;
	private $economy;
	private $chat;

	private $economyEnabled = true;
	private $chatEnabled = true;

	public function onEnable() {
		$this->saveResource("config.yml");
		$this->configuration = new Configuration($this);

		$this->setUpEconomy();
		$this->setUpChat();
	}

	/**
	 * Hints Switchbox to check for requirements specified in the plugin passed. The plugin specified should AT LEAST have soft depend on Switchbox.
	 * If a requirement was not found, alerts the logger, and if specified, disables the plugin passed.
	 *
	 * To add required plugins to your plugin, you can add the following method (example):
	 * public function _require(): array {
	 *   return ["EssentialsPE", "EconomyAPI"];
	 * }
	 * If this method is added, the requirements will be checked once hint($this) gets called. Make sure to AT LEAST have soft depend on Switchbox.
	 * It is recommended to call hint($this) on startup.
	 *
	 * @param PluginBase $plugin
	 * @param bool       $forceDisable
	 *
	 * @return bool
	 */
	public function hint(PluginBase $plugin, bool $forceDisable = false) {
		if(method_exists($plugin, "_require")) {
			/** @var string[] $requirements */
			$requirements = $plugin->_require();
			foreach($requirements as $requirement) {
				if($requirement !== $this->getEconomy()->getName() && $requirement !== $this->getChat()->getName()) {
					$this->getLogger()->alert(
						"The plugin " . $plugin->getName() . " requires " . $requirement . " to work correctly." . PHP_EOL .
						"Consider using " . $requirement . " to get the most out of " . $plugin->getName() . ".");
					if($forceDisable) {
						$plugin->setEnabled(false);
						return true;
					}
				}
			}
		}
		return false;
	}

	/**
	 * @return EconomyProvider
	 */
	public function getEconomy(): EconomyProvider {
		return $this->economy;
	}

	/**
	 * @return ChatProvider
	 */
	public function getChat(): ChatProvider {
		return $this->chat;
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
	 * @return bool
	 */
	public function setUpChat(): bool {
		if(!$this->getConfiguration()->isChatEnabled()) {
			$this->chatEnabled = false;
			return false;
		}
		$pluginSwitcher = new PluginSwitcher($this, $this->getConfiguration()->getPluginPreferences());
		if($pluginSwitcher->getChat() === false) {
			$this->chatEnabled = false;
		}
		$this->chat = $pluginSwitcher->getChat();
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

	/**
	 * @return bool
	 */
	public function isChatEnabled(): bool {
		return $this->chatEnabled;
	}
}
