<?php
use Diress\Diress;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'DIRESS_FILE', __FILE__ );
define( 'DIRESS_DIR', __DIR__ );
define( 'DIRESS_VERSION', '1.0.0' );
define( 'DIRESS_DB_VERSION', '1.0.0' );
define( 'TEMPLATE_URL', get_template_directory_uri() );
define( 'TEMPLATE_DIR', get_template_directory() );
define( 'DIRESS_DOMAIN', 'diress' );

require_once DIRESS_DIR . '/vendor/autoload.php';

global $diress;
$diress = new Diress();
$diress->run();