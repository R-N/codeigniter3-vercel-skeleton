<?php

class MY_DB_postgre_driver extends CI_DB_postgre_driver {
    /**
     * Database connection
     *
     * @param   bool    $persistent
     * @return  resource|object
     */
    public function db_connect($persistent = FALSE)
    {
        empty($this->dsn) && $this->_build_dsn();
        $this->conn_id = ($persistent === TRUE)
            ? pg_pconnect($this->dsn)
            : pg_connect($this->dsn);

        if ($this->conn_id !== FALSE)
        {
            if ($persistent === TRUE
                && pg_connection_status($this->conn_id) === PGSQL_CONNECTION_BAD
                && pg_ping($this->conn_id) === FALSE
            )
            {
                return FALSE;
            }

            empty($this->schema) OR $this->simple_query("SET search_path = '{$this->schema},public';");
        }

        return $this->conn_id;
    }

    public function mysqlToPostgres($query){
        return mysqlToPostgres($query);
    }
}
