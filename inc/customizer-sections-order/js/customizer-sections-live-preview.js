/*global wp*/

/**
 * File customizer_sections_live_preview.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
    'use strict';

    wp.customize( 'sections_order', function( value ) {
        value.bind( function( to ) {
            var json = JSON.parse(to);
            var result = '';
            for (var k in json) {
                if (json.hasOwnProperty(k)) {
                    var section_html = $('section[data-sorder='+k+']').prop('outerHTML');
                    if(typeof(section_html) !== 'undefined'){
                        result += section_html;
                    }

                }
            }
            result+=$('footer').prop('outerHTML');
            jQuery('.home .main').html(result);

        } );
    } );

} )( jQuery );