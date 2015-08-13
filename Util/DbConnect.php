<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 8/13/15
 * Time: 12:39 PM
 */

namespace Contact\Util;

/*
 *Create a connection to mysql db
 Accept four initialization parameters
 @params $db, $url, $pass, $user
*/
class DbConnect {

    private $dbHost;
    private $dbName;
    private $dbPass;
    private $dbUsername;


    public function __construct($host, $db, $pass, $user) {
        $this->dbName = $db;
        $this->dbPass = $pass;
        $this->dbUsername = $user;
        $this->dbHost = $host;
    }


    /*
     * Create a connection to database and return the link if
     * no error occured
     * @return $link;
     */
    public function getConnection() {
        $link = new \mysqli($this->dbHost, $this->dbUsername,
            $this->dbPass, $this->dbName);

        if($link->errno){
            die('Connection error ('.$link->errno. ') '.$link->connect_error);
        }else{
            return $link;
        }
    }

    /*
     * Close the connection to the provided link,
     * if connection is not already closed.
     */
    public function closeConnection($link) {
        if($link != null) {
            $link->close();
        }
    }
}