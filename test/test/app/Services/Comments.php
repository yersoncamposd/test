<?php
namespace App\Services;

use App\Repositories\Comments as CommentsRepository;

class Comments {
    protected $commentss;

    public function __construct(CommentsRepository $commentss) {
        $this->commentss = $commentss;
    }

    public function all() {
      return $this->commentss->all();
    }

    public function store($data){
        return $this->commentss->create($data);
    }

    public function update($data, $id){
        return $this->commentss->update($data, $id);
    }

    public function delete($id){
        return $this->commentss->delete($id);
    }

    public function paginate($perPage = 15, $columns = array('*'), $order_type = 'desc') {
        return $this->commentss->paginate($perPage, $columns, $order_type);
    }

    public function find($id, $columns = array('*')) {
        return $this->commentss->find($id, $columns);
    }

    public function findBy($field, $value, $columns = array('*')) {
        return $this->commentss->findBy($field, $value, $columns);
    }
}