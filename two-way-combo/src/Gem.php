<?php

class Gem
{
    private string $_id;
    private string $_color;
    private string $_category;
    private array $_categories = array(
        'birth', 'death', 'healing', 'love', 'protection', 'return', 'strength', 'war'
    );

    public function __construct( string $id, string $color ) {
        $this->_id = $id;
        $this->_color = $color;
        $this->_category = $this->_categories[0];
    }

    public function get_html(): string {
        $src = "./assets/$this->_color/$this->_category.png";
        $html  = '  <div class="three columns">';
        $html .= "      <img class=\"gem\" id=\"$this->_id\" src=\"$src\">";
        $html .= '  </div>';
        return $html;
    }
    

}
