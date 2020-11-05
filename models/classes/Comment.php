<?php
/**
 * Comment class
 * Object corresponding to comment table
 */

class Comment {

    /**
     * @var int $id
     * comment's id
     */
    private $id;

    /**
     * @var int $chapter_id
     * comment's chapter's id
     */
    private $chapter_id;

    /**
     * @var string $author_lastname
     * author's lastname
     */
    private $author_lastname;

    /**
     * @var string $author_firstname
     * author's firstname
     */
    private $author_firstname;

    /**
     * @var string $date_creation
     * Comment's date of creation
     */
    private $date_creation;

    /**
     * @var string $text
     * Comment's text
     */
    private $text;

    /**
     * @var int $signaled
     * Comment signaled or not
     */
    private $signaled;

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
     * Get $author_lastname
     *
     * @return  string
     */
    public function get_author_lastname()
    {
        return $this->author_lastname;
    }

    /**
     * Set $author_lastname
     *
     * @param  string  $author_lastname
     *
     * @return  self
     */
    public function set_author_lastname(string $author_lastname)
    {
        $this->author_lastname = $author_lastname;
        return $this;

    }

    /**
     * Get $author_firstname
     *
     * @return  string
     */
    public function get_author_firstname()
    {
        return $this->author_firstname;
    }

    /**
     * Set $author_firstname
     *
     * @param  string  $author_firstname
     *
     * @return  self
     */
    public function set_author_firstname(string $author_firstname)
    {
        $this->author_firstname = $author_firstname;
        return $this;

    }

    /**
     * Get $text
     *
     * @return  string
     */
    public function get_text()
    {
        return $this->text;
    }

    /**
     * Set $text
     *
     * @param  string  $text
     * @return  self
     */
    public function set_text(string $text)
    {
        $this->text = $text;
        return $this;

    }


    /**
     * Get $signaled
     *
     * @return  int
     */
    public function get_signaled()
    {
        return $this->signaled;
    }

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

    /**
     * Get $chapter_id
     *
     * @return  int
     */
    public function get_chapter_id()
    {
        return $this->chapter_id;
    }

    /**
     * Set $chapter_id
     *
     * @param  int  $chapter_id
     *
     * @return  self
     */
    public function set_chapter_id(int $chapter_id)
    {

        if($chapter_id > 0) {

            $this->chapter_id = $chapter_id;
            return $this;
        }
    }
}
