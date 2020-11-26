<?php

namespace Models;

require_once ("Models/Model.php");

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


    public function __construct(Array $data) // parameter must be an array
    {
		$this->dbConnect();
		$this->hydrate($data);
	}

	public function hydrate($data)
    {
        if (isset($data['id']))
        {
            $this->setId($data['id']);
        }

        if (isset($data['chapter_id']))
        {
            $this->setChapter_id($data['chapter_id']);
        }

        if (isset($data['pseudo']))
        {
            $this->setPseudo($data['pseudo']);
        }

        if (isset($data['creation_date']))
        {
            $this->setDate($data['creation_date']);
        }

        if (isset($data['content']))
        {
            $this->setContent($data['content']);
		}

		if (isset($data['report']))
        {
            $this->setReport($data['report']);
		}

		if (isset($data['report_date']))
        {
            $this->setReport_date($data['report_date']);
        }
	}

	// GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getChapter_id()
    {
        return $this->chapter_id;
	}

    public function getPseudo()
    {
        return $this->pseudo;
    }

	public function getCreation_date()
	{
		return $this->creation_date;
	}

    public function getContent()
    {
        return $this->content;
    }

    public function getReport()
    {
        return $this->report;
    }

    public function getReport_date()
    {
        return $this->report_date;
	}


    // SETTERS

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setChapter_id($chapter_id)
    {
        $this->chapter_id = htmlspecialchars($chapter_id);

        return $this;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function setCreation_date($creation_date)
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function setContent($content)
    {
        $this->content = htmlspecialchars_decode($content);

        return $this;
    }

    public function setReport($report){
        $this->report = $report;

        return $this;
    }

    public function setReport_date($report_date){
        $this->report_date = $report_date;

        return $this;
    }

    /**
     * Get all reported comments
     */
    public function getReported(){
        $report = false;
        $query = $this->db->query('SELECT * FROM comment WHERE report = 1');
        $queryReport = $query->fetch(PDO::FETCH_ASSOC);
        if($queryReport){
            $report = true;
        }
        return $report;
    }

    public function addComment(Comment $comment){
        $query = $this->db->prepare("INSERT INTO comment(chapter_id, pseudo, content, creation_date, report) VALUES(:chapter_id, :pseudo, :content, NOW(), 0)");
        $query->execute([
            'chapter_id' => $comment->getChapter_id(),
            'pseudo' => $comment->getPseudo(),
            'content' => $comment->getContent()
        ]);
    }

    /*public function getChapterWithComments()
    {
        // return a list of all comments with the chapter's title
        $comments = [];

        $query = $this->db->query('SELECT comment.id, chapter_id, pseudo, content, creation_date, report, chapter.title
        FROM comment
        INNER JOIN chapter ON comment.chapter_id = chapter.id
        ORDER BY report DESC, creation_date DESC');

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $comments[] = new Comment($data);
        }

        return $comments;
    }*/

    public function getComments($chapter_id){
        // return a list of comments in an array
        $comments = [];

        $query = $this->db->prepare('SELECT id, chapter_id, pseudo, content, creation_date, report FROM comment WHERE chapter_id = ? ORDER BY report, creation_date DESC');
        $query->execute([$chapter_id]);
        while ($data = $query->fetch(PDO::FETCH_ASSOC)){
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    public function unreport(Comment $comment){
        $query = $this->db->prepare("UPDATE comment SET report = 0 WHERE id = ?");
        $result = $query->execute([
            $comment->getId()
        ]);

        return (bool) $result;
    }

    public function report(Comment $comment){
        $query = $this->db->prepare("UPDATE comment SET report = 1, report_date = NOW() WHERE id = ?");
        $query->execute([
            $comment->getId()
        ]);
    }

    public function deleteComment(Comment $comment){
        $query = $this->db->prepare("DELETE FROM comment WHERE id = ?");
        $result = $query->execute([
            $comment->getId()
        ]);

        return (bool) $result;
    }
}
