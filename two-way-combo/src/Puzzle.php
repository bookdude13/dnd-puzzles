<?php

require __DIR__ . '/GemRow.php';

class Puzzle
{
    private GemRow $_green_gems;
    private GemRow $_white_gems;

    public function __construct() {
        $this->_green_gems = new GemRow( 'green' );
        $this->_white_gems = new GemRow( 'white' );
    }

    public function get_html(): string {
        $html = '';
        $html .= $this->_green_gems->get_html();
        $html .= $this->_white_gems->get_html();
        return $html;
    }
}
