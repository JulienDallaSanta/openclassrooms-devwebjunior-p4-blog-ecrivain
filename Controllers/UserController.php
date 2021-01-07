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

    static function message(){
        if( isset($_POST['name']) && isset($_POST['firstName']) && isset($_POST['email']) && isset($_POST['object']) && isset($_POST['message']) ){
            $regex = '/^[^\W][a-zA-Z0-9\-\._]+[^\W]@[^\W][a-zA-Z0-9\-\._]+[^\W]\.[a-zA-Z]{2,6}$/';
            if(preg_match($regex, $_POST['email'])){ // Si l'email est valide...
                $mailContact['name'] = htmlspecialchars($_POST['name']);
                $mailContact['firstName'] = htmlspecialchars($_POST['firstName']);
                $mailContact['email'] = $_POST['email'];
                $mailContact['object'] = htmlspecialchars($_POST['object']);
                $mailContact['message'] = htmlspecialchars($_POST['message']);
                $apiResponse = [
                    'JSON'=> [
                        'message' => 'OK'
                    ],
                    'code'=> 200
                ];
                http_response_code($apiResponse['code']);
                echo(json_encode($apiResponse['JSON']));
            }else{
                $apiResponse = [
                    'JSON'=> [
                        'error' => 'Invalid email'
                    ],
                    'code'=> 401
                ];
                http_response_code($apiResponse['code']);
                echo(json_encode($apiResponse['JSON']));
            }
        }
        else{ // if one input is empty
            $apiResponse = [
                'JSON'=> [
                    'error'=> 'Missing name or firstname or email or object or message'
                ],
                'code'=> 400
            ];
            http_response_code($apiResponse['code']);
            echo(json_encode($apiResponse['JSON']));
        }
    }
}

?>
