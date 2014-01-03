<?php

// Database class CRUD

/*
  useful methods: prepare and query; constructor for connection
 */

class dbMysqli extends mysqli {

    protected static $instance;
    protected static $options = array();

    private function __construct() {
        $o = self::$options;

        // turn of error reporting
        mysqli_report(MYSQLI_REPORT_OFF);

        // connect to database

        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            $o['user'] = 'root';
            $o['db'] = 'db1';
            $o['pwd'] = '';
        } else {
            $o['user'] = 'd018ea07';
            $o['db'] = $o['user'];
            $o['pwd'] = 'openECCtest';
        }
//        host,user,pwd,db,port,socket
        @parent::__construct('localhost', $o['user'], $o['pwd'], $o['db'], 3306, false);

        // check if a connection established
        if (mysqli_connect_errno()) {
            throw new exception(mysqli_connect_error(), mysqli_connect_errno());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function setOptions(array $opt) {
        self::$options = array_merge(self::$options, $opt);
    }

    public function query($query) {
        if (!$this->real_query($query)) {
            throw new exception($this->error, $this->errno);
        }

        $result = new mysqli_result($this);
        return $result;
    }

    public function prepare($query) {
        $stmt = new mysqli_stmt($this, $query);
        return $stmt;
    }

}
