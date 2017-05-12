<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 5/9/17
 * Time: 12:29 AM
 */

namespace Neutron\Core\Process;


use Neutron\Core\Model\SiteSettingGroup;
use Phpfox\Form\FieldInterface;
use Phpfox\Form\Form;
use Phpfox\View\ViewModel;

class AdminManageAclSettingsProcess extends AbstractProcess
{
    public function getSettingGroups(Form $form)
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

    public function getPostData(Form $form)
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
        $request = _service('request');
        $settingGroupId = $this->get('setting_group');

        if (!$settingGroupId) {
            $settingGroupId = $request->get('setting_group');
        }

        /** @var SiteSettingGroup $settingGroup */
        $settingGroup = _find('site_setting_group', $settingGroupId);

        if (!$settingGroup) {
            throw new \InvalidArgumentException(_sprintf('Invalid group [{0}]', [$settingGroupId]));
        }

        $formName = $settingGroup->getFormName();

        if (!class_exists($formName)) {
            throw new \InvalidArgumentException(_sprintf('Invalid group [{0}]', [$settingGroupId]));
        }

        /** @var Form $form */
        $form = (new \ReflectionClass($formName))->newInstanceArgs([]);

        if ($request->isGet()) {

            $data = _service('core.setting')->getForEdit($this->getSettingGroups($form));

            $form->populate($data);

            $form->postPopulate();
        }

        if ($request->isPost() and $form->isValid($request->all())) {

            $data = $this->getPostData($form);

            _service('core.setting')->updateGroupValues($data);

            $form->postSave();

            _service('cache.local')->flush();
        }

        $vm = new ViewModel(['form' => $form], 'layout/form-edit');

        if (is_array($data = $this->get('data'))) {
            $vm->assign($data);
        }

        return $vm;
    }
}