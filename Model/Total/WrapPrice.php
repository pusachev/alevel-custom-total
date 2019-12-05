<?php
/**
 * @author     Pavel Usachev <pausachev@gmail.com>
 * @copyright  2019 Pavel Usachev
 * @license    https://opensource.org/licenses/BSD-3-Clause  BSD-3-Clause
 */
namespace ALevel\CustomTotal\Model\Total;

use ALevel\CustomTotal\Api\Model\Total\CustomTotalInterface;
use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;
use Magento\Quote\Model\Quote\Item\AbstractItem;
use Magento\Quote\Model\Quote;
use Magento\Quote\Api\Data\ShippingAssignmentInterface;
use Magento\Quote\Model\Quote\Address\Total;

/**
 * Class WrapPrice
 * @package ALevel\CustomTotal\Model\Total
 */
class WrapPrice extends AbstractTotal implements CustomTotalInterface
{
    public function collect(Quote $quote, ShippingAssignmentInterface $shippingAssignment, Total $total)
    {
        parent::collect($quote, $shippingAssignment, $total);

        $items = $shippingAssignment->getItems();

        if (empty($items)) {
            return $this;
        }

        $wrapTotal = 0;

        /** @var AbstractItem $item */
        foreach ($items as $item) {
            if ($item->getProduct()->getData('is_wrapped')) {
                $wrapTotal += (float)$item->getProduct()->getData('wrapped_price') * $item->getTotalQty();
            }
        }

        $total->setTotalAmount($this->getCode(), $wrapTotal);
        $total->setBaseTotalAmount($this->getCode(), $wrapTotal);
        $quote->setData(self::CODE_AMOUNT, $wrapTotal);
        $quote->setData(self::BASE_CODE_AMOUNT, $wrapTotal);

        return $this;
    }

    /**
     * @param Quote $quote
     * @param Total $total
     * @return array
     */
    public function fetch(Quote $quote, Total $total)
    {
        return [
            'code' => $this->getCode(),
            'title' => $this->getLabel(),
            'value' => $total->getData(self::CODE_AMOUNT)
        ];
    }

    public function getLabel()
    {
        return __(self::LABEL);
    }
}
