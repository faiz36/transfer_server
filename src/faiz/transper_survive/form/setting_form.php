<?php


namespace faiz\transper_survive\form;


use faiz\transper_survive\Main;
use pocketmine\form\Form;
use pocketmine\Player;

class setting_form implements Form
{
    public function jsonSerialize(): array
    {
        return[
            "type" => "custom_form",
            "title" => "§l<서버이동 설정>",
            "content" => [
                [
                    "type" => "input",
                    "text" => "명령어의 이름을 정해주세요 (ex : 야생이동\n"
                ],
                [
                    "type" => "input",
                    "text" => "이동할 서버의 포트를 넣어주세요 (ex : 19132\n"
                ],
                [
                    "type" => "input",
                    "text" => "이동할 서버의 주소를 넣어주세요."
                ]
            ]
        ];
    }
    public function handleResponse(Player $player, $data): void
    {
        if($data === NULL) {
            return;
        }elseif($data[1] === ""){
            $player->sendMessage(""."서버의 포트를 넣어주세요");
        }elseif($data[2] === ""){
            $player->sendMessage(""."서버의 주소를 적어주세요");
        }elseif(!is_numeric($data[1])){
            $player->sendMessage(""."서버 포트는 숫자만 넣어주세요");
        }else{
            if($data[0] === ""){
                return;
            }
            Main::$db["port"] = $data[1];
            Main::$db["ip"] = $data[2];
            Main::$db["name"] = $data[0];
            Main::getInstance()->save();
            $player->sendMessage(""."저장되었습니다! (명령어 이름은 서버가 재부팅후 바뀝니다 /reload 가능)");
        }
    }
}