<?php

class Player
{
    const VERSION = "Folder Bot FTW";

    public function betRequest(GameState $gameState)
    {
        $rankingForAllCards = new Ranking($gameState->getAllCards());
        $rankingForCommunityCards = new Ranking(array("community" => $gameState->getAllCards()["community"]));
        if(count($gameState->getAllCards()["community"]) && $rankingForCommunityCards->getRank() >= $rankingForAllCards->getRank()) {
            return 0;
        } elseif($rankingForAllCards->getRank() >= 1) {
            return max($gameState->getMinimumToRaise() * 10 * $gameState->getStackDependentmultiplyer(), $gameState->getMinimumToRaise());
        } elseif ($rankingForAllCards->isBothHoleCardsAbove9()) {
            return $gameState->getExactToCheck();
        } 
        
        return max($gameState->getExactToCheck(), 2 * $gameState->getBigBlind());
    }

    public function showdown($game_state)
    {
    }
}
