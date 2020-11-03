<?php

require_once __DIR__ . '/Light.php';

class LightRow
{
    protected array $_lights;

    public function __construct() {
        $num_lights = 2;
        $this->_lights = array();
        for ($i = 0; $i < $num_lights; $i++) {
            $id = '';
            $this->_lights[] = new Light( $id );
        }
    }

    public function get_html(): string {
        $html = '<div class="row">';
        foreach ( $this->_lights as $light ) {
            $html .= '  ' . $light->get_html();
        }
        $html .= '</div>';

        return $html;
    }
}
