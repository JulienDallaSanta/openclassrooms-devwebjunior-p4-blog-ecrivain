<?php

namespace Controllers;

use Controllers\Controller;

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

    public function getPreview(){
        $_VIEW['preview'] = Chapter::getPreview();
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

    public function setPreview($preview){
        Chapter::setPreview();
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


    public function addChapter(){
        $chapter = new Chapter();
        return $_VIEW['newChapter'] = Chapter::addChapter($chapter);
    }

    static function getPosted(){
        $chapters = Chapter::getPosted(); // Call to a function of this object
        return $chapters;
    }

    public function getChapters(){
        $Chapters = Chapter::getChapters(); // Call to a function of this object
        $_VIEW['allChapters'] = $Chapters;
        require $this->View('admin');
    }

    public function getChapter($id){
        return $_VIEW['chapter'] = Chapter::getChapter($id);
    }

    public function deleteChapter($chapter){
        return $_VIEW['deleteChapter'] = Chapter::deleteChapter($chapter);
    }

    public function undeleteChapter($chapter){
        return $_VIEW['undeleteChapter'] = Chapter::undeleteChapter($chapter);
    }

    public function updateChapter($chapter){
        return $_VIEW['updateChapter'] = Chapter::updateChapter($chapter);
    }

    public function exists($id){
        return $_VIEW['chapterExists'] = Chapter::exists($id);
    }

    static function printBlog(){
        $chapters = self::getInstance()->getPosted();
        $_VIEW['chapters'] = $chapters;
        return self::View('blog', $_VIEW);
    }
}

?>
