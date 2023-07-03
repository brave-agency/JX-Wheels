<?php
/* -------------------------------------------------------------------
Globals that need WP initialised
----------------------------------------------------------------------
Import this file in to functions.php
eg: require_once TEMPLATEPATH . '/functions/globals.php';


These are being cached as 'transients', so they should have a minimal impact on speed.
This can be cleared via wp-cli, or a plugin if required.
------------------------------------------------------------------- */

function instagramUser($your_token,$ig_user_id)
{
    
    // Instagram API connection - user info
    $instagram_response = wp_remote_get( "https://api.instagram.com/v1/users/" . $ig_user_id . "?access_token=" . $your_token );
    $instagram_response = json_decode( $instagram_response['body'],true);

    // How long you wanna save it for
    if( $instagram_response['meta']['code'] == 200 ) {
        set_transient('tux_instagram_response', $instagram_response, 1 * WEEK_IN_SECONDS);
    }

}

function instagramUserMedia($your_token,$ig_user_id)
{

    // Instagram API connection - user media
    $instagram_response_media = wp_remote_get( "https://api.instagram.com/v1/users/" . $ig_user_id . "/media/recent?access_token=" . $your_token );
    $instagram_response_media = json_decode( $instagram_response_media['body'],true);

    // How long you wanna save it for
    if( $instagram_response_media['meta']['code'] == 200 ) {
       // set_transient('tux_instagram_response_media', $instagram_response_media, 1 * WEEK_IN_SECONDS);
    }

}

function example_globals()
{

    global $instagram_response;
    global $instagram_response_media;
    global $hashtag;
    
    // Instagram API token taken from custom field under option page
    $your_token = get_field('instagram_access_token', 'option');
    $hashtag = get_field('instagram_hashtag', 'option');
    $ig_user_id = 'self';

    if (false === ($instagram_response = get_transient('tux_instagram_response'))):
        instagramUser($your_token,$ig_user_id);
    endif;

    if (false === ($instagram_response_media = get_transient('tux_instagram_response_media'))):
        instagramUserMedia($your_token,$ig_user_id);
    endif;

    // Load the data
    $instagram_response = get_transient('tux_instagram_response');
    $instagram_response_media = get_transient('tux_instagram_response_media');

}

add_action('init', 'example_globals');
