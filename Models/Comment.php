<?php

namespace Models;

use Models\Model;
use PDO;

/**
 * Comment class
 * Object corresponding to comment table
 */

class Comment extends Model{
    /**
	 * @var int $id
	 * chapter id
	 */
	private $id;

	/**
	 * @var int $chapter_id
	 * comment's chapter's id
	 */
	private $chapter_id;

    /**
	 * @var string $pseudo
	 * pseudo
	 */
    private $pseudo;


	/**
	 * @var string $creation_date
	 * comment's publishing datetime
	 */
	private $creation_date;


	/**
	 * @var string $content
	 * comment's content
	 */
	private $content;

	/**
     * @var int $report
     * comment's reported or not
     */
    private $report;

    /**
	 * @var string $report_date
	 * comment's reporting timestamp
	 */
	private $report_date;


    public function __construct($data = false) // parameter must be an array
    {
        $this->dbConnect();
        if($data){
            $this->hydrate($data);
        }
	}

	static function hydrate($data)
    {
        if (isset($data['id']))
        {
            static::getInstance()->setId($data['id']);
        }

        if (isset($data['chapter_id']))
        {
            static::getInstance()->setChapter_id($data['chapter_id']);
        }

        if (isset($data['pseudo']))
        {
            static::getInstance()->setPseudo($data['pseudo']);
        }

        if (isset($data['creation_date']))
        {
            static::getInstance()->setCreation_date($data['creation_date']);
        }

        if (isset($data['content']))
        {
            static::getInstance()->setContent($data['content']);
		}

		if (isset($data['report']))
        {
            static::getInstance()->setReport($data['report']);
		}

		if (isset($data['report_date']))
        {
            static::getInstance()->setReport_date($data['report_date']);
        }
    }

    public function toArray(){
        return [
            "id" => $this->getId(),
            "chapter_id" => $this->getChapter_id(),
            "pseudo" => $this->getPseudo(),
            "creation_date" => $this->getCreation_date(),
            "content" => $this->getContent(),
            "report" => $this->getReport(),
            "report_date" => $this->getReport_date()
        ];
    }

	// GETTERS

    static function getId()
    {
        return static::getInstance()->id;
    }

    static function getChapter_id()
    {
        return static::getInstance()->chapter_id;
	}

    static function getPseudo()
    {
        return static::getInstance()->pseudo;
    }

	static function getCreation_date()
	{
		return static::getInstance()->creation_date;
	}

    static function getContent()
    {
        return static::getInstance()->content;
    }

    static function getReport()
    {
        return static::getInstance()->report;
    }

    static function getReport_date()
    {
        return static::getInstance()->report_date;
	}


    // SETTERS

    static function setId($id)
    {
        static::getInstance()->id = $id;

        return static::getInstance();
    }

    public function setChapter_id($chapter_id)
    {
        static::getInstance()->chapter_id = htmlspecialchars($chapter_id);

        return static::getInstance();
    }

    static function setPseudo($pseudo)
    {
        static::getInstance()->pseudo = $pseudo;

        return static::getInstance();
    }

    static function setCreation_date($creation_date)
    {
        static::getInstance()->creation_date = $creation_date;

        return static::getInstance();
    }

    static function setContent($content)
    {
        static::getInstance()->content = htmlspecialchars_decode($content);

        return static::getInstance();
    }

    static function setReport($report){
        static::getInstance()->report = $report;

        return static::getInstance();
    }

    static function setReport_date($report_date){
        static::getInstance()->report_date = $report_date;

        return static::getInstance();
    }

    /**
     * Get all reported comments
     */
    static function getReported(){
        $report = false;
        $query = static::getInstance()->db->prepare("SELECT id, chapter_id, pseudo, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin') AS creation_date, report  FROM p4_comment WHERE report = 1");
        $query->execute();
        $queryReport = $query->fetch(PDO::FETCH_ASSOC);
        if($queryReport){
            $report = true;
        }
        return $query;
    }

    static function getNumberOfReportedComments(){
        $comments = [];
        $query = static::getInstance()->db->prepare('SELECT COUNT(*) as nb FROM p4_comment WHERE report = 1');
        $query->execute([]);
        $data = $query->fetch();
        return (int) $data['nb'];
    }

    static function addComment(Comment $comment){
        $query = static::getInstance()->db->prepare("INSERT INTO p4_comment(chapter_id, pseudo, content, creation_date, report) VALUES(:chapter_id, :pseudo, :content, NOW(), 0)");
        $query->execute([
            'chapter_id' => $comment->getChapter_id(),
            'pseudo' => $comment->getPseudo(),
            'content' => $comment->getContent()
        ]);
    }

    static function getComments($chapter_id){
        // return a list of comments in an array
        $comments = [];
        $query = static::getInstance()->db->prepare("SELECT id, chapter_id, pseudo, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin') AS creation_date, report FROM p4_comment WHERE chapter_id = ? AND report=0 ORDER BY report, creation_date DESC");
        $query->execute([$chapter_id]);
        while ($data = $query->fetch(PDO::FETCH_ASSOC)){
            array_push($comments, (new Comment($data))->toArray());
        }
        return $comments;
    }

    static function getCommentById($id){
        $query = static::getInstance()->db->prepare("SELECT id, chapter_id, pseudo, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin') AS creation_date, report FROM p4_comment WHERE id = ?");
        $query->execute([$id]);
        $comment = new Comment($query->fetch(PDO::FETCH_ASSOC));
        return $comment;
    }

    static function getNumberOfComments($chapter_id){
        $comments = [];
        $query = static::getInstance()->db->prepare('SELECT COUNT(*) as nb FROM p4_comment WHERE chapter_id = ?');
        $query->execute([$chapter_id]);
        $data = $query->fetch();
        return (int) $data['nb'];
    }

    static function getNumberOfNonReportedComments($chapter_id){
        $comments = [];
        $query = static::getInstance()->db->prepare('SELECT COUNT(*) as nb FROM p4_comment WHERE chapter_id = ? AND report = 0');
        $query->execute([$chapter_id]);
        $data = $query->fetch();
        return (int) $data['nb'];
    }

    static function unreport(Comment $comment){
        $query = static::getInstance()->db->prepare("UPDATE p4_comment SET report = 0, report_date = NULL WHERE id = ?");
        $query->execute([$comment->getId()]);
    }

    static function report(Comment $comment){
        $query = static::getInstance()->db->prepare("UPDATE p4_comment SET report = 1, report_date = NOW() WHERE id = ?");
        $query->execute([$comment->getId()]);
    }

    static function deleteComment(Comment $comment){
        $query = static::getInstance()->db->prepare("DELETE FROM p4_comment WHERE id = ?");
        $query->execute([$comment->getId()]);
    }
}
