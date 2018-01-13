<?php
namespace TPToggle\commands;
use TPToggle\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
class TPtoCommand implements CommandExecutor {
    private $plugin;
    private $tpManager;
    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
        $this->tpManager = $plugin->getTeleportManager();
    }
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
        if(!($sender instanceof Player)) {
            $sender->sendMessage(TextFormat::RED.'CONSOLE cannot teleport. :(');
            return true;
        }
        if(!$sender->hasPermission('tptoggle.command.tpto')) {
            $sender->sendMessage($this->plugin->getMessageHandler()->no_permission);
            return true;
        }
        if(count($args) < 1) {
            $sender->sendMessage($this->plugin->getMessageHandler()->tp_name_missing);
            return true;
        }
        $target = $this->plugin->getServer()->getPlayer($args[0]);
        # Player is not online or may be auto-completed.
        if($target === null) {
            $players = [];
            foreach($this->plugin->getServer()->getOnlinePlayers() as $player) \array_push($players, $player->getName());
            sort($players);
            foreach($players as $player) {
                if(substr(strtolower($player), 0, strlen($args[0])) !== strtolower($args[0])) continue;
                $target = $this->plugin->getServer()->getPlayer($player);
                # We found our guy, let's get outta here!
                break;
            }
            # Ensure that we have a target before proceeding.
            if($target === null) {
                $sender->sendMessage(TextFormat::RED.'Player was not found, the player may be offline.');
                return true;
            }
        }
        # Check if the target allows teleportation requests.
        if($this->tpManager->getStatus($target->getName()) === false) {
            $sender->sendMessage($this->plugin->getMessageHandler()->tp_not_allowed);
            return true;
        }      
       }
}