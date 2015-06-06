<?php
//by: SavionLegendZzz and ItzBulkDev
namespace DeathHead;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\PlayerDeathEvent;
use pocketmine\event\PlayerInteractEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\Item;
use onebone\economyapi\EconomyAPI;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener{

public function onEnable(){
$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());
$this->getServer()->getLogger()->info(TextFormat::BLUE."[DeathHead] DeathHead has been enabled!");
$this->money = EconomyAPI::getInstance();
if (!$this->money) {
	$this->getLogger()->info(TextFormat::RED."Unable to find EconomyAPI.");
	return true;
	}
}

public function onDeath(PlayerDeathEvent $event){
  $cause = $event->getEntity()->getLastDamageCause();
  $item = $event->getItem("91");
        if($cause instanceof EntityDamageByEntityEvent) {
            $player = $event->getEntity();
            $killer = $event->getEntity()->getLastDamageCause()->getDamager();
            if($killer instanceof Player) {
                $killer->sendMessage($message);
                $killer->getInventory()->addItem($item);
                $killer->sendMessage(TextFormat::RED."You killed $player.\n");
                $killer->sendMessage(TextFormat::GREEN."You earn $" . $config->get("paid-amount") . " for getting a kill.");
                    
		$player->sendMessage(TextFormat::RED."You were killed by $killer.");
		$player->sendMessage(TextFormat::RED."You lose $" . $config->get("lose-amount") . " for getting killed.");
		
		$this->money->addMoney($damager, $config->get("paid-amount"));
                $this->money->reduceMoney($player, $config->get("lose-amount"));
                }
        }
}
public function onTouch(PlayerInteractEvent $event){
            $player = $event->getPlayer()->getName();
            $item = $event->getItem()->getName();
            $config = $this->getConfig();
	    if($item == "91") {
	        $id = 91;
                $damage = 0;
                $count = 1;
                $item =  Item::get($id, $damage, $count);
                $player->getInventory()->addItem($item);
                $player->sendMessage("You can sell this for" . $config->get("paid-amount") . "!");
         }
     }
}
