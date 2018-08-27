<?php
namespace App\Services;

use App\Repositories\Posts as PostsRepository;

class Posts {
    protected $postss;

    public function __construct(PostsRepository $postss) {
        $this->postss = $postss;
    }

    public function all() {
      return $this->postss->all();
    }

    public function store($data){
        return $this->postss->create($data);
    }

    public function update($data, $id){
        return $this->postss->update($data, $id);
    }

    public function delete($id){
        return $this->postss->delete($id);
    }

    public function paginate($perPage = 15, $columns = array('*'), $order_type = 'desc') {
        return $this->postss->paginate($perPage, $columns, $order_type);
    }

    public function find($id, $columns = array('*')) {
        return $this->postss->find($id, $columns);
    }

    public function findBy($field, $value, $columns = array('*')) {
        return $this->postss->findBy($field, $value, $columns);
    }
}