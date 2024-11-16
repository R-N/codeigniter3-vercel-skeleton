<?php

#[\AllowDynamicProperties]
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

    public function addSchema($table){
        return addSchema($table);
    }
    
    public function insert_id()
    {
        $v = $this->version();

        $table  = (func_num_args() > 0) ? func_get_arg(0) : NULL;
        $column = (func_num_args() > 1) ? func_get_arg(1) : NULL;

        if ($table === NULL && $v >= '8.1')
        {
            $sql = 'SELECT LASTVAL() AS ins_id';
        }
        elseif ($table !== NULL)
        {
            $table = $this->addSchema($table);
            if ($column !== NULL && $v >= '8.0')
            {
                $sql = 'SELECT pg_get_serial_sequence(\''.$table."', '".$column."') AS seq";
                $query = $this->query($sql);
                $query = $query->row();
                $seq = $query->seq;
            }
            else
            {
                // seq_name passed in table parameter
                $seq = $table;
            }

            $sql = 'SELECT CURRVAL(\''.$seq."') AS ins_id";
        }
        else
        {
            return pg_last_oid($this->result_id);
        }

        $query = $this->query($sql);
        $query = $query->row();
        return (int) $query->ins_id;
    }

    protected function _list_columns($table = '')
    {
        return parent::_list_columns($this->addSchema($table));
    }
    public function field_data($table)
    {
        return parent::field_data($this->addSchema($table));
    }
    protected function _update($table, $values)
    {
        return parent::_update($this->addSchema($table), $values);
    }
    protected function _update_batch($table, $values, $index)
    {
        return parent::_update_batch($this->addSchema($table), $values, $index);
    }
    protected function _delete($table)
    {
        return parent::_delete($this->addSchema($table));
    }
    
    public function primary($table)
    {
        return parent::primary($this->addSchema($table));
    }
    public function count_all($table = ''){
        return parent::count_all($this->addSchema($table));
    }
    public function table_exists($table)
    {
        return parent::table_exists($this->addSchema($table));
    }
    public function list_fields($table)
    {
        return parent::list_fields($this->addSchema($table));
    }
    public function field_exists($field_name, $table)
    {
        return parent::field_exists($field_name, $this->addSchema($table));
    }
    public function insert_string($table, $data)
    {
        return parent::insert_string($this->addSchema($table), $data);
    }
    protected function _insert($table, $keys, $values)
    {
        return parent::_insert($this->addSchema($table), $keys, $values);
    }
    public function update_string($table, $data, $where)
    {
        return parent::update_string($this->addSchema($table), $data, $where);
    }
    
    public function query($sql, $binds = FALSE, $return_object = NULL)
    {
        $sql = $this->mysqlToPostgres($sql);
        return parent::query($sql, $binds, $return_object);
    }
}
