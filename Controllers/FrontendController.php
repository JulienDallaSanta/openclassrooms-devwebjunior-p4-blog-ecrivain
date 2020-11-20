<?php
namespace Controllers;
use Controllers\Controller;

class FrontendController extends Controller{
    // pages are methods
    function printHome(){
        return $this->View('home');
    }
    function printBiography(){
        return $this->View('biography');
    }
    function printBlog(){
        $chapterManager = new ChapterManager();
        // get published chapters, order by date of creation
        $chapters = $chapterManager->getPosted();
        return $this->View('blog');
    }
    function printChapter(){
        $chapterManager = new ChapterManager();
        $commentManager = new CommentManager();

        // if a comment is signaled

        return $this->View('chapitre');
    }
    function printAdmin(){
        return $this->View('admin');
    }


}

?>
