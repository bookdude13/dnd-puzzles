<?php

require_once __DIR__ . '/GemWheel.php';

class GemWheelRow
{
    protected array $_wheels;

    public function __construct( string $color ) {
        $num_wheels = 4;
        $this->_wheels = array();
        for ($i = 0; $i < $num_wheels; $i++) {
            $id = '';
            $this->_wheels[] = new GemWheel( $id, $color );
        }
    }

    public function get_html(): string {
        $html = '<div class="row">';
        foreach ( $this->_wheels as $wheel ) {
            $html .= '  ' . $wheel->get_html();
        }
        $html .= '</div>';

        return $html;
    }
}
