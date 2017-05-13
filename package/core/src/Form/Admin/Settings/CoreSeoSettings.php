<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class CoreSeoSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('SEO Settings', 'core_seo'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'core_seo__facebook_enable',
            'value'    => 0,
            'label'    => _text('Enable Facebook?', 'core_seo'),
            'note'     => _text('[Enable Facebook Note]', 'core_seo'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'core_seo__facebook_app_id',
            'label'    => _text('Facebook App ID', 'core_seo'),
            'note'     => _text('[Facebook App ID Note]', 'core_seo'),
            'required' => false,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'core_seo__facebook_app_name',
            'label'    => _text('Facebook App Name', 'core_seo'),
            'note'     => _text('[Facebook App Name Note]', 'core_seo'),
            'required' => false,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'core_seo__google_analytic_enable',
            'label'    => _text('Enable Google Analytics', 'core_seo'),
            'note'     => _text('[Enable Google Analytics Note]', 'core_seo'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'core_seo__google_analytic_id',
            'label'    => _text('Google Analytics ID', 'core_seo'),
            'note'     => _text('[Google Analytics ID Note]', 'core_seo'),
            'required' => false,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'core_seo__site_title',
            'label'    => _text('Site Title', 'core_seo'),
            'note'     => _text('[Site Title Note]', 'core_seo'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'core_seo__title_separator',
            'label'    => _text('Site Title Separator', 'core_seo'),
            'note'     => _text('[Site Title Separator Note]', 'core_seo'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'textarea',
            'name'     => 'core_seo__keyword',
            'label'    => _text('Meta Keywords', 'core_seo'),
            'note'     => _text('[Meta Keywords Note]', 'core_seo'),
            'rows'     => 3,
            'required' => false,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'core_seo__keyword_limit',
            'label'    => _text('Meta Keyword Limit', 'core_seo'),
            'note'     => _text('[Meta Keyword Limit Note]', 'core_seo'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'textarea',
            'name'     => 'core_seo__description',
            'label'    => _text('Meta Description', 'core_seo'),
            'note'     => _text('[Meta Description Note]', 'core_seo'),
            'rows'     => 3,
            'required' => false,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'core_seo__description_limit',
            'label'    => _text('Meta Description Limit', 'core_seo'),
            'note'     => _text('[Meta Description Limit Note]', 'core_seo'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'core_seo__copyright',
            'label'    => _text('Site Copyright', 'core_seo'),
            'note'     => _text('[Site Copyright Note]', 'core_seo'),
            'required' => false,
        ]);


        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}