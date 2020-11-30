<?php

namespace Controllers;

use Controllers\Controller;

use Models\Chapter;
use Models\Comment;

class CommentController extends Controller{
    // GETTERS
    public function getId(){
        $_VIEW['id'] = Comment::getId();
    }

    public function chapter_id(){
        $_VIEW['chapter_id'] = Comment::chapter_id();
    }

    public function getPseudo(){
        $_VIEW['pseudo'] = Comment::getPseudo();
    }

    public function getCreation_date(){
        $_VIEW['creation_date'] = Comment::getCreation_date();
    }

    public function getReport(){
        $_VIEW['report'] = Comment::getReport();
    }

    public function getReport_date(){
        $_VIEW['report_date'] = Comment::getReport_date();
    }

    // SETTERS
    public function setId($id){
        Comment::getId();
    }

    public function setChapter_id($chapter_id){
        Comment::chapter_id();
    }

    public function setPseudo($pseudo){
        Comment::getPseudo();
    }

    public function setCreation_date($creation_date){
        Comment::getCreation_date();
    }

    public function setContent($content){
        Comment::setContent();
    }

    public function setReport($report){
        Comment::getReport();
    }

    public function setReport_date($report_date){
        Comment::getReport_date();
    }


    public function addComment(){
        $comment = new Comment();
        return $_VIEW['newComment'] = Chapter::addComment($comment);
    }

    public function report(){
        $comment = new Comment();
        if(!empty($_GET['comment']) && !empty($_GET['chapter']) && $_GET['report'] == 1){
            $newComment = new Comment(['id' => $_GET['comment']]);
            $comment->report($newComment);
            header('Location: index.php?action=view&id=' .$_GET['chapter'] . '#comments');
            exit();
        }
    }

    public function getComments($chapter_id){
        return $_VIEW['comments'] = Comment::getComments($chapter_id);
    }

    public function deleteComment($comment){
        Comment::deleteComment($comment);
    }
}

?>
