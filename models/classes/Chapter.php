<?php
/**
 * Chapter class
 * Object corresponding to chapter table
 */
class Chapter
{
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
	 * @var string $text
	 * chapter content
	 */
	private $text;

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

		return $this->text;

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
	 * text Setter
	 * @param $text
	 * @return Chapter
	 */
	public function setText(string $text)
	{

		$this->text = $text;
		return $this;

	}
	/**
	 * text Getter
	 *
	 */
	public function getText()
	{

		return $this->text;

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

};
?>
