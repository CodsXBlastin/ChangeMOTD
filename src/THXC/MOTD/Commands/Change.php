<?php

namespace THXC\MOTD\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\plugin\Plugin;
use THXC\MOTD\Changer;

class Change extends Command implements PluginIdentifiableCommand
{
    public function getPlugin(): Plugin

    public function __construct(Changer $plugin)
    {
        $this->plugin = $plugin;
        $this->setPermission("motd.change");
        parent::__construct(
            "motd",
            "Change the Server MOTD",
            "/motd [text]"
        );
    }

    public function execute(CommandSender $player, string $commandLabel, array $args): bool
    {
        if ($player->hasPermission("motd.change")) {
            if (count($args) === 1) {
                $text = $args[0];

                $config = Changer::getConfigFile("Config");
                $config->set("motd", $text);
                $config->save();

                $player->sendMessage("You have successfully updated the motd !");
                $this->plugin->getServer()->getNetwork()->setName($text);
            }else{
                $player->sendMessage("§cPlease, enter a message");
            }
        } else {
            $player->sendMessage("§cYou don't have permission do this");
        }
        return true;
    }

}