<?php

class Player
{
    const VERSION = "Default PHP folding player";

    public function betRequest(GameState $gameState)
    {
        $ranking = new Ranking($gameState->getAllCards());
        if($ranking->hasHolePair()) {
            return max($gameState->getMinimumToRaise() * 10 * $gameState->getStackDependentmultiplyer(), $gameState->getMinimumToRaise());
        } elseif ($ranking->isBothHoleCardsAbove9()) {
            return $gameState->getExactToCheck();
        }
        
        return 0;
    }

    public function showdown($game_state)
    {
    }
}
