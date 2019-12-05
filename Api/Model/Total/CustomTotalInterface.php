<?php
/**
 * @author     Pavel Usachev <pausachev@gmail.com>
 * @copyright  2019 Pavel Usachev
 * @license    https://opensource.org/licenses/BSD-3-Clause  BSD-3-Clause
 */
namespace ALevel\CustomTotal\Api\Model\Total;

use Magento\Quote\Model\Quote\Address\Total\CollectorInterface;
use Magento\Quote\Model\Quote\Address\Total\ReaderInterface;

/**
 * Interface CustomTotalInterface
 * @package ALevel\CustomTotal\Api\Model\Total
 */
interface CustomTotalInterface extends CollectorInterface, ReaderInterface
{
    /**
     * @+
     * @const string
     */
    const CODE              = 'wrap_total';
    const CODE_AMOUNT       = 'wrap_total_amount';
    const BASE_CODE_AMOUNT  = 'base_wrap_total_amount';
    const LABEL             = 'Wrap Total';
}
