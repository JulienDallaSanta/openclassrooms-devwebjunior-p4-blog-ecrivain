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
	private $chapter_image;
	private $content;
	private $published;
    private $published_date;
	private $deleted;
    private $deleted_date;

	public function __construct($data = false){ // parameter must be an array
        $this->dbConnect();
        if($data){
            $this->hydrate($data);
        }
	}

	static function hydrate($data){
        if (isset($data['id']))
        {
            static::getInstance()->setId($data['id']);
        }

        if (isset($data['title']))
        {
            static::getInstance()->setTitle($data['title']);
        }

        if (isset($data['creation_date']))
        {
            static::getInstance()->setCreation_date($data['creation_date']);
        }

        if (isset($data['chapter_image']))
        {
            static::getInstance()->setChapter_image($data['chapter_image']);
        }

        if (isset($data['content']))
        {
            static::getInstance()->setContent($data['content']);
		}

		if (isset($data['published']))
        {
            static::getInstance()->setPublished($data['published']);
		}

        if (isset($data['published_date']))
        {
            static::getInstance()->setPublishedDate($data['published_date']);
		}

		if (isset($data['deleted']))
        {
            static::getInstance()->setDeleted($data['deleted']);
        }

        if (isset($data['deleted_date']))
        {
            static::getInstance()->setDeletedDate($data['deleted_date']);
        }
    }

    public function toArray(){
        return [
            "id" => $this->getId(),
            "title" => $this->getTitle(),
            "creation_date" => $this->getCreation_date(),
            "chapter_image" => $this->getChapter_image(),
            "content" => $this->getContent(),
            "published" => $this->getPublished(),
            "published_date" => $this->getPublishedDate(),
            "deleted" => $this->getDeleted(),
            "deleted_date" => $this->getDeletedDate()
        ];
    }

	// GETTERS

    static function getId(){
        return static::getInstance()->id;
    }

    static function getTitle(){
        return static::getInstance()->title;
	}

	static function getCreation_date(){
		return static::getInstance()->creation_date;
	}

    static function getChapter_image(){
        return static::getInstance()->chapter_image;
	}

    static function getContent(){
        return static::getInstance()->content;
	}

	static function getPublished(){
        return static::getInstance()->published;
	}

    static function getPublishedDate(){
        return static::getInstance()->published_date;
	}

	static function getDeleted(){
        return static::getInstance()->deleted;
    }

    static function getDeletedDate(){
        return static::getInstance()->deleted_date;
    }

	// SETTERS

    static function setId($id){

        static::getInstance()->id = $id;
        return static::getInstance();
    }

    static function setTitle($title){
        static::getInstance()->title = htmlspecialchars($title);
        return static::getInstance();
    }

    static function setContent($content){
        static::getInstance()->content = htmlspecialchars_decode($content);
        return static::getInstance();
    }

    static function setCreation_date($creation_date){
        static::getInstance()->creation_date = $creation_date;
        return static::getInstance();
    }

    static function setChapter_image($chapter_image){
        static::getInstance()->chapter_image = $chapter_image;
        return static::getInstance();
	}

	static function setPublished($published){
        static::getInstance()->published = $published;
        return static::getInstance();
	}

    static function setPublishedDate($published_date){
        static::getInstance()->published_date = $published_date;
        return static::getInstance();
	}

	static function setDeleted($deleted){
        static::getInstance()->deleted = $deleted;
        return static::getInstance();
    }

    static function setDeletedDate($deleted_date){
        static::getInstance()->deleted_date = $deleted_date;
        return static::getInstance();
    }

	/**
     * Set deleted to TRUE
     *
     */
    static function deleteChapter(Chapter $chapter){
        $query = static::getInstance()->db->prepare("UPDATE p4_chapter SET published = 0, published_date = NULL, deleted = 1, deleted_date = NOW() WHERE id = ?");
        $query->execute([$chapter->getId()]);
	}

	/**
     * Set deleted to FALSE
     *
     */
    static function undeleteChapter(Chapter $chapter){
        $query = static::getInstance()->db->prepare('UPDATE p4_chapter SET deleted = 0, deleted_date = NULL WHERE id = ?');
        $query->execute([$chapter->getId()]);
	}

    /**
     * Set published to TRUE
     *
     */
    static function publishChapter(Chapter $chapter){
        $query = static::getInstance()->db->prepare("UPDATE p4_chapter SET published = 1, published_date = NOW(), deleted = 0, deleted_date = NULL WHERE id = ?");
        $query->execute([$chapter->getId()]);
	}

	static function addChapter(Chapter $chapter){ // parameter must be a Chapter object
		$query = static::getInstance()->db->prepare("INSERT INTO p4_chapter(title, creation_date, chapter_image, content, published, deleted) VALUES (:title, NOW(), :chapter_image, :content, 0,0)");
		$query->execute([
			'title' => $chapter->getTitle(),
			'chapter_image' => $chapter->getChapter_image(),
			'content' => $chapter->getContent()
		]);
	}

	static function updateChapter(Chapter $chapter){
		$query = static::getInstance()->db->prepare('UPDATE p4_chapter SET title = :title, chapter_image = :chapter_image, content = :content WHERE id = :id')
		or die(print_r(static::getInstance()->db->errorInfo()));
		$query->execute([
            ':id' => $chapter->getId(),
            ':chapter_image' => $chapter->getChapter_image(),
			':title' => $chapter->getTitle(),
			':content' => $chapter->getContent()
		]);
	}

	static function getChapters(){
		$chapters = [];
        $query = static::getInstance()->db->prepare("SELECT id, title, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%im') AS creation_date, chapter_image, content, deleted, DATE_FORMAT(deleted_date, '%d/%m/%Y à %Hh%im') AS deleted_date, published, DATE_FORMAT(published_date, '%d/%m/%Y à %Hh%im') AS published_date FROM p4_chapter ORDER BY id");
        $query->execute();
        while($data = $query->fetch(PDO::FETCH_ASSOC)){
			array_push($chapters, (new Chapter($data))->toArray());
		}
        return $chapters;
	}

    static function getNumberOfChapters(){
        $chapters = [];
        $query = static::getInstance()->db->prepare("SELECT COUNT(*) as nb FROM p4_chapter");
        $query->execute();
        $data = $query->fetchColumn();
        return (int) $data;
    }

	static function getPosted(){
		// return a list of published chapters in an objects array
        $chapters = [];
		$query = static::getInstance()->db->prepare("SELECT id, title, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%im') AS creation_date, chapter_image, content, published, deleted FROM p4_chapter WHERE deleted = 0 AND published = 1 ORDER BY creation_date");
        $query->execute();
        while ($data = $query->fetch(PDO::FETCH_ASSOC)){
            array_push($chapters, (new Chapter($data))->toArray());
        }
        return $chapters;
    }

    static function getChaptersToPublish(){
		// return a list of deleted chapters in an objects array
        $chaptersToPublish = [];
		$query = static::getInstance()->db->prepare("SELECT id, title, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%im') AS creation_date, chapter_image, content, published, deleted, deleted_date FROM p4_chapter WHERE published = 0 ORDER BY creation_date");
        $query->execute();
        while ($data = $query->fetch(PDO::FETCH_ASSOC)){
            array_push($chaptersToPublish, (new Chapter($data))->toArray());
        }
        return $chaptersToPublish;
    }

    static function getNumberOfChaptersToPublish(){
        $chaptersToPublish = [];
        $query = static::getInstance()->db->prepare("SELECT COUNT(*) as nb FROM p4_chapter WHERE published = 0");
        $query->execute();
        $data = $query->fetchColumn();
        return (int) $data;
    }

    static function getDeletedChapters(){
		// return a list of deleted chapters in an objects array
        $deletedChapters = [];
		$query = static::getInstance()->db->prepare("SELECT id, title, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%im') AS creation_date, chapter_image, content, published, deleted, deleted_date FROM p4_chapter WHERE deleted = 1 ORDER BY deleted_date");
        $query->execute();
        while ($data = $query->fetch(PDO::FETCH_ASSOC)){
            array_push($deletedChapters, (new Chapter($data))->toArray());
        }
        return $deletedChapters;
    }

    static function getNumberOfDeletedChapters(){
        $deletedChapters = [];
        $query = static::getInstance()->db->prepare("SELECT COUNT(*) as nb FROM p4_chapter WHERE deleted = 1");
        $query->execute();
        $data = $query->fetchColumn();
        return (int) $data;
    }

    static function get4lastChapters(){
		// return a list of 4 last chapters in an objects array
        $lastChapters = [];
        // $instance = static::getInstance();
		$query = static::getInstance()->db->prepare("SELECT id, title, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%im') AS creation_date, chapter_image, content, published, deleted FROM p4_chapter WHERE deleted = 0 AND published = 1 ORDER BY id DESC LIMIT 4");
        $query->execute();
        while ($data = $query->fetch(PDO::FETCH_ASSOC)){
            array_push($lastChapters, (new Chapter($data))->toArray());
        }
        return $lastChapters;
	}

	static function getChapter($id){
        $query = static::getInstance()->db->prepare("SELECT id, title, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%im') AS creation_date, chapter_image, content, published, deleted FROM p4_chapter WHERE id = ?");
        $query->execute([$id]);
        $chapter = $query->fetch(PDO::FETCH_ASSOC);
        return $chapter;
	}

    static function getChapterById($id){
        $query = static::getInstance()->db->prepare("SELECT id, title, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%im') AS creation_date, chapter_image, content, published, deleted, deleted_date FROM p4_chapter WHERE id = ?");
        $query->execute([$id]);
        $chapter = new Chapter($query->fetch(PDO::FETCH_ASSOC));
        return $chapter;
    }

	static function exists($id){
        if (is_numeric($id)){
            $query = static::getInstance()->db->prepare('SELECT id FROM p4_chapter WHERE id = ?');
            $query->execute([$id]);

            return $query->fetch(PDO::FETCH_ASSOC);
        }
        else{
            return false;
        }
    }

};
?>
