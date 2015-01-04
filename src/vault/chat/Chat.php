<?php
namespace vault\chat;


abstract class Chat{
    /**
     * Gets name of chat method
     * @return string
     */
    abstract public function getName();
    /**
     * Checks if permission method is enabled.
     * @return boolean
     */
    abstract public function isEnabled();
    /**
     * Gets a player's prefix
     * @param $world
     * @param $player
     * @return string
     */
    abstract public function getPlayerPrefix($world, $player);
    /**
     * Set a player`s prefix
     * @param $world
     * @param $player
     * @param $prefix
     * @return void
     */
    abstract public function setPlayerPrefix($world, $player, $prefix);
    /**
     * Get players suffix
     * @param $world
     * @param $player
     * @return string
     */
     abstract public function getPlayerSuffix($world, $player);
    /**
     * Set a player's suffix
     * @param $world
     * @param $player
     * @param $suffix
     * @return void
     */
    abstract public function setPlayerSuffix($world, $player, $suffix);
    /**
     * Gets a group's prefix
     * @param $world
     * @param $group
     * @return string
     */
    abstract public function getGroupPrefix($world, $group);
    /**
     * Set a group`s prefix
     * @param $world
     * @param $group
     * @param $prefix
     * @return void
     */
    abstract public function setGroupPrefix($world, $group, $prefix);
    /**
     * Get groups suffix
     * @param $world
     * @param $group
     * @return string
     */
    abstract public function getGroupSuffix($world, $group);
    /**
     * Set a group's suffix
     * @param $world
     * @param $group
     * @param $suffix
     * @return void
     */
    abstract public function setGroupSuffix($world, $group, $suffix);
    /**
     * Set a players informational node value
     * @param $world
     * @param $player
     * @param $node
     * @return string
     */
    abstract public function getPlayerInfoNode($world, $player, $node);
    /**
     * Set a players informational node value
     * @param $world
     * @param $player
     * @param $node
     * @param $value
     * @return void
     */
    abstract public function setPlayerInfoNode($world, $player, $node, $value);
    /**
     * Set a groups informational node value
     * @param $world
     * @param $group
     * @param $node
     * @return string
     */
    abstract public function getGroupInfoNode($world, $group, $node);
    /**
     * Set a groups informational node value
     * @param $world
     * @param $group
     * @param $node
     * @param $value
     * @return void
     */
    abstract public function setGroupInfoNode($world, $group, $node, $value);

}