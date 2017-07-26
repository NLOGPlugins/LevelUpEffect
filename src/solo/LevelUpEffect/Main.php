<?php

namespace solo\LevelUpEffect;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;

class Main extends PluginBase implements Listener{
	
 	 public function onEnable(){
    	$this->getServer()->getPluginManager()->registerEvents($this, $this);
 	 }
 	 
 	 public function onLevelUp(PlayerLevelUpEvent $ev) {
 	 	new LevelUpTask($ev->getPlayer(), $ev->getNextLevel());
 	 }
}
?>