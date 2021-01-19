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
        Comment::setId();
    }

    public function setChapter_id($chapter_id){
        Comment::setChapter_id();
    }

    public function setPseudo($pseudo){
        Comment::setPseudo();
    }

    public function setCreation_date($creation_date){
        Comment::setCreation_date();
    }

    public function setContent($content){
        Comment::setContent();
    }

    public function setReport($report){
        Comment::setReport();
    }

    public function setReport_date($report_date){
        Comment::setReport_date();
    }


    static function addComment($newComment){
        $comment = new Comment($newComment);
        return Comment::addComment($comment);
    }

    static function createComment(){
        var_dump($_POST);
        if( isset($_POST['pseudo']) && isset($_POST['comment']) && isset($_POST['chapter_id']) ){
            $newComment['pseudo'] = htmlspecialchars($_POST['pseudo']);
            $newComment['content'] = htmlspecialchars($_POST['comment']);
            $rawPath = $_SERVER['REQUEST_URI'];
            $newComment['chapter_id'] = $_POST['chapter_id'];
            $apiResponse = [
                'JSON'=> [
                    'message' => 'OK'
                ],
                'code'=> 200
            ];
            http_response_code($apiResponse['code']);
            echo(json_encode($apiResponse['JSON']));
            CommentController::addComment($newComment);
        }else{ // if one input is empty
            $apiResponse = [
                'JSON'=> [
                    'error'=> 'Missing pseudo or comment'
                ],
                'code'=> 400
            ];
            http_response_code($apiResponse['code']);
            echo(json_encode($apiResponse['JSON']));
        }
    }

    /**
     * @param int $commentId
     */
    static function report(){
        $apiResponse = [
            'JSON'=> [
                'message' => 'OK'
            ],
            'code'=> 200
        ];
        http_response_code($apiResponse['code']);
        echo(json_encode($apiResponse['JSON']));
        Comment::report(Comment::getCommentById($_POST['id']));
        return;
    }

    // public function unreport(){
    //     $comment = new Comment();
    //     if(!empty($_GET['comment']) && !empty($_GET['chapter']) && $_GET['report'] == 1){
    //         $newComment = new Comment(['id' => $_GET['comment']]);
    //         $comment->unreport($newComment);
    //         header('Location: index.php?action=view&id=' .$_GET['chapter'] . '#comments');
    //         exit();
    //     }
    // }

    static function getComments($chapter_id){
        $comments = Comment::getComments($chapter_id);
        return $comments;
    }

    static function getNumberOfComments($chapter_id){
        $numberOfComments = Comment::getNumberOfComments($chapter_id);
        return $numberOfComments;
    }
    static function getReported(){
        $reportedComments = Comment::getReported();
        return $reportedComments;
    }

    static function getNumberOfReportedComments(){
        $numberOfReportedComments = Comment::getNumberOfReportedComments();
        return $numberOfReportedComments;
    }

    static function getNumberOfNonReportedComments($chapter_id){
        $numberOfNonReportedComments = Comment::getNumberOfNonReportedComments($chapter_id);
        return $numberOfNonReportedComments;
    }

    public function deleteComment($comment){
        Comment::deleteComment($comment);
    }
}

?>
