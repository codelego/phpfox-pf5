<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\ProfileQuestion\SelectProfileQuestion;
use Neutron\Core\Form\Admin\ProfileSection\AddProfileSection;
use Neutron\Core\Model\ProfileProcess;
use Phpfox\View\ViewModel;

class AdminBasicProfileController extends AdminController
{
    /**
     * @var string
     */
    protected $packageId = 'user';

    /**
     * @var string
     */
    protected $itemType = 'user';

    /**
     * @var string
     */
    protected $catalogModel = 'user_catalog';

    /**
     * @var string
     */
    protected $route = 'admin.user.profile';

    /**
     * @var array
     */
    protected $processTypes = ['create', 'edit', 'view', 'search'];

    public function actionCatalog()
    {
        $items = _model($this->catalogModel)->select()->all();

        return new ViewModel(['items'=>$items],'core/admin-profile/manage-catalog');
    }

    public function actionAttribute()
    {
        $items = _model('profile_attribute')
            ->select()
            ->where('item_type=?', $this->itemType)
            ->all();

        return new ViewModel(['items'=>$items],'core/admin-profile/manage-attribute');
    }

    public function actionProcess()
    {
        $items = _model('profile_process')
            ->select()
            ->where('item_type=?', $this->itemType)
            ->all();

        return new ViewModel(['items'=>$items],'core/admin-profile/manage-process');
    }

    public function actionSection()
    {
        $items = _model('profile_section')
            ->select()
            ->where('item_type=?', $this->itemType)
            ->all();

        return new ViewModel(['items'=>$items],'core/admin-profile/manage-section');
    }

    public function actionIndex()
    {
        $catalogId = 1;
        $processType = 'create';
        $coreProfile = _get('core.profile');

        $process = $coreProfile->getProfileProcess($this->itemType, $processType, $catalogId);

        if (!$process and _model($this->catalogModel)->findById($catalogId) != null) {
            $process = _model('profile_process')
                ->create([
                    'item_type'    => $this->itemType,
                    'process_type' => $processType,
                    'catalog_id'   => $catalogId,
                ]);
            $process->save();
        }

        if (!$process) {
            throw new \InvalidArgumentException('Oops!, process not found');
        }

        $sections = $coreProfile->getProfileSections($process->getId());

        $backUrl = base64_encode(_url('#'));

        _get('menu.admin.buttons')
            ->clear()
            ->add([
                'label' => 'Add Section',
                'extra' => ['class' => 'btn btn-danger', 'data-cmd' => 'modal'],
                'href'  => _url($this->route,
                    ['action' => 'add-section', 'process_id' => $process->getId(), 'back' => $backUrl]),
            ]);

        return new ViewModel([
            'process'     => $process,
            'sections'    => $sections,
            'itemType'    => $this->itemType,
            'catalogId'   => $catalogId,
            'processType' => $processType,
            'route'       => $this->route,
        ], 'core/admin-profile/manage-profile-process');
    }

    public function actionAddSection()
    {

        $request = _get('request');
        $processId = $request->get('process_id');
        $coreProfile = _get('core.profile');

        // validate information
        $profileProcess = $coreProfile->findProfileProcess($processId);

        $this->validateProcess($profileProcess);

        $form = new AddProfileSection([

        ]);

        if ($request->isGet()) {
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = array_merge($form->getData(), [
                'process_id'   => $processId,
                'is_active'    => 1,
                'ordering'     => 1,
                'dependencies' => '[]',
            ]);

            _model('profile_section')->create($data)->save();

            $backUrl = base64_decode($request->get('back'));

            _get('response')->redirect($backUrl);
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionAddQuestion()
    {
        $request = _get('request');
        $sectionId = $request->get('section_id');
        $processId = $request->get('process_id');
        $coreProcess = _get('core.profile');

        $profileProcess = $coreProcess->findProfileProcess($processId);
        $profileSection = $coreProcess->findProfileSection($sectionId);

        $this->validateProcess($profileProcess);

        if (!$profileSection or $profileSection->getProcessId() != $processId) {
            throw new \InvalidArgumentException('Invalid parameter "process_id');
        }
        // show form select attribute id.

        $form = new SelectProfileQuestion([
            'itemType'  => $this->itemType,
            'processId' => $processId,
        ]);

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $attributeIds = $form->getData()['attribute_id'];
            $coreProcess->addProfileQuestions($profileSection, $attributeIds);
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
        // find process
    }

    /**
     * @param ProfileProcess $profileProcess
     */
    protected function validateProcess($profileProcess)
    {
        if (!$profileProcess
            OR $profileProcess->getItemType() != $this->itemType
            OR !in_array($profileProcess->getProcessType(), $this->processTypes)
        ) {
            throw new \InvalidArgumentException('Invalid parameter "process_id');
        }
    }
}