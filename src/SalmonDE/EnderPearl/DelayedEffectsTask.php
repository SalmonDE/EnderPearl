<?php
declare(strict_types = 1);

namespace SalmonDE\EnderPearl;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\Player;
use pocketmine\scheduler\PluginTask;
use pocketmine\level\sound\EndermanTeleportSound;

class DelayedEffectsTask extends PluginTask {

    protected $player;

    public function __construct(EnderPearlMain $owner, Player $player){
        parent::__construct($owner);
        $this->player = $player;
    }

    public function onRun(int $currentTick): void{
        $this->player->attack($event = new EntityDamageEvent($this->player, EntityDamageEvent::CAUSE_FALL, 5));

        $this->player->getLevel()->addSound(new EndermanTeleportSound($this->player), $this->player->getViewers());
        $this->player->getLevel()->broadcastLevelEvent($this->player, 2013);
    }
}
