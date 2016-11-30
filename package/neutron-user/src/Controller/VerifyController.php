<?php
namespace Neutron\User\Controller;


use Phpfox;
use Phpfox\Mvc\StandardController;

class VerifyController extends StandardController
{
    public function actionIndex()
    {
        $p = Phpfox::trans('Email Verification');

        Phpfox::html()
            ->setTitle($p)
            ->addBreadcrumb($p, null);

        $request = \Phpfox::get('input');
        $hash = $request->get('link', '');
        $verifyResult = Phpfox::get('user.verify.process')
            ->verify($hash);

        if ($verifyResult) {
            $redirectUrl = Phpfox::getParam('user.redirect_url_after_verify');

            if (!$redirectUrl) {
                $redirectUrl = Phpfox::getUrl('login');
            }

            if (Phpfox::getParam('user.approve_users')) {

                Phpfox::get('flash_message')
                    ->set(Phpfox::trans('your_account_is_pending_approval'));

                return Phpfox::getResponse()->redirect(null);
            }

            Phpfox::get('flash_message')
                ->set(Phpfox::trans('your_email_has_been_verified_please_log_in_with_the_information_you_provided_during_sign_up'));

            return Phpfox::getResponse()->redirect($redirectUrl);

        }

        return $this->forward('core.error', 'general');
    }
}