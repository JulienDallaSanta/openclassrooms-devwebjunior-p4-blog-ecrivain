<?php

namespace Models;

use Models\Model;
use PDO;

/**
 * Admin class
 * Object corresponding to admin_data table
 */

class Admin extends Model{

    /**
     * @var string $admin_id
     * admin's id
     */
    private $admin_id;

    /**
     * @var string $admin_password
     * admin's password
     */
    private $admin_password;


    public function __construct($data = false){
        $this->dbConnect();
        if($data){
            $this->hydrate($data);
        }
    }

    static function hydrate($data){
        if(isset($data['admin_id'])){
            self::getInstance()->setAdmin_id($data['admin_id']);
        }
        if(isset($data['admin_password'])){
            self::getInstance()->setAdmin_password($data['admin_password']);
        }
    }

    //GETTERS
    /**
     * Get $admin_id
     *
     * @return string
     */
    static function getAdmin_id(){

        return self::getInstance()->admin_id;
    }

    /**
     * Get $admin_password
     *
     * @return string
     */
    static function getAdmin_password(){
        return self::getInstance()->admin_password;
    }


    //SETTERS
    /**
     * Set $admin_id
     *
     * @param  string  $admin_id
     *
     * @return  string
     */
    static function setAdmin_id($admin_id){
        self::getInstance()->admin_id = $admin_id;
    }

    /**
     * Set $admin_password
     *
     * @param  string  $admin_password
     *
     * @return  string
     */
    static function setAdmin_password($admin_password){
        self::getInstance()->admin_password = $admin_password;
    }
}
