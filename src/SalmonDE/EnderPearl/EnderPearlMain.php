<?php
declare(strict_types = 1);

namespace SalmonDE\EnderPearl;

use pocketmine\entity\Entity;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\item\ItemFactory;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class EnderPearlMain extends PluginBase implements Listener {

    private $enderPearlUses = [];

    public function onEnable(): void{
        ItemFactory::registerItem(new EnderPearlItem());
        Entity::registerEntity(EnderPearl::class, false, ['Enderpearl', 'EnderPearl', 'minecraft:ender_pearl']);

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onQuit(PlayerQuitEvent $event): void{
        unset($this->enderPearlUses[$event->getPlayer()->getLowerCaseName()]);
    }

    public function useEnderPearl(Player $player): void{
        $this->enderPearlUses[$player->getLowerCaseName()] = microtime(true);
    }

    public function canUseEnderPearl(Player $player): bool{
        return (microtime(true) - ($this->enderPearlUses[$player->getLowerCaseName()] ?? 0)) >= 1;
    }
}
