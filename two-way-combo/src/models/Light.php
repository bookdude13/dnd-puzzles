<?php

require_once __DIR__ . '/iRenderable.php';

class Light implements iRenderable
{
    private string $_id;
    private bool $_on;

    public function __construct( string $id, bool $on ) {
        $this->_id = $id;
        $this->_on = $on;
    }

    public function get_html(): string {
        $img_name = $this->_on ? "on" : "off";
        $src = "./assets/light/$img_name.png";

        $html  = '  <div class="three columns">';
        $html .= "      <img class=\"light center\" id=\"$this->_id\" src=\"$src\">";
        $html .= '  </div>';

        return $html;
    }
    

}
