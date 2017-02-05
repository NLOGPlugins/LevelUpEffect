package solo.levelupeffect;

import java.util.Random;

import cn.nukkit.Player;
import cn.nukkit.Server;
import cn.nukkit.block.Block;
import cn.nukkit.entity.Entity;
import cn.nukkit.entity.data.EntityMetadata;
import cn.nukkit.event.EventHandler;
import cn.nukkit.event.Listener;
import cn.nukkit.level.particle.CriticalParticle;
import cn.nukkit.level.particle.DestroyBlockParticle;
import cn.nukkit.level.particle.Particle;
import cn.nukkit.math.Vector3;
import cn.nukkit.network.protocol.AddEntityPacket;
import cn.nukkit.network.protocol.MoveEntityPacket;
import cn.nukkit.network.protocol.RemoveEntityPacket;
import cn.nukkit.plugin.PluginBase;
import cn.nukkit.scheduler.Task;
import solo.solobasepackage.event.player.PlayerLevelUpEvent;

public class Main extends PluginBase implements Listener{
	
	@Override
	public void onEnable(){
		this.getServer().getPluginManager().registerEvents(this, this);
	}
	
	@EventHandler
	public void onLevelUp(PlayerLevelUpEvent event){
		new LevelUpTask(event.getPlayer(), event.getNextLevel());
	}
	
	public class LevelUpTask{
		
		public Player player;
		public int level;
		
		public int step;
		
		public AddEntityPacket apk;
		public MoveEntityPacket mpk;
		public RemoveEntityPacket rpk;
		public RemoveEntityPacket rpk2;
		
		public LevelUpTask(Player player, int nextLevel){
			this.player = player;
			this.level = nextLevel;
			
			this.step = 0;
			
			this.update();
		}
		
