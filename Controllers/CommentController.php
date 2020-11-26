<?php
namespace Controllers;
use Controllers\Controller;

class CommentController extends Controller{
    public function commentReported(){
        $comment = new Comment();
        if(!empty($_GET['comment']) && !empty($_GET['chapter']) && $_GET['report'] == 1){
            $newComment = new Comment([
                'id' => $_GET['comment']
            ]);
            $comment->report($newComment);
            header('Location: index.php?action=view&id=' .$_GET['chapter'] . '#comments');
            exit();
        }
    }

    public function getComments($chapter_id){
        Comment::getComments($chapter_id);
    }

    public function deleteComment($comment){
        Comment::deleteComment($comment);
    }
}

?>
