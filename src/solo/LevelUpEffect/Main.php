<?php

namespace solo\LevelUpEffect;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExperienceChangeEvent;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener{
    
    private $level = [ ];
	
 	 public function onEnable() {
 	    
 	    if (!class_exists("\\pocketmine\\event\\player\\PlayerExperienceChangeEvent", true)) {
 	    	$this->getLogger()->critical("PlayerExperienceChangeEvent가 없는 구동기입니다. 다른 구동기를 사용하세요.");
 	    	$this->getPluginLoader()->disablePlugin($this);
 	    	return;
 	    }
 	    
    	$this->getServer()->getPluginManager()->registerEvents($this, $this);
 	 }
 	 
 	 public function onJoin (PlayerJoinEvent $ev) {
 	     $this->level [$ev->getPlayer()->getName()] = $ev->getPlayer()->getXpLevel();
 	 }
 	 
 	 public function onUpdate (PlayerExperienceChangeEvent $ev) {
 	     if ($this->level [$ev->getPlayer()->getName()] < $ev->getExpLevel()) {
 	        new LevelUpTask($ev->getPlayer(), $ev->getExpLevel());
 	        $this->level [$ev->getPlayer()->getName()] = $ev->getExpLevel();
 	     }
 	 }
}
