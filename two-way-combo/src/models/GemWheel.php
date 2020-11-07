<?php

require_once __DIR__ . '/iRenderable.php';

class GemWheel implements iRenderable
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

    private function _prev_category( string $category ) {
        $index = array_search( $category, $this->_categories, true );
        $num_categories = count( $this->_categories );
        $prev_index = ($index + $num_categories - 1) % $num_categories;
        return $this->_categories[$prev_index];
    }

    private function _next_category( string $category ) {
        $index = array_search( $category, $this->_categories, true );
        $num_categories = count( $this->_categories );
        $next_index = ($index + 1) % $num_categories;
        return $this->_categories[$next_index];
    }

    public function get_html(): string {
        $src = "./assets/wheelstones/wheel$this->_category.png";

        $html  = '  <div class="three columns">';
        $html .= "      <img class=\"gem-wheel center\" id=\"$this->_id\" src=\"$src\">";
        $html .= "      <br>";
        $html .= "      <div class=\"center\">";
        $html .= "          <button class=\"btn-rotate-left\">&lt;--</button>";
        $html .= "          <button class=\"btn-rotate-right\">--&gt;</button>";
        $html .= "      </div>";
        $html .= '  </div>';

        return $html;
    }
    

}
