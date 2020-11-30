<?php

namespace Models;

use Models\Model;
use PDO;

/**
 * User class
 * Object corresponding to user table
 */

class User extends Model{

    /**
     * @var int $id
     * user's id
     */
    private $id;

    /**
     * @var string $pseudo
     * user's pseudo
     */
    private $pseudo;

    /**
     * @var string $pass
     * user's pass
     */
    private $pass;

    /**
     * @var string $mail
     * user's mail
     */
    private $mail;

    /**
     * @var string $date_inscription
     * user's date of inscription
     */
    private $date_inscription;


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
        if(isset($data['pseudo'])){
            self::getInstance()->setPseudo($data['pseudo']);
        }
        if(isset($data['pass'])){
            self::getInstance()->setPass($data['pass']);
        }
        if(isset($data['mail'])){
            self::getInstance()->setMail($data['mail']);
        }
        if(isset($data['date_inscription'])){
            self::getInstance()->setDate_inscription($data['date_inscription']);
        }
    }

    // GETTERS
    /**
     * Get $id
     *
     * @return  int
     */
    static function getId(){
        return self::getInstance()->id;
    }

    /**
     * Get $pseudo
     *
     * @return  string  $pseudo
     */
    static function getPseudo(){
        return self::getInstance()->pseudo;
    }

    /**
     * Get $pass
     *
     * @return  string  $pass
     */
    static function getPass(){
        return self::getInstance()->pass;
    }

    /**
     * Get $mail
     *
     * @return  string  $mail
     */
    static function getMail(){
        return self::getInstance()->mail;
    }

    /**
     * Get $date_inscription
     *
     * @return  string  $date_inscription
     */
    static function getDate_inscription(){
        return self::getInstance()->date_inscription;
    }


    //SETTERS

    /**
     * Set $id
     *
     * @param  int  $id
     *
     * @return  self
     */
    static function setId($id){
        self::getInstance()->id = $id;
    }

    /**
     * Set $pseudo
     *
     * @param  string  $pseudo
     *
     * @return  string
     */
    static function setPseudo($pseudo){
        self::getInstance()->pseudo = $pseudo;
    }

    /**
     * Set $pass
     *
     * @param  string  $pass
     *
     * @return  string
     */
    static function setPass($pass){
        self::getInstance()->pass = $pass;
    }

    /**
     * Set $mail
     *
     * @param  string  $mail
     *
     * @return  string
     */
    static function setMail($mail){
        self::getInstance()->mail = $mail;
    }

    /**
     * Set $date_inscription
     *
     * @param  string  $date_inscription
     *
     * @return  string
     */
    static function setDate_inscription($date_inscription){
        self::getInstance()->date_inscription = $date_inscription;
    }


    static function getUser($pseudo){
        // search for a pseudo and return a User object
        $query = self::getInstance()->db->prepare('SELECT id, pseudo, pass FROM user WHERE pseudo = ?');
        $query->execute([$pseudo]);

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!$data){ // si la recherche de pseudo n'a rien donné
            return false;
        } else{
            return new User($data);
        }
    }

    static function exists($pseudo){
        // search for a lowercase pseudo to avoid duplicates
        $query = self::getInstance()->db->prepare('SELECT pseudo FROM user WHERE LOWER(pseudo) = ?');
        $query->execute([strtolower($pseudo)]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    static function addUser(User $user){
        $query = self::getInstance()->db->prepare('INSERT INTO user(pseudo, pass, mail, date_inscription) VALUES(:pseudo, :pass, :mail, NOW())');
        $query->execute([
            'pseudo' => $user->getPseudo(),
            'pass' => $user->getPass(),
            'mail' => $user->getMail()
        ]);
    }
}
