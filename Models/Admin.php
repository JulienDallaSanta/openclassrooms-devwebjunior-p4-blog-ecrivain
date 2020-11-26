<?php
namespace Models;

use Models\Model;

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


    public function __construct(Array $data){
        $this->hydrate($data);
        $this->dbConnect();
    }

    public function hydrate($data){
        if(isset($data['admin_id'])){
            $this->setAdmin_id($data['admin_id']);
        }
        if(isset($data['admin_password'])){
            $this->setAdmin_password($data['admin_password']);
        }
    }

    //GETTERS
    /**
     * Get $admin_id
     *
     * @return string
     */
    public function getAdmin_id(){

        return $this->admin_id;
    }

    /**
     * Get $admin_password
     *
     * @return string
     */
    public function getAdmin_password(){
        return $this->admin_password;
    }


    //SETTERS
    /**
     * Set $admin_id
     *
     * @param  string  $admin_id
     *
     * @return  string
     */
    public function setAdmin_id($admin_id){
        $this->admin_id = $admin_id;
    }

    /**
     * Set $admin_password
     *
     * @param  string  $admin_password
     *
     * @return  string
     */
    public function setAdmin_password($admin_password){
        $this->admin_password = $admin_password;
    }
}
