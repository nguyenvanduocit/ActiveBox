/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {
    wp.customize( 'diress_CallToAction_settings[cta_text]', function( value ) {
        value.bind( function( newval ) {
            $('.cta-title').text(newval);
        } );
    } );
    wp.customize( 'diress_CallToAction_settings[cta_desc]', function( value ) {
        value.bind( function( newval ) {
            $('.cta-desc').text(newval);
        } );
    } );
    wp.customize( 'diress_CallToAction_settings[cta_btn_text]', function( value ) {
        value.bind( function( newval ) {
            $('.cta-button').text(newval);
        } );
    } );
    wp.customize( 'diress_CallToAction_settings[cta_btn_href]', function( value ) {
        value.bind( function( newval ) {
            $('.cta-button').attr('href',newval);
        } );
    } );
    wp.customize( 'diress_CallToAction_settings[cta_btn_bg_color]', function( value ) {
        value.bind( function( newval ) {
            $('.cta-button').css('background-color',newval);
        } );
    } );
    wp.customize( 'diress_CallToAction_settings[cta_bg_color]', function( value ) {
        value.bind( function( newval ) {
            console.log(newval);
            $('#download').css('background-color',newval);
        } );
    } );

} )( jQuery );