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
                var url = urlBuilder.build("liquido/checkout/start");
                window.location.href = url;
            },
        });
    }
);
