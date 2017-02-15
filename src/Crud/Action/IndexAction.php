<?php
namespace App\Crud\Action;

class IndexAction extends \Crud\Action\BaseAction
{

    use \Crud\Traits\FindMethodTrait;
    use \Crud\Traits\SerializeTrait;
    use \Crud\Traits\ViewTrait;
    use \Crud\Traits\ViewVarTrait;

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

    protected function _handle()
    {
        $query = $this->_table()->find($this->findMethod());
        $subject = $this->_subject(['success' => true, 'query' => $query]);

        $items = $this->_table()->query($subject->query);
//        $this->_trigger('beforePaginate', $subject);
//        $items = $this->_controller()->paginate($subject->query);
        $subject->set(['entities' => $items]);

//        $this->_trigger('afterPaginate', $subject);
        $this->_trigger('beforeRender', $subject);
    }
}
