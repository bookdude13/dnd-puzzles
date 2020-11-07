<?php

require_once __DIR__ . '/../Constants.php';

class RoomState
{
    public string $id;
    public array $light_states;
    public array $green_gem_states;
    public array $white_gem_states;
    public array $wheel_states;

    public function __construct(
        array $light_states,
        array $green_gem_states,
        array $white_gem_states,
        array $wheel_states
    ) {
        $this->id = $this->_generate_id();
        $this->light_states = $light_states;
        $this->green_gem_states = $green_gem_states;
        $this->white_gem_states = $white_gem_states;
        $this->wheel_states = $wheel_states;
    }

    // Props MichelAyres https://stackoverflow.com/questions/21671179/how-to-generate-a-new-guid
    private function _generate_id(): string {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
            mt_rand(0, 65535), mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(16384, 20479),
            mt_rand(32768, 49151),
            mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535)
        );
    }

    public static function create_new(): RoomState {
        $default_category = Constants::$gem_categories[0];
        $default_category_state = array(
            $default_category,
            $default_category,
            $default_category,
            $default_category
        );

        return new RoomState(
            array( false, false ),
            $default_category_state,
            $default_category_state,
            $default_category_state
        );
    }
}