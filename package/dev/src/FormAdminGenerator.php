<?php

namespace Neutron\Dev;

use Neutron\Core\Model\CorePackage;
use Neutron\Dev\Model\DevAction;
use Phpfox\View\ViewModel;

class FormAdminGenerator extends AbstractGenerator
{
    /**
     * @var string
     */
    protected $category = 'Form';

    /**
     * @var DevAction $meta
     */
    protected $meta;

    /**
     * @var CorePackage
     */
    protected $packageInfo;

    /**
     * @var string
     */
    protected $textDomain;

    /**
     * @var string
     */
    protected $tableName;

    /**
     * @var string
     */
    protected $packageId;

    /**
     * @var string
     */
    protected $formType;

    /**
     * Template script
     *
     * @var string
     */
    protected $template;

    /**
     * AbstractGenerator constructor.
     *
     * @param DevAction $meta
     */
    public function __construct(DevAction $meta)
    {
        $this->meta = $meta;

        $this->textDomain = $this->meta->getTextDomain();

        $this->tableName = $this->meta->getTableName();

        $this->packageId = $this->meta->getPackageId();

        $this->packageInfo = _model('core_package')
            ->select()
            ->where('name=?', $this->packageId)
            ->first();

        $this->initialized();
    }

    protected function initialized()
    {

    }

    protected function getElementGeneratorParams()
    {
        return [
            'textDomain' => $this->meta->getTextDomain(),
            'packageId'  => $this->meta->getPackageId(),
        ];
    }

    /**
     * @return string
     */
    public function process()
    {
        $elementGeneratorParams = $this->getElementGeneratorParams();
        $elementGenerator = new ElementGenerator($elementGeneratorParams);
        $messageContainer = new MessageContainer($this->meta->getTextDomain());
        $elementGenerator->setMessageContainer($messageContainer);

        $elements = _model('dev_element')
            ->select()
            ->where('is_active=?', 1)
            ->where('meta_id=?', $this->meta->getMetaId())
            ->order('sort_order', 1)
            ->all();

        $namespace = $this->getNameSpace();
        $shortFormClass = $this->getShortFormClass();
        $fullFormClass = $this->getFullFormClass();
        $formTitle = $this->getFormTitle();
        $component = $this->getComponent();

        $modulePath = $this->packageInfo->getPath();

        $formClassPath = $modulePath . '/src/Form/Admin/' . $component . '/' . $shortFormClass . '.php';

        switch ($this->meta->getActionId()) {
            case 'delete':
                if (file_exists($formClassPath)) {
                    @unlink($formClassPath);
                }
                return true;
            case 'skip':
                return true;
            default:
        }

        $formCode = (new ViewModel([
            'elementGenerator' => $elementGenerator,
            'elements'         => $elements,
            'fullFormClass'    => $fullFormClass,
            'namespace'        => $namespace,
            'component'        => $component,
            'shortFormClass'   => $shortFormClass,
            'heading'          => 'Table to Form',
            'tableName'        => $this->tableName,
            'moduleName'       => $this->packageId,
            'formType'         => $this->formType,
            'textDomain'       => $this->textDomain,
            'formTitle'        => $formTitle,
        ], $this->template))->render();

        _get('core.i18n')->insertDomainMessages($messageContainer->all(), $this->packageId, '');

        $this->putContents($formClassPath, $formCode);
    }

    /**
     * @return string
     */
    public function getNameSpace()
    {
        return 'Neutron\\' . _inflect($this->meta->getPackageId()) . '\\Form\\Admin\\' . $this->getComponent();
    }


    public function fixTab($number, $content)
    {
        $pad = str_pad('', $number, ' ');

        $lines = explode(PHP_EOL, $content);
        foreach ($lines as $index => $line) {
            $lines[$index] = $pad . $line;
        }
        return implode(PHP_EOL, $lines);
    }


    /**
     * @return string
     */
    public function getShortFormClass()
    {
        $string = $this->formType . ' ' . str_replace('_', ' ', $this->tableName);

        return _inflect($string);
    }

    /**
     * @return string
     */
    public function getComponent()
    {
        return _inflect(str_replace('_', ' ', $this->tableName));
    }

    public function getFullFormClass()
    {
        return _sprintf('{0}\\{1}', [
            $this->getNameSpace(),
            $this->getShortFormClass(),
        ]);
    }

    /**
     * @return string
     */
    protected function getFormTitle()
    {
        $string = ucfirst($this->formType) . ' ' . implode(' ', array_map(function ($v) {
                return ucwords($v);
            }, explode('_', $this->tableName)));

        $string = preg_replace("/(Admin|I18n)/", '', $string);

        $string = preg_replace("/(\s+)/", ' ', $string);

        return $string;
    }

}