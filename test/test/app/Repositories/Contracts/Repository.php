<?php namespace App\Repositories\Contracts;

interface Repository {
  public function all($columns = array('*'));
  public function paginate($perPage = 15, $columns = array('*'), $order_type = 'desc');
  public function create(array $data);
  public function update(array $data, $id);
  public function delete($id);
  public function find($id, $columns = array('*'));
  public function findBy($field, $value, $columns = array('*'));
}