<?php

namespace Models;

use Models\Model;

/**
 * Chapter class
 * Object corresponding to chapter table
 */
class Chapter extends Model{
	private $id;
    private $title;
    private $creation_date;
	private $preview;
	private $chapter_image;
	private $content;
	private $published;
	private $deleted;

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

        if (isset($data['title']))
        {
            $this->setTitle($data['title']);
        }

        if (isset($data['creation_date']))
        {
            $this->setDate($data['creation_date']);
        }

        if (isset($data['preview']))
        {
            $this->setPreview($data['preview']);
        }

        if (isset($data['chapter_image']))
        {
            $this->setChapter_image($data['chapter_image']);
        }

        if (isset($data['content']))
        {
            $this->setContent($data['content']);
		}

		if (isset($data['published']))
        {
            $this->setPublished($data['published']);
		}

		if (isset($data['deleted']))
        {
            $this->setDeleted($data['deleted']);
        }
	}

	// GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
	}

	public function getCreation_date()
	{
		return $this->creation_date;
	}

    public function getPreview()
    {
        return $this->preview;
    }

    public function getChapter_image()
    {
        return $this->chapter_image;
	}

    public function getContent()
    {
        return $this->content;
	}

	public function getPublished()
    {
        return $this->published;
	}

	public function getDeleted()
    {
        return $this->deleted;
    }

	// SETTERS

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setTitle($title)
    {
        $this->title = htmlspecialchars($title);

        return $this;
    }

    public function setContent($content)
    {
        $this->content = htmlspecialchars_decode($content);

        return $this;
    }

    public function setCreation_date($creation_date)
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function setPreview($preview)
    {
        $this->preview = $preview;

        return $this;
    }

    public function setChapter_image($chapter_image)
    {
        $this->chapter_image = $chapter_image;

        return $this;
	}

	public function setPublished($published)
    {
        $this->published = $published;

        return $this;
	}

	public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

	/**
     * Set deleted to TRUE
     *
     */
    public function deleteChapter(Chapter $chapter){
        $query = $this->db->query('UPDATE chapter SET deleted = 1 WHERE id = ?');
	}

	/**
     * Set deleted to FALSE
     *
     */
    public function undeleteChapter(Chapter $chapter){
        $query = $this->db->query('UPDATE chapter SET deleted = 0 WHERE id = ?');
	}

	public function addChapter(Chapter $chapter){ // parameter must be a Chapter object
		$query = $this->db->prepare('INSERT INTO `chapter`(`id`, `title`, `creation_date`, `preview`, `chapter_image`, `content`, `published`, `deleted`) VALUES (?,?,NOW(),?,?,?,?,0)');
		$query->execute([
			$chapter->getTitle(),
			$chapter->getContent(),
			$chapter->getPreview(),
			$chapter->getPublished()
		]);
	}

	public function updateChapter(Chapter $chapter){
		$query = $this->db->prepare('UPDATE chapter SET title = :title, preview = :preview, chapter_image = :chapter_image, content = :content, published = :published WHERE id = :id')
		or die(print_r($this->db->errorInfo()));
		$query->execute([
			':title' => $chapter->getTitle(),
			':content' => $chapter->getContent(),
			':preview' => $chapter->getPreview(),
			':published' => $chapter->getPublished()
		]);
	}

	public function getChapters(){
		$chapters = [];
        $query = $this->db->query('SELECT id, title, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, preview, chapter_image, content, deleted, published FROM chapter WHERE deleted = 0 ORDER BY creation_date DESC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$chapters = new Chapter($data);
		}
        return $chapters;
	}

	public function getPosted(){
		// return a list of published chapters in an objects array
		$chapters = [];
		$query = $this->db->query("SELECT id, title, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, preview, chapter_image, content, published, deleted FROM chapter WHERE deleted = 0 AND published = 1 ORDER BY creation_date");
		while ($data = $query->fetch(PDO::FETCH_ASSOC)){
			$chapters[] = new Chapter($data);
		}
        return $chapters;
	}

	public function getChapter($id){
        $query = $this->db->prepare('SELECT id, title, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, preview, chapter_image, content, published, deleted FROM chapter WHERE id = ?');
        $query->execute([$id]);
        if($query->rowcount() == 1){
            $chapter = $query->fetch(PDO::FETCH_ASSOC);
            return new Chapter($chapter);
        } else{
            throw new Exception("Aucun chapitre ne correspond à l'identifiant '$id'");
        }
	}

	public function exists($id){
        if (is_numeric($id))
        {
            $query = $this->db->prepare('SELECT id FROM chapter WHERE id = ?');
            $query->execute([$id]);

            return $query->fetch(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }
    }

};
?>
