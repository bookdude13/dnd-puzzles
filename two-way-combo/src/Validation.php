<?php

function get_validated_room_id( array $input ): ?string {
    if ( !key_exists( 'rid', $input ) ) {
        error_log( "Missing rid" );
        return null;
    }

    $room_id = $input[ 'rid' ];
    if ( !is_valid_uuid( $room_id ) ) {
        error_log( "Invalid rid" );
        return null;
    }

    return $room_id;
}

function get_validated_state_update( array $input ): ?StateUpdate {
    if ( !key_exists( 'update', $input ) ) {
        error_log( "Missing update" );
        return null;
    }

    $update = $input[ 'update' ];
    if ( !is_array( $update )
        || !is_numeric( $update[ "wheel_index" ] )
        || !in_array( $update[ "direction" ], [ 'left', 'right' ], true )
    ) {
        error_log( "Invalid update" );
        return null;
    }

    $state_update = new StateUpdate(
        intval( $update[ "wheel_index" ] ),
        $update[ "direction" ]
    );
    return $state_update;
}

// Props Joel-James https://gist.github.com/Joel-James/3a6201861f12a7acf4f2
function is_valid_uuid( $uuid ) {
    if ( !is_string( $uuid ) || ( preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/', $uuid ) !== 1) ) {
        return false;
    }

    return true;
}