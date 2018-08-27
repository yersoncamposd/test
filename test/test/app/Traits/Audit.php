<?php namespace App\Traits;

use Webpatser\Uuid\Uuid;

trait Audit {
  protected static function boot(){
    parent::boot();
    static::creating(function($model) {
      $model->{$model->getKeyName()} = Uuid::generate()->string;
      /*if(isset(auth()->user()->id)) {
        $model->usuario_creacion = '' . auth()->user()->colaborador_id;
      } else {
        $model->usuario_creacion = '';
      }*/
    });

    static::updating(function($model) {
      /*if(isset(auth()->user()->colaborador_id)) {
        $model->usuario_modificacion = '' . auth()->user()->colaborador_id;
      } else {
        $model->usuario_modificacion = '';
      }*/
    });
  }
}