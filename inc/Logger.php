<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/26/2015
 * Time: 12:30 PM
 */

namespace Diress;


class Logger {
	/**
	 * @var array Stores open file _handles.
	 * @access private
	 */
	private $_handles;

	/**
	 * Constructor for the logger.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->_handles = array();
	}


	/**
	 * Destructor.
	 *
	 * @access public
	 * @return void
	 */
	public function __destruct() {
		foreach ( $this->_handles as $handle ) {
			@fclose( escapeshellarg( $handle ) );
		}
	}

	/**
	 * Add a log entry to chosen file.
	 *
	 * @access public
	 *
	 * @param string $handle
	 * @param string $message
	 *
	 * @return void
	 */
	public function add( $handle, $message ) {
		if ( $this->open( $handle ) && is_resource( $this->_handles[ $handle ] ) ) {
			$time = date_i18n( 'm-d-Y @ H:i:s -' ); // Grab Time
			@fwrite( $this->_handles[ $handle ], $time . " " . $message . "\n" );
		}
	}

	/**
	 * Open log file for writing.
	 *
	 * @access private
	 *
	 * @param mixed $handle
	 *
	 * @return bool success
	 */
	private function open( $handle ) {
		if ( isset( $this->_handles[ $handle ] ) ) {
			return true;
		}

		if ( $this->_handles[ $handle ] = @fopen( $this->get_log_file_path( $handle ), 'a' ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Get a log file path
	 *
	 * @since 2.2
	 *
	 * @param string $handle name
	 *
	 * @return string the log file path
	 */
	function get_log_file_path( $handle ) {
		return trailingslashit( DIRESS_LOG_DIR ) . $handle . '-' . sanitize_file_name( wp_hash( $handle ) ) . '.log';
	}

	/**
	 * Clear entries from chosen file.
	 *
	 * @access public
	 *
	 * @param mixed $handle
	 *
	 * @return void
	 */
	public function clear( $handle ) {
		if ( $this->open( $handle ) && is_resource( $this->_handles[ $handle ] ) ) {
			@ftruncate( $this->_handles[ $handle ], 0 );
		}
	}
}