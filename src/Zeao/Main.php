<?php

namespace Zeao;

use Zeao\commands\TPToggleCommand;
use Zeao\commands\TPto2Command;
use Zeao\util\TeleportManager;
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
        $this->getLogger()->info(TextFormat::RED . "TpToggle disabled.");
   }
}
