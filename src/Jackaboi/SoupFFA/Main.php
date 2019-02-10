<?php
namespace Jackaboi\SoupFFA;

use pocketmine\plugin\PluginBase;
use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;

class Main extends PluginBase implements Listener {

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function handleInteract(PlayerInteractEvent $event){

       if($event->getItem()->getId() == 282 || $event->getItem()->getId() == 459){

            $event->getPlayer()->setHealth($event->getPlayer()->getHealth() + 3.5);
            $event->getPlayer()->getInventory()->setItemInHand(item::get(0));
        }
    }
}
