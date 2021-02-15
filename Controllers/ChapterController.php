<?php

namespace Controllers;

use Controllers\Controller;
use Controllers\CommentController;

use Models\Chapter;
use Models\Comment;

class ChapterController extends Controller{
    // GETTERS
    public function getId(){
        $_VIEW['id'] = Chapter::getId();
    }

    public function getTitle(){
        $_VIEW['title'] = Chapter::getTitle();
    }

    public function getCreation_date(){
        $_VIEW['creation_date'] = Chapter::getCreation_date();
    }

    public function getChapter_image(){
        $_VIEW['chapter_image'] = Chapter::getChapter_image();
    }

    public function getContent(){
        $_VIEW['content'] = Chapter::getContent();
    }

    public function getPublished(){
        $_VIEW['published'] = Chapter::getPublished();
    }

    public function getDeleted(){
        $_VIEW['deleted'] = Chapter::getDeleted();
    }

    // SETTERS
    public function setId($id){
        Chapter::setId();
    }

    public function setTitle($title){
        Chapter::setTitle();
    }

    public function setContent($content){
        Chapter::setContent();
    }

    public function setCreation_date($creation_date){
        Chapter::setCreation_date();
    }

    public function setChapter_image($chapter_image){
        Chapter::setChapter_image();
    }

    public function setPublished($published){
        Chapter::setPublished();
    }

    public function setDeleted($deleted){
        Chapter::setDeleted();
    }


    static function uploadImage(){
        if ( 0 < $_FILES['file']['error'] ) {
            $apiResponse = [
                'JSON'=> [
                    'error'=> 'Une erreur est survenue lors de l\'envoi de l\'image'
                ],
                'code'=> 500
            ];
        }
        else {
            move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/Public/uploads/'. $_FILES['file']['name']);
            $apiResponse = [
                'JSON'=> [
                    'message'=> 'OK',
                    'url' => 'http://'.$_SERVER['SERVER_NAME'].'/Public/uploads/'.$_FILES['file']['name'],
                ],
                'code'=> 200
            ];

        }
        http_response_code($apiResponse['code']);
        echo(json_encode($apiResponse['JSON']));
    }

    static function addChapter($newChapter){
        $chapter = new Chapter($newChapter);
        return Chapter::addChapter($chapter);
    }

    static function createChapter(){
        if( isset($_POST['title']) && isset($_POST['content']) && isset($_POST['chapter_image']) ){
            $chapter['title'] = htmlspecialchars($_POST['title']);
            $chapter['content'] = htmlspecialchars($_POST['content']);
            $chapter['chapter_image'] = $_POST['chapter_image'];
            $apiResponse = [
                'JSON'=> [
                    'message' => 'OK'
                ],
                'code'=> 200
            ];
            http_response_code($apiResponse['code']);
            echo(json_encode($apiResponse['JSON']));
            chapterController::addChapter($chapter);
        }else{ // if one input is empty
            $apiResponse = [
                'JSON'=> [
                    'error'=> 'Missing title, content, picture or published value'
                ],
                'code'=> 400
            ];
            http_response_code($apiResponse['code']);
            echo(json_encode($apiResponse['JSON']));
        }
    }

    static function getPosted(){ //return published chapters
        $chapters = Chapter::getPosted(); // Call to a function of this object
        return $chapters;
    }

    static function getChaptersToPublish(){
        $chaptersToPublish = Chapter::getChaptersToPublish(); // Call to a function of this object
        $_VIEW['chaptersToPublish'] = $chaptersToPublish;
        return $chaptersToPublish;
    }

    static function getNumberOfChaptersToPublish(){
        $numberOfChaptersToPublish = Chapter::getNumberOfChaptersToPublish();
        return $numberOfChaptersToPublish;
    }

    static function getDeletedChapters(){
        $deletedChapters = Chapter::getDeletedChapters(); // Call to a function of this object
        $_VIEW['deletedChapters'] = $deletedChapters;
        return $deletedChapters;
    }

    static function getNumberOfDeletedChapters(){
        $numberOfDeletedChapters = Chapter::getNumberOfDeletedChapters();
        return $numberOfDeletedChapters;
    }

    static function get4lastChapters(){
        $lastChapters = Chapter::get4lastChapters(); // Call to a function of this object
        return $lastChapters;
    }

