<?php
/**
 * Oggetto Web extension for Magento
 *
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade
 * the Oggetto Assist module to newer versions in the future.
 * If you wish to customize the Oggetto Assist module for your needs
 * please refer to http://www.magentocommerce.com for more information.
 *
 * @category   Oggetto
 * @package    Oggetto_Assist
 * @copyright  Copyright (C) 2012 Oggetto Web ltd (http://oggettoweb.com/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Assist payment method model
 *
 * @category   Oggetto
 * @package    Oggetto_Assist
 * @subpackage Model
 * @author     Denis Obukhov <denis.obukhov@oggettoweb.com>
 */
class Oggetto_Assist_Model_Source_PaymentMethods
{
    /**
     * Return array of options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'CardPayment', 'label' => Mage::helper('assist')->__('Credit Card')),
            array('value' => 'WMPayment', 'label' => Mage::helper('assist')->__('WebMoney Transfer')),
            array('value' => 'PayCashPayment', 'label' => Mage::helper('assist')->__('PayCash')),
            array('value' => 'QIWIPayment', 'label' => Mage::helper('assist')->__('QIWI Payment')),
            array('value' => 'QIWIBeelinePayment', 'label' => Mage::helper('assist')->__('QIWI Beeline Payment')),
            array('value' => 'QIWIMegafonPayment', 'label' => Mage::helper('assist')->__('QIWI Megafon Payment')),
            array('value' => 'QIWIMtsPayment', 'label' => Mage::helper('assist')->__('QIWI MTS Payment')),
            array('value' => 'AssistIDPayment', 'label' => Mage::helper('assist')->__('Assist®ID')),
            array('value' => 'YMPayment', 'label' => Mage::helper('assist')->__('YandexMoney')),
            array('value' => 'GifteryPayment', 'label' => Mage::helper('assist')->__('Giftery Sertificate')),
            array('value' => 'BankClientPayment',
                'label' => Mage::helper('assist')->__('The Saint Petersburg Bank or SofortBanking client')),
        );
    }
}
