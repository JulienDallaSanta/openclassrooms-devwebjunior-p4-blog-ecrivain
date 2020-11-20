<?php
namespace Models;

require_once ("Models/Model.php");

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


    public function __construct(Array $data){
        $this->hydrate($data);
        $this->dbConnect();
    }

    public function hydrate($data){
        if(isset($data['id'])){
            $this->setId($data['id']);
        }
        if(isset($data['consulted_pages'])){
            $this->setConsulted_pages($data['consulted_pages']);
        }
        if(isset($data['length'])){
            $this->setLength($data['length']);
        }
        if(isset($data['rebound'])){
            $this->setRebound($data['rebound']);
        }
        if(isset($data['date_creation'])){
            $this->setDate_creation($data['date_creation']);
        }
    }

    //GETTERS
    /**
     * Get $id
     *
     * @return  int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Get $consulted_pages
     *
     * @return  int
     */
    public function getConsulted_pages(){
        return $this->consulted_pages;
    }

    /**
     * Get $length
     *
     * @return  string
     */
    public function getLength(){
        return $this->length;
    }

    /**
     * Get $rebound
     *
     * @return  int
     */
    public function getRebound(){
        return $this->rebound;
    }

    /**
     * Get $date_creation
     *
     * @return string
     */
    public function getDate_creation(){
        return $this->date_creation;
    }

    //SETTERS
    /**
     * Set $consulted_pages
     *
     * @param int $consulted_pages
     *
     * @return self
     */
    public function setConsulted_pages($consulted_pages){
        $this->consulted_pages = $consulted_pages;
    }

    /**
     * Set $length
     *
     * @param string $length
     *
     * @return  self
     */
    public function setLength($length){
        $this->length = $length;
    }

    /**
     * Set $rebound
     *
     * @param int $rebound
     *
     * @return int
     */
    public function setRebound($rebound){
        $this->rebound = $rebound;
    }

    /**
     * Set $date_creation
     *
     * @param string $date_creation
     *
     * @return string
     */
    public function setDate_creation($date_creation){
        $this->date_creation = $date_creation;
    }
}
