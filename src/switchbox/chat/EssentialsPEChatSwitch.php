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

namespace vault\chat;

use EssentialsPE\Sessions\SessionManager;
use pocketmine\OfflinePlayer;
use switchbox\api\chat\ChatProvider;
use switchbox\api\ProviderReply;
use switchbox\Switchbox;
use xecon\Session;

class EssentialsPEChatSwitch extends ChatProvider {

	protected $groupSupport = false;
	protected $name = "EssentialsPE";

	/** @var \EssentialsPE\Loader */
	private $plugin;

	public function __construct(\EssentialsPE\Loader $loader) {
		$this->plugin = $loader;
		parent::__construct($loader->getServer());
	}

	/**
	 * @param OfflinePlayer $player
	 * @param string        $level
	 *
	 * @return string
	 */
	public function getNick(OfflinePlayer $player, string $level = ""): string {
		if($this->plugin->isEnabled()) {
			return SessionManager::getSession($player)->getNick();
		}
		return "";
	}

	/**
	 * @param OfflinePlayer $player
	 * @param string        $nick
	 * @param string        $level
	 *
	 * @return ProviderReply
	 */
	public function setNick(OfflinePlayer $player, string $nick, string $level = ""): ProviderReply {
		if($this->plugin->isEnabled()) {
			return new ProviderReply(SessionManager::getSession($player)->setNick($nick));
		}
		return new ProviderReply(false);
	}

	/**
	 * @param OfflinePlayer $player
	 * @param string        $level
	 *
	 * @return string
	 */
	public function getPrefix(OfflinePlayer $player, string $level = ""): string {
		if($this->plugin->isEnabled()) {
			return SessionManager::getSession($player)->getPrefix();
		}
		return "";
	}

	/**
	 * @param OfflinePlayer $player
	 * @param string        $prefix
	 * @param string        $level
	 *
	 * @return ProviderReply
	 */
	public function setPrefix(OfflinePlayer $player, string $prefix, string $level = ""): ProviderReply {
		if($this->plugin->isEnabled()) {
			return new ProviderReply(SessionManager::getSession($player)->setPrefix($prefix));
		}
		return new ProviderReply(false);
	}

	/**
	 * @param OfflinePlayer $player
	 * @param string        $level
	 *
	 * @return string
	 */
	public function getSuffix(OfflinePlayer $player, string $level = ""): string {
		if($this->plugin->isEnabled()) {
			return SessionManager::getSession($player)->getSuffix();
		}
		return "";
	}

	/**
	 * @param OfflinePlayer $player
	 * @param string        $suffix
	 * @param string        $level
	 *
	 * @return ProviderReply
	 */
	public function setSuffix(OfflinePlayer $player, string $suffix, string $level = ""): ProviderReply {
		if($this->plugin->isEnabled()) {
			return new ProviderReply(SessionManager::getSession($player)->setSuffix($suffix));
		}
		return new ProviderReply(false);
	}

	/**
	 * @param string $group
	 * @param string $level
	 *
	 * @return string
	 */
	public function getGroupPrefix(string $group, string $level = ""): string {
		return false;
	}

	/**
	 * @param string $group
	 * @param string $prefix
	 * @param string $level
	 *
	 * @return ProviderReply
	 */
	public function setGroupPrefix(string $group, string $prefix, string $level = ""): ProviderReply {
		return new ProviderReply(false);
	}

	/**
	 * @param string $group
	 * @param string $level
	 *
	 * @return string
	 */
	public function getGroupSuffix(string $group, string $level = ""): string {
		return "";
	}

	/**
	 * @param string $group
	 * @param string $suffix
	 * @param string $level
	 *
	 * @return ProviderReply
	 */
	public function setGroupSuffix(string $group, string $suffix, string $level = ""): ProviderReply {
		return new ProviderReply(false);
	}
}
