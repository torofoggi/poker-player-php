<?php
class GameState {
    private $state;
    
    const BASESTACK = 1000;
    
    public function __construct($jsonState) {
        $this->parseState(json_decode($jsonState, true));
    }
    
    private function parseState($state) {
        $this->state = $state;
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
    
    public function getStack() {
        return $this->getOurPlayerStatus()["stack"];
    }
    
    public function getStackDependentmultiplyer() {
        if($this->getStack() > (self::BASESTACK/2)) {
            return 1;
        }
        return 0.5;
    }
    
    public function getHoleCard($index) {
        $card = $this->getOurHoleCards()[$index];
        return $this->addValueAbove9InCards($card);
    }
    
    private function addValueAbove9InCards($card) {
        switch ($card["rank"]) {
            case "J":
                $rank = 11;
                break;
            case "Q":
                $rank = 12;
                break;
            case "K":
                $rank = 13;
                break;
            case "A":
                $rank = 14;
                break;
            default:
                $rank = $card["rank"];
        }
        $card["value"] = $rank; 
        return $card;
    }
    
    public function getAllCards() {
        return array(
            "hole" => array(
                $this->getHoleCard(0),
                $this->getHoleCard(1),
            ),
            "community" => array(
            ),
        );
    }
}
