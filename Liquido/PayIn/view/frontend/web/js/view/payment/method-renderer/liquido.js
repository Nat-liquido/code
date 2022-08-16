define(
    [
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/view/payment/default',
        'mage/url'
    ],
    function (quote, Component, urlBuilder) {
        'use strict';

        return Component.extend({
            defaults: {
                redirectAfterPlaceOrder: false,
                template: 'Liquido_PayIn/payment/form'
            },
            afterPlaceOrder: function () {
                var url = urlBuilder.build("liquido/checkout/start");
                window.location.href = url;
            },
        });
    }
);
