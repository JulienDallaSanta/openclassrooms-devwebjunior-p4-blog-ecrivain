<?php

namespace Controllers;

use Controllers\Controller;
use Controllers\ChapterController;
use Controllers\CommentController;
use Controllers\UserController;

use Models\Admin;

class AdminController extends Controller{
    public function getChapters(){
        $chapters = ChapterController::getChapters();
    }

    public function addChapter($chapter){
        ChapterController::addChapter($chapter);
    }

    public function deleteChapter($chapter){
        ChapterController::deleteChapter($chapter);
    }

    public function undeleteChapter($chapter){
        ChapterController::undeleteChapter($chapter);
	}

    public function getChapterWithComments($id){
        // return a list of all comments with the chapter's title
        $chapter = ChapterController::getChapter($id);
        $chapterTitle = $chapter->getTitle();
        $comments = CommentController::getComments($id);
        $_VIEW['chapterTitle'] = $chapterTitle;
        $_VIEW['comments'] =  $comments;
        require $this->View('admin');
    }

    public function unreport($comment){
        CommentController::setReport(0, $comment->getId());
    }

    public function deleteComment($comment){
        CommentController::deleteComment($comment);
    }

    static function printAdmin(){
        return self::View('admin');
    }
}

?>
