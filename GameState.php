<?php
class GameState {
    private $state;
    
    public function __construct($jsonState) {
        $this->state = json_decode($jsonState, true);
    }
    
    public function getMinimumToRaise() {
        return getExactToCheck() + $this->state["minimum_raise"];
    }
    
    public function hasHolePair() {
        $holeCards = $this->getOurHoleCards();
        return ($holeCards[0]["rank"] == $holeCards[1]["rank"]);
    }
    
    private function getOurPlayerId() {
        return $this->state["in_action"];
    }
    
    private function getOurHoleCards() {
        return $this->getOurPlayerStatus()["hole_cards"];
    }
    
    private function getOurPlayerStatus() {
        return $this->state["players"][$this->getOurPlayerId()];
    }
    
    public function getExactToCheck() {
        return ($this->state["current_buy_in"] - $this->getOurPlayerStatus()["bet"]);
    }
}
