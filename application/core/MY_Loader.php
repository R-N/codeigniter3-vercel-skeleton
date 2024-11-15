<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class MY_Loader
 *
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class MY_Loader extends HungNG_Loader
{    /* overloaded methods */

    public function database( $params = '', $return = false, $query_builder = null ) {
        $ci =& get_instance( );

        if ( $return === false && $query_builder === null && isset( $ci->db ) && is_object( $ci->db ) && !empty( $ci->db->conn_id) ) {
            return false;
        }

        require_once( BASEPATH . 'database/DB.php' );

        $db =& DB( $params, $query_builder );

        $driver = config_item( 'subclass_prefix' ) . 'DB_' . $db->dbdriver . '_driver';
        $dirs = array("libraries", "core");
        foreach ($dirs as $dir){
            $file = APPPATH . "{$dir}/{$driver}.php";
    
            if ( file_exists( $file ) === true && is_file( $file ) === true ) {
                require_once( $file );
    
                $dbo = new $driver( get_object_vars( $db ) );
                $db = & $dbo;
                break;
            }
        }

        if ( $return === true ) {
            return $db;
        }

        $ci->db = '';
        $ci->db = $db;

        return $this;
    }
}
