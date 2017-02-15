<?php
namespace App\Crud\Action;

class ListAction extends \Crud\Action\BaseAction
{

    use \Crud\Traits\SerializeTrait;
    use \Crud\Traits\ViewTrait;
    use \Crud\Traits\ViewVarTrait;

    protected $_defaultConfig = [
        'enabled' => true,
        'scope' => 'table',
        'findMethod' => 'list'
    ];

    protected function _handle()
    {
        $request = $this->_request();

        $query = $this->_table()->find($this->config('findMethod'), $this->_getFindConfig());
	
        $filter_field = $request->query('filter_field');
        $filter_value = $request->query('filter_value');
	if(!empty($filter_field)&&!empty($filter_value))
		$query = $query->where([$filter_field => $filter_value]);

        $subject = $this->_subject(['success' => true, 'query' => $query]);
        $this->_trigger('beforeLookup', $subject);
        $subject->set(['entities' => $query->find('all')]);
        $this->_trigger('afterLookup', $subject);

        $this->_trigger('beforeRender', $subject);
    }

    protected function _getFindConfig()
    {
        $request = $this->_request();

        $columns = $this->_table()->schema()->columns();
        $config = (array)$this->config('findConfig');

        $idField = $request->query('id');
        if (in_array($idField, $columns)) {
            $config['keyField'] = $idField;
        }

        $valueField = $request->query('value');
        if (in_array($valueField, $columns)) {
            $config['valueField'] = $valueField;
        }

        return $config;
    }
}
