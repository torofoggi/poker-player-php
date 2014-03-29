<?php

/**
    array(
        'cards' => json_encode(array(
            array(
                "suit" => "Diamonds",
                "rank" => "2"
            ),
            array(
                "suit" => "Diamonds",
                "rank" => "10",
                "value" => 14
            ),
            array(
                "suit" => "Diamonds",
                "rank" => "10"
            ),
            array(
                "suit" => "Diamonds",
                "rank" => "10"
            ),
            array(
                "suit" => "Diamonds",
                "rank" => "10"
            )
        ))
    )
*/

class Ranklib {
    protected static $server = "http://192.168.2.117:2048";

    public function getRank($cards) {
        $postData = http_build_query(array('cards' => json_encode($cards)));

        $contextOptions = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postData
            )
        );

        $context  = stream_context_create($contextOptions);

        return json_decode(file_get_contents(self::$server, false, $context));
    }
}

