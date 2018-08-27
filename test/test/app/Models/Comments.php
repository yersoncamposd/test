<?php namespace App\Models;

use App\Traits\Audit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model {
  use Audit;
  Use SoftDeletes;

  public $incrementing = false;
  public $table = 'comments';
  public $hidden = [
      'created_at',
      'updated_at',
      'deleted_at'
  ];
  protected $dates = ['deleted_at'];

  public $fillable = [
    'id',
    'subject',
    'menssage',
    'post_id'
  ];
}