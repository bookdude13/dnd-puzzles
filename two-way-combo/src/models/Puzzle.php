<?php

require_once __DIR__ . '/iRenderable.php';
require_once __DIR__ . '/../state/RoomState.php';
require_once __DIR__ . '/GemRow.php';
require_once __DIR__ . '/GemWheelRow.php';
require_once __DIR__ . '/LightRow.php';

class Puzzle implements iRenderable
{
    private LightRow $_light_row;
    private GemRow $_green_gems;
    private GemRow $_white_gems;
    private GemWheelRow $_gem_wheels;

    public function __construct( RoomState $room_state ) {
        $this->_light_row = new LightRow( $room_state->light_states );
        $this->_green_gems = new GemRow( 'green', $room_state->green_gem_states );
        $this->_white_gems = new GemRow( 'white', $room_state->white_gem_states );
        $this->_gem_wheels = new GemWheelRow( 'green', $room_state->wheel_states );
    }

    public function get_html(): string {
        $html = '';
        $html .= $this->_light_row->get_html();
        $html .= $this->_green_gems->get_html();
        $html .= $this->_white_gems->get_html();
        $html .= $this->_gem_wheels->get_html();
        return $html;
    }
}
