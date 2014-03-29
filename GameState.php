<?php
class GameState {
    private $state;
    
    public function __construct($jsonState) {
        $this->state = json_decode($jsonState, true);
    }
    
    public function getMinimumToRaise() {
        return $this->getExactToCheck() + $this->state["minimum_raise"];
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
    
    public function getHoleCard($index) {
        return $this->getOurHoleCards()[$index];
    }
}
