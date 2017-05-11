<?php
namespace Neutron\Core\Form\Admin\LayoutThemeParams;

use Phpfox\Form\Form;

class AddLayoutThemeParams extends Form{

    public function initialize(){

        $this->setTitle(_text('Add Layout Theme Params','admin.i18n'));
        $this->setInfo(_text('[Add Layout Theme Params Info]','admin.i18n'));
        $this->setAction(_url('#'));
        
        /** start elements **/

        // skip element `params_id` #identity
        
        // element `theme_id`
        $this->addElement(array (
          'name' => 'theme_id',
          'factory' => 'text',
          'label' => _text('Theme Id',null),
          'note' => _text('[Theme Id Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));
        // skip element `params` #skips

        /** end elements **/
        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);

         $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}
