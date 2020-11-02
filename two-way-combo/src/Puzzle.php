<?php

require __DIR__ . '/GreenGemRow.php';

class Puzzle
{
    private GreenGemRow $_green_gems;

    public function __construct() {
        $this->_green_gems = new GreenGemRow();
    }

    public function get_html(): string {
        $html = '';
        $html .= $this->_green_gems->get_html();
        $html .= $this->_green_gems->get_html();
        return $html;
    }
}
