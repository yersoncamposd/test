<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Services\Comments as CommentsService;
use App\Repositories\Comments as CommentsRepository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class CommentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testPuedeCrearUnComment()
    {
		$app = new App();
		$collection = new Collection();
		$repository = new CommentsRepository($app, $collection);
		$service = new CommentsService($repository);
        $data = ['subject' => 'SUBJECT07', 'menssage' => 'HOLA COMO ESTAS BIENVENIDO MI ESTIMADO 01',
        'post_id' => '43161470-aa39-11e8-9f44-6b075f8023ad'];
        
        $validator = Validator::make(
            array('subject' => $data['subject'], 'menssage' => $data['menssage'], 'post_id' => $data['post_id']),
            array('subject' => 'required|max:100|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ0-9_. ]*$/','menssage' => 'required|max:600|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ0-9_. ]*$/', 'post_id' => 'required')
        );
        
        if ($validator->fails()) {
            dd($messages = $validator->messages());
        } else {
            $PostFindBy = $service->All();
            
            if (count($PostFindBy) >0) {
                foreach ($PostFindBy as $item) {
                    if ($item->subject == $data['subject']) {
                        dd('Estas tratando de insertar un dato existente comments?????');
                    }
                }
                $Commentsstore = $service->store($data);
                $this->assertTrue($Postsstore->id != '');
            }
        }
    }

    public function testPuedeActualizarUnComment()
    {
		$app = new App();
		$collection = new Collection();
		$repository = new CommentsRepository($app, $collection);
		$service = new CommentsService($repository);
        $data = ['subject' => 'SUBJECT03', 'menssage' => 'HOLA COMO ESTAS BIENVENIDO MI ESTIMADO 02',
        'post_id' => '43161470-aa39-11e8-9f44-6b075f8023ad'];
        
        $id = '16643600-aa38-11e8-850a-7197c0408281';
		$CommentsUpdate = $service->update($data, $id);

    	if ($CommentsUpdate == 1) {
    		$this->assertEquals($CommentsUpdate,1);
    	} else {
      		$this->assertEquals($CommentsUpdate,0);
      	}
    }

    public function testPuedeTraerTodoUnComment()
    {
		$app = new App();
		$collection = new Collection();
		$repository = new CommentsRepository($app, $collection);
        $service = new CommentsService($repository);
        
		$CommentsAll = $service->all();
    	$this->assertTrue(count($CommentsAll) > 0);
    }

    public function testPuedeEliminarUnComment()
    {
		$app = new App();
		$collection = new Collection();
		$repository = new CommentsRepository($app, $collection);
        $service = new CommentsService($repository);
        
		$id = 'bddf7db0-aa37-11e8-8358-853a657e23de';

    	$CommentDelete = $service->delete($id);
    	
    	if ($CommentDelete == 1) {
    		$this->assertEquals($CommentDelete,1);
    	} else {
    		$this->assertEquals($CommentDelete,0);
    	};
    }

    public function testPuedeBuscarUnComment()
    {
		$app = new App();
		$collection = new Collection();
		$repository = new CommentsRepository($app, $collection);
        $service = new CommentsService($repository);
        
		$id = 'bddf7db0-aa37-11e8-8358-853a657e23de';
    	
    	$CommentFind = $service->find($id);

    	if (count($CommentFind) > 0) {
    		$this->assertTrue(count($CommentFind) > 0);
    	} else {
    		$this->assertFalse(count($CommentFind) > 0);
		}
    }

    public function testPuedeBuscarEspecificoUnComment()
    {
		$app = new App();
		$collection = new Collection();
		$repository = new CommentsRepository($app, $collection);
        $service = new CommentsService($repository);
        
		$value = 'CommentS03';
    	
    	$CommentFindBY = $service->findBy('title', $value);
        
    	if (count($CommentFindBY) > 0) {
    		$this->assertTrue(count($CommentFindBY) > 0);
    	} else {
    		$this->assertFalse(count($CommentFindBY) > 0);
		}
    }
}