		public void update(){
			if(! player.isOnline()){
				return;
			}
			
			Random random = new Random();
			Particle particle;
			Vector3 pos = new Vector3(this.player.x, this.player.y, this.player.z);
			
			if(this.step == 0){
				long eid = Entity.entityCount++;
				
				this.apk = new AddEntityPacket();
				this.apk.entityUniqueId = eid;
				this.apk.entityRuntimeId = eid;
				this.apk.type = 15; //villager
				this.apk.x = (float) (this.player.x);
				this.apk.y = (float) (this.player.y + 2.3);
				this.apk.z = (float) (this.player.z);
				this.apk.speedX = 0;
				this.apk.speedY = 0;
				this.apk.speedZ = 0;
				this.apk.yaw = 0;
				this.apk.pitch = 0;
				
				long flags = 0;
				flags |= 1 << Entity.DATA_FLAG_INVISIBLE;
				flags |= 1 << Entity.DATA_FLAG_CAN_SHOW_NAMETAG;
				flags |= 1 << Entity.DATA_FLAG_ALWAYS_SHOW_NAMETAG;
				flags |= 1 << Entity.DATA_FLAG_NO_AI;
				EntityMetadata metadata = new EntityMetadata()
						.putLong(Entity.DATA_FLAGS, flags)
						.putShort(Entity.DATA_AIR, 400)
						.putShort(Entity.DATA_MAX_AIR, 400)
						.putString(Entity.DATA_NAMETAG, "§a§l" + "Level UP !!!")
						.putLong(Entity.DATA_LEAD_HOLDER_EID, -1)
						.putFloat(Entity.DATA_SCALE, 0.001f);
				
				this.apk.metadata = metadata;
				
				this.mpk = new MoveEntityPacket();
				this.mpk.eid = eid;
				this.mpk.x = (float) (this.player.x);
				this.mpk.y = (float) (this.player.y + 2.7);
				this.mpk.z = (float) (this.player.z);
				
				this.rpk = new RemoveEntityPacket();
				this.rpk.eid = eid;
				
				this.player.getLevel().getPlayers().values().forEach((p) -> p.dataPacket(this.apk));
			}else if(this.step == 1){
				
			}else if(this.step == 2){

				this.player.getLevel().getPlayers().values().forEach((p) -> p.dataPacket(this.mpk));
				
			}else if(this.step < 17){
				particle = new CriticalParticle(pos);
				for(int i = 0; i < 2; i++){
					particle.setComponents(
							pos.x + (random.nextFloat() * 2 - 1) * 2,
							pos.y + (random.nextFloat() * 2 - 1) + 1,
							pos.z + (random.nextFloat() * 2 - 1) * 2
					);
					this.player.level.addParticle(particle);
				}
				
			}else if(this.step == 4){
				
			}else if(this.step == 5){
				
			}else if(this.step == 6){
				
			}else if(this.step == 7){
				
			}else if(this.step == 8){
				
			}else if(this.step == 9){
				
			}else if(this.step == 10){
				
			}else if(this.step == 11){
				
			}else if(this.step == 12){
				
			}else if(this.step == 13){
				
			}else if(this.step == 14){
				
			}else if(this.step == 15){
				
			}else if(this.step == 16){
				
			}else if(this.step == 17){
				
				
				long eid = Entity.entityCount++;
				
				this.apk = new AddEntityPacket();
				this.apk.entityUniqueId = eid;
				this.apk.entityRuntimeId = eid;
				this.apk.type = 15; //villager
				this.apk.x = (float) (this.player.x);
				this.apk.y = (float) (this.player.y + 1.8);
				this.apk.z = (float) (this.player.z);
				this.apk.speedX = 0;
				this.apk.speedY = 0;
				this.apk.speedZ = 0;
				this.apk.yaw = 0;
				this.apk.pitch = 0;
				
				long flags = 0;
				flags |= 1 << Entity.DATA_FLAG_INVISIBLE;
				flags |= 1 << Entity.DATA_FLAG_CAN_SHOW_NAMETAG;
				flags |= 1 << Entity.DATA_FLAG_ALWAYS_SHOW_NAMETAG;
				flags |= 1 << Entity.DATA_FLAG_NO_AI;
				EntityMetadata metadata = new EntityMetadata()
						.putLong(Entity.DATA_FLAGS, flags)
						.putShort(Entity.DATA_AIR, 400)
						.putShort(Entity.DATA_MAX_AIR, 400)
						.putString(Entity.DATA_NAMETAG, "§b§l~~ " + Integer.toString(this.level) + " ~~")
						.putLong(Entity.DATA_LEAD_HOLDER_EID, -1)
						.putFloat(Entity.DATA_SCALE, 0.001f);
				
				this.apk.metadata = metadata;
				
				this.mpk = new MoveEntityPacket();
				this.mpk.eid = eid;
				this.mpk.x = (float) (this.player.x);
				this.mpk.y = (float) (this.player.y + 2.2);
				this.mpk.z = (float) (this.player.z);

				this.player.getLevel().getPlayers().values().forEach((p) -> {
					p.dataPacket(this.apk);
					p.dataPacket(this.mpk);
				});
				
				this.rpk2 = new RemoveEntityPacket();
				this.rpk2.eid = eid;
				
			}else if(this.step < 40 && this.step % 3 == 0){
				particle = new DestroyBlockParticle(pos, Block.get(Block.DIAMOND_BLOCK));
				//for(int i = 0; i < 2; i++){
					particle.setComponents(
							pos.x + (random.nextFloat() * 2 - 1) * 3,
							pos.y + 0.3,
							pos.z + (random.nextFloat() * 2 - 1) * 3
					);
					this.player.level.addParticle(particle);
				//}
				
			}else if(this.step == 19){
				
			}else if(this.step == 20){
				
			}else if(this.step == 21){
				
			}else if(this.step == 22){
				
			}else if(this.step == 23){
				
			}else if(this.step == 24){
				
			}else if(this.step == 25){
				
			}else if(this.step == 26){
				
			}else if(this.step == 27){
				
			}else if(this.step == 28){
				
			}else if(this.step == 29){
				
			}else if(this.step == 30){
				
			}else if(this.step == 31){
				
			}else if(this.step == 32){
				
			}else if(this.step == 33){
				
			}else if(this.step == 34){
				
			}else if(this.step == 35){
				
			}else if(this.step == 36){
				
			}else if(this.step == 37){
				
			}else if(this.step == 38){
				
			}else if(this.step == 39){
				
			}else if(this.step == 40){
				
			}else if(this.step == 41){
				
			}else if(this.step == 42){
				
			}else if(this.step == 43){
				
			}else if(this.step == 44){
				
			}else if(this.step == 45){
				
			}else if(this.step == 46){
				
			}else if(this.step == 47){
				
			}else if(this.step == 48){
				
			}else if(this.step == 49){
				
			}else{
				this.player.getLevel().getPlayers().values().forEach((p) -> {
					p.dataPacket(this.rpk);
					p.dataPacket(this.rpk2);
				});
				return;
			}
			this.step++;
			Server.getInstance().getScheduler().scheduleDelayedTask(new Task(){
				@Override
				public void onRun(int currentTick){
					LevelUpTask.this.update();
				}
			}, 1);
		}
	}
	
}