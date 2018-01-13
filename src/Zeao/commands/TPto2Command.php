<?php
declare(strict_types = 1);
namespace TPToggle\commands;
use TPToggle\Main;
use TPToggle\util\TeleportManager;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
class TPto2Command extends CommandExecutor {
    /**
     * @param BaseAPI $api
     */
    public function __construct(Main $plugin){
        parent::__construct($api, "tpto", "Teleport to a player.", "<player>", false, ["s"]);
        $this->setPermission("tptoggle.tpto");
    }
    /**
     * @param CommandSender $sender
     * @param string $alias
     * @param array $args
     * @return bool
     */
    public function execute(CommandSender $sender, string $alias, array $args): bool{
        if(!$this->testPermission($sender)){
            return false;
        }
        if(!$sender instanceof Player || count($args) !== 1){
            $this->sendUsage($sender, $alias);
            return false;
        }
        if(!($player = $this->getMain()->getPlayer($args[0]))){
            $sender->sendMessage(TextFormat::RED . "[Error] Player not found");
            return false;
        }
        $player->teleport($sender);
        $sender->sendMessage(TextFormat::YELLOW . "Teleporting to " . $player->getDisplayName() . "...");
        $player->sendMessage(TextFormat::YELLOW . "Teleporting " . $sender->getDisplayName() . " to you...");
        return true;
    }
} 