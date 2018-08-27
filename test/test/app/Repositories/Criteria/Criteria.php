<?php namespace App\Repositories\Criteria;

use App\Repositories\Contracts\Repository as RepositoryInterface;

abstract class Criteria {
  public abstract function apply($model, RepositoryInterface $repository);
}