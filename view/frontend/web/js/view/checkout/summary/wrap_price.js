/**
 * @author     Pavel Usachev <pausachev@gmail.com>
 * @copyright  2019 Pavel Usachev
 * @license    https://opensource.org/licenses/BSD-3-Clause  BSD-3-Clause
 */
define(
    [
        'Magento_Checkout/js/view/summary/abstract-total',
        'Magento_Checkout/js/model/quote',
        'Magento_Catalog/js/price-utils',
        'Magento_Checkout/js/model/totals'
    ],
    function (Component, quote, priceUtils, totals) {
        "use strict";
        return Component.extend({
            defaults: {
                template: 'ALevel_CustomTotal/checkout/summary/wrap_price',
                title: 'Wrap Price'
            },
            totals: quote.getTotals(),
            title: function () {
                return totals.getSegment('wrap_total').title;
            },

            isDisplayed: function () {
                return this.isFullMode() && this.getPureValue() !== 0;
            },

            getValue: function () {
                let price = 0;
                if (this.totals()) {
                    price = totals.getSegment('wrap_total').value;
                }
                return this.getFormattedPrice(price);
            },
            getPureValue: function () {
                let price = 0;
                if (this.totals()) {
                    price = totals.getSegment('wrap_total').value;
                }
                return price;
            }
        });
    }
);
