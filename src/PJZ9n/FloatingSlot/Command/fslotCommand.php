<?php
	
	namespace PJZ9n\FloatingSlot\Command;
	
	use PJZ9n\FloatingSlot\Main;
	use pocketmine\command\Command;
	use pocketmine\command\CommandSender;
	use pocketmine\Player;
	use pocketmine\utils\TextFormat;
	
	class fslotCommand extends Command {
		
		/** @var Main */
		private $owner = null;
		
		public function __construct(Main $owner) {
			parent::__construct(
				"fslot",
				"FloatingSlotの設定画面を表示",
				"/fslot"
			);
		}
		
		public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
			if (!$this->testPermission($sender)) {
				return true;
			}
			if (!$sender instanceof Player) {
				$sender->sendMessage(TextFormat::RED . "このコマンドはプレイヤーのみ実行可能です。");
				return true;
			}
			//TODO: ここでFormを出す
			return true;
		}
		
	}