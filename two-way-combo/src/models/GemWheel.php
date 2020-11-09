<?php

require_once __DIR__ . '/iRenderable.php';

class GemWheel implements iRenderable
{
    private int $_index;
    private string $_id;
    private string $_color;
    private string $_category;

    public function __construct( int $index, string $color, string $state ) {
        $this->_index = $index;
        $this->_id = 'gem-wheel-' . $color . '-' . strval( $index );
        $this->_color = $color;
        $this->_category = $state;
    }

    public function get_html(): string {
        $src = "./assets/wheelstones/wheel$this->_category.png";

        $html  = "  <div class=\"three columns gem-wheel-container\" data-index=\"$this->_index\">";
        $html .= "      <img class=\"gem-wheel center\" id=\"$this->_id\" src=\"$src\">";
        $html .= "      <br>";
        $html .= "      <div class=\"center\">";
        $html .= "          <button class=\"btn-rotate-left\">&lt;--</button>";
        $html .= "          <button class=\"btn-rotate-right\">--&gt;</button>";
        $html .= "      </div>";
        $html .= "  </div>";

        return $html;
    }
    

}
