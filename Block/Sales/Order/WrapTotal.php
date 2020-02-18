<?php
/**
 * @author     Pavel Usachev <pausachev@gmail.com>
 * @copyright  2019 Pavel Usachev
 * @license    https://opensource.org/licenses/BSD-3-Clause  BSD-3-Clause
 */
namespace ALevel\CustomTotal\Block\Sales\Order;

use ALevel\CustomTotal\Api\Builder\CustomTotalBuilderInterface;
use ALevel\CustomTotal\Api\Model\Total\CustomTotalInterface;
use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Block\Adminhtml\Order\Invoice\Totals;

/**
 * Class WrapTotal
 * @package ALevel\CustomTotal\Block\Sales\Order
 */
class WrapTotal extends Template
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

    public function initTotals()
    {
        /** @var $parent Totals */
        $parent = $this->getParentBlock();
        $source = $parent->getSource();

        if (!empty($source->getData(CustomTotalInterface::CODE_AMOUNT))) {
            $wrapTotalData = $this->getWrapTotalData(
                $source->getData(CustomTotalInterface::CODE_AMOUNT),
                $source->getData(CustomTotalInterface::BASE_CODE_AMOUNT)
            );

            $parent->addTotal($wrapTotalData, 'subtotal');
        }

        return $this;
    }

    /**
     * @param $total
     * @param $baseTotal
     * @return DataObject
     */
    private function getWrapTotalData($total, $baseTotal) : DataObject
    {
        return $this->builder
                    ->setCode(CustomTotalInterface::CODE)
                    ->setValue($total)
                    ->setBaseValue($baseTotal)
                    ->setLabel(CustomTotalInterface::LABEL)
                    ->build();
    }
}
