<?php

class Player
{
    const VERSION = "Default PHP folding player";

    public function betRequest(GameState $gameState)
    {
        if($this->hasHolePair($gameState)) {
            return $gameState->getMinimumToRaise() * 5;
        } elseif ($this->isBothHoleCardsAbove9($gameState)) {
            return $gameState->getExactToCheck();
        }
        
        return 0;
    }

    public function showdown($game_state)
    {
    }
    
     private function hasHolePair($gameState) {
        return ($gameState->getHoleCard(0)["rank"] == $gameState->getHoleCard(1)["rank"]);
    }
    
    private function isBothHoleCardsAbove9($gameState) {
        return ($gameState->getHoleCard(0)["rank"] >= 10 && $gameState->getHoleCard(1)["rank"] >= 10);
    }
}
