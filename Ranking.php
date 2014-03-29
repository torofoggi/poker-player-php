<?php

class Ranking {
    private $holeCards = array();
    private $communityCards = array();
    
    private $ranklib;
    
    public function __construct(array $cards) {
        if(isset($cards["hole"])) {
            $this->holeCards = $cards["hole"];
        }
        if(isset($cards["community"])) {
            $this->communityCards = $cards["community"];
        }
        $this->ranklib = new Ranklib();
        $this->ranklib->request($this->getAllCards());
    }
    
    public function hasHolePair() {
        return ($this->holeCards[0]["value"] == $this->holeCards[1]["value"]);
    }
    
    public function isBothHoleCardsAbove9() {
        return ($this->holeCards[0]["value"] >= 10 && $this->holeCards[1]["value"] >= 10);
    }
    
    public function getAllCards() {
        return array_merge(
            $this->holeCards,
            $this->communityCards
        );
    }
    
    public function getRank() {
        return $this->ranklib->getRank();
    }
}
