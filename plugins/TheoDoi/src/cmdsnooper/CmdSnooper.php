<?php

namespace cmdsnooper;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class CmdSnooper extends PluginBase {
	public $snoopers = [];
	
	public function onEnable() {
		@mkdir($this->getDataFolder());
		$this->getLogger()->info("Theo Dõi By PIG");
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, array(
	  	"Console.Logger" => "true",
  		));
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, String $label, array $args) : bool {	
		if(strtolower($cmd->getName()) == "theodoi") {
		 	if($sender instanceof Player) {
				if($sender->hasPermission("theodoi.command")) {
					if(!isset($this->snoopers[$sender->getName()])) {
						$sender->sendMessage("§l§c【 §fvιcтoʀʏ §eoғ §6ʟᴇԍᴇɴᴅ §c】§b Bạn đã bật chế độ Theo Dõi..!");
						$this->snoopers[$sender->getName()] = $sender;
						return true;
					} else {
						$sender->sendMessage("§l§c【 §fvιcтoʀʏ §eoғ §6ʟᴇԍᴇɴᴅ §c】§c Bạn đã tắt chế độ Theo Dõi..!");
						unset($this->snoopers[$sender->getName()]);
						return true;
					}
				}
			}
		}
	}
 }
