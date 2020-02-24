<?php
namespace AshleyHunter01\SoupFFA;

use pocketmine\plugin\PluginBase;
use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
class Main extends PluginBase implements Listener {
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("§2SoupFFA Has Been Enabled");
    }
    public function handleInteract(PlayerInteractEvent $event){
        if($event->getItem()->getId() == 282 || $event->getItem()->getId() == 459){
            $event->getPlayer()->setHealth($event->getPlayer()->getHealth() + 3.5);
            $event->getPlayer()->getInventory()->setItemInHand(item::get(0));

        }
    }
    public function onDisable() {
        $this->getLogger()->info("§4SoupFFA Has Been Disabled");
    }
}
