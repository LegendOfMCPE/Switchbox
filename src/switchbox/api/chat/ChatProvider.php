<?php

namespace switchbox\api\economy;

use pocketmine\level\Level;
use pocketmine\OfflinePlayer;
use switchbox\api\BaseProvider;
use switchbox\api\ProviderReply;
use switchbox\Loader;

abstract class ChatProvider extends BaseProvider {

	protected $groupSupport = false;

	public function __construct(Loader $loader) {
		parent::__construct($loader);
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