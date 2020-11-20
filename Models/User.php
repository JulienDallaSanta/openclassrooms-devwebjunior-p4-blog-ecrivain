<?php
namespace Models;

require_once ("Models/Model.php");

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


    public function __construct(Array $data){
        $this->hydrate($data);
        $this->dbConnect();
    }

    public function hydrate($data){
        if(isset($data['id'])){
            $this->setId($data['id']);
        }
        if(isset($data['pseudo'])){
            $this->setPseudo($data['pseudo']);
        }
        if(isset($data['pass'])){
            $this->setPass($data['pass']);
        }
        if(isset($data['mail'])){
            $this->setMail($data['mail']);
        }
        if(isset($data['date_inscription'])){
            $this->setDate_inscription($data['date_inscription']);
        }
    }

    // GETTERS
    /**
     * Get $id
     *
     * @return  int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Get $pseudo
     *
     * @return  string  $pseudo
     */
    public function getPseudo(){
        return $this->pseudo;
    }

    /**
     * Get $pass
     *
     * @return  string  $pass
     */
    public function getPass(){
        return $this->pass;
    }

    /**
     * Get $mail
     *
     * @return  string  $mail
     */
    public function getMail(){
        return $this->mail;
    }

    /**
     * Get $date_inscription
     *
     * @return  string  $date_inscription
     */
    public function getDate_inscription(){
        return $this->date_inscription;
    }


    //SETTERS

    /**
     * Set $id
     *
     * @param  int  $id
     *
     * @return  self
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * Set $pseudo
     *
     * @param  string  $pseudo
     *
     * @return  string
     */
    public function setPseudo($pseudo){
        $this->pseudo = $pseudo;
    }

    /**
     * Set $pass
     *
     * @param  string  $pass
     *
     * @return  string
     */
    public function setPass($pass){
        $this->pass = $pass;
    }

    /**
     * Set $mail
     *
     * @param  string  $mail
     *
     * @return  string
     */
    public function setMail($mail){
        $this->mail = $mail;
    }

    /**
     * Set $date_inscription
     *
     * @param  string  $date_inscription
     *
     * @return  string
     */
    public function setDate_inscription($date_inscription){
        $this->date_inscription = $date_inscription;
    }


    public function getUser($pseudo){
        // search for a pseudo and return a User object
        $query = $this->db->prepare('SELECT id, pseudo, pass FROM user WHERE pseudo = ?');
        $query->execute([
            $pseudo
        ]);

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!$data) // si la recherche de pseudo n'a rien donné
        {
            return false;
        }
        else
        {
            return new User($data);
        }
    }

    public function exists($pseudo)
    {
        // search for a lowercase pseudo to avoid duplicates
        $query = $this->db->prepare('SELECT pseudo FROM user WHERE LOWER(pseudo) = ?');
        $query->execute([
            strtolower($pseudo)
        ]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser(User $user)
    {
        $query = $this->db->prepare('INSERT INTO user(pseudo, pass, mail, date_inscription) VALUES(:pseudo, :pass, :mail, NOW())');
        $query->execute([
            'pseudo' => $user->getPseudo(),
            'pass' => $user->getPass(),
            'mail' => $user->getMail()
        ]);
    }
}
