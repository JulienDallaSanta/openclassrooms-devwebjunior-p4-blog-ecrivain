<?php
namespace Controllers;
use Controllers\Controller;

class PageController extends Controller{
    function printHome(){
        return $this->View('home');
    }
    function printBiography(){
        return $this->View('biography');
    }
    function printBlog(){
        $chapter = new Chapter();
        // get published chapters, order by date of creation
        $chapters = $chapter->getPosted();
        require $this->View('blog');
    }
    function printChapter(){
        $chapterManager = new ChapterManager();
        // get published chapters, order by date of creation
        $chapter = $chapterManager->getChapter($id);
        return $chapter;
    }
    function printAdmin(){
        return $this->View('admin');
    }
}
?>
