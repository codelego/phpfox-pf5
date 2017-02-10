<?php

namespace Neutron\Report\Form;

use Phpfox\Form\Form;

/**
 * Class AddAbuseReport
 *
 * <code>
 * $form = new AddAbuseReport(['itemId'=>'', 'itemType'=>'']);
 * </code>
 *
 * @package Neutron\Report\Form
 */
class AddAbuseReport extends Form
{
    /**
     * @var mixed
     */
    protected $itemId;

    /**
     * @var mixed
     */
    protected $itemType;

    /**
     * @param mixed $itemId
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * @param mixed $itemType
     */
    public function setItemType($itemType)
    {
        $this->itemType = $itemType;
    }

    protected function initialize()
    {
        $this->addElements([
            ['name' => 'about_id', 'factory' => 'hidden'],
            ['name' => 'about_type', 'factory' => 'hidden',],
            [
                'name'     => 'category_id',
                'label'    => _text('What\'s going on?', 'reports'),
                'required' => true,
                'factory'  => 'choice',
                'render'   => 'radio',
                'options'  => \Phpfox::get('reports')
                    ->getActiveCategoryOptions(),
            ],
            [
                'name'       => 'message',
                'factory'    => 'textarea',
                'label'      => _text('Message', 'reports'),
                'attributes' => ['class' => 'form-control'],
            ],
        ]);
    }
}