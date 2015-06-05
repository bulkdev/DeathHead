<?php
//by: SavionLegendZzz and ItzBulkDev
namespace DeathHead;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\PlayerDeathEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class Main extends PluginBase{

public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
// maybe we dont need this?$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());
$this->getServer()->getLogger()->info(TextFormat::BLUE."DeathHead Enabled");
}

public function onDeath(PlayerDeathEvent $event){
  $cause = $event->getEntity()->getLastDamageCause();
        if($cause instanceof EntityDamageByEntityEvent) {
            $player = $event->getEntity();
            $killer = $event->getEntity()->getLastDamageCause()->getDamager();
            if($killer instanceof Player) {
                    $killer->sendMessage($message);
                }
}
