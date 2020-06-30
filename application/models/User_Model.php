<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model {

    public function addUser($user){
        $this->db->insert("users", $user);
    }
    
    public function getUsers(){
        $reponse = $this->db->query("SELECT * FROM users")->result();
        return $reponse;
    }

    public function updateUser($user){
        $name = $user->name;
        $lastname = $user->lastname;
        $email = $user->email;
        $type_id = $user->type_id;
        $identification = $user->identification;
        $password = $user->password;
        $id = $user->id;
    $reponse = $this->db->query("UPDATE  users SET name='${name}', lastname='${lastname}', email='${email}', type_id='${type_id}', identification ='${identification}', password='${password}' WHERE id ={$id}");
        return $reponse;
    }

    public function deleteUser($id){
    $response = $this->db->query("DELETE FROM users WHERE id ={$id->id}");
    }

    public function validUser($user){
    $response = $this->db->query("SELECT * FROM users WHERE email ='{$user->email}' AND password = '{$user->password}'")->result();
        return $response;
    

    }

    
}
