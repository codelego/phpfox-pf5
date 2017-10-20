<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 5/9/17
 * Time: 12:29 AM
 */

namespace Neutron\Core\Process;


use Neutron\Core\Model\SettingForm;
use Phpfox\Form\FieldInterface;
use Phpfox\Form\Form;
use Phpfox\Kernel\AbstractProcess;
use Phpfox\View\ViewModel;

class AdminEditSettingsProcess extends AbstractProcess
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
        $formId = $this->get('form_id');

        $formName =  $this->get('form');

        if(!$formName){
            if (!$formId) {
                $formId = $request->get('form_id');
            }

            /** @var SettingForm $settingForm */
            $settingForm = _find('setting_form', $formId);

            if (!$settingForm) {
                throw new \InvalidArgumentException(_sprintf('Invalid group [{0}]', [$formId]));
            }

            $formName = $settingForm->getFormName();
        }

        if (!class_exists($formName)) {
            throw new \InvalidArgumentException(_sprintf('Invalid group [{0}]', [$formId]));
        }


        /** @var Form $form */
        $form = (new \ReflectionClass($formName))->newInstanceArgs([]);


        if ($request->isGet()) {

            $data = _get('core.setting')->getForEdit($this->collectDomains($form));

            $form->populate($data);
        }

        if ($request->isPost() and $form->isValid($request->all())) {

            $data = $this->collectPostData($form);

            _get('core.setting')->updateValues($data);

            _get('shared.cache')->flush();
        }

        $vm = new ViewModel(['form' => $form], 'layout/form-edit');

        if (is_array($data = $this->get('data'))) {
            $vm->assign($data);
        }

        return $vm;
    }
}