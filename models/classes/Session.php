<?php
/**
 * Session class
 * Object corresponding to session table
 */

class Session {

    /**
     * @var int $id
     * session's id
     */
    private $id;

    /**
     * @var int $consulted_pages
     * number of consulted pages during the session
     */
    private $consulted_pages;

    /**
     * @var string $length
     * length of the session
     */
    private $length;

    /**
     * @var int $rebound
     * end of the session at the first page consulted
     * Sending 0 or 1 in the url
     */
    private $rebound;

    /**
     * @var string $date
     * dateTime of the session
     */
    private $date;


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
     * Get $consulted_pages
     *
     * @return  int
     */
    public function get_consulted_pages()
    {
        return $this->consulted_pages;
    }

    /**
     * Set $consulted_pages
     *
     * @param  int  $consulted_pages
     *
     * @return  self
     */
    public function set_consulted_pages(string $consulted_pages)
    {
        $this->consulted_pages = $consulted_pages;
        return $this;

    }

    /**
     * Get $length
     *
     * @return  string
     */
    public function get_length()
    {
        return $this->length;
    }

    /**
     * Set $length
     *
     * @param  string  $length
     *
     * @return  self
     */
    public function set_length(string $length)
    {
        $this->length = $length;
        return $this;

    }

    /**
     * Get $rebound
     *
     * @return 0 or 1
     */
    public function get_rebound()
    {
        return $this->rebound;
    }

    /**
     * Set $rebound
     * @param int $rebound
     * @return Session
     */
    public function setRebound(int $rebound)
    {

        $this->rebound = $rebound;
        return $this;

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

}
