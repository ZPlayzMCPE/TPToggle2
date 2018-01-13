<?php

namespace Zeao;

use Zeao\commands\TPToggleCommand;
use Zeao\commands\TPto2Command;
use Zeao\util\TeleportManager;
use pocketmine\util\TextFormat;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {
    
    private static $plugin;
    protected $teleportManager;
    public function onEnable() {
        self::$plugin = $this;
        $this->teleportManager = new TeleportManager($this);
        $this->getCommand('tpto')->setExecutor(new Tpto2Command($this));
        $this->getCommand('tptoggle')->setExecutor(new TpToggleCommand($this));
   }
   public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "TpToggle disabled.");
   }
}
