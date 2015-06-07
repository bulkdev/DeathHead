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
$this->saveDefaultConfig();
$config = $this->getConfig();
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->getServer()->getLogger()->info(TextFormat::BLUE."[DeathHead] DeathHead has been enabled!");
$this->getServer()->getLogger()->info(TextFormat::BLUE."[DeathHead] Created by ItzBulkDev. Helped by SavionLegendZzz and MinecrafterPH");
$this->money = EconomyAPI::getInstance();
if (!$this->money) {
	$this->getLogger()->info(TextFormat::BLUE. "[DeathHead]" . TectFormat::RED . "Unable to find EconomyAPI.");
	return true;
	}
}
    public function onDisable(){
      	$this->saveDefaultConfig();
      	$this->getServer()->getPluginManager()->registerEvents($this, $this);
      	$this->getLogger()->info(TEXTFORMAT::LIGHT_PURPLE . "[DeathHead] Death Head has been Disabled!");
      }

public function onDeath(PlayerDeathEvent $event){
  $cause = $event->getEntity()->getLastDamageCause();
  $item = $event->getItem("91");
        if($cause instanceof EntityDamageByEntityEvent) {
            $player = $event->getEntity();
            $killer = $event->getEntity()->getLastDamageCause()->getDamager();
            if($killer instanceof Player) {
                $killer->getInventory()->addItem($item);
                $killer->sendPopup(TextFormat::GREEN."You earn $" . $config->get("paid-amount") . " for killing" . $player . ".");
                    
		$player->sendMessage(TextFormat::RED."You lose $" . $config->get("lose-amount") . " for getting killed by" . $killer. ".");
		
		$this->money->addMoney($damager, $config->get("paid-amount"));
                $this->money->reduceMoney($player, $config->get("lose-amount"));
                }
        }
}
}
