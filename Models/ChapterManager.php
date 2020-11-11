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
	 * @var string $date
	 * chapter datetime of publish
	 */
	private $date;

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
	 * Get $id
	 *
	 * @return  int
	 */
	public function get_id()
	{
		return $this->id;
	}

	/**
	 * title Setter
	 * @param $title
	 * @return string
	 */
	public function setTitle(string $title)
	{
		$this->title = $title;
		return $this;

	}
	/**
	 * title Getter
	 *
	 */
	public function getTitle()
	{

		return $this->title;

	}

	/**
	 * date Setter
	 * @param $date
	 * @return string
	 */
	public function setDate(string $date)
	{

		$this->date = $date;
		return $this;

	}
	/**
	 * date Getter
	 *
	 */
	public function getDate()
	{

		return $this->date;

	}

	/**
	 * preview Setter
	 * @param $preview
	 * @return Chapter
	 */
	public function setPreview(string $preview)
	{

		$this->preview = $preview;
		return $this;

	}
	/**
	 * preview Getter
	 *
	 */
	public function getPreview()
	{

		return $this->preview;

	}

	/**
	 * content Setter
	 * @param $content
	 * @return Chapter
	 */
	public function setContent(string $content)
	{

		$this->content = $content;
		return $this;

	}
	/**
	 * content Getter
	 *
	 */
	public function getContent()
	{

		return $this->content;

	}

	/**
     * deleted Setter
     * @param int $deleted
     * @return Chapter
     */
    public function setDeleteChapter(int $deleted)
    {

        $this->deleted = $deleted;
        return $this;

    }
    /**
     * deleted Getter
     * @return 0 or 1
     */
    public function getDeleteChapter()
    {

        return $this->deleted;

	}

	final public function addChapter() {
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO `chapter`(`id`, `title`, `date_creation`, `preview`, `chapter_image`, `content`, `deleted`) VALUES (?,?,NOW(),?,?,?,0)');
		$affectedLines = $req->execute(array($_POST['title'], $_POST['preview'], $_POST['chapter_image'], $_POST['content']));

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
