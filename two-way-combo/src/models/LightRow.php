<?php

require_once __DIR__ . '/iRenderable.php';
require_once __DIR__ . '/Light.php';

class LightRow implements iRenderable
{
    protected array $_lights;
    private string $_id;

    public function __construct() {
        $num_lights = 2;
        $this->_lights = array();
        $this->_id = 'light-row';
        for ($i = 0; $i < $num_lights; $i++) {
            $id = 'light-' . strval($i);
            $this->_lights[] = new Light( $id );
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
