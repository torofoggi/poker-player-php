<?php

class Player
{
    const VERSION = "Default PHP folding player";

    public function betRequest($game_state)
    {
        return $game_state["minimum_raise"];
    }

    public function showdown($game_state)
    {
    }
}
