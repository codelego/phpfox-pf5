<?php

namespace Neutron\Core\Process;


use Phpfox\Db\DbModel;
use Phpfox\Form\Form;
use Phpfox\Model\ModelInterface;
use Phpfox\View\ViewModel;

class AdminEditEntryProcess extends AbstractProcess
{

    public function process()
    {
        $req = _service('request');

        $idKey = $req->get($this->get('key'));

        /** @var Form $form */
        $form = (new \ReflectionClass($this->get('form')))->newInstanceArgs([]);

        /** @var ModelInterface $model */
        $model = (new \ReflectionClass($this->get('model')))->newInstanceArgs([]);

        /** @var DbModel $entry */
        $entry = _model($model->getModelId())->findById($idKey);

        if ($req->isGet()) {
            $form->populate($entry);
        }

        if ($req->isPost() and $form->isValid($req->all())) {
            $entry->fromArray($form->getData());
            $entry->save();
            \Phpfox::$service->get('response')->redirect($this->get('redirect'));
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }
}