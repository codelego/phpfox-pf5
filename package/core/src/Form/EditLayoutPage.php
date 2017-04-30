<?php

namespace Neutron\Core\Form;

use Neutron\Core\Model\LayoutPage;
use Phpfox\Form\Button;
use Phpfox\Form\Form;

class EditLayoutPage extends Form
{
    /**
     * @return array
     */
    public function getParentPageIdOptions()
    {
        $select = \Phpfox::with('layout_page')->select();

        return array_map(function (LayoutPage $v) {
            return [
                'label' => $v->__get('page_name'),
                'value' => $v->getId(),
            ];
        }, $select->all());
    }


    public function initialize()
    {
        $this->addElement([
            'factory'    => 'static',
            'name'       => 'page_id',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Page Id'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'select',
            'name'       => 'parent_page_id',
            'attributes' =>
                [
                    'placeholder' => _('Select'),
                    'maxlength'   => PHPFOX_TITLE_LENGTH,
                    'class'       => 'form-control',
                ],
            'options'    => $this->getParentPageIdOptions(),
            'label'      => _text('Parent Page Id'),
            'required'   => false,
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'page_name',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Page Name'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'select',
            'name'       => 'package_id',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'options'    => \Phpfox::get('core.packages')
                ->getPackageIdOptions(),
            'label'      => _text('Package Id'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'textarea',
            'name'       => 'description',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_DESC_LENGTH,
                    'class'     => 'form-control',
                    'rows'      => PHPFOX_DESC_ROWS,
                ],
            'label'      => _text('Description'),
            'required'   => true,
        ]);
    }

    public function getButtons()
    {
        return [
            new Button([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
            new Button([
                'type'       => 'submit',
                'label'      => _text('Cancel'),
                'href'       => _url('admin.blog.category'),
                'attributes' => ['class' => 'btn btn-link'],
            ]),
        ];
    }
}
