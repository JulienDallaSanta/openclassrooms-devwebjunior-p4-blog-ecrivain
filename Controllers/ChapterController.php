<?php

namespace Controllers;

use Controllers\Controller;

use Models\Chapter;
use Models\Comment;

class ChapterController extends Controller{
    public function addChapter(){
        $chapter = new Chapter();
        return $newChapter = Chapter::addChapter($chapter);
    }

    public function listChapters(){
        $chapters = Chapter::getPosted(); // Call to a function of this object
        $_VIEW['chapters'] = $chapters;
        require $this->View('blog');
    }

    public function getChapters(){
        $Chapters = Chapter::getChapters(); // Call to a function of this object
        $_VIEW['allChapters'] = $Chapters;
        require $this->View('admin');
    }

    public function getChapter($id){
        Chapter::getChapter($id);
    }

    public function deleteChapter($chapter){
        Chapter::deleteChapter($chapter);
    }

    public function undeleteChapter($chapter){
        Chapter::undeleteChapter($chapter);
    }
}

?>
