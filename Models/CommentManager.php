<?php
namespace Models;

require_once ("Models/Model.php");

/**
 * Comment class
 * Object corresponding to comment table
 */

class CommentManager extends Model{
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
	 * @var string $author_lastname
	 * author lastname
	 */
    private $author_lastname;

    /**
	 * @var string $author_firstname
	 * author firstname
	 */
	private $author_firstname;

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
     * @var int $signaled
     * comment's signaled or not
     */
    private $signaled;


    /**
     * Set $signaled
     *
     * @param  int  $signaled
     *
     * @return  self
     */
    public function set_signaled(int $signaled)
    {

        $this->signaled = $signaled;
            return $this;

    }


    public function deleteComment($commentId){
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comment WHERE id = ?');
        $deleteComment = $req->execute(array($commentId));

        if ($deleteComment === false) {
            throw new Exception('Impossible de supprimer le commentaire !');
        }
    }

    /**
     * Set $signaled to false
     *
     */
    public function setCancelReport($id)
    {
        $db = $this->dbConnect();
        $req = $db->query('UPDATE comment SET signaled = 0 WHERE id = ?');
    }


    public function getComments($chapterId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, chapter_id, author_lastname, author_firstname, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, content, signaled FROM comment WHERE chapter_id = ? ORDER BY creation_date DESC');
        $comments->execute(array($chapterId));

        return $comments;
    }
}
