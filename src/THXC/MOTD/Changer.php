<?php

namespace THXC\MOTD;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use THXC\MOTD\Commands\Change;
use THXC\MOTD\Commands\Current;

class Changer extends PluginBase implements Listener{
    /** @var $config Config */
    public $config;

    private static $instance;

    public function onEnable()
    {
        self::$instance = $this;
        $this->onCommandsPlugin();

        $array = [
            "motd" => "this is motd",
        ];

        $this->config = new Config($this->getDataFolder() . "Config.yml", Config::YAML,$array);


        if(file_exists($this->getDataFolder() . "Config.yml")){

        } else {
            $this->getLogger()->info("The MotdChanger config as been created !");
            $this->saveResource("Config.yml");
        }

        $config = self::getConfigFile("Config");
        $this->getServer()->getNetwork()->setName($config->get("motd"));
        $this->getServer()->getLogger()->notice("Your currently motd is: " . $config->get("motd"));
        $this->getServer()->getLogger()->notice("Loaded successfully 2 commands");
    }

    public static function getInstance()
    {
        return self::$instance;
    }

    public static function getConfigFile(string $configName)
    {
        return $file = new Config(Changer::getInstance()->getDataFolder() . $configName . ".yml", Config::YAML);
    }

    private function onCommandsPlugin()
    {
        $this->getServer()->getCommandMap()->registerAll("ChangerMotd", [
            new Current($this),
            new Change($this),
        ]);
    }
}