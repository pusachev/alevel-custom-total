<?php
/**
 * @author     Pavel Usachev <pausachev@gmail.com>
 * @copyright  2019 Pavel Usachev
 * @license    https://opensource.org/licenses/BSD-3-Clause  BSD-3-Clause
 */
namespace ALevel\CustomTotal\Builder;

use ALevel\CustomTotal\Api\Builder\CustomTotalBuilderInterface;
use Magento\Framework\DataObject;
use Magento\Framework\DataObjectFactory;
use Magento\Framework\Phrase;

/**
 * Class WrapTotalBuilder
 * @package ALevel\CustomTotal\Builder
 */
class WrapTotalBuilder implements CustomTotalBuilderInterface
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var Phrase
     */
    private $label;

    /**
     * @var float
     */
    private $value;

    /**
     * @var float
     */
    private $baseValue;

    /**
     * @var DataObjectFactory
     */
    private $dataObjectFactory;

    /**
     * WrapTotalBuilder constructor.
     * @param DataObjectFactory $dataObjectFactory
     */
    public function __construct(DataObjectFactory $dataObjectFactory)
    {
        $this->dataObjectFactory = $dataObjectFactory;
    }

    /**
     * @inheritDoc
     */
    public function build(): DataObject
    {
        $this->validate();

        return $this->dataObjectFactory
                    ->create(
                        [
                            'data' => [
                                'code'       => $this->code,
                                'value'      => $this->value,
                                'base_value' => $this->baseValue,
                                'label'      => $this->label
                            ]
                        ]
                    );
    }

    /**
     * @inheritDoc
     */
    public function setCode(string $code): CustomTotalBuilderInterface
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setValue(float $value): CustomTotalBuilderInterface
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setBaseValue(float $baseValue): CustomTotalBuilderInterface
    {
        $this->baseValue = $baseValue;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLabel(string $label): CustomTotalBuilderInterface
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @throws \LogicException
     */
    private function validate()
    {
        $prop = get_object_vars($this);

        foreach ($prop as $name => $value) {
            if ($value === null) {
                throw new \LogicException(sprintf("property %s is not initialized", $name));
            }
        }
    }
}
