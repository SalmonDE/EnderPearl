<?php
declare(strict_types = 1);

namespace SalmonDE\EnderPearl;

use pocketmine\scheduler\PluginTask;
use pocketmine\level\sound\EndermanTeleportSound;
use pocketmine\level\Position;

class DelayedEffectsTask extends PluginTask {

    protected $pos;
    protected $viewers;

    public function __construct(EnderPearlMain $owner, Position $pos, array $viewers){
        parent::__construct($owner);
        $this->pos = $pos;
        $this->viewers;
    }

    public function onRun(int $currentTick): void{
        $this->pos->getLevel()->addSound(new EndermanTeleportSound($this->pos), $this->viewers);
        $this->pos->getLevel()->broadcastLevelEvent($this->pos, 2013);
    }
}
