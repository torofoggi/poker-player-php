<?php

class Player
{
    const VERSION = "Default PHP folding player";

    public function betRequest(GameState $gameState)
    {
        if($gameState->hasHolePair()) {
            return $gameState->getMinimumToRaise() * 5;
        } 
        
        return $gameState->getExactToCheck();
    }

    public function showdown($game_state)
    {
    }
}
