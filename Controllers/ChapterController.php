<?php

namespace Controllers;

use Controllers\Controller;

use Models\Chapter;
use Models\Comment;

class ChapterController extends Controller{
    public function addChapter(){
        $chapter = new Chapter();
        $newChapter = Chapter::addChapter($chapter);
    }

    public function listChapters(){
        $chapters = Chapter::getPosted(); // Call to a function of this object
        $_VIEW['chapters'] = $chapters;
        require $this->View('blog');
    }
}

?>
