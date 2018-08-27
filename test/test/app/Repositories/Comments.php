<?php namespace App\Repositories;

use App\Repositories\Eloquent\Repository;

class Comments extends Repository {

  function model()
  {
    return 'App\Models\Comments';
  }
}