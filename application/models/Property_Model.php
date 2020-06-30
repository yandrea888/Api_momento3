<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Property_Model extends CI_Model {

    public function addProperty($Property){
        $this->db->insert("properties", $Property);
    }
    
    public function getProperties(){
        $reponse = $this->db->query("SELECT * FROM properties ")->result();
        return $reponse;
    }

    public function updateProperty($Property){
        $title = $Property->title;
        $type = $Property->type;
        $addresses = $Property->addresses;
        $rooms = $Property->rooms;
        $price = $Property->price;
        $area = $Property->area;
        $id_property = $Property->id_property;
    $reponse = $this->db->query("UPDATE  properties SET title='${title}', type='${type}', addresses='${addresses}', rooms ='${rooms}', price='${price}', area='${area}'WHERE id_property ={$id_property}");
        return $reponse;
    }

    public function deleteProperty($id_property){
    $response = $this->db->query("DELETE FROM properties WHERE id_property ={$id_property->id_property}");
    }

    public function getSortedProperties(){
        $reponse = $this->db->query("SELECT * FROM properties  ORDER BY price "
        )->result();
        return $reponse;
     }

}
