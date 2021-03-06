<?php
/**
 * Oggetto Web extension for Magento
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
 * Assist redirect controller
 *
 * @category   Oggetto
 * @package    Oggetto_Assist
 * @subpackage controllers
 * @author     Denis Obukhov <denis.obukhov@oggettoweb.com>
 */
class Oggetto_Assist_RedirectController extends Mage_Core_Controller_Front_Action
{

    /**
     * Index action
     *
     * @return void
     */
    public function indexAction()
    {
        $this->getResponse()
            ->setHeader('Content-type', 'text/html; charset=' . Oggetto_Assist_Model_Payment::ASSIST_POST_CHARSET)
            ->setBody(
                $this->getLayout()
                    ->createBlock('assist/redirect')
                    ->toHtml()
            );
    }

    /**
     * Confirm action
     *
     * @return void
     */
    public function confirmAction()
    {
        if ($this->getRequest()->isPost()) {
            $paymentModel   = $this->getPaymentModel();
            $orderId        = $this->getRequest()->getParam('ordernumber');
            $responseCode   = $this->getRequest()->getParam('responsecode');
            $order          = Mage::getModel('sales/order')->loadByIncrementId($orderId);

            $paymentModel->debugData($paymentModel->isValidRequest($this->getRequest()));
            if ($paymentModel->isValidRequest($this->getRequest()) && $order->getId()) {
                $payment = $order->getPayment();
                $this->getPaymentModel()->authorizeOrder($order, $this->getRequest()->getParam('billnumber'));
                $payment->setTransactionAdditionalInfo($this->getRequest()->getPost(), true);
                $paymentModel->updateOrderStatus($orderId, (strtoupper($responseCode) == 'AS000'));
            }

            $paymentModel->debugData($this->getRequest()->getParams());
        }
    }

    /**
     * Failure action
     *
     * @return void
     */
    public function failureAction()
    {
          $this->_redirect('checkout/onepage/failure', array('_secure' => true));
    }

    /**
     * Success action
     *
     * @return void
     */
    public function successAction()
    {
        if ($orderId = $this->getRequest()->getParam('ordernumber')) {
            $order = Mage::getModel('sales/order')->loadByIncrementId($orderId);
            if ($order->getId()) {
                $this->getPaymentModel()->authorizeOrder($order, $this->getRequest()->getParam('billnumber'));
            }
        }
        $this->_redirect('checkout/onepage/success', array('_secure' => true));
    }

    /**
     * Get assist payment model
     *
     * @return Oggetto_Assist_Model_Payment
     */
    public function getPaymentModel()
    {
        return Mage::getSingleton('assist/payment');
    }

}
