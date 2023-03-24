<?php
namespace AshiePleb\SoupFFA;

use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat;
use pocketmine\player\GameMode;

class Main extends PluginBase implements Listener {
    private $enabledWorlds;
    private $healthRegen;
    private $fullHealthMessage;
    private $configVersion;

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->enabledWorlds = $this->getConfig()->get("enabled-worlds");
        $this->healthRegen = $this->getConfig()->get("health-regen");
        $this->fullHealthMessage = $this->getConfig()->get("full-health-message");
        $this->configVersion = $this->getConfig()->get("config-version");
        if ($this->configVersion !== $this->getDescription()->getVersion()) {
            $this->getLogger()->warning("You're using an outdated version of the plugin, please head over to the plugin page to download the latest version.");
        }
    }

    public function handleInteract(PlayerInteractEvent $event) {
        $player = $event->getPlayer();
        $levelName = $player->getWorld()->getFolderName();
        foreach ($this->enabledWorlds as $item) {
            if ($levelName == $item) {
                if ($event->getItem()->equals(VanillaItems::MUSHROOM_STEW()) ||
                    $event->getItem()->equals(VanillaItems::RABBIT_STEW()) ||
                    $event->getItem()->equals(VanillaItems::BEETROOT_SOUP())) {
                    if ($player->getGamemode() === GameMode::SURVIVAL() || $player->getGamemode() === GameMode::ADVENTURE()) {
                        if ($player->getHealth() != $player->getMaxHealth()) {
                            $player->getInventory()->setItemInHand(VanillaItems::AIR()->asItem());
                            $player->setHealth($player->getHealth() + $this->healthRegen);
                        } else {
                            $player->sendPopup(TextFormat::colorize($this->fullHealthMessage));
                        }
                    }
                }
            }
        }
    }
}
