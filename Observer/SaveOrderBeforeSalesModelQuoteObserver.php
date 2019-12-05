<?php
/**
 * @author     Pavel Usachev <pausachev@gmail.com>
 * @copyright  2019 Pavel Usachev
 * @license    https://opensource.org/licenses/BSD-3-Clause  BSD-3-Clause
 */
namespace ALevel\CustomTotal\Observer;

use ALevel\CustomTotal\Api\Model\Total\CustomTotalInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Sales\Model\Order;
use Magento\Quote\Model\Quote;

/**
 * Class SaveOrderBeforeSalesModelQuoteObserver
 * @package ALevel\CustomTotal\Observer
 */
class SaveOrderBeforeSalesModelQuoteObserver implements ObserverInterface
{
    /** {@inheritDoc} */
    public function execute(Observer $observer)
    {
        /* @var Order $order */
        $order = $observer->getEvent()->getData('order');
        /* @var Quote $quote */
        $quote = $observer->getEvent()->getData('quote');

        foreach ([CustomTotalInterface::CODE_AMOUNT, CustomTotalInterface::BASE_CODE_AMOUNT] as $code) {
            if ($quote->hasData($code)) {
                $order->setData($code, $quote->getData($code));
            }
        }

        return $this;
    }
}
