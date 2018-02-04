<?php
declare(strict_types = 1);

namespace SalmonDE\EnderPearl;

use pocketmine\entity\Entity;
use pocketmine\entity\projectile\Throwable;
use pocketmine\Player;
use pocketmine\event\entity\EntityDamageEvent;

class EnderPearl extends Throwable {

    public const NETWORK_ID = self::ENDER_PEARL;

    public function canCollideWith(Entity $entity): bool{
        if($this->getOwningEntityId() === $entity->getId()){
            return false;
        }

        return parent::canCollideWith($entity);
    }

    public function onCollideWithEntity(Entity $entity){
        parent::onCollideWithEntity($entity);
        $this->teleportPlayer();
    }

    public function entityBaseTick(int $tickDiff = 1): bool{
        if($this->closed){
            return false;
        }

        $hasUpdate = parent::entityBaseTick($tickDiff);

        if($this->isCollided){
            $this->teleportPlayer();

            $this->flagForDespawn();
            $hasUpdate = true;
        }

        return $hasUpdate;
    }

    public function teleportPlayer(): bool{
        if(($player = $this->getOwningEntity()) instanceof Player and $this->y > -1){
            $player->teleport($this, $player->getYaw(), $player->getPitch());
            $player->attack(new EntityDamageEvent($player, EntityDamageEvent::CAUSE_FALL, 5));

            $player->getServer()->getScheduler()->scheduleDelayedTask(new DelayedEffectsTask($player->getServer()->getPluginManager()->getPlugin('EnderPearl'), $this->asPosition(), $this->getViewers()), 1);

            return true;
        }

        return false;
    }
}
