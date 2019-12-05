<?php
/**
 * @author     Pavel Usachev <pausachev@gmail.com>
 * @copyright  2019 Pavel Usachev
 * @license    https://opensource.org/licenses/BSD-3-Clause  BSD-3-Clause
 */
namespace ALevel\CustomTotal\Block\Order;

use ALevel\CustomTotal\Api\Builder\CustomTotalBuilderInterface;
use ALevel\CustomTotal\Api\Model\Total\CustomTotalInterface;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\Context;
use Magento\Sales\Model\Order;

/**
 * Class WrapTotal
 * @package ALevel\CustomTotal\Block\Order
 */
class WrapTotal extends AbstractBlock
{
    /**
     * @var CustomTotalBuilderInterface
     */
    private $builder;

    /**
     * WrapTotal constructor.
     *
     * @param Context                       $context
     * @param CustomTotalBuilderInterface   $customTotalBuilder
     * @param array                         $data
     */
    public function __construct(
        Context $context,
        CustomTotalBuilderInterface $customTotalBuilder,
        array $data = []
    ) {
        $this->builder = $customTotalBuilder;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    public function initTotals()
    {
        $orderTotalsBlock = $this->getParentBlock();
        /** @var Order $order */
        $order = $orderTotalsBlock->getOrder();
        if ($order->getData(CustomTotalInterface::CODE_AMOUNT) > 0) {
            $data = $this->builder
                 ->setLabel(__(CustomTotalInterface::LABEL))
                 ->setCode(CustomTotalInterface::CODE)
                 ->setValue($order->getData(CustomTotalInterface::CODE_AMOUNT))
                 ->setBaseValue($order->getData(CustomTotalInterface::BASE_CODE_AMOUNT));

            $orderTotalsBlock->addTotal($data, 'subtotal');
        }
    }
}