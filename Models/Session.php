<?php
namespace Models;

use Models\Model;
use PDO;

/**
 * Session class
 * Object corresponding to session table
 */

class Session extends Model{

    /**
     * @var int $id
     * session's id
     */
    private $id;

    /**
     * @var int $consulted_pages
     * number of consulted pages during the session
     */
    private $consulted_pages;

    /**
     * @var string $length
     * length of the session
     */
    private $length;

    /**
     * @var int $rebound
     * end of the session at the first page consulted
     * Sending 0 or 1 in the url
     */
    private $rebound;

    /**
     * @var string $date_creation
     * dateTime of the session
     */
    private $date_creation;


    public function __construct($data = false){
        $this->dbConnect();
        if($data){
            $this->hydrate($data);
        }
    }

    static function hydrate($data){
        if(isset($data['id'])){
            self::getInstance()->setId($data['id']);
        }
        if(isset($data['consulted_pages'])){
            self::getInstance()->setConsulted_pages($data['consulted_pages']);
        }
        if(isset($data['length'])){
            self::getInstance()->setLength($data['length']);
        }
        if(isset($data['rebound'])){
            self::getInstance()->setRebound($data['rebound']);
        }
        if(isset($data['date_creation'])){
            self::getInstance()->setDate_creation($data['date_creation']);
        }
    }

    //GETTERS
    /**
     * Get $id
     *
     * @return  int
     */
    static function getId(){
        return self::getInstance()->id;
    }

    /**
     * Get $consulted_pages
     *
     * @return  int
     */
    static function getConsulted_pages(){
        return self::getInstance()->consulted_pages;
    }

    /**
     * Get $length
     *
     * @return  string
     */
    static function getLength(){
        return self::getInstance()->length;
    }

    /**
     * Get $rebound
     *
     * @return  int
     */
    static function getRebound(){
        return self::getInstance()->rebound;
    }

    /**
     * Get $date_creation
     *
     * @return string
     */
    static function getDate_creation(){
        return self::getInstance()->date_creation;
    }

    //SETTERS
    /**
     * Set $consulted_pages
     *
     * @param int $consulted_pages
     *
     * @return self
     */
    static function setConsulted_pages($consulted_pages){
        self::getInstance()->consulted_pages = $consulted_pages;
    }

    /**
     * Set $length
     *
     * @param string $length
     *
     * @return  self
     */
    static function setLength($length){
        self::getInstance()->length = $length;
    }

    /**
     * Set $rebound
     *
     * @param int $rebound
     *
     * @return int
     */
    static function setRebound($rebound){
        self::getInstance()->rebound = $rebound;
    }

    /**
     * Set $date_creation
     *
     * @param string $date_creation
     *
     * @return string
     */
    static function setDate_creation($date_creation){
        self::getInstance()->date_creation = $date_creation;
    }
}
