<?php

require_once __DIR__ . '/Gem.php';

class GemRow
{
    protected array $_gems;
    private string $_id;

    public function __construct( string $color ) {
        $num_gems = 4;
        $this->_gems = array();
        $this->_id = 'gem-row-' . $color;
        for ($i = 0; $i < $num_gems; $i++) {
            $id = 'gem-' . $color . '-' . strval($i);
            $this->_gems[] = new Gem( $id, $color );
        }
    }

    public function get_html(): string {
        $html = "<div class=\"row\" id=\"$this->_id\">";
        foreach ( $this->_gems as $gem ) {
            $html .= '  ' . $gem->get_html();
        }
        $html .= '</div>';

        return $html;
    }
}
