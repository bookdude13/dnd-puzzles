<?php

class Light
{
    private string $_id;
    private string $_state;
    private array $_states = array( 'on', 'off' );

    public function __construct( string $id ) {
        $this->_id = $id;
        $this->_state = 'off';
    }

    public function get_html(): string {
        $src = "./assets/light/$this->_state.png";
        $html  = '  <div class="three columns">';
        $html .= "      <img class=\"light center\" id=\"$this->_id\" src=\"$src\">";
        $html .= '  </div>';
        return $html;
    }
    

}
