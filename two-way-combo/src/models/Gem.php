<?php

require_once __DIR__ . '/iRenderable.php';
require_once __DIR__ . '/../Constants.php';

class Gem implements iRenderable
{
    private string $_id;
    private string $_color;
    private string $_category;

    public function __construct( string $id, string $color, string $state ) {
        $this->_id = $id;
        $this->_color = $color;
        $this->_category = $state;
    }

    public function get_html(): string {
        $src = "./assets/$this->_color/$this->_category.png";
        $html  = '  <div class="three columns">';
        $html .= "      <img class=\"gem center\" id=\"$this->_id\" src=\"$src\">";
        $html .= '  </div>';
        return $html;
    }
    

}
