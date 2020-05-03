<?php

namespace Language;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Language extends PluginBase {

	/** @var Language */
	protected static $plugin;

	public function onEnable() {
		static::$plugin = $this;
		$this->saveDefaultConfig();
	}

	/**
	* @return Language|null
	*/
	public static function getInstance() : Language{
		return static::$plugin;
	}


	/**
	* @param Player $player
	* @return string
	*/
	public function getLanguage(Player $player) : string{
		return (new Config($this->getDataFolder() . 'languages.yml', Config::YAML))->get($player->getName(), 'eng');
	}

	/**
	* @return array
	*/
	public function getLanguages() : array{
		return (new Config($this->getDataFolder() . 'config.yml', Config::YAML))->getAll();
	}

	/**
	 * @param CommandSender $sender
	 * @param Command       $command
	 * @param string        $label
	 * @param string[]      $args
	 *
	 * @return bool
	 */
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		if ($sender instanceof Player) {
			$config = new Config($this->getDataFolder() . 'languages.yml', Config::YAML);
			
			if (count($args) < 1) {
				$sender->sendMessage(TF::RED . 'Usage: /lang list');
				return true;
			}

			$default = $args[0];

			if ($default == 'list') {
				$sender->sendMessage(TF::GREEN . 'Language list: ');
				foreach ($this->getLanguages() as $key => $value) {
					$sender->sendMessage(TF::GREEN . $key . ' - ' . $value);
				}
			}elseif (array_key_exists($default, $this->getLanguages())) {
				$config->set($sender->getName(), $default);
				$config->save();
				$sender->sendMessage(TF::GREEN . 'Your language change to ' . $default . '.');
			}else{
				$sender->sendMessage(TF::RED . 'The language ' . $default . ' not exists.');
			}
			return true;
		}
		else {
			$sender->sendMessage(TF::RED . 'No command from console');
			$sender->sendMessage(TF::GREEN . 'Language list: ');
			foreach ($this->getLanguages() as $key => $value) {
				$sender->sendMessage(TF::GREEN . $key . ' - ' . $value);
			}
		}
		return true;
	}
}
