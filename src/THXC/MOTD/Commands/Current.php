<?php

namespace THXC\MOTD\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\plugin\Plugin;
use THXC\MOTD\Changer;

class Current extends Command implements PluginIdentifiableCommand
{
    public $plugin;

    public function getPlugin(): Plugin

    public function __construct(Changer $plugin)
    {
        $this->plugin = $plugin;
        parent::__construct(
            "currentmotd",
            "Look the Server MOTD",
            "/currentmotd [text]"
        );
    }

    public function execute(CommandSender $player, string $commandLabel, array $args): bool
    {
        $config = Changer::getConfigFile("Config");
        $player->sendMessage("The current motd is: " . $config->get("motd"));


        return true;
    }

}