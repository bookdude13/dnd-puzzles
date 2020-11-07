<?php

require_once __DIR__ . '/iRenderable.php';
require_once __DIR__ . '/GemWheel.php';

class GemWheelRow implements iRenderable
{
    protected array $_wheels;
    private string $_id;

    public function __construct( string $color ) {
        $num_wheels = 4;
        $this->_wheels = array();
        $this->_id = 'gem-wheels-' . $color;
        for ($i = 0; $i < $num_wheels; $i++) {
            $id = 'gem-wheel-' . $color . '-' . strval($i);
            $this->_wheels[] = new GemWheel( $id, $color );
        }
    }

    public function get_html(): string {
        $html = "<div class=\"row\" id=\"$this->_id\">";
        foreach ( $this->_wheels as $wheel ) {
            $html .= '  ' . $wheel->get_html();
        }
        $html .= '</div>';

        return $html;
    }
}
