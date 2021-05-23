<?php

namespace faiz\transper_survive\Command;

use faiz\transper_survive\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\Color;
use pocketmine\utils\Config;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class transfer_command extends Command {

    public function __construct()
    {
        $name = Main::$db["name"];
        parent::__construct(Main::$db["name"], "$name 명령어");
        $this->setPermission("default");
    }

    public $data;
    public static $db;

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {

        if($sender instanceof Player){
            if(\faiz\transper_survive\Main::$db["ip"] === ""){
                $sender->sendMessage(TextFormat::RED."서버 주소가 설정되지 않았습니다");
                return;
            }elseif (\faiz\transper_survive\Main::$db["port"] === ""){
                $sender->sendMessage(TextFormat::RED."포트가 설정되지 않았습니다.");
                return;
            }else{
                $sender->getPlayer()->transfer(\faiz\transper_survive\Main::$db["ip"], \faiz\transper_survive\Main::$db["port"]);
            }
        }
    }
}