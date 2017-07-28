<?php

namespace solo\LevelUpEffect;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Main extends PluginBase implements Listener{
	
 	 public function onEnable(){
    		$this->getServer()->getPluginManager()->registerEvents($this, $this);
 	 }
 	 
 	 public function onCommand (CommandSender $sender, Command $cmd, $label, array $args) {
 	 	if ($cmd->getName() === "par") {
 	 		new LevelUpTask($sender, (int) 2);
 	 	}
 	 }
}
?>
