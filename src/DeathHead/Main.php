<?php
//by: SavionLegendZzz and ItzBulkDev
namespace DeathHead;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\Item;
use onebone\economyapi\EconomyAPI;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->saveDefaultConfig();
$config = $this->getConfig();
$this->getServer()->getLogger()->info(TextFormat::BLUE."[DeathHead] DeathHead has been enabled!");
$this->getServer()->getLogger()->info(TextFormat::BLUE."[DeathHead] Created by ItzBulkDev. Helped by SavionLegendZzz and MinecrafterPH");
$this->money = EconomyAPI::getInstance();
if (!$this->money) {
	$this->getLogger()->info(TextFormat::BLUE. "[DeathHead]" . TectFormat::RED . "Unable to find EconomyAPI.");
	return true;
	}
}

public function onDeath(PlayerDeathEvent $event){
  $cause = $event->getEntity()->getLastDamageCause();
        if($cause instanceof EntityDamageByEntityEvent) {
            $player = $event->getEntity();
            $config = $this->getConfig();
            $killer = $event->getEntity()->getLastDamageCause()->getDamager();
            $paid = $config->get("paid-amount")
            $lost = $config->get("lost-amount")
            if($killer instanceof Player) {
                $killer->getInventory()->addItem(Item::get("91"));
                $killer->sendPopup(TextFormat::GREEN."You earn $" . $paid . " for killing" . $player . ".");
                    
		$player->sendMessage(TextFormat::RED."You lose $" . $lost . " for getting killed by" . $killer. ".");
		
		$this->money->addMoney($damager, $config->get("paid-amount"));
                $this->money->reduceMoney($player, $config->get("lose-amount"));
                }
        }
}
}
