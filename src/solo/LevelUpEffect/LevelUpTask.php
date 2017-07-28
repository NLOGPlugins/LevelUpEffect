<?php

namespace solo\LevelUpEffect;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\math\Vector3;
use pocketmine\entity\Entity;
use pocketmine\network\mcpe\protocol\AddEntityPacket;
use pocketmine\network\mcpe\protocol\RemoveEntityPacket;
use pocketmine\network\mcpe\protocol\MoveEntityPacket;
use pocketmine\network\mcpe\protocol\AddPlayerPacket;
use pocketmine\scheduler\Task;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\level\particle\CriticalParticle;
use pocketmine\block\Block;
use pocketmine\utils\UUID;
use pocketmine\entity\Item;

class LevelUpTask {
	
	public $plugin;
	
	public $player;
	public $level, $step;
	
	public $apk;
	public $mpk;
	public $rpk;
	public $rpk2;
	
	/**
	 * 
	 * @param Player $player
	 * @param int $nextLevel
	 */
	public function __construct(Player $player, int $nextLevel, $plugin) {
		$this->player = $player;
		$this->level = $nextLevel;
		$this->step = 0;
		
		$this->plugin = $plugin;
		
		$this->update();
	}
	
	public function random() {
		$result = mt_rand() / mt_getrandmax();
		$result = (float) substr($result, 0, 14);
		return $result;
	}
	
