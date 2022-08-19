define(
    [
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/view/payment/default',
        'mage/url',
        'jquery',
    ],
    function (quote, Component, urlBuilder, jQuery) {
        'use strict';

        return Component.extend({
            defaults: {
                redirectAfterPlaceOrder: false,
                template: 'Liquido_PayIn/payment/form'
            },
            afterPlaceOrder: function () {
                jQuery("body").trigger("processStart");
                console.log(quote);
                console.log("quote id: " + quote.getQuoteId());
                console.log(quote.totals());
                console.log(quote.guestEmail);
                console.log(quote.shippingAddress());
                const grandTotal = quote.totals()['grand_total'];
                // var url = urlBuilder.build("liquido/checkout/start/?grandTotal="+ grandTotal);
                var url = urlBuilder.build("checkout/liquidobrl/index");
                window.location.href = url;
            },
        });
    }
);
