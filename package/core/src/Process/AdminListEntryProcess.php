<?php

namespace Neutron\Core\Process;


use Phpfox\Db\SqlSelect;
use Phpfox\Form\Form;
use Phpfox\Model\ModelInterface;
use Phpfox\Support\AbstractProcess;
use Phpfox\Support\FilterCriteria;
use Phpfox\Support\FilterInterface;
use Phpfox\View\ViewModel;

class AdminListEntryProcess extends AbstractProcess
{
    function process()
    {
        $request = _get('request');
        $criteria = new FilterCriteria();


        if ($this->get('filter.form')) {
            /** @var Form $search */
            $search = (new \ReflectionClass($this->get('filter.form')))->newInstanceArgs([]);

            $search->populate($_GET);

            _get('registry')->set('filter.form', $search);

            $criteria->addCriteria($search->getData());
        }



        /** @var FilterInterface $filter */
        $filter = $this->get('filter.service');



        if ($filter instanceof FilterInterface) {
            /** @var SqlSelect $select */
            $select = $filter->filter($criteria);
        } else {
            /** @var SqlSelect $select */
            $select = $this->get('select');

            if (!$select) {
                /** @var ModelInterface $model */
                $model = (new \ReflectionClass($this->get('model')))->newInstanceArgs([]);

                /** @var string $modelId */
                $modelId = $model->getModelId();

                $select = _model($modelId)
                    ->select();
            }
        }

        $items = _get('pagination')
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