<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 4:54 PM
 */

namespace Diress;


class Util {
	public static function html( $tag ) {
		static $SELF_CLOSING_TAGS = array( 'area', 'base', 'basefont', 'br', 'hr', 'input', 'img', 'link', 'meta' );
		$args = func_get_args();
		$tag = array_shift( $args );
		if ( is_array( $args[0] ) ) {
			$closing = $tag;
			$attributes = array_shift( $args );
			foreach ( $attributes as $key => $value ) {
				if ( false === $value ) {
					continue;
				}
				if ( true === $value ) {
					$value = $key;
				}
				$tag .= ' ' . $key . '="' . esc_attr( $value ) . '"';
			}
		} else {
			list( $closing ) = explode( ' ', $tag, 2 );
		}
		if ( in_array( $closing, $SELF_CLOSING_TAGS ) ) {
			return "<{$tag} />";
		}
		$content = implode( '', $args );
		return "<{$tag}>{$content}</{$closing}>";
	}
	public static function html_link( $url, $title = '' ) {
		if ( empty( $title ) ) {
			$title = $url;
		}
		return Util::html( 'a', array( 'href' => esc_url( $url ) ), $title );
	}
	public static function admin_notice($msg, $class = 'updated' ){
		return Util::html( "div class='$class fade'", Util::html( "p", $msg ) );
	}
	public static function getElegantIconList(){
		return array(
				'icon-mobile'=>'icon-mobile',
				'icon-laptop'=>'icon-laptop',
				'icon-desktop'=>'icon-desktop',
				'icon-tablet'=>'icon-tablet',
				'icon-phone'=>'icon-phone',
				'icon-document'=>'icon-document',
				'icon-documents'=>'icon-documents',
				'icon-search'=>'icon-search',
				'icon-notebook'=>'icon-notebook',
				'icon-book-open'=>'icon-book-open'
		);
	}
}