<?php

namespace faiz\transper_survive;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use faiz\transper_survive\Command\{
    transfer_command,
    transfer_setting
};
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {
    public static $db;
    public $data;

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getdata();
        $this->getServer()->getCommandMap()->registerAll("faiz", [
            new transfer_command,
            new transfer_setting
        ]);
    }
    public function save() {

        $this->data->setAll(self::$db);
        $this->data->save();

    }
    private static $instance;

    public static function getInstance():self
    {
        return static::$instance;
    }

    public function onLoad():void
    {
        self::$instance = $this;
    }
    public function getdata(){
        @mkdir($this->getdataFolder());
        $this->data = new Config($this->getDataFolder()."data.yml", config::YAML);
        self::$db = $this->data->getAll();
        if(!isset(self::$db["ip"])){
            self::$db["ip"] = "";
            $this->save();
        }
        if(!isset(self::$db["port"])){
            self::$db["port"] = "19132";
            $this->save();
        }
        if(!isset(self::$db["name"])){
            self::$db["name"] = "야생이동";
            $this->save();
        }
    }

}
