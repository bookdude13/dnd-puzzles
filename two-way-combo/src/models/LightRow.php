<?php

require_once __DIR__ . '/iRenderable.php';
require_once __DIR__ . '/Light.php';

class LightRow implements iRenderable
{
    protected array $_lights = array();
    private string $_id;

    public function __construct( array $light_states ) {
        $num_lights = 2;
        if ( count( $light_states ) !== $num_lights ) {
            error_log( "Light states inconsistent! " . json_encode( $light_states ) );
            return;
        }

        $this->_id = 'light-row';
        for ($i = 0; $i < $num_lights; $i++) {
            $id = 'light-' . strval($i);
            $this->_lights[] = new Light( $id, $light_states[$i] );
        }
    }

    public function get_html(): string {
        $html = "<div class=\"row\" id=\"$this->_id\">";
        foreach ( $this->_lights as $light ) {
            $html .= '  ' . $light->get_html();
        }
        $html .= '</div>';

        return $html;
    }
}
