<?php

require_once('GameState.php');
require_once('player.php');

$player = new Player();

$gameState = new GameState($_POST['game_state']);

switch($_POST['action'])
{
    case 'bet_request':
        echo $player->betRequest($gameState);
        break;
    case 'showdown':
        $player->showdown($gameState);
        break;
    case 'version':
        echo Player::VERSION;
}
