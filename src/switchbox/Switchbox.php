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

use pocketmine\event\Listener;
use pocketmine\event\plugin\PluginDisableEvent;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use switchbox\api\chat\ChatProvider;
use switchbox\api\economy\EconomyProvider;
use switchbox\chat\DummyChatSwitch;
use switchbox\economy\DummyEconomySwitch;
use switchbox\economy\EconomyAPISwitch;
use vault\chat\EssentialsPEChatSwitch;

class Switchbox extends PluginBase implements Listener {

	const TYPE_CHAT = "chat";
	const TYPE_ECONOMY = "economy";

	/** @var ProviderRegistry[][] */
	private $providers = [
		Switchbox::TYPE_CHAT => [],
		Switchbox::TYPE_ECONOMY => [],
	];

	/** @var Configuration */
	private $configuration;

	public function onEnable() {
		$this->saveResource("config.yml");
		$this->configuration = new Configuration($this);

		$this->getServer()->getPluginManager()->registerEvents($this, $this); // NOTE: Only listen to events from the PocketMine API in this class!
		$this->registerDefaults();
	}

	/**
	 * @param Plugin $requester The plugin requesting the provider. This method may return different values for different requesters.
	 *
	 * @return EconomyProvider
	 */
	public function getEconomyProvider(Plugin $requester): EconomyProvider {
		if(isset($this->configuration->getEconomyPrefs()[strtolower($requester->getName())])) {
			return $this->getProviderByName(Switchbox::TYPE_ECONOMY, $this->configuration->getEconomyPrefs()[strtolower($requester->getName())]);
		}
		return $this->getProviderByName(Switchbox::TYPE_ECONOMY, $this->configuration->getEconomyPluginName());
	}

	/**
	 * @param Plugin $requester The plugin requesting the provider. This method may return different values for different requesters.
	 *
	 * @return ChatProvider
	 */
	public function getChatProvider(Plugin $requester): ChatProvider {
		if(isset($this->configuration->getChatPrefs()[strtolower($requester->getName())])) {
			return $this->getProviderByName(Switchbox::TYPE_CHAT, $this->configuration->getChatPrefs()[strtolower($requester->getName())]);
		}
		return $this->getProviderByName(Switchbox::TYPE_CHAT, $this->configuration->getChatPluginName());
	}

	/**
	 * @return Configuration
	 */
	public function getConfiguration(): Configuration {
		return $this->configuration;
	}

	/**
	 * @param string $type
	 * @param string $class
	 * @param Plugin $plugin
	 */
	public function registerProvider(string $type, string $class, Plugin $plugin) {
		if(!isset($this->providers[$type])) {
			throw new \InvalidArgumentException("Invalid type given, please use one of the constants");
		}
		$this->providers[$type][strtolower($plugin->getName())] = $registry = new ProviderRegistry();
		$registry->plugin = $plugin;
		$registry->class = $class;
		$registry->validate($type);
	}

	/**
	 * @param string $type
	 * @param string $name
	 *
	 * @return mixed
	 */
	private function getProviderByName(string $type, string $name) {
		if(!isset($this->providers[$type])) {
			throw new \InvalidArgumentException("Unknown type '$type'");
		}
		$name = strtolower($name);
		if(!isset($this->providers[$type][$name])) {
			throw new \RuntimeException("$type provider '$name' is not supported.");
		}
		$registry = $this->providers[$type][$name];
		return $registry->instantiate();
	}

	/**
	 * @internal
	 */
	private function registerDefaults() {
		$data = [
			[Switchbox::TYPE_ECONOMY, DummyEconomySwitch::class, "Switchbox"],
			[Switchbox::TYPE_ECONOMY, EconomyAPISwitch::class, "EconomyAPI"],
			[Switchbox::TYPE_CHAT, DummyChatSwitch::class, "Switchbox"],
			[Switchbox::TYPE_CHAT, EssentialsPEChatSwitch::class, "EssentialsPE"],
		];
		foreach($data as list($type, $class, $name)) {
			$plugin = $this->getServer()->getPluginManager()->getPlugin($name);
			if($plugin !== null and $plugin->isEnabled()) {
				$this->registerProvider(Switchbox::TYPE_ECONOMY, EconomyProvider::class, $plugin);
			}
		}
	}

	/**
	 * @param PluginDisableEvent $event
	 *
	 * @priority MONITOR
	 * @internal
	 */
	public function WARNING_this_method_is_INTERNAL_do_NOT_call_me_directly_onPluginDisable(PluginDisableEvent $event) {
		foreach($this->providers as &$typedProviders) {
			foreach($typedProviders as $name => $providerRegistry) {
				if($providerRegistry->plugin === $event->getPlugin()) {
					unset($typedProviders[$name]);
				}
			}
		}
	}
}
