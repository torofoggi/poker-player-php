<?php

class Player
{
    const VERSION = "Default PHP folding player";

    public function betRequest(GameState $gameState)
    {
        return $gameState->getMinimumToRaise();
    }

    public function showdown($game_state)
    {
    }
}
