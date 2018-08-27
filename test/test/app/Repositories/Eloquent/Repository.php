<?php namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\Repository as RepositoryInterface;
use App\Repositories\Criteria\Criteria;
use App\Repositories\Criteria\CriteriaInterface;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

abstract class Repository implements RepositoryInterface, CriteriaInterface {
  private $app;
  public $model;
  protected $criteria;
  protected $skipCriteria = false;

  public function __construct(App $app, Collection $collection)
  {
    $this->app = $app;
    $this->criteria = $collection;
    $this->resetScope();
    $this->makeModel();
  }

  abstract function model();


  public function all($columns = array('*'))
  {
    $this->applyCriteria();
    return $this->model->get($columns);
  }

  public function paginate($perPage = 15, $columns = array('*'), $order_type = 'desc')
  {
    $this->applyCriteria();
    return $this->model->paginate($perPage, $columns);
  }

  public function create(array $data)
  {
    return $this->model->create($data);
  }

  public function update(array $data, $id, $attribute = 'id')
  {
    return $this->model->where($attribute, '=', $id)->update($data);
  }

  public function delete($id)
  {
    return $this->model->destroy($id);
  }

  public function find($id, $columns = array('*'))
  {
    $this->applyCriteria();
    return $this->model->find($id, $columns);
  }

  public function findBy($field, $value, $columns = array('*'))
  {
    $this->applyCriteria();
    return $this->model->where($field, '=', $value)->first();
  }

  public function makeModel() {
    $model = $this->app->make($this->model());

    if(!$model instanceof Model) {
      throw new Exception("Class {$this->model()} must be a instance of Illuminate\\Database\\Eloquent\\Model");
    }
    return $this->model = $model;
  }

  public function resetScope() {
    $this->skipCriteria(false);
    return $this;
  }

  public function skipCriteria($status = true)
  {
    $this->skipCriteria = $status;
    return $this;
  }

  public function getCriteria()
  {
    return $this->criteria;
  }

  public function getByCriteria(Criteria $criteria)
  {
    $this->model = $criteria->apply($this->model, $this);
    return $this;
  }

  public function pushCriteria(Criteria $criteria)
  {
    $this->criteria->push($criteria);
    return $this;
  }

  public function applyCriteria()
  {
    if($this->skipCriteria === true)
      return $this;

    foreach ($this->getCriteria() as $criteria) {
      if($criteria instanceof Criteria)
        $this->model = $criteria->apply($this->model, $this);
    }

    return $this;
  }
}