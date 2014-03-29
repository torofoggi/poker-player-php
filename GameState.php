<?php
class GameState {
    private $state;
    
    public function __construct($jsonState) {
        $this->state = json_decode($jsonState, true);
    }
    
    public function getMinimumToRaise() {
        return $this->state["minimum_raise"];
    }
}
