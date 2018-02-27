<?php
namespace App\Controller\Api;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\Association;
use Cake\Utility\Inflector;
use RuntimeException;

class AppController extends Controller
{

    use \Crud\Controller\ControllerTrait;

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Crud.Crud', [
            'actions' => [
		//'Crud.Index',
                'index' => ['className' => '\App\Crud\Action\FullIndexAction'],
                'Crud.View',
                'Crud.Add',
                'Crud.Edit',
                'Crud.Delete',
                'list' => ['className' => '\App\Crud\Action\ListAction'],
            ],
            'listeners' => [
                'Crud.Api',
                'Crud.ApiPagination',
                'Crud.ApiQueryLog'
            ]
        ]);
        $this->loadComponent('Auth', [
//            'storage' => 'Memory',
            'authenticate' => [
                'Form' => [
	    	'scope' => ['Users.active' => 1]
                ],
                'ADmad/JwtAuth.Jwt' => [
                    'parameter' => 'token',
                    'userModel' => 'Users',
	    	    'scope' => ['Users.active' => 1],
                    'fields' => [
                        'username' => 'id'
                    ],
                    'queryDatasource' => true
                ]
            ],
	    'unauthenticatedException' => false,
            'unauthorizedRedirect' => false,
            'checkAuthIn' => 'Controller.initialize'
        ]);

	$this->Crud->addListener('relatedModels', 'Crud.RelatedModels');
    }

    private function getRelatedModels($model,$depth,$max_depth=0)
    {
	    $related = array();
	    if($depth<$max_depth)
	    {
		    $this->loadModel($model);

		    foreach($this->{$model}->associations()->getIterator() as $key=>$value)
		    {
			    $related[$value->getName()]=$this->getRelatedModels($value->getName(),$depth+1,$max_depth);

		    }
	    }
	    return $related;

    }

    public function beforeFilter(\Cake\Event\Event $event) 
    {
	    parent::beforeFilter($event);
	    $this->Crud->on('beforeFind', function(\Cake\Event\Event $event) {
			    $related = $this->getRelatedModels($this->modelClass,0,intval($this->request->getHeaderLine('Recurse')));
			    $event->getSubject()->query->contain($related);
	    });

    }
}
