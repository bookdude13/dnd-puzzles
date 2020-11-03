<?php

require_once __DIR__ . '/GemRow.php';
require_once __DIR__ . '/GemWheelRow.php';
require_once __DIR__ . '/LightRow.php';

class Puzzle
{
    private LightRow $_light_row;
    private GemRow $_green_gems;
    private GemRow $_white_gems;
    private GemWheelRow $_gem_wheels;

    public function __construct() {
        $this->_light_row = new LightRow();
        $this->_green_gems = new GemRow( 'green' );
        $this->_white_gems = new GemRow( 'white' );
        $this->_gem_wheels = new GemWheelRow( 'green' );
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
