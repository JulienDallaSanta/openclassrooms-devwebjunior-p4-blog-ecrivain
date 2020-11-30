<?php

namespace Models;

use Models\Model;
use PDO;

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

	public function __construct($data = false){ // parameter must be an array
        $this->dbConnect();
        if($data){
            $this->hydrate($data);
        }
	}

	static function hydrate($data){
        if (isset($data['id']))
        {
            self::getInstance()->setId($data['id']);
        }

        if (isset($data['title']))
        {
            self::getInstance()->setTitle($data['title']);
        }

        if (isset($data['creation_date']))
        {
            self::getInstance()->setDate($data['creation_date']);
        }

        if (isset($data['preview']))
        {
            self::getInstance()->setPreview($data['preview']);
        }

        if (isset($data['chapter_image']))
        {
            self::getInstance()->setChapter_image($data['chapter_image']);
        }

        if (isset($data['content']))
        {
            self::getInstance()->setContent($data['content']);
		}

		if (isset($data['published']))
        {
            self::getInstance()->setPublished($data['published']);
		}

		if (isset($data['deleted']))
        {
            self::getInstance()->setDeleted($data['deleted']);
        }
	}

	// GETTERS

    static function getId(){
        return self::getInstance()->id;
    }

    static function getTitle(){
        return self::getInstance()->title;
	}

	static function getCreation_date(){
		return self::getInstance()->creation_date;
	}

    static function getPreview(){
        return self::getInstance()->preview;
    }

    static function getChapter_image(){
        return self::getInstance()->chapter_image;
	}

    static function getContent(){
        return self::getInstance()->content;
	}

	static function getPublished(){
        return self::getInstance()->published;
	}

	static function getDeleted(){
        return self::getInstance()->deleted;
    }

	// SETTERS

    static function setId($id){
        self::getInstance()->id = $id;

        return self::getInstance();
    }

    static function setTitle($title){
        self::getInstance()->title = htmlspecialchars($title);

        return self::getInstance();
    }

    static function setContent($content){
        self::getInstance()->content = htmlspecialchars_decode($content);

        return self::getInstance();
    }

    static function setCreation_date($creation_date){
        self::getInstance()->creation_date = $creation_date;

        return self::getInstance();
    }

    static function setPreview($preview){
        self::getInstance()->preview = $preview;

        return self::getInstance();
    }

    static function setChapter_image($chapter_image){
        self::getInstance()->chapter_image = $chapter_image;

        return self::getInstance();
	}

	static function setPublished($published){
        self::getInstance()->published = $published;

        return self::getInstance();
	}

	static function setDeleted($deleted){
        self::getInstance()->deleted = $deleted;

        return self::getInstance();
    }

	/**
     * Set deleted to TRUE
     *
     */
    static function deleteChapter(Chapter $chapter){
        $query = self::getInstance()->db->prepare('UPDATE chapter SET deleted = 1 WHERE id = ?');
        $query->execute();
	}

	/**
     * Set deleted to FALSE
     *
     */
    static function undeleteChapter(Chapter $chapter){
        $query = self::getInstance()->db->prepare('UPDATE chapter SET deleted = 0 WHERE id = ?');
        $query->execute();
	}

	static function addChapter(Chapter $chapter){ // parameter must be a Chapter object
		$query = self::getInstance()->db->prepare('INSERT INTO `chapter`(`id`, `title`, `creation_date`, `preview`, `chapter_image`, `content`, `published`, `deleted`) VALUES (?,?,NOW(),?,?,?,?,0)');
		$query->execute([
			$chapter->getTitle(),
			$chapter->getContent(),
			$chapter->getPreview(),
			$chapter->getPublished()
		]);
	}

	static function updateChapter(Chapter $chapter){
		$query = self::getInstance()->db->prepare('UPDATE chapter SET title = :title, preview = :preview, chapter_image = :chapter_image, content = :content, published = :published WHERE id = :id')
		or die(print_r(self::getInstance()->db->errorInfo()));
		$query->execute([
			':title' => $chapter->getTitle(),
			':content' => $chapter->getContent(),
			':preview' => $chapter->getPreview(),
			':published' => $chapter->getPublished()
		]);
	}

	static function getChapters(){
		$chapters = [];
        $query = self::getInstance()->db->prepare('SELECT id, title, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, preview, chapter_image, content, deleted, published FROM chapter WHERE deleted = 0 ORDER BY creation_date DESC');
        $query->execute();
        while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$chapters = new Chapter($data);
		}
        return $chapters;
	}

	static function getPosted(){
		// return a list of published chapters in an objects array
        $chapters = [];
		$query = self::getInstance()->db->prepare("SELECT id, title, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr, preview, chapter_image, content, published, deleted FROM chapter WHERE deleted = 0 AND published = 1 ORDER BY creation_date");
        $query->execute();
        while ($data = $query->fetch(PDO::FETCH_ASSOC)){
			$chapters[] = new Chapter($data);
		}
        return $chapters;
	}

	static function getChapter($id){
        $query = self::getInstance()->db->prepare('SELECT id, title, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, preview, chapter_image, content, published, deleted FROM chapter WHERE id = ?');
        $query->execute([$id]);
        if($query->rowcount() == 1){
            $chapter = $query->fetch(PDO::FETCH_ASSOC);
            return new Chapter($chapter);
        } else{
            throw new Exception("Aucun chapitre ne correspond à l'identifiant '$id'");
        }
	}

	static function exists($id){
        if (is_numeric($id))
        {
            $query = self::getInstance()->db->prepare('SELECT id FROM chapter WHERE id = ?');
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
