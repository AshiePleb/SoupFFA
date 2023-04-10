<?php

declare(strict_types=1);

namespace AshiePleb\SoupFFA;

use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat;
use pocketmine\player\GameMode;

class Main extends PluginBase implements Listener {

    private int $healthRegen = 0;
    private array $enabledWorlds = [];
    private string $fullHealthMessage = '';
    private string $configVersion = '';

    // =============================
    //        PLUGIN ENABLE
    // =============================
    
    public function onEnable(): void {
        $this->loadConfig();
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    // =============================
    //      LOAD PLUGIN CONFIG
    // =============================

    private function loadConfig(): void {
        $config = $this->getConfig();

        $this->enabledWorlds = (array) $config->get('enabled-worlds', []);
        $this->healthRegen = (int) $config->get('health-regen', 0);
        $this->fullHealthMessage = (string) $config->get('full-health-message', '');
        $this->configVersion = (string) $config->get('config-version', $this->getDescription()->getVersion());

        if($this->configVersion !== $this->getDescription()->getVersion()) {
            $this->getLogger()->warning("You're using an outdated version of the plugin, please head over to the plugin page to download the latest version.");
        }
    }

    // =============================
    //        SOUP INTERACT
    // =============================

    public function handleInteract(PlayerInteractEvent $event): void {
        $player = $event->getPlayer();
        $worldName = $player->getWorld()->getFolderName();

        if(!in_array($worldName, $this->enabledWorlds, true)) {
            return;
        }

        $item = $event->getItem();
        $isSoup = $item->getId() === VanillaItems::MUSHROOM_STEW()->getId()
            || $item->getId() === VanillaItems::RABBIT_STEW()->getId()
            || $item->getId() === VanillaItems::BEETROOT_SOUP()->getId();

        if(!$isSoup) {
            return;
        }

        $gameMode = $player->getGamemode();
        if(!$gameMode->equals(GameMode::SURVIVAL()) && !$gameMode->equals(GameMode::ADVENTURE())) {
            return;
        }

        $health = $player->getHealth();
        $maxHealth = $player->getMaxHealth();
        if ($health >= $maxHealth) {
            $player->sendPopup(TextFormat::colorize($this->fullHealthMessage));
            return;
        }

        $player->getInventory()->setItemInHand(VanillaItems::AIR());
        $player->setHealth($health + $this->healthRegen);
    }
}
