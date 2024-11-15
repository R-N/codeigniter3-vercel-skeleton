<?php

if (!function_exists('mysqlToPostgres')) {
    function mysqlToPostgres($query){
        $db = &get_instance()->db;
        if ($db->dbdriver !== "postgre")
            return $query;
        $schema = $db->schema;  // Replace with your dynamic schema name

        // Replace backticks
        $query = str_replace('`', '', $query);

        // Replace Show Columns
        $query = preg_replace(
            '/SHOW\s+COLUMNS\s+FROM\s+\"?([\`\'\"a-zA-Z0-9\-_,\(\)\s]+?)\"?(?=$|\;|\s+(ON|WHERE|HAVING|LIMIT|OFFSET|JOIN|LEFT\s+JOIN|RIGHT\s+JOIN|\;|$))/i', 
            "
            SELECT DISTINCT
                c.column_name AS \"Field\",
                c.data_type AS \"Type\",
                c.is_nullable AS \"Null\",
                CASE 
                    WHEN tc.constraint_type = 'PRIMARY KEY' THEN 'PRI'
                    WHEN tc.constraint_type = 'UNIQUE' THEN 'UNI'
                    WHEN tc.constraint_type = 'FOREIGN KEY' THEN 'MUL'
                    ELSE ''
                END AS \"Key\",
                c.column_default AS \"Default\",
                CASE 
                    WHEN c.is_identity = 'YES' THEN 'auto_increment'
                    ELSE ''
                END AS \"Extra\",
                CASE 
                    WHEN tc.constraint_type = 'PRIMARY KEY' THEN TRUE
                    ELSE FALSE
                END AS \"primary_key\"
            FROM 
                information_schema.columns c
            LEFT JOIN 
                information_schema.key_column_usage kcu 
                ON c.table_schema = kcu.table_schema 
                AND c.table_name = kcu.table_name 
                AND c.column_name = kcu.column_name
            LEFT JOIN 
                information_schema.table_constraints tc 
                ON kcu.constraint_name = tc.constraint_name
            WHERE 
                c.table_schema = '{$schema}' 
                AND c.table_name = '$1';
            ", 
            $query
        );


        // Wrap select column name in quotation marks
        // $query = preg_replace_callback('/\bSELECT\s+([\`\'\"a-zA-Z0-9\-_,\(\)\s]+?)(?=$|\;|\s+(FROM|\;|$))/i', function($matches) use ($schema) {
        //     // Split comma-separated cols
        //     $cols = explode(',', $matches[1]);
        //     foreach ($cols as &$col) {
        //         $col = trim($col);
        //         //add quotation mark to the last word
        //         $col = preg_replace('/\b\"?([A-Za-z_][A-Za-z0-9_]*)\"?\b(?=\s*$)/i', '"$1"', $col);
        //     }
        //     $cols = implode(', ', $cols);
        //     $rest = '';
        //     //$rest = $matches[2] ? "{$matches[2]} {$rest}" : $rest;
        //     //$rest = $matches[3] ? "{$matches[3]} {$rest}" : $rest;
        //     return "SELECT {$cols} {$rest}";
        // }, $query);


        // Add schema name to tables in FROM, JOIN, LEFT JOIN, RIGHT JOIN clauses (only once per table name)
        $query = preg_replace_callback('/\b(FROM|JOIN|LEFT\s+JOIN|RIGHT\s+JOIN)\s+([\`\'\"a-zA-Z0-9\-_,\(\)\s]+?)(?=$|\;|\s+(ON|WHERE|HAVING|LIMIT|OFFSET|JOIN|LEFT\s+JOIN|RIGHT\s+JOIN|\;|$))/i', function($matches) use ($schema) {
            // Split comma-separated tables
            $tables = explode(',', $matches[2]);
            foreach ($tables as &$table) {
                // Trim spaces and add schema to each table name
                $table = trim($table);
                $table = "\"{$schema}\".{$table}";
            }
            $tables = implode(', ', $tables);
            $rest = '';
            //$rest = $matches[3] ? "{$matches[3]} {$rest}" : $rest;
            //$rest = $matches[4] ? "{$matches[4]} {$rest}" : $rest;
            return "{$matches[1]} {$tables} {$rest}";
        }, $query);

        // Remove duplicate schema occurrences
        $query = str_replace("\"{$schema}\".\"{$schema}\"", "\"{$schema}\"", $query);
        $query = str_replace("\"{$schema}\".\"{$schema}\"", "\"{$schema}\"", $query);

        // Replace CURDATE() with CURRENT_DATE
        $query = preg_replace('/\bCURDATE\(\)/i', 'CURRENT_DATE', $query);
        // Replace INTERVAL X UNIT with INTERVAL 'X units', ensuring unit is plural
        $query = preg_replace_callback('/INTERVAL\s+(\d+)\s+(\w+)/i', function($matches) {
            $unit = strtolower($matches[2]);
            // Ensure unit is plural for PostgreSQL
            if (substr($unit, -1) !== 's') {
                $unit .= 's';
            }
            return "INTERVAL '{$matches[1]} $unit'";
        }, $query);
        // Replace YEAR(<column>) with EXTRACT(YEAR FROM <column>)
        $query = preg_replace('/YEAR\(([^)]+)\)/i', 'EXTRACT(YEAR FROM $1)', $query);
        // Replace MONTH(<column>) with EXTRACT(MONTH FROM <column>)
        $query = preg_replace('/MONTH\(([^)]+)\)/i', 'EXTRACT(MONTH FROM $1)', $query);
        // Replace DAYNAME(<column>) with TO_CHAR(<column>, 'Day')
        $query = preg_replace('/DAYNAME\(([^)]+)\)/i', "TO_CHAR($1, 'Day')", $query);
        // Replace WEEKDAY(<column>) with EXTRACT(DOW FROM <column>)
        $query = preg_replace('/WEEKDAY\(([^)]+)\)/i', 'EXTRACT(DOW FROM $1)', $query);


        return $query;
    }
}

if (!function_exists('fixPath')) {
    function fixPath($path){
        if (!isset($_SERVER['DOCUMENT_ROOT']) || ENVIRONMENT !== 'production'){
            return $path;
        }
        return $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $path;
    }
}
