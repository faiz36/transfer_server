<?php

namespace faiz\transper_survive\Command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use faiz\transper_survive\form\setting_form;

class transfer_setting extends Command{

    public function __construct()
    {
        parent::__construct("이동설정", "서버이동 관련 설정");
        $this->setPermission("op");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player){
            $sender->sendForm(new setting_form);
        }
    }

}