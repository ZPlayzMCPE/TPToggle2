<?php
namespace TPToggle;
use TPToggle\commands\TpToggleCommand;
use TPToggle\commands\TptoCommand;
use TPToggle\util\TeleportManager;
use pocketmine\plugin\PluginBase;
class Main extends PluginBase {
    private static $plugin;
    protected $teleportManager;
    public function onEnable() {
        self::$plugin = $this;
        $this->saveDefaultConfig();
        $this->teleportManager = new TeleportManager($this);
        $this->getCommand('tpto')->setExecutor(new TptoCommand($this));
        $this->getCommand('tptoggle')->setExecutor(new TpToggleCommand($this));
    }
    public function onDisable() {
        # Cleanup in case of a reload.
        unset($this->teleportManager,
        self::$plugin = null;
    }
    public static function getPlugin(): TPToggle {
        return self::$plugin;
    }
    public function getTeleportManager(): TeleportManager {
        return $this->teleportManager;
    }
}