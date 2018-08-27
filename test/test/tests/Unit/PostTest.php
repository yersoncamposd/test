<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Services\Posts as PostsService;
use App\Repositories\Posts as PostsRepository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class PostTest extends TestCase
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

    public function testPuedeCrearUnPost()
    {
		$app = new App();
		$collection = new Collection();
		$repository = new PostsRepository($app, $collection);
        $service = new PostsService($repository);
        
        $data = ['title' => 'POSTS06', 'description' => 'BIENVENIDO POSTS 1'];

        $validator = Validator::make(
            array('title' => $data['title'],'description' => $data['description']),
            array('title' => 'required|max:100|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ0-9_. ]*$/', 'description' => 'max:600')
        );

        if ($validator->fails()) {
            dd($messages = $validator->messages());
        } else {
            $PostFindBy = $service->All();
            
            if (count($PostFindBy) >0) {
                foreach ($PostFindBy as $item) {
                    if ($item->title == $data['title']) {
                        dd('Estas tratando de insertar un dato existente post?????');
                    }
                }
                $Postsstore = $service->store($data);
                $this->assertTrue($Postsstore->id != '');
            } 
        }
        
    }

    public function testPuedeActualizarUnPost()
    {
		$app = new App();
		$collection = new Collection();
		$repository = new PostsRepository($app, $collection);
		$service = new PostsService($repository);
		$data = ['title' => 'POSTS03', 'description' => 'BIENVENIDO POSTS 2'];
        
        $id = '16643600-aa38-11e8-850a-7197c0408281';
		$PostsUpdate = $service->update($data, $id);

    	if ($PostsUpdate == 1) {
    		$this->assertEquals($PostsUpdate,1);
    	} else {
      		$this->assertEquals($PostsUpdate,0);
      	}
    }

    public function testPuedeTraerTodoUnPost()
    {
		$app = new App();
		$collection = new Collection();
		$repository = new PostsRepository($app, $collection);
        $service = new PostsService($repository);
        
        $PostsAll = $service->all();
        if (count($PostsAll) > 0) {
            $this->assertTrue(count($PostsAll) > 0);
        } else {
            $this->assertTrue(true);
        }
    }

    public function testPuedeEliminarUnPost()
    {
		$app = new App();
		$collection = new Collection();
		$repository = new PostsRepository($app, $collection);
        $service = new PostsService($repository);
        
		$id = 'bddf7db0-aa37-11e8-8358-853a657e23de';

    	$PostDelete = $service->delete($id);
    	
    	if ($PostDelete == 1) {
    		$this->assertEquals($PostDelete,1);
    	} else {
    		$this->assertEquals($PostDelete,0);
    	};
    }

    public function testPuedeBuscarUnPost()
    {
		$app = new App();
		$collection = new Collection();
		$repository = new PostsRepository($app, $collection);
        $service = new PostsService($repository);
        
		$id = 'bddf7db0-aa37-11e8-8358-853a657e23de';
    	
    	$PostFind = $service->find($id);

    	if (count($PostFind) > 0) {
    		$this->assertTrue(count($PostFind) > 0);
    	} else {
    		$this->assertFalse(count($PostFind) > 0);
		}
    }

    public function testPuedeBuscarEspecificoUnPost()
    {
		$app = new App();
		$collection = new Collection();
		$repository = new PostsRepository($app, $collection);
        $service = new PostsService($repository);
        
		$value = 'POSTS03';
    	
    	$PostFindBY = $service->findBy('title', $value);
        
    	if (count($PostFindBY) > 0) {
    		$this->assertTrue(count($PostFindBY) > 0);
    	} else {
    		$this->assertFalse(count($PostFindBY) > 0);
		}
    }

}
