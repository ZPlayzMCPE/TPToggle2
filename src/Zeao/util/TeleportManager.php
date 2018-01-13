<?php
namespace TPToggle\util;
use TPToggle\Main;
class TeleportManager {
    private $plugin;
    private $status;
    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
        $this->status = [];
    }
    public function getStatus($player) {
        $player = strtolower($player);
        return (isset($this->status[$player])) ? $this->status[$player] : true;
    }
    /**
     * Sets the status of a specified player.
     *
     * @param $player
     * @param $status
     */
    public function setStatus($player, $status) {
        $player = strtolower($player);
        $this->status[$player] = $status;
    }
}