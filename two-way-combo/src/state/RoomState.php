<?php

require_once __DIR__ . '/../Categories.php';
require_once __DIR__ . '/DtoRoom.php';
require_once __DIR__ . '/StateUpdate.php';

class RoomState
{
    public string $id;
    public array $light_states;
    public array $green_gem_states;
    public array $white_gem_states;
    public array $wheel_states;

    public function __construct(
        string $room_id,
        array $light_states,
        array $green_gem_states,
        array $white_gem_states,
        array $wheel_states
    ) {
        $this->id = $room_id;
        $this->light_states = $light_states;
        $this->green_gem_states = $green_gem_states;
        $this->white_gem_states = $white_gem_states;
        $this->wheel_states = $wheel_states;
    }

    // Props MichelAyres https://stackoverflow.com/questions/21671179/how-to-generate-a-new-guid
    private static function _generate_id(): string {
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
        $green_gem_states = Categories::$gem_categories;
        $white_gem_states = Categories::$gem_categories;
        $wheel_states = Categories::$gem_categories;

        shuffle( $green_gem_states );
        shuffle( $white_gem_states );
        shuffle( $wheel_states );

        return new RoomState(
            self::_generate_id(),
            array( false, false ),
            $green_gem_states,
            $white_gem_states,
            $wheel_states
        );
    }

    public function update( StateUpdate $update ): bool {
        $index = $update->wheel_index;
        if ( $index < 0 || $index > 4 ) {
            error_log( "Update has wheel_index out of range");
            return false;
        }

        $curr_category = $this->wheel_states[ $index ];
        if ( "right" === $update->direction ) {
            $this->wheel_states[ $index ] = Categories::prev_category( $curr_category );
            return RoomPersistence::instance()->update( $this );
        } else if ( "left" === $update->direction ) {
            $this->wheel_states[ $index ] = Categories::next_category( $curr_category );
            return RoomPersistence::instance()->update( $this );
        } else {
            error_log( "Unknown direction: " . $update->direction );
            return false;
        }

        return true;
    }

    private static function _get_light_state( $wheel_states, $code ): bool {
        $is_match = true;
        for ( $i = 0; $i < count( $wheel_states ); $i++ ) {
            if ( $wheel_states[$i] !== $code[$i] ) {
                $is_match = false;
            }
        }
        return $is_match;
    }

    /**
     * Room A is the room state we're creating. It's paired room is room B.
     */
    public static function from_dto_rooms( DtoRoom $room_a, DtoRoom $room_b ): RoomState {
        
        $green_gem_states = array(
            $room_b->wheel_0,
            $room_b->wheel_1,
            $room_b->wheel_2,
            $room_b->wheel_3
        );

        $code_a = array(
            $room_a->code_0,
            $room_a->code_1,
            $room_a->code_2,
            $room_a->code_3
        );

        $code_b = array(
            $room_b->code_0,
            $room_b->code_1,
            $room_b->code_2,
            $room_b->code_3
        );

        $wheel_states_a = array(
            $room_a->wheel_0,
            $room_a->wheel_1,
            $room_a->wheel_2,
            $room_a->wheel_3
        );

        $wheel_states_b = array(
            $room_b->wheel_0,
            $room_b->wheel_1,
            $room_b->wheel_2,
            $room_b->wheel_3
        );

        $light_states = array(
            self::_get_light_state( $wheel_states_a, $code_b ),
            self::_get_light_state( $wheel_states_b, $code_a )
        );

        return new RoomState( $room_a->room_id, $light_states, $wheel_states_b, $code_a, $wheel_states_a );
    }
}