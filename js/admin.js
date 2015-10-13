/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {
    var import_notice_dimiss = $('#import_notice_dimiss');
    if(import_notice_dimiss){
        import_notice_dimiss.on('click', function(){
        });
    }
} )( jQuery );