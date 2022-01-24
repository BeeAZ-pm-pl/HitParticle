<?php

namespace lenlenlL6\hitparticle;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\world\Posiition;
use pocketmine\world\particle\HeartParticle;
use pocketmine\world\particle\InkParticle;
use pocketmine\world\particle\FlameParticle; 
use pocketmine\world\particle\LavaParticle;
use pocketmine\world\particle\PotionSplashParticle;
use pocketmine\world\particle\WaterParticle;
use pocketmine\world\particle\SmokeParticle;  

class Main extends PluginBase implements Listener {
  
  public $prefix = "§a[ §bHitParticle §a]";
  
  public function onEnable() : void{
    $this->getLogger()->info("
    _   _ _ _   ____            _   _      _      
 | | | (_) |_|  _ \ __ _ _ __| |_(_) ___| | ___ 
 | |_| | | __| |_) / _` | '__| __| |/ __| |/ _ \
 |  _  | | |_|  __/ (_| | |  | |_| | (__| |  __/
 |_| |_|_|\__|_|   \__,_|_|   \__|_|\___|_|\___|
 Plugin Enable");
 $this->saveDefaultConfig();
 $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }
  
  public function onDisable() : void{
    $this->getLogger()->info("
    _   _ _ _   ____            _   _      _      
 | | | (_) |_|  _ \ __ _ _ __| |_(_) ___| | ___ 
 | |_| | | __| |_) / _` | '__| __| |/ __| |/ _ \
 |  _  | | |_|  __/ (_| | |  | |_| | (__| |  __/
 |_| |_|_|\__|_|   \__,_|_|   \__|_|\___|_|\___|
 Plugin Disable");
  }
  
  public function onCommand(CommandSender $player, Command $cmd, String $label, array $args): bool{
    if($cmd->getName() === "hitparticle"){
      if(isset($args[0])){
        switch($args[0]){
          case "on":
            $this->getConfig()->set("active", true);
            $player->sendMessage($this->prefix . "§a HitParticle enabled");
            break;
            
            case "off":
              $this->getConfig()->set("active", false);
            $player->sendMessage($this->prefix . "§a HitParticle disable");
              break;
        }
      }else{
        $player->sendMessage($this->prefix . "§c /hitparticle [on | off]");
      }
    }
    return true;
  }
  
  public function onDamage(EntityDamageByEntityEvent $event){
    $entity = $event->getEntity();
    $position = $entity->getPosition();
    $world = $entity->getWorld();
    if(!$event->isCancelled()){
      if($this->getConfig()->get("active") === true){
     if($this->getConfig()->get("HeartParticle") === true){
       $world->addParticle($position, new HeartParticle(1, $position));
     }
     if($this->getConfig()->get("InkParticle") === true){
       $world->addParticle($position, new InkParticle(1, $position));
     }
     if($this->getConfig()->get("LavaParticle") === true){
       $world->addParticle($position, new LavaParticle($position));
     }
     if($this->getConfig()->get("FlameParticle") === true){
       $world->addParticle($position, new FlameParticle($position));
     }
     if($this->getConfig()->get("SmokeParticle") === true){
       $world->addParticle($position, new SmokeParticle(1, $position));
     }
     if($this->getConfig()->get("WaterParticle") === true){
       $world->addParticle($position, new WaterParticle($position));
     }
      }
    }
  }
}
