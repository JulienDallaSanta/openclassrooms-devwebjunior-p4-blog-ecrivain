<?php
namespace Models;

require_once ("Models/Model.php");

/**
 * AdminManager class
 * Object corresponding to admin_data table
 */

class AdminManager extends Model{

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


    /**
     * Get $admin_id
     *
     * @return string
     */
    public function getId(){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT admin_id FROM admin_data');

        $admin_id = $req->fetch();

        return $admin_id;
    }

    /**
     * Set $admin_id
     *
     * @param  string  $admin_id
     *
     * @return  self
     */
    public function setId(string $admin_id)
    {
        $db = $this->dbConnect();
        $req = $db->query('UPDATE admin_data SET admin_id = '.$admin_id);


        return $admin_id;

    }


    /**
     * Get $admin_password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->admin_password;
    }

    /**
     * Set $admin_password
     *
     * @param  string  $admin_password
     *
     * @return  self
     */
    public function setPassword(string $admin_password)
    {
        $db = $this->dbConnect();
        $req = $db->query('UPDATE admin_data SET admin_password = '.$admin_password);

        return $admin_password;
    }
}
