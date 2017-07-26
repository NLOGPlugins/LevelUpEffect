<?php

declare(strict_types=1);

namespace solo\LevelUpEffect;

use pocketmine\event\player\PlayerEvent;
use pocketmine\event\Cancellable;

use pocketmine\Player;

class PlayerLevelUpEvent extends PlayerEvent implements Cancellable {
	
	public static $handlerList = null;
	
	private $experience;
	
	public function __construct(Player $player) {
		$this->player = $player;
	}
	
	public function getNextLevel() {
		return $this->player->getXpLevel() + 1;
	}
	
	public function getLevel() {
		return $this->player->getXpLevel();
	}
}