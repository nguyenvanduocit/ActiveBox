/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {
    //Update site link color in real time...
    wp.customize( 'diress_header_settings[panner_text]', function( value ) {
        value.bind( function( newval ) {
            $('.diress_header_panner_text').text(newval);
        } );
    } );
    //Update site link color in real time...
    wp.customize( 'diress_header_settings[panner_desc]', function( value ) {
        value.bind( function( newval ) {
            $('.diress_header_panner_desc').text(newval);
        } );
    } );
    //Update site link color in real time...
    wp.customize( 'diress_header_settings[panner_btn_text]', function( value ) {
        value.bind( function( newval ) {
            $('.diress_header_panner_button').text(newval);
        } );
    } );
    //Update site link color in real time...
    wp.customize( 'diress_header_settings[panner_btn_href]', function( value ) {
        value.bind( function( newval ) {
            $('.diress_header_panner_button').attr('href', newval);
        } );
    } );
    //Update site link color in real time...
    wp.customize( 'diress_header_settings[panner_btn_bg_color]', function( value ) {
        value.bind( function( newval ) {
            $('.diress_header_panner_button').css('background-color', newval);
        } );
    } );
    //Update site link color in real time...
    wp.customize( 'diress_header_settings[panner_background_image]', function( value ) {
        value.bind( function( newval ) {
            $('.banner').css('background-image', 'url('+newval+')');
        } );
    } );
    //Update site link color in real time...
    wp.customize( 'diress_header_settings[header_logo_src]', function( value ) {
        value.bind( function( newval ) {
            console.log(newval);
            $('img.header_logo').attr('src', newval);
        } );
    } );

} )( jQuery );