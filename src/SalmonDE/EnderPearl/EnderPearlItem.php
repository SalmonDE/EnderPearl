<?php
declare(strict_types = 1);

namespace SalmonDE\EnderPearl;

use pocketmine\item\ProjectileItem;
use pocketmine\math\Vector3;
use pocketmine\Player;

class EnderPearlItem extends ProjectileItem {

    public function __construct(int $meta = 0){
        parent::__construct(self::ENDER_PEARL, $meta, "EnderPearl");
    }

    public function getMaxStackSize(): int{
        return 16;
    }

    public function getProjectileEntityType(): string{
        return "EnderPearl";
    }

    public function getThrowForce(): float{
        return 1.5;
    }

    public function onClickAir(Player $player, Vector3 $directionVector): bool{
        if(!($plugin = $player->getServer()->getPluginManager()->getPlugin('EnderPearl'))->canUseEnderPearl($player)){
            return false;
        }

        $plugin->useEnderPearl($player);
        return parent::onClickAir($player, $directionVector);
    }
}
