<?php
	
	namespace PJZ9n\FloatingSlot\Listener;
	
	use PJZ9n\FloatingSlot\Main;
	use pocketmine\event\Listener;
	use pocketmine\event\player\PlayerJoinEvent;
	use pocketmine\Server;
	
	class addFloatingTextListener implements Listener {
		
		/** @var Main */
		private $owner = null;
		
		public function __construct(Main $owner) {
			$this->owner = $owner;
		}
		
		/**
		 * 参加時イベント
		 *
		 * @param PlayerJoinEvent $event
		 *
		 * @priority NORMAL
		 */
		public function onJoin(PlayerJoinEvent $event): void {
			$player = $event->getPlayer();
			$floating_position = $this->owner->getConfig()->get("floating_position");
			$level = Server::getInstance()->getLevelByName($floating_position["world"]);
			$level->addParticle($this->owner->particle, [$player]);
		}
		
	}