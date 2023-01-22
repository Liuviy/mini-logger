<?php

namespace Liuviy1;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\scheduler\CallbackTask;

class export extends PluginBase implements Listener{

	public function onEnable() {
  $this->getServer()->getPluginManager()->registerEvents($this, $this);
 }
	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$max = $this->getServer()->getMaxPlayers();
		$name = $player->getName();
		$cid = $player->getClientId();
		$online = count($this->getServer()->getOnlinePlayers());
		$ip = $player->getAddress();
		$a = date('d.m.Y H:i:s'); 
		file_put_contents('/folder/export.log', "\n{$a} [JOIN] {$name} зашёл. IP: {$ip} CID: {$cid} Онлайн: {$online}/{$max}", FILE_APPEND);
	}
	
	public function onChat(PlayerChatEvent $e){
		$b = date('d.m.Y H:i:s');
	   $chat = "{$b} [CHAT] ".$e->getPlayer()->getName().": ".$e->getMessage();
       file_put_contents('/folder/export.log', "\n".$chat, FILE_APPEND);
    }
	public function onCmd(PlayerCommandPreprocessEvent $e){if($e->getMessage()[0] == '/'){
		$c = date('d.m.Y H:i:s'); 
		$cmdd = "{$c} [CMD] ".$e->getPlayer()->getName().": ".$e->getMessage();
        file_put_contents('/folder/export.log', "\n".$cmdd, FILE_APPEND);
    }} //Logger Cmd
	
	public function onQuit(PlayerQuitEvent $e){
		$d = date('d.m.Y H:i:s');
		$player = $e->getPlayer();
		$name = $player->getName();
		$ip = $player->getAddress();
		$cid = $player->getClientId();
		file_put_contents('/folder/export.log',  "\n{$d} [QUIT] Игрок {$name} покинул сервер!", FILE_APPEND);
	}
}
