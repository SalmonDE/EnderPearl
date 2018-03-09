<?php
declare(strict_types = 1);

namespace SalmonDE\EnderPearl;

use pocketmine\entity\Entity;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\plugin\PluginBase;

class EnderPearlMain extends PluginBase {

    public function onEnable(): void{
        ItemFactory::registerItem($i = new EnderPearlItem());
        Item::addCreativeItem($i);
        Entity::registerEntity(EnderPearl::class, false, ['Enderpearl', 'EnderPearl', 'minecraft:ender_pearl']);
    }
}
