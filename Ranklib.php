<?php



class Ranklib {
    protected static $server = "http://localhost:2048";

    private $rankArray;
    
    public function request($cards) {
        if(count($cards) < 5) {
            $this->rankArray = array("rank" => $this->rankCardsUnder5($cards)); 
            return ;
        } 
        
        $postData = http_build_query(array('cards' => json_encode($cards)));

        $contextOptions = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postData
            )
        );

        $context  = stream_context_create($contextOptions);

        $this->rankArray = json_decode(file_get_contents(self::$server, false, $context), true);
    }
    
    public function getRank() {
       return $this->rankArray["rank"];
    }
    
    private function rankCardsUnder5($cards) {
        $pairRank = $this->calculatePairRank($cards);
        if($pairRank == 1) {
            return 1;
        } elseif ($pairRank == 2) {
            return 2;
        } elseif ($pairRank == 3) {
            return 3;
        } elseif ($pairRank > 3) {
            return 7;
        }
        return 0;
    }
    
    private function isPair($card1, $card2) {
        return ($card1["value"] == $card2["value"]);
    }
    
    private function calculatePairRank($cards) {
        $counter = 0;
        for ($i = 0; $i < count($cards); $i++) {
            for ($j = $i; $j < count($cards); $j++) {
                if($i != $j) {
                    if($this->isPair($cards[$i], $cards[$j])) {
                        $counter++;
                    }
                }
            }   
        }
        
        return $counter;
    }
    
}

