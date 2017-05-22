<?php

namespace vault;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Loader extends PluginBase {

	private $configuration;

	public function onEnable() {
		$this->saveResource("config.yml");
		$this->configuration = new Configuration($this);

		$this->setUpEconomy();
	}

	public function setUpEconomy(): bool {
		if(!$this->getConfiguration()->isEconomyEnabled()) {
			return false;
		}
		if(($ecoPlugin = $this->getServer()->getPluginManager()->getPlugin($this->getConfiguration()->getEconomyPlugin())) === null || $ecoPlugin->isDisabled()) {
			$this->getLogger()->warning(TextFormat::RED . "The selected economy plugin could not be found in {undefined}!" . PHP_EOL . "Checking for available economy plugins...");
			$result = false;
		} else {
			$result = true;
		}
		// TODO: Finish this when I start actually implementing things.
		return $result;
	}

	/**
	 * @return Configuration
	 */
	public function getConfiguration(): Configuration {
		return $this->configuration;
	}
}