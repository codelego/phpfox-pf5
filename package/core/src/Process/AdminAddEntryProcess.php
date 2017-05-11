<?php

namespace Neutron\Core\Process;


use Phpfox\Form\Form;
use Phpfox\Model\ModelInterface;
use Phpfox\View\ViewModel;

class AdminAddEntryProcess extends AbstractProcess
{
    public function process()
    {
        $request = _service('request');

        /** @var Form $form */
        $form = (new \ReflectionClass($this->get('form')))->newInstanceArgs([]);

        /** @var ModelInterface $model */
        $model = (new \ReflectionClass($this->get('model')))->newInstanceArgs([]);

        /** @var string $modelId */
        $modelId = $model->getModelId();

        if ($request->isGet()) {
        }

        if ($request->isPost() and $form->isValid($request->all())) {

            /** @var ModelInterface $entry */
            $entry = _model($modelId)
                ->create($form->getData());
            $entry->save();

            \Phpfox::$service->get('response')->redirect($this->get('redirect'));
        }

        $vm = new ViewModel(['form' => $form], 'layout/form-edit');

        if (is_array($data = $this->get('data'))) {
            $vm->assign($data);
        }

        return $vm;
    }
}