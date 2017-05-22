<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 5/9/17
 * Time: 12:29 AM
 */

namespace Neutron\Core\Process;


use Neutron\Core\Form\Admin\Settings\FilterPermissionLevel;
use Neutron\Core\Model\AclForm;
use Phpfox\Form\FieldInterface;
use Phpfox\Form\Form;
use Phpfox\Support\AbstractProcess;
use Phpfox\View\ViewModel;

class AdminEditPermissionProcess extends AbstractProcess
{
    public function collectDomains(Form $form)
    {
        $settingGroups = [];

        foreach ($form->getElements() as $element) {
            $elementName = $element->getName();

            if (!$element instanceof FieldInterface) {
                continue;
            }

            if (!strpos($elementName, '__')) {
                continue;
            }

            list($settingGroup, $settingName) = explode('__', $element->getName());

            $settingGroups[$settingGroup][] = $settingName;
        }

        return $settingGroups;
    }

    public function collectPostData(Form $form)
    {
        $data = [];
        foreach ($form->getElements() as $element) {

            $elementName = $element->getName();

            if (!$element instanceof FieldInterface) {
                continue;
            }

            if (!strpos($elementName, '__')) {
                continue;
            }

            list($settingGroup, $settingName) = explode('__', $element->getName());

            $data[$settingGroup][$settingName] = $element->getValue();
        }

        return $data;
    }

    public function process()
    {
        $request = _get('request');

        $filter = new FilterPermissionLevel([
            'model' => $this->get('levelModel'),
        ]);

        _get('registry')->set('filter', $filter);


        $filter->populate($request->all());

        $data = $filter->getData();
        $formId = $data['form_id'];
        $levelType = $this->get('levelType');
        $levelId = $data['level_id'];


        /** @var AclForm $settingForm */
        $settingForm = _find('acl_form', $formId);

        if (!$settingForm) {
            throw new \InvalidArgumentException(_sprintf('Invalid group [{0}]', [$formId]));
        }

        $formName = $settingForm->getFormName();

        if (!class_exists($formName)) {
            throw new \InvalidArgumentException(_sprintf('Invalid group [{0}]', [$formId]));
        }

        /** @var Form $form */
        $form = (new \ReflectionClass($formName))->newInstanceArgs([]);

        if ($request->isGet()) {

            $data = _get('core.permission')->getForEdit($levelType, $levelId, $this->collectDomains($form));

            $form->populate($data);
        }

        if ($request->isPost() and $form->isValid($request->all())) {

            $data = $this->collectPostData($form);

            _get('core.permission')->updateValues($levelType, $levelId, $data);
        }

        $vm = new ViewModel(['form' => $form], 'layout/form-edit');

        if (is_array($data = $this->get('data'))) {
            $vm->assign($data);
        }

        return $vm;
    }

}