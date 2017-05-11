<?php

namespace Neutron\Core\Process;


use Phpfox\Form\Form;
use Phpfox\Model\ModelInterface;
use Phpfox\View\ViewModel;

class AdminManageEntryProcess extends AbstractProcess
{
    function process()
    {
        $request = _service('request');

        if ($this->get('filter')) {
            /** @var Form $filter */
            $filter = (new \ReflectionClass($this->get('filter')))->newInstanceArgs([]);

            $filter->populate($_GET);

            _service('registry')
                ->set('search.filter', $filter);
        }

        /** @var ModelInterface $model */
        $model = (new \ReflectionClass($this->get('model')))->newInstanceArgs([]);

        /** @var string $modelId */
        $modelId = $model->getModelId();


        $select = _model($modelId)
            ->select();

        $items = _service('pagination')
            ->factory($select)
            ->setLimit($this->get('limit', $request->get('limit', 10)))
            ->setPageNumber($this->get('page', $request->get('page', 1)))
            ->setNoLimit($this->get('noLimit', false))
            ->prepare();


        $vm = new ViewModel([
            'items' => $items,
        ], $this->get('template'));

        if (is_array($data = $this->get('data'))) {
            $vm->assign($data);
        }

        return $vm;
    }
}