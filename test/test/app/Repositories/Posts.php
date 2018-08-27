<?php namespace App\Repositories;

use App\Repositories\Eloquent\Repository;

class Posts extends Repository {

  function model()
  {
    return 'App\Models\Posts';
  }
}