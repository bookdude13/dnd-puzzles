<?php

require_once __DIR__ . '/iRenderable.php';
require_once __DIR__ . '/Gem.php';

class GemRow implements iRenderable
{
    protected array $_gems = array();
    private string $_id;

    public function __construct( string $color, array $gem_states ) {
        $num_gems = 4;
        if ( count( $gem_states) !== $num_gems ) {
            error_log( "Gem states inconsistent! " . json_encode( $gem_states ) );
            return;
        }

        $this->_id = 'gem-row-' . $color;
        for ($i = 0; $i < $num_gems; $i++) {
            $id = 'gem-' . $color . '-' . strval($i);
            $this->_gems[] = new Gem( $id, $color, $gem_states[$i] );
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
