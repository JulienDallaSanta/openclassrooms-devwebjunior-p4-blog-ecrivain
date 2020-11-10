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
}
?>
