<?php
/**
 * @author     Pavel Usachev <pausachev@gmail.com>
 * @copyright  2019 Pavel Usachev
 * @license    https://opensource.org/licenses/BSD-3-Clause  BSD-3-Clause
 */
namespace ALevel\CustomTotal\Api\Builder;

use Magento\Framework\DataObject;
use Magento\Framework\Phrase;

/**
 * Interface CustomTotalBuilderInterface
 * @package ALevel\CustomTotal\Api\Builder
 */
interface CustomTotalBuilderInterface
{
    /**
     * @return DataObject
     */
    public function build() : DataObject;

    /**
     * @param string $code
     * @return CustomTotalBuilderInterface
     */
    public function setCode(string $code) : CustomTotalBuilderInterface;

    /**
     * @param float $value
     * @return CustomTotalBuilderInterface
     */
    public function setValue(float $value) : CustomTotalBuilderInterface;

    /**
     * @param float $value
     * @return CustomTotalBuilderInterface
     */
    public function setBaseValue(float $baseValue) : CustomTotalBuilderInterface;

    /**
     * @param string $label
     * @return CustomTotalBuilderInterface
     */
    public function setLabel(Phrase $label) : CustomTotalBuilderInterface;
}
