<?php

use pocketmine\Player;
use pocketmine\network\SourceInterface;
use pocketmine\network\mcpe\protocol\UpdateAttributesPacket;
use pocketmine\entity\Attribute;
use solo\solocore\util\ExperienceUtil;

class SPlayer extends Player{
	
	public function __construct(SourceInterface $interface, long $clientID,string $ip,int $port) {
		parent::__construct($interface, $clientID, $ip, $port);
	}
	
	public function sendAttributes() {
		$pk = new UpdateAttributesPacket();
		$pk->entityRuntimeId = 0;
		$pk->entries = [
				Attribute::getAttribute(Attribute::HEALTH)->setValue($this->getHealth()),
				Attribute::getAttribute(Attribute::HUNGER)->setValue($this->getExhaustion()),
				Attribute::getAttribute(Attribute::EXPERIENCE_LEVEL)->setValue( (float) ExperienceUtil::getCurrentPercent($this->getXpLevel(), $this->getXpProgress()))
		];
		$this->dataPacket($pk);
	}
	
}