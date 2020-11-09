<?php

class StateUpdate
{
    public int $wheel_index;
    public string $direction;

    public function __construct( int $index, string $direction ) {
        $this->wheel_index = $index;
        $this->direction = $direction;
    }
}