	public function update() {
		if (!($this->player->isOnline())) {
			return;
		}
	
		$pos = new Vector3($this->player->x, $this->player->y, $this->player->z);
	
		if ($this->step == 0) {
			$eid = Entity::$entityCount++;
			
			$this->apk = new AddEntityPacket();
			$this->apk->entityRuntimeId = $eid;
			$this->apk->x = $this->player->x;
			$this->apk->y = $this->player->y;
			$this->apk->z = $this->player->z;
			
			$flag = 0;
			$flag |= 1 << Entity::DATA_FLAG_CAN_SHOW_NAMETAG;
			$flag |= 1 << Entity::DATA_FLAG_ALWAYS_SHOW_NAMETAG;
			$flag |= 1 << Entity::DATA_FLAG_IMMOBILE;
			
			$this->apk->yaw = 0;
			$this->apk->pitch = 0;
			$this->apk->meta = 0;
			$this->apk->type = Item::NETWORK_ID;
			$this->apk->metadata = [ 
			 Entity::DATA_NAMETAG => 
			  [ Entity::DATA_TYPE_STRING, "§a§lLevel UP !!!" ],
			 Entity::DATA_FLAGS => 
			  [ Entity:: DATA_TYPE_LONG, $flag ] 
			];
				
			$this->mpk = new MoveEntityPacket();
			$this->mpk->entityRuntimeId = $eid;
			$this->mpk->x = (float) $this->player->x;
			$this->mpk->y = (float) $this->player->y + 2.7;
			$this->mpk->z = (float) $this->player->z;
			$this->mpk->pitch = (float) 0;
			$this->mpk->yaw = (float) 0;
			$this->mpk->headYaw = (float) 0;
			
			$this->rpk = new RemoveEntityPacket();
			$this->rpk->entityUniqueId = $eid;
			
			foreach ($this->player->getLevel()->getPlayers() as $p) {
				$p->dataPacket($this->apk);
			}
			
		}elseif ($this->step == 1) {
				
		}elseif ($this->step == 2) {
			
			foreach ($this->player->getLevel()->getPlayers() as $p) {
				$p->dataPacket($this->mpk);
			}
				
		}elseif ($this->step < 17) {
			
			$particle = new CriticalParticle($pos);
			for($i = 0; $i < 2; $i++){
				$particle->setComponents(
						$pos->x + (self::random() * 2 - 1) * 2,
						$pos->y + (self::random() * 2 - 1) + 1,
						$pos->z + (self::random() * 2 - 1) * 2
						);
				$this->player->getLevel()->addParticle($particle);
			}
			
		}elseif($this->step == 4){
	
		}elseif($this->step == 5){
				
		}elseif($this->step == 6){
				
		}elseif($this->step == 7){
				
		}elseif($this->step == 8){
				
		}elseif($this->step == 9){
				
		}elseif($this->step == 10){
				
		}elseif($this->step == 11){
				
		}elseif($this->step == 12){
				
		}elseif($this->step == 13){
				
		}elseif($this->step == 14){
				
		}elseif($this->step == 15){
				
		}elseif($this->step == 16){
				
		}elseif($this->step == 17){
			
			$eid = Entity::$entityCount++;
	
			/*$this->apk = new AddEntityPacket();
			$this->apk->entityRuntimeId = $eid;
			$this->apk->type = (int) 15;
			$this->apk->x = $this->player->x;
			$this->apk->y = $this->player->y;
			$this->apk->z = $this->player->z;
	
			$flags = 0;
			$flags |= 1 << Entity::DATA_FLAG_INVISIBLE;
			$flags |= 1 << Entity::DATA_FLAG_CAN_SHOW_NAMETAG;
			$flags |= 1 << Entity::DATA_FLAG_ALWAYS_SHOW_NAMETAG;
			$flags |= 1 << Entity::DATA_FLAG_NO_AI;
	
			$metadata = [
					Entity::DATA_FLAGS => [Entity::DATA_TYPE_LONG, $flags],
					Entity::DATA_AIR => [Entity::DATA_TYPE_SHORT, 400],
					Entity::DATA_NAMETAG => [Entity::DATA_TYPE_STRING, "§b§l~~ ".strval($this->level)." ~~"],
					Entity::DATA_LEAD_HOLDER_EID => [Entity::DATA_TYPE_LONG, -1],
					Entity::DATA_SCALE => [Entity::DATA_TYPE_FLOAT, "0.001f"]
			];
	
			$this->apk->metadata = $metadata;*/
			
			$this->apk = new AddEntityPacket();
			$this->apk->entityRuntimeId = $eid;
			
			$flag = 0;
			$flag |= 1 << Entity::DATA_FLAG_CAN_SHOW_NAMETAG;
			$flag |= 1 << Entity::DATA_FLAG_ALWAYS_SHOW_NAMETAG;
			$flag |= 1 << Entity::DATA_FLAG_IMMOBILE;
			
			$this->apk->x = $this->player->x;
			$this->apk->y = $this->player->y;
			$this->apk->z = $this->player->z;
			$this->apk->yaw = 0;
			$this->apk->pitch = 0;
			$this->apk->meta = 0;
			$this->apk->type = Item::NETWORK_ID;
			$this->apk->metadata = [ 
			 Entity::DATA_NAMETAG => 
			  [ Entity::DATA_TYPE_STRING, "§b§l~~ ".strval($this->level)." ~~" ],
			 Entity::DATA_FLAGS => 
			  [ Entity:: DATA_TYPE_LONG, $flag ] 
			];
	
			$this->mpk = new MoveEntityPacket();
			$this->mpk->entityRuntimeId = $eid;
			$this->mpk->x = (float) $this->player->x;
			$this->mpk->y = (float) $this->player->y + 2.2;
			$this->mpk->z = (float) $this->player->z;
			$this->mpk->pitch = (float) 0;
			$this->mpk->yaw = (float) 0;
			$this->mpk->headYaw = (float) 0;
	
			$this->rpk2 = new RemoveEntityPacket();
			$this->rpk2->entityUniqueId = $eid;
	
			foreach ($this->player->getLevel()->getPlayers() as $p) {
				$p->dataPacket($this->apk);
				$p->dataPacket($this->mpk);
			}
				
			$this->rpk2 = new RemoveEntityPacket();
			$this->rpk2->entityUniqueId = $eid;
			
		}elseif ($this->step < 40 && $this->step % 3 == 0) {
			
			$particle = new DestroyBlockParticle($pos, Block::get(Block::DIAMOND_BLOCK));
			$particle->setComponents(
					$pos->x + (self::random() * 2 - 1) * 3,
					$pos->y + 0.3,
					$pos->z + (self::random() * 2 - 1) * 3
					);
			$this->player->getLevel()->addParticle($particle);
			
		}elseif($this->step == 19){
	
		}elseif($this->step == 20){
	
		}elseif($this->step == 21){
	
		}elseif($this->step == 22){
	
		}elseif($this->step == 23){
	
		}elseif($this->step == 24){
	
		}elseif($this->step == 25){
	
		}elseif($this->step == 26){
	
		}elseif($this->step == 27){
	
		}elseif($this->step == 28){
	
		}elseif($this->step == 29){
	
		}elseif($this->step == 30){
	
		}elseif($this->step == 31){
	
		}elseif($this->step == 32){
	
		}elseif($this->step == 33){
	
		}elseif($this->step == 34){
	
		}elseif($this->step == 35){
	
		}elseif($this->step == 36){
	
		}elseif($this->step == 37){
	
		}elseif($this->step == 38){
	
		}elseif($this->step == 39){
	
		}elseif($this->step == 40){
	
		}elseif($this->step == 41){
	
		}elseif($this->step == 42){
	
		}elseif($this->step == 43){
	
		}elseif($this->step == 44){
	
		}elseif($this->step == 45){
	
		}elseif($this->step == 46){
	
		}elseif($this->step == 47){
	
		}elseif($this->step == 48){
	
		}elseif($this->step == 49){
	
		}else{
			foreach ($this->player->getLevel()->getPlayers() as $p) {
				$p->dataPacket($this->rpk);
				$p->dataPacket($this->rpk2);
			}
			return;
		}
	
		$this->step++;
		Server::getInstance()->getScheduler()->scheduleDelayedTask(new class($this) extends Task{
			private $task;

			public function __construct($task){
				$this->task = $task;
			}

			public function onRun($currentTick){
				$this->task->update();
			}
		}, 1);
	}
	
}

?>
