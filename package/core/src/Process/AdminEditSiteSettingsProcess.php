<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 5/9/17
 * Time: 12:29 AM
 */

namespace Neutron\Core\Process;


use Neutron\Core\Model\SiteSettingGroup;
use Phpfox\Form\Form;
use Phpfox\View\ViewModel;

class AdminEditSiteSettingsProcess extends AbstractProcess
{
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

        }

        if ($request->isPost() and $form->isValid($request->all())) {

        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }
}