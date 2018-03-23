<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: root
 * Date: 03.03.18
 * Time: 20:48
 */

class Parking_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_client()
    {
        $data = [
            'full_name' => $this->input->post('full_name', TRUE),
            'gender' => $this->input->post('gender', TRUE),
            'phone' => $this->input->post('phone', TRUE),
            'address' => $this->input->post('address', TRUE)
        ];
        $this->db->insert('clients', $data);
        return $this->db->insert_id();
    }

    public function add_car($client_id){
        //var_dump($this->input->post('new_car'));
        $data = ['client_id' => $client_id, 'status' => 0];
        $data += $this->input->post('new_car', TRUE);
        $this->db->insert('cars', $data);
        return $this->db->insert_id();
    }

    public function get_client($id){
        $query = $this->db->get_where('clients', ['id' => $id]);
        return $query->row_array();
    }

    public function get_clients(){
        $query = $this->db->get('clients');
        return $query->result_array();
    }

    public function get_clients_cars($offset = NULL, $count){
        $query = $this->db->select('full_name, label, model, color, reg_plate, clients.id as client_id, cars.id')->from('cars')
            ->join('clients', 'clients.id = cars.client_id', 'right')
            ->limit($count, $offset)->get();
        return $query->result_array();
    }

    public function get_cars($client_id){
        $query = $this->db->get_where('cars', ['client_id' => $client_id]);
        return $query->result_array();
    }

    public function get_parked($offset = NULL, $count){
        $query = $this->db->select('full_name, label, model, color, reg_plate, client_id, cars.id')->from('cars')
            ->join('clients', 'clients.id = cars.client_id')->where(['status' => 1])
            ->limit($count, $offset)->get();
        return $query->result_array();
    }

    public function save_client($id){
        $data = [
            'full_name' => $this->input->post('full_name', TRUE),
            'gender' => $this->input->post('gender', TRUE),
            'phone' => $this->input->post('phone', TRUE),
            'address' => $this->input->post('address', TRUE)
        ];
        $this->db->update('clients', $data, ['id' => $id]);
    }

    public function save_cars(){
        if ($this->input->post('car'))
        {
            $cars = $this->input->post('car', TRUE);
            foreach ($cars as $car_id => $car) $this->db->update('cars', $car, ['id' => $car_id]);
        }
    }

    public function park(){
        $id = $this->input->post('car');
        $this->db->update('cars', ['status' => 1], ['id' => $id]);
    }

    public function unpark($id){
        $this->db->update('cars', ['status' => 0], ['id' => $id]);
    }
}