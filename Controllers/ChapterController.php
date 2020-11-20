<?php
namespace Controllers;
use Controllers\Controller;

class ChapterController extends Controller{
    public function addChapter(){
        require ChapterManager.php;
    }

    public function listChapters(){
        $chapterManager = new ChapterManager(); // object creation
        $chapters = $chapterManager->getChapters(); // Call to a function of this object

        require $this->View('blog');
    }
}

?>
