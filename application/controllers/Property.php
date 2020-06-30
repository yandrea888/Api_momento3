<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Property extends CI_Controller {

    //url base
    //http://localhost/api_momento3/index.php/property
	public function index()
	{
		echo "index property controller";
    }
    public function validOnlyNumbers($str) {
        return preg_match('/^[0-9]*$/',$str);
    }
    #endpoint add Property
    public function addProperty(){
        $addProperty = true;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method ==='POST'){
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            if($data->title == "")
            {
                $addProperty = false;
                $response = array('response' =>'Empty spaces in title, please check');
                echo json_encode($response);
            }
            if($data->type == ""){
                $addProperty = false;
                $response = array('response' =>'Empty spaces in type, please check');
                echo json_encode($response);
            }
            if($data->type != "house" && $data->type != "room" && $data->type != "hostel")
            {
                $addProperty = false;
                $response = array('response' =>'Type of housing not admitted, only valid: house/room/hostel');
                echo json_encode($response);
            }
            if($data->addresses == ""){
                $addProperty = false;
                $response = array('response' =>'Empty spaces in addresses, please check');
                echo json_encode($response);
            }
            if($data->rooms == ""){
                $addProperty = false;
                $response = array('response' =>'Empty spaces in rooms, please check');
                echo json_encode($response);
            }
            if($this->validOnlyNumbers($data->rooms) == false){
                $addProperty = false;
                $response = array('response' =>'Only numbers in rooms, please check');
                echo json_encode($response);
            }
            if($data->price == ""){
                $addProperty = false;
                $response = array('response' =>'Empty spaces in price, please check');
                echo json_encode($response);
            }
            if($this->validOnlyNumbers($data->price) == false){
                $addProperty = false;
                $response = array('response' =>'Only numbers in price, please check');
                echo json_encode($response);
            }
            if($data->area == ""){
                $addProperty = false;
                $response = array('response' =>'Empty spaces in area, please check');
                echo json_encode($response);
            }
            if($this->validOnlyNumbers($data->area) == false){
                $addProperty = false;
                $response = array('response' =>'Only numbers in area, please check');
                echo json_encode($response);
            }
            if($addProperty == true){
                $this->Property_Model->addProperty($data);
                header('content_type: aplication/json');
                $response = array('response' =>'Property added successfully');
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

    public function getProperties()
    {
        header("Access-Control-Allow_Origin: *");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method ==='GET'){
            $properties = $this->Property_Model->getProperties();
            //var_dump($properties);
            // http_response_code(200);
            header('content_type: aplication/json');
            $response = array('properties' =>$properties, "status"=> true);
            echo json_encode($response);
        }
        else{
            http_response_code(200);
            header('content_type: aplication/json');
            $response = array('properties' =>[], "status"=> false);
            echo json_encode($response);
        }
    }

    public function updateProperty(){
        $updateProperty = true;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method ==='PUT'){
            $json = file_get_contents('php://input');
            $data = json_decode($json);

            if($data->title == "")
            {
                $updateProperty = false;
                $response = array('response' =>'Empty spaces in title, please check');
                echo json_encode($response);
            }
            if($data->type == ""){
                $updateProperty = false;
                $response = array('response' =>'Empty spaces in type, please check');
                echo json_encode($response);
            }
            if($data->type != "house" && $data->type != "room" && $data->type != "hostel")
            {
                $updateProperty = false;
                $response = array('response' =>'Type of housing not admitted, only valid: house/room/hostel');
                echo json_encode($response);
            }
            if($data->addresses == ""){
                $updateProperty = false;
                $response = array('response' =>'Empty spaces in addresses, please check');
                echo json_encode($response);
            }
            if($data->rooms == ""){
                $updateProperty = false;
                $response = array('response' =>'Empty spaces in rooms, please check');
                echo json_encode($response);
            }
            if($this->validOnlyNumbers($data->rooms) == false){
                $updateProperty = false;
                $response = array('response' =>'Only numbers in rooms, please check');
                echo json_encode($response);
            }
            if($data->price == ""){
                $updateProperty = false;
                $response = array('response' =>'Empty spaces in price, please check');
                echo json_encode($response);
            }
            if($this->validOnlyNumbers($data->price) == false){
                $updateProperty = false;
                $response = array('response' =>'Only numbers in price, please check');
                echo json_encode($response);
            }
            if($data->area == ""){
                $updateProperty = false;
                $response = array('response' =>'Empty spaces in area, please check');
                echo json_encode($response);
            }
            if($this->validOnlyNumbers($data->area) == false){
                $updateProperty = false;
                $response = array('response' =>'Only numbers in area, please check');
                echo json_encode($response);
            }
            if($updateProperty == true){
               $this->Property_Model->updateProperty($data); 
            http_response_code(200);
            header('content_type: aplication/json');
            $response = array('response' =>'Property update successfully');
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

    public function deleteProperty(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method ==='DELETE'){
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $this->Property_Model->deleteProperty($data); 
            http_response_code(200);
            header('content_type: aplication/json');
            $response = array('response' =>'Property removed successfully');
            echo json_encode($response);
        }
        else{
            http_response_code(200);
            header('content_type: aplication/json');
            $response = array('response' =>'Bad request');
            echo json_encode($response);
        };
    }

    public function getSortedProperties()
    {
        header("Access-Control-Allow_Origin: *");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method ==='GET'){
            $properties = $this->Property_Model->getSortedProperties(
        );
            //var_dump($properties);
            // http_response_code(200);
            header('content_type: aplication/json');
            $response = array('properties' => $properties, "status"=> true);
            echo json_encode($response);
        }
        else{
            http_response_code(200);
            header('content_type: aplication/json');
            $response = array('properties' =>[], "status"=> false);
            echo json_encode($response);
        }
    }



}
