<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Account
{
    public $isValid = false;
    public $uid;
    public $account;
    public $password;
    public $maxchars;
    public $creation_date;
    public $last_login;
    public $plevel;
    public $status;
    public $characters = array();
    
    function __construct($account = null, $password = null, $client) {
        $query = "SELECT
						a.id,
						a.account,
						a.password,
						a.maxchars,
						a.creation_date,
						a.last_login,
						a.plevel,
						a.status
					FROM
						accounts a
					WHERE
						a.account = :account and
						a.password = :password and
						a.status = 1";
        
        $sth = UltimaPHP::$db->prepare($query);
        $sth->execute(array(":account" => $account, ":password" => $password));
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        if (isset($result[0])) {
            $this->uid = $result[0]['id'];
            $this->account = $result[0]['account'];
            $this->password = $result[0]['password'];
            $this->maxchars = $result[0]['maxchars'];
            $this->creation_date = $result[0]['creation_date'];
            $this->last_login = $result[0]['last_login'];
            $this->plevel = $result[0]['plevel'];
            $this->status = $result[0]['status'];
            
            $this->isValid = true;
            
            UltimaPHP::$socketClients[$client]['account'] = $this;
        }
    }
}
