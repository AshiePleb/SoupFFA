<?php
namespace AshiePleb\SoupFFA;

use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {
    private $enabledWorlds;
    private $configVersion;

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->enabledWorlds = $this->getConfig()->get("enabled-worlds");
        $this->configVersion = $this->getConfig()->get("config-version");
        $this->getLogger()->info("SoupFFA Has Been Enabled");
        if ($this->configVersion !== $this->getDescription()->getVersion()) {
            $this->getLogger()->info("You're using an outdated version of the plugin, please head over to the plugin page to download the latest version.");
        }
    }

    public function handleInteract(PlayerInteractEvent $event) {
        $player = $event->getPlayer();
        $levelName = $player->getWorld()->getFolderName();
        if ($player->getHealth() != $player->getMaxHealth()) {
            foreach ($this->enabledWorlds as $item) {
                if ($levelName == $item) {
                    if ($event->getItem()->equals(VanillaItems::MUSHROOM_STEW()) ||
                        $event->getItem()->equals(VanillaItems::RABBIT_STEW()) ||
                        $event->getItem()->equals(VanillaItems::BEETROOT_SOUP())) {
                        $player->getInventory()->setItemInHand(VanillaItems::AIR());
                        $player->setHealth($player->getHealth() + 3.5);
                    }
                }
            }
        } else {
            $player->sendPopup(TextFormat::GREEN . "Your health is already full!");
        }
    }

    public function onDisable(): void {
        $this->getLogger()->info("SoupFFA Has Been Disabled");
    }
}