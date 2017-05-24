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

namespace switchbox\api\chat;

use pocketmine\OfflinePlayer;
use pocketmine\Server;
use switchbox\api\BaseProvider;
use switchbox\api\ProviderReply;

abstract class ChatProvider extends BaseProvider {

	protected $groupSupport = false;

	public function __construct(Server $server) {
		parent::__construct($server);
	}

	/**
	 * Returns whether the chat plugin has group support added or not.
	 *
	 * @return bool
	 */
	public function hasGroupSupport(): bool {
		return $this->groupSupport;
	}

	/**
	 * Returns the nick of the given player, and in a certain world if this is supported by the chat plugin.
	 *
	 * @param OfflinePlayer $player
	 * @param string        $level
	 *
	 * @return string
	 */
	public abstract function getNick(OfflinePlayer $player, string $level = ""): string;

	/**
	 * Sets the nick of the given player, and in a certain world if this is supported by the chat plugin.
	 * Returns the reply from the chat plugin.
	 *
	 * @param OfflinePlayer $player
	 * @param string        $nick
	 * @param string        $level
	 *
	 * @return ProviderReply
	 */
	public abstract function setNick(OfflinePlayer $player, string $nick, string $level = ""): ProviderReply;

	/**
	 * Returns the prefix of the given player, and in a certain world if this is supported by the chat plugin.
	 *
	 * @param OfflinePlayer $player
	 * @param string        $level
	 *
	 * @return string
	 */
	public abstract function getPrefix(OfflinePlayer $player, string $level = ""): string;

	/**
	 * Sets the prefix of the player, and in a certain world if this is supported by the chat plugin.
	 * Returns the reply from the chat plugin.
	 *
	 * @param OfflinePlayer $player
	 * @param string        $prefix
	 * @param string        $level
	 *
	 * @return ProviderReply
	 */
	public abstract function setPrefix(OfflinePlayer $player, string $prefix, string $level = ""): ProviderReply;

	/**
	 * Returns the suffix of the given player, and in a certain world if this is supported by the chat plugin.
	 *
	 * @param OfflinePlayer $player
	 * @param string        $level
	 *
	 * @return string
	 */
	public abstract function getSuffix(OfflinePlayer $player, string $level = ""): string;

	/**
	 * Sets the suffix of the player, and in a certain world if this is supported by the chat plugin.
	 * Returns the reply from the chat plugin.
	 *
	 * @param OfflinePlayer $player
	 * @param string        $suffix
	 * @param string        $level
	 *
	 * @return ProviderReply
	 */
	public abstract function setSuffix(OfflinePlayer $player, string $suffix, string $level = ""): ProviderReply;

	/**
	 * Gets the prefix of a group if group support is in the chat plugin, and in a certain world if this is supported by the chat plugin.
	 *
	 * @param string $group
	 * @param string $level
	 *
	 * @return mixed
	 */
	public abstract function getGroupPrefix(string $group, string $level = ""): string;

	/**
	 * Sets the prefix of a group if group support is in the chat plugin, and in a certain world if this is supported by the chat plugin.
	 *
	 * @param string $group
	 * @param string $prefix
	 * @param string $level
	 *
	 * @return ProviderReply
	 */
	public abstract function setGroupPrefix(string $group, string $prefix, string $level = ""): ProviderReply;

	/**
	 * Returns the suffix of a group if group support is in the chat plugin, and in a certain world if this is supported by the chat plugin.
	 *
	 * @param string $group
	 * @param string $level
	 *
	 * @return string
	 */
	public abstract function getGroupSuffix(string $group, string $level = ""): string;

	/**
	 * Sets the suffix of a group if group support is in the chat plugin, and in a certain world if this is supported by the chat plugin.
	 *
	 * @param string $group
	 * @param string $suffix
	 * @param string $level
	 *
	 * @return mixed
	 */
	public abstract function setGroupSuffix(string $group, string $suffix, string $level = "");
}
