<?php
	
	namespace PJZ9n\FloatingSlot;
	
	use PJZ9n\FloatingSlot\Command\fslotCommand;
	use PJZ9n\FloatingSlot\Listener\addFloatingTextListener;
	use PJZ9n\FloatingSlot\Listener\signTouchListener;
	use pocketmine\level\particle\FloatingTextParticle;
	use pocketmine\math\Vector3;
	use pocketmine\plugin\PluginBase;
	use pocketmine\Server;
	use pocketmine\utils\Config;
	
	class Main extends PluginBase {
		
		/** @var FloatingTextParticle */
		public $particle = null;
		
		/** @var mixed[] */
		public $gameData = [
			"nowNumbers" => [1, 2, 3, 4, 5, 6, 7, 8, 9],
			"nowPlayer" => null,
			"nowRotate" => false,
		];
		
		public function onEnable(): void {
			$this->getLogger()->info("プラグインが有効になりました!");
			$this->getLogger()->info("Copyright PJZ9n allrights reserved.");
			
			new Config($this->getDataFolder() . "config.yml", Config::YAML, [
				"one_play_money" => 1000,
				"floating_position" => [
					"posx" => 0,
					"posy" => 0,
					"posz" => 0,
					"world" => Server::getInstance()->getDefaultLevel()->getName(),
				],
				"sign_position" => [
					"posx" => 0,
					"posy" => 0,
					"posz" => 0,
					"world" => Server::getInstance()->getDefaultLevel()->getName(),
				],
			]);
			
			Server::getInstance()->getPluginManager()->registerEvents(new addFloatingTextListener($this), $this);
			Server::getInstance()->getPluginManager()->registerEvents(new signTouchListener($this), $this);
			
			Server::getInstance()->getCommandMap()->register("FloatingSlot", new fslotCommand($this));
			
			$this->floatingTextInit();
		}
		
		public function onDisable(): void {
			$this->getConfig()->save();
		}
		
		public function floatingTextInit(): void {
			$now_numbers_string = [];
			foreach ($this->gameData["nowNumbers"] as $number) {
				if ($number === 0) {
					$now_numbers_string[] = "=";
				} else {
					$now_numbers_string[] = "{$number}";
				}
			}
			$now_numbers_string = "{$now_numbers_string[0]} : {$now_numbers_string[1]} : {$now_numbers_string[2]}\n" .
				"{$now_numbers_string[3]} : {$now_numbers_string[4]} : {$now_numbers_string[5]}\n" .
				"{$now_numbers_string[6]} : {$now_numbers_string[7]} : {$now_numbers_string[8]}";
			$floating_position = $this->getConfig()->get("floating_position");
			$this->particle = new FloatingTextParticle(new Vector3($floating_position["posx"], $floating_position["posy"], $floating_position["posz"]), $now_numbers_string, "slot");
		}
		
		public function floatingTextUpdate(): void {
			$now_numbers_string = [];
			foreach ($this->gameData["nowNumbers"] as $number) {
				if ($number === 0) {
					$now_numbers_string[] = "=";
				} else {
					$now_numbers_string[] = "{$number}";
				}
			}
			$now_numbers_string = "{$now_numbers_string[0]} : {$now_numbers_string[1]} : {$now_numbers_string[2]}\n" .
				"{$now_numbers_string[3]} : {$now_numbers_string[4]} : {$now_numbers_string[5]}\n" .
				"{$now_numbers_string[6]} : {$now_numbers_string[7]} : {$now_numbers_string[8]}";
			$this->particle->setText($now_numbers_string);
			$this->particle->setInvisible(false);
		}
		
	}