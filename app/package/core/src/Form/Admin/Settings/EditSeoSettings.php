<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditSeoSettings extends Form
{

    /** id=670 */
    public function initialize()
    {

        $this->setTitle(_text('Edit SEO Settings', '_core.seo_settings'));
        $this->setInfo(_text('Edit Site Settings [Info]', '_core'));
        $this->setMethod('post');
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `core__site_title` id=2117 **/
        $this->addElement([
            'name'     => 'core__site_title',
            'factory'  => 'text',
            'label'    => _text('Site Title', '_core.seo_settings'),
            'info'     => _text('Site Title [Info]', '_core.seo_settings'),
            'required' => true,
        ]);

        /** element `core__title_separator` id=2118 **/
        $this->addElement([
            'name'     => 'core__title_separator',
            'factory'  => 'text',
            'label'    => _text('Title Separator', '_core.seo_settings'),
            'info'     => _text('Title Separator [Info]', '_core.seo_settings'),
            'value'    => '&#187;',
            'required' => true,
        ]);

        /** element `core__site_description` id=2119 **/
        $this->addElement([
            'name'    => 'core__site_description',
            'factory' => 'textarea',
            'label'   => _text('Site Description', '_core.seo_settings'),
            'info'    => _text('Site Description [Info]', '_core.seo_settings'),
            'rows'    => '3',
        ]);

        /** element `core__description_limit` id=2120 **/
        $this->addElement([
            'name'     => 'core__description_limit',
            'factory'  => 'text',
            'label'    => _text('Description Limit', '_core.seo_settings'),
            'info'     => _text('Description Limit [Info]', '_core.seo_settings'),
            'required' => true,
        ]);

        /** element `core__site_keyword` id=2121 **/
        $this->addElement([
            'name'    => 'core__site_keyword',
            'factory' => 'textarea',
            'label'   => _text('Site Keyword', '_core.seo_settings'),
            'info'    => _text('Site Keyword [Info]', '_core.seo_settings'),
            'rows'    => '3',
        ]);

        /** element `core__keyword_limit` id=2122 **/
        $this->addElement([
            'name'     => 'core__keyword_limit',
            'factory'  => 'text',
            'label'    => _text('Keyword Limit', '_core.seo_settings'),
            'info'     => _text('Keyword Limit [Info]', '_core.seo_settings'),
            'required' => true,
        ]);

        /**
         * Enable open-graph ?
         */
        $this->addElement([
            'name'     => 'core__enable_open_graph',
            'factory'  => 'yesno',
            'label'    => _text('Enable Open Graph?', '_core.general_settings'),
            'info'     => _text('Force Https [Info]', '_core.general_settings'),
            'required' => true,
        ]);

        /** element `core__enable_facebook` id=2123 **/
        $this->addElement([
            'name'     => 'core__enable_facebook',
            'factory'  => 'yesno',
            'label'    => _text('Enable Facebook', '_core.seo_settings'),
            'info'     => _text('Enable Facebook [Info]', '_core.seo_settings'),
            'required' => true,
        ]);

        /** element `core__facebook_app_id` id=2124 **/
        $this->addElement([
            'name'    => 'core__facebook_app_id',
            'factory' => 'text',
            'label'   => _text('Facebook App ', '_core.seo_settings'),
            'info'    => _text('Facebook App Id [Info]', '_core.seo_settings'),
        ]);

        /** element `core__facebook_app_secret` id=2125 **/
        $this->addElement([
            'name'    => 'core__facebook_app_secret',
            'factory' => 'text',
            'label'   => _text('Facebook App Secret', '_core.seo_settings'),
            'info'    => _text('Facebook App Secret [Info]', '_core.seo_settings'),
        ]);

        /** element `core__facebook_app_name` id=2126 **/
        $this->addElement([
            'name'    => 'core__facebook_app_name',
            'factory' => 'text',
            'label'   => _text('Facebook App Name', '_core.seo_settings'),
            'info'    => _text('Facebook App Name [Info]', '_core.seo_settings'),
        ]);

        /** element `core__enable_google_plus` id=2127 **/
        $this->addElement([
            'name'     => 'core__enable_google_plus',
            'factory'  => 'yesno',
            'label'    => _text('Enable Google Plus', '_core.seo_settings'),
            'info'     => _text('Enable Google Plus [Info]', '_core.seo_settings'),
            'required' => true,
        ]);

        $this->addElement([
            'name'     => 'core__enable_twitter_card',
            'factory'  => 'yesno',
            'label'    => _text('Enable Twitter Card', '_core.seo_settings'),
            'info'     => _text('Enable Twitter Card [Info]', '_core.seo_settings'),
            'required' => true,
        ]);

        /** element `core__google_plus_id` id=2128 **/
        $this->addElement([
            'name'    => 'core__google_plus_id',
            'factory' => 'select',
            'label'   => _text('Google Plus ID', '_core.seo_settings'),
            'info'    => _text('Google Plus Id [Info]', '_core.seo_settings'),
        ]);

        /** element `core__enable_google_analytic` id=2129 **/
        $this->addElement([
            'name'     => 'core__enable_google_analytic',
            'factory'  => 'yesno',
            'label'    => _text('Enable Google Analytic', '_core.seo_settings'),
            'info'     => _text('Enable Google Analytic [Info]', '_core.seo_settings'),
            'required' => true,
        ]);

        /** element `core__google_analytic_id` id=2130 **/
        $this->addElement([
            'name'    => 'core__google_analytic_id',
            'factory' => 'text',
            'label'   => _text('Google Analytic ID', '_core.seo_settings'),
            'info'    => _text('Google Analytic Id [Info]', '_core.seo_settings'),
        ]);

        /** element `core__enable_open_graph` id=2131 **/
        $this->addElement([
            'name'     => 'core__enable_open_graph',
            'factory'  => 'yesno',
            'label'    => _text('Enable Open Graph', '_core.seo_settings'),
            'info'     => _text('Enable Open Graph [Info]', '_core.seo_settings'),
            'required' => true,
        ]);
        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => _url('#'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
