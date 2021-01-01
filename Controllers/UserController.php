<?php
namespace Controllers;
use Controllers\Controller;

class UserController extends Controller{
    static function login(){
        $username = "Admin";
        $password = "Admin1806";
        if( isset($_POST['username']) && isset($_POST['password']) ){
            if($_POST['username'] == $username && $_POST['password'] == $password){ // Si les infos correspondent...
                $_SESSION['username'] = $username;
                $_SESSION['grade'] = 'admin';
                $apiResponse = [
                    'JSON'=> [
                        'message' => 'OK'
                    ],
                    'code'=> 200
                ];
                http_response_code($apiResponse['code']);
                echo(json_encode($apiResponse['JSON']));
            }
            else{ // Sinon
                $apiResponse = [
                    'JSON'=> [
                        'error' => 'Invalid username or password'
                    ],
                    'code'=> 401
                ];
                http_response_code($apiResponse['code']);
                echo(json_encode($apiResponse['JSON']));
            }
        }else{
            $apiResponse = [
                'JSON'=> [
                    'error'=> 'Missing username or password'
                ],
                'code'=> 400
            ];
            http_response_code($apiResponse['code']);
            echo(json_encode($apiResponse['JSON']));
        }
    }
    static function logout(){
        $_SESSION['username'] = null;
        $_SESSION['grade'] = null;
        session_destroy();
    }
}

?>
