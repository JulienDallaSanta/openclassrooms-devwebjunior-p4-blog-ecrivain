<?php
namespace Models;

require_once ("Models/Model.php");

/**
 * Chapter class
 * Object corresponding to chapter table
 */
class ChaptersManager extends Model{
	/**
	 * @var int $id
	 * chapter id
	 */
	private $id;

	/**
	 * @var string $title
	 * chapter title
	 */
	private $title;

	/**
	 * @var string $creation_date
	 * chapter datetime of publish
	 */
	private $creation_date;

	/**
	 * @var string $preview
	 * chapter preview
	 */
	private $preview;

	/**
	 * @var string $content
	 * chapter content
	 */
	private $content;

	/**
     * @var int $deleted
     * Sending 0 or 1 in the url
     */
    private $deleted;


	/**
	 * title Getter
	 *
	 */
	public function getTitle($id){
		$db = $this->dbConnect();
        $req = $db->query('SELECT title FROM chapter WHERE id ='.$id);
		$chapterTitle = $req->execute(array($id));

		return $chapterTitle;
	}

	/**
	 * creation_date Getter
	 *
	 */
	public function getDate($id){
		$db = $this->dbConnect();
        $req = $db->query('SELECT creation_date FROM chapter WHERE id ='.$id);
		$chapterDate = $req->execute(array($id));

		return $chapterDate;
	}

	/**
	 * preview Getter
	 *
	 */
	public function getPreview($id){
		$db = $this->dbConnect();
        $req = $db->query('SELECT preview FROM chapter WHERE id ='.$id);
		$chapterPreview = $req->execute(array($id));

		return $chapterPreview;
	}

	/**
	 * content Getter
	 *
	 */
	public function getContent($id){
		$db = $this->dbConnect();
        $req = $db->query('SELECT content FROM chapter WHERE id ='.$id);
		$chapterContent = $req->execute(array($id));

		return $chapterContent;
	}

    /**
     * Set deleted
     *
     */
    public function setDelete($id){
		$db = $this->dbConnect();
        $req = $db->query('UPDATE chapter SET deleted = ? WHERE id ='.$id);
	}

	public function addChapter(){
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO `chapter`(`id`, `title`, `creation_date`, `preview`, `chapter_image`, `content`, `deleted`) VALUES (?,?,NOW(),?,?,?,0)');
		$affectedLines = $req->execute(array($_POST['title'], $_POST['preview'], $_POST['chapter_image'], $_POST['content']));

		return $affectedLines;
	}

	public function updateChapter(){
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE chapter SET title = ?, preview = ?, chapter_image = ?, content = ? WHERE id = ?');
		$affectedLines = $req->execute(array($_POST['title'], $_POST['preview'], $_POST['chapter_image'], $_POST['content'], $id));

		return $affectedLines;
	}

	public function getChapters(){
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, preview, chapter_image, content, deleted FROM chapter WHERE deleted = 0 ORDER BY creation_date DESC');

        return $req;
	}

	public function getChapter($chapterId){
        $db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, preview, chapter_image, content, deleted FROM chapter WHERE id = ?');
		$req->execute(array($chapterId));
		$chapter = $req->fetch();

        return $chapter;
    }

};
?>
