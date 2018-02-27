<?php
namespace App\Crud\Action;

use Crud\Traits\FindMethodTrait;
use Crud\Traits\SerializeTrait;
use Crud\Traits\ViewTrait;
use Crud\Traits\ViewVarTrait;

class FullIndexAction extends \Crud\Action\BaseAction
{

    use FindMethodTrait;
    use SerializeTrait;
    use ViewTrait;
    use ViewVarTrait;

    /**
     * Default settings for 'index' actions
     *
     * @var array
     */
    protected $_defaultConfig = [
        'enabled' => true,
        'scope' => 'table',
        'findMethod' => 'all',
        'view' => null,
        'viewVar' => null,
        'serialize' => [],
        'api' => [
            'success' => [
                'code' => 200
            ],
            'error' => [
                'code' => 400
            ]
        ]
    ];

    /**
     * Generic handler for all HTTP verbs
     *
     * @return void
     */
    protected function _handle()
    {

	    $repository = $this->_table();

	    $subject = $this->_subject();
	    list($finder, $options) = $this->_extractFinder();
	    $query = $repository->find($finder, $options);

	    $subject->set([
			    'repository' => $repository,
			    'query' => $query
			    ]);

	    $this->_trigger('beforeFind', $subject);
	    $entity = $subject->query;
	    $subject->set(['entity' => $entity, 'success' => true]);
	    $this->_trigger('afterFind', $subject);



	    $subject->set(['entities' => $entity]);

	    $this->_trigger('afterPaginate', $subject);
	    $this->_trigger('beforeRender', $subject);
    }
}
