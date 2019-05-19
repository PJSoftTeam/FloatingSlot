<?php
	
	namespace PJZ9n\FloatingSlot\Listener;
	
	use PJZ9n\FloatingSlot\Main;
	use pocketmine\block\Block;
	use pocketmine\event\Listener;
	use pocketmine\event\player\PlayerInteractEvent;
	use pocketmine\Server;
	
	class signTouchListener implements Listener {
		
		/** @var Main */
		private $owner = null;
		
		public function __construct(Main $owner) {
			$this->owner = $owner;
		}
		
		/**
		 * 看板タッチ時イベント
		 *
		 * @param PlayerInteractEvent $event
		 *
		 * @priority NORMAL
		 */
		public function onSignTouch(PlayerInteractEvent $event): void {
			$this->owner->gameData["nowNumbers"][0] = rand(1, 9);
			$this->owner->gameData["nowNumbers"][1] = rand(1, 9);
			$this->owner->gameData["nowNumbers"][2] = rand(1, 9);
			$this->owner->gameData["nowNumbers"][3] = rand(1, 9);
			$this->owner->gameData["nowNumbers"][4] = rand(1, 9);
			$this->owner->gameData["nowNumbers"][5] = rand(1, 9);
			$this->owner->gameData["nowNumbers"][6] = rand(1, 9);
			$this->owner->gameData["nowNumbers"][7] = rand(1, 9);
			$this->owner->gameData["nowNumbers"][8] = rand(1, 9);
			$this->owner->floatingTextUpdate();
			$player = $event->getPlayer();
			$block = $event->getBlock();
			switch ($block->getId()) {
				case Block::SIGN_POST:
				case Block::WALL_SIGN:
				case Block::STANDING_SIGN:
					$sign_position = $this->owner->getConfig()->get("sign_position");
					if ($block->getLevel() === Server::getInstance()->getLevelByName($sign_position["world"])) {
						if ($block->getFloorX() === $sign_position["posx"]) {
							if ($block->getFloorY() === $sign_position["posy"]) {
								if ($block->getFloorZ() === $sign_position["posz"]) {
									//TODO: ここで処理する
									//
								}
							}
						}
					}
					break;
			}
		}
		
	}