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
            self::getInstance()->setId($data['id']);
        }

        if (isset($data['chapter_id']))
        {
            self::getInstance()->setChapter_id($data['chapter_id']);
        }

        if (isset($data['pseudo']))
        {
            self::getInstance()->setPseudo($data['pseudo']);
        }

        if (isset($data['creation_date']))
        {
            self::getInstance()->setDate($data['creation_date']);
        }

        if (isset($data['content']))
        {
            self::getInstance()->setContent($data['content']);
		}

		if (isset($data['report']))
        {
            self::getInstance()->setReport($data['report']);
		}

		if (isset($data['report_date']))
        {
            self::getInstance()->setReport_date($data['report_date']);
        }
	}

	// GETTERS

    static function getId()
    {
        return self::getInstance()->id;
    }

    static function getChapter_id()
    {
        return self::getInstance()->chapter_id;
	}

    static function getPseudo()
    {
        return self::getInstance()->pseudo;
    }

	static function getCreation_date()
	{
		return self::getInstance()->creation_date;
	}

    static function getContent()
    {
        return self::getInstance()->content;
    }

    static function getReport()
    {
        return self::getInstance()->report;
    }

    static function getReport_date()
    {
        return self::getInstance()->report_date;
	}


    // SETTERS

    static function setId($id)
    {
        self::getInstance()->id = $id;

        return self::getInstance();
    }

    static function setChapter_id($chapter_id)
    {
        self::getInstance()->chapter_id = htmlspecialchars($chapter_id);

        return self::getInstance();
    }

    static function setPseudo($pseudo)
    {
        self::getInstance()->pseudo = $pseudo;

        return self::getInstance();
    }

    static function setCreation_date($creation_date)
    {
        self::getInstance()->creation_date = $creation_date;

        return self::getInstance();
    }

    static function setContent($content)
    {
        self::getInstance()->content = htmlspecialchars_decode($content);

        return self::getInstance();
    }

    static function setReport($report){
        self::getInstance()->report = $report;

        return self::getInstance();
    }

    static function setReport_date($report_date){
        self::getInstance()->report_date = $report_date;

        return self::getInstance();
    }

    /**
     * Get all reported comments
     */
    static function getReported(){
        $report = false;
        $query = self::getInstance()->db->prepare('SELECT * FROM comment WHERE report = 1');
        $query->execute();
        $queryReport = $query->fetch(PDO::FETCH_ASSOC);
        if($queryReport){
            $report = true;
        }
        return $report;
    }

    static function addComment(Comment $comment){
        $query = self::getInstance()->db->prepare("INSERT INTO comment(chapter_id, pseudo, content, creation_date, report) VALUES(:chapter_id, :pseudo, :content, NOW(), 0)");
        $query->execute([
            'chapter_id' => $comment->getChapter_id(),
            'pseudo' => $comment->getPseudo(),
            'content' => $comment->getContent()
        ]);
    }

    static function getComments($chapter_id){
        // return a list of comments in an array
        $comments = [];

        $query = self::getInstance()->db->prepare('SELECT id, chapter_id, pseudo, content, creation_date, report FROM comment WHERE chapter_id = ? ORDER BY report, creation_date DESC');
        $query->execute([$chapter_id]);
        while ($data = $query->fetch(PDO::FETCH_ASSOC)){
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    static function unreport(Comment $comment){
        $query = self::getInstance()->db->prepare("UPDATE comment SET report = 0 WHERE id = ?");
        $result = $query->execute([$comment->getId()]);

        return (bool) $result;
    }

    static function report(Comment $comment){
        $query = self::getInstance()->db->prepare("UPDATE comment SET report = 1, report_date = NOW() WHERE id = ?");
        $query->execute([$comment->getId()]);
    }

    static function deleteComment(Comment $comment){
        $query = self::getInstance()->db->prepare("DELETE FROM comment WHERE id = ?");
        $result = $query->execute([$comment->getId()]);

        return (bool) $result;
    }
}
