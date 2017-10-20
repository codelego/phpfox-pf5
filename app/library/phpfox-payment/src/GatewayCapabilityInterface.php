<?php

namespace Phpfox\Payments;


interface GatewayCapabilityInterface
{
    /**
     * @return bool
     */
    public function supportSandbox();

    /**
     * @return bool
     */
    public function supportAuthorize();

    /**
     * @return bool
     */
    public function supportCompleteAuthorize();

    /**
     * @return bool
     */
    public function supportCapture();

    /**
     * @return bool
     */
    public function supportPurchase();

    /**
     * @return bool
     */
    public function supportCompletePurchase();

    /**
     * @return bool
     */
    public function supportRefund();

    /**
     * @return bool
     */
    public function supportVoid();

    /**
     * @return bool
     */
    public function supportCreateCard();

    /**
     * @return bool
     */
    public function supportDeleteCard();

    /**
     * @return bool
     */
    public function supportUpdateCard();

    /**
     * @return bool
     */
    public function supportRecurring();

    /**
     * @return string[]
     */
    public function supportCurrencies();
}