<?php

require_once __DIR__ . '/Gem.php';

class GemRow
{
    protected array $_gems;

    public function __construct( string $color ) {
        $num_gems = 4;
        $this->_gems = array();
        for ($i = 0; $i < $num_gems; $i++) {
            $id = '';
            $this->_gems[] = new Gem( $id, $color );
        }
    }

    public function get_html(): string {
        $html = '<div class="row">';
        foreach ( $this->_gems as $gem ) {
            $html .= '  ' . $gem->get_html();
        }
        $html .= '</div>';

        return $html;
    }
}
