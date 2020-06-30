<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    //url base
    //http://localhost/api_momento3/index.php/user
	public function index()
	{
		echo "index user controller";
    }
    public function validChr($str) {
        return preg_match('/^((?![(¡@#$%&?¿¡]).)*$/',$str);
    }
    public function validEmail($str) {
        return preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.+-]+(\.com|\.net)$/',$str);
    }
    public function validOnlyNumbers($str) {
        return preg_match('/^[0-9]*$/',$str);
    }
    public function validPass($str) {
        return preg_match('/^(?:[^¡@#$%&?¿¡*]*[¡@#$%&?¿¡*]){2}$/',$str);
    }
    
    #endpoint add product
    public function addUser(){
        $addUser = true;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method ==='POST'){
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            if($data->name == "")
            {
                $addUser = false;
                $response = array('response' =>'Empty spaces in name, please check');
                echo json_encode($response);
            }
            elseif(strlen($data->name) > 40){
                $addUser = false;
                $response = array('response' =>'Maximum 40 characters in name, please check');
                echo json_encode($response);
            }
            elseif($this->validChr($data->name)==false){
                $addUser = false;
                $response = array('response' =>'Invalid characters in name (¡, @, #, $, %, &, ?, ¿, ¡), please check');
                echo json_encode($response);
            }
            if($data->lastname == "")
            {
                $addUser = false;
                $response = array('response' =>'Empty spaces in lastname, please check');
                echo json_encode($response);
            }
            elseif(strlen($data->lastname) > 40){
                $addUser = false;
                $response = array('response' =>'Maximum 40 characters in lastname, please check');
                echo json_encode($response);
            }
            elseif($this->validChr($data->lastname)==false){
                $addUser = false;
                $response = array('response' =>'Invalid characters in lastname (¡, @, #, $, %, &, ?, ¿, ¡), please check');
                echo json_encode($response);
            }

            if($data->email == "")
            {
                $addUser = false;
                $response = array('response' =>'Empty spaces in email, please check');
                echo json_encode($response);
            }

            elseif($this->validEmail($data->email)==false){
                $addUser = false;
                $response = array('response' =>'Invalid email format(Must include @ /.com or .net), please check');
                echo json_encode($response);
            }

            if($data->type_id != "CC" && $data->type_id != "PAS")
            {
                $addUser = false;
                $response = array('response' =>'Invalid document type, only valid: CC or PAS, please check');
                echo json_encode($response);
            }

            if($data->type_id == "PAS" && strlen($data->identification) > 10)
            {
                $addUser = false;
                $response = array('response' =>'Maximum 10 numbers in PAS, please check');
                echo json_encode($response);
            }
            if($data->identification == "")
            {
                $addUser = false;
                $response = array('response' =>'Empty spaces in identification, please check');
                echo json_encode($response);
            }
            if($data->type_id == "CC" && $this->validOnlyNumbers($data->identification) == false)
            {
                $addUser = false;
                $response = array('response' =>'Only numbers in identification CC, please check');
                echo json_encode($response);
            }

            if(strlen($data->password) < 8 || strlen($data->password) > 16)
            {
                $addUser = false;
                $response = array('response' =>'Minimum 8 characters and maximum 16, please check');
                echo json_encode($response);
            }

            

            if($this->validPass($data->password) == false)
            {
                $addUser = false;
                $response = array('response' =>'Invalid password, must have at least two special characters (¡,@, #, $, %, &, ?, ¡, ¿, *) please check');
                echo json_encode($response);
            }


            if($addUser == true){
                $this->User_Model->addUser($data);
                header('content_type: aplication/json');
                $response = array('response' =>'User added successfully');
                echo json_encode($response);
            }
            //var_dump($data);
           
        }
        else{
            http_response_code(200);
            header('content_type: aplication/json');
            $response = array('response' =>'Bad request');
            echo json_encode($response);
        }
       
    }

    public function validUser(){
        header("Access-Control-Allow_Origin: *");     
        $method = $_SERVER['REQUEST_METHOD'];
        

        if($method ==='GET'){
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $user = new User;
            $user->email = $data->email;
            $user->password = $data->password;
            $validUser = $this->User_Model->validUser($user);
            
            if ($validUser == null)
            {

                $response = new stdClass();
                $response->success = false;
                $response->data = "";
                $response->error = new stdClass();
                $response->error->title = 'Incorrect data';
                $response->error->messagee = 'Invalid user';

                //$response = array('response' =>'Invalid User');
                //$response->success = "";
                //$response =  json_encode($object, JSON_FORCE_OBJECT);
                echo json_encode($response);
                
                

                
            }
            else{
                //$this->User_Model->validUser($user);
                header('content_type: aplication/json');
                $response = array('response' => 'Valid User');

                $response = new stdClass();
                $response->success = true;
                $response->data = $validUser;
                $response->error = new stdClass();
                $response->error->title = 'Valid user';
                $response->error->messagee = 'Welcome!!!';

                //$response = array('response' =>'Invalid User');
                //$response->success = "";
                //$response =  json_encode($object, JSON_FORCE_OBJECT);
                //echo json_encode($response);


                echo json_encode($response);
                
            }
        
        }

        
        else{
            http_response_code(200);
            header('content_type: aplication/json');
            $response = array('response' =>'Bad request');
            echo json_encode($response);
        }    
    }

    

}
