<?php
declare(strict_types = 1);

namespace SalmonDE\EnderPearl;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\Player;
use pocketmine\scheduler\PluginTask;
use pocketmine\level\sound\EndermanTeleportSound;

class DelayedEffectsTask extends PluginTask {

    protected $player;
    protected $viewers;

    public function __construct(EnderPearlMain $owner, Player $player, array $viewers){
        parent::__construct($owner);
        $this->player = $player;
        $this->viewers = $viewers;
    }

    public function onRun(int $currentTick): void{
        $this->player->attack($event = new EntityDamageEvent($this->player, EntityDamageEvent::CAUSE_FALL, 5));

        $this->player->getLevel()->addSound(new EndermanTeleportSound($this->player), $this->viewers);
        $this->player->getLevel()->broadcastLevelEvent($this->player, LevelEventPacket::EVENT_PARTICLE_ENDERMAN_TELEPORT);
    }
}