    static function getChapters(){ //return all chapters (deleted, published, non published...)
        $allChapters = Chapter::getChapters(); // Call to a function of this object
        return $allChapters;
    }

    static function getChapter($id){
        $chapter = Chapter::getChapter($id);
        return $chapter;
    }

    static function publishChapter(){
        Chapter::publishChapter(Chapter::getChapterById($_POST['id']));
        $apiResponse = [
            'JSON'=> [
                'message' => 'OK'
            ],
            'code'=> 200
        ];
        http_response_code($apiResponse['code']);
        echo(json_encode($apiResponse['JSON']));
        return;
    }

    static function deleteChapter(){
        Chapter::deleteChapter(Chapter::getChapterById($_POST['id']));
        $apiResponse = [
            'JSON'=> [
                'message' => 'OK'
            ],
            'code'=> 200
        ];
        http_response_code($apiResponse['code']);
        echo(json_encode($apiResponse['JSON']));
        return;
    }

    static function undeleteChapter(){
        Chapter::undeleteChapter(Chapter::getChapterById($_POST['id']));
        $apiResponse = [
            'JSON'=> [
                'message' => 'OK'
            ],
            'code'=> 200
        ];
        http_response_code($apiResponse['code']);
        echo(json_encode($apiResponse['JSON']));
        return;
    }

    static function updateChapter(){
        if( isset($_POST['title']) && isset($_POST['content']) && isset($_POST['chapter_image']) ){
            $chapter['title'] = htmlspecialchars($_POST['title']);
            $chapter['content'] = htmlspecialchars($_POST['content']);
            $chapter['chapter_image'] = $_POST['chapter_image'];
            $apiResponse = [
                'JSON'=> [
                    'message' => 'OK'
                ],
                'code'=> 200
            ];
            http_response_code($apiResponse['code']);
            echo(json_encode($apiResponse['JSON']));
            Chapter::updateChapter(Chapter::getChapterById($_POST['id']));
        }else{ // if one input is empty
            $apiResponse = [
                'JSON'=> [
                    'error'=> 'Missing title, content, picture or published value'
                ],
                'code'=> 400
            ];
            http_response_code($apiResponse['code']);
            echo(json_encode($apiResponse['JSON']));
        }
    }

    static function exists($id){
        return $_VIEW['chapterExists'] = Chapter::exists($id);
    }

    static function printLastChapters(){
        $lastChapters = static::getInstance()->get4lastChapters();
        $_VIEW['lastChapters'] = $lastChapters;
        return self::View('home', $_VIEW);
    }

    static function printBlog(){
        $chapters = static::getInstance()->getPosted();
        $_VIEW['chapters'] = $chapters;
        return self::View('blog', $_VIEW);
    }

    static function printChapter($id){
        $chapter = static::getInstance()->getChapter($id);
        $_VIEW['chapter'] = $chapter;
        $comments = CommentController::getComments($id);
        $_VIEW['comments'] = $comments;
        $commentsCount = CommentController::getNumberOfNonReportedComments($id);
        $_VIEW['commentsCount'] = $commentsCount;
        return self::View('chapitre', $_VIEW);
    }

    static function printAdmin(){
        $allChapters = static::getInstance()->getChapters();
        $_VIEW['allChapters'] = $allChapters;
        $numberOfChapters = Chapter::getNumberOfChapters();
        $_VIEW['numberOfChapters'] = $numberOfChapters;
        $numberOfDeletedChapters = static::getInstance()->getNumberOfDeletedChapters();
        $_VIEW['numberOfDeletedChapters'] = $numberOfDeletedChapters;
        $deletedChapters = static::getInstance()->getDeletedChapters();
        $_VIEW['deletedChapters'] = $deletedChapters;
        $numberOfChaptersToPublish = static::getInstance()->getNumberOfChaptersToPublish();
        $_VIEW['numberOfChaptersToPublish'] = $numberOfChaptersToPublish;
        $chaptersToPublish = static::getInstance()->getChaptersToPublish();
        $_VIEW['chaptersToPublish'] = $chaptersToPublish;
        $reportedComments = CommentController::getReported();
        $_VIEW['reportedComments'] = $reportedComments;
        $numberOfReportedComments = CommentController::getNumberOfReportedComments();
        $_VIEW['numberOfReportedComments'] = $numberOfReportedComments;
        return self::View('admin', $_VIEW);
    }
}

?>
