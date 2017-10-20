<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 5/9/17
 * Time: 12:29 AM
 */

namespace Neutron\Core\Process;


use Neutron\Core\Form\Admin\Settings\FilterPermissionLevel;
use Neutron\Core\Model\AclAction;
use Neutron\Core\Model\AclForm;
use Phpfox\Form\FieldInterface;
use Phpfox\Form\Form;
use Phpfox\Kernel\AbstractProcess;
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

    /**
     * @param string $domainId
     * @param string $name
     *
     * @return AclAction
     */
    public function findAction($domainId, $name)
    {
        return _model('acl_action')
            ->select()
            ->where('domain_id=?', $domainId)
            ->where('name=?', $name)
            ->first();
    }

    /**
     * @param Form  $form
     * @param mixed $levelId
     * @param mixed $itemType
     */
    public function removeInvalidElements($form, $levelId, $itemType)
    {
        $validate = $this->collectDomains($form);

        $permissionFacades = _get('acl');


        foreach ($validate as $domainId => $names) {
            foreach ($names as $actionName) {
                $elementName = $domainId . '__' . $actionName;
                $aclAction = $this->findAction($domainId, $actionName);

                if (!$aclAction) {
                    $form->removeElement($elementName);
                    continue;
                }

                if ($aclAction->getAcceptType() != '*' and $aclAction->getAcceptType() != $itemType) {
                    $form->removeElement($elementName);
                    continue;
                }

                if (null != ($dependency = $aclAction->getDependency())) {
                    if (!$permissionFacades->checkByLevel($levelId, $itemType, $dependency)) {
                        $form->removeElement($elementName);
                        continue;
                    }
                }
            }
        }
    }

    public function process()
    {
        $request = _get('request');

        $filter = new FilterPermissionLevel([
            'model' => $this->get('levelModel'),
        ]);

        $filter->populate($request->all());

        $data = $filter->getData();
        $formId = $data['form_id'];
        $itemType = $this->get('itemType');
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
        $form = (new \ReflectionClass($formName))->newInstanceArgs([['levelId' => $levelId, 'itemType' => $itemType]]);

        $this->removeInvalidElements($form, $levelId, $itemType);


        if ($request->isGet()) {

            $data = _get('core.permission')->getForEdit($itemType, $levelId, $this->collectDomains($form));

            $form->populate($data);
        }

        if ($request->isPost() and $form->isValid($request->all())) {

            $data = $this->collectPostData($form);

            _get('core.permission')->updateValues($itemType, $levelId, $data);
        }

        $vm = new ViewModel(['form' => $form, 'filter' => $filter], 'core/admin-settings/edit-permission');

        if (is_array($data = $this->get('data'))) {
            $vm->assign($data);
        }

        return $vm;
    }

}