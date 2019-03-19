<div class="alert alert-warning" role="alert">
   <strong><i>Note:</strong></i> This plugin requires Ceres and IO in version 2.0.3 or above.
</div>

# plentymarkets Payment&nbsp;– Cash on delivery

With this plugin, you integrate the payment method **Cash on delivery** into your online store.

## Setting up a payment method

To make the payment method available in your online store, you have to carry out settings in the back end of your plentymarkets system.

First of all, activate the payment method once in the **System » System Settings » Orders » Payment » Methods** menu. More information on carrying out this setting is available on the <strong><a href="https://knowledge.plentymarkets.com/en/payment/managing-payment-methods#20" target="_blank">Managing payment methods</a></strong> page of the manual.

In addition, make sure that the payment method is included among the Permitted payment methods in the <strong><a href="https://knowledge.plentymarkets.com/en/crm/managing-contacts#15" target="_blank">customer classes</a></strong> and that it is not listed among the Blocked payment methods in the <strong><a href="https://knowledge.plentymarkets.com/en/order-processing/fulfilment/preparing-the-shipment#1000" target="_blank">shipping profiles</a></strong>.


##### Setting up a payment method:

1. Go to **System&nbsp;» System settings » Orders&nbsp;» Shipping » Options**.
2. Go to the tab **Shipping profiles**.
3. Activate the option **Cash on delivery**.
4. Go to the tab **Table of shipping charges**.
5. Carry out the settings. Pay attention to the information on <a href="https://knowledge.plentymarkets.com/en/fulfilment/preparing-the-shipment#1500"><strong>Shipping profiles</strong></a>.
5. **Save** the settings.

## Displaying the payment method in the online store

The template plugin **Ceres** provides the option to display an individual name and logo for a payment method in the checkout. Proceed as follows to display name and logo for this payment method.

##### Setting up name and logo:

1. Go to **Plugins » Plugin overview**.
2. Click on the plugin **Cash on delivery**.
3. Click on **Configuration**.
4. Under **Name**, enter the name to be displayed for the payment method.
5. Under **Logo URL**, enter an https URL that leads to the logo. Valid file formats are .gif, .jpg or .png. The image may not exceed a maximum size of 190 pixels in width and 60 pixels in height.
5. **Save** the settings.<br />→ Name and logo for the payment method are displayed in the checkout.

## Selecting the payment method

If at least one active and valid shipping profile has the option **Cash on delivery**, the payment method is displayed in the checkout, but cannot be selected. After selecting a shipping profile with the option **Cash on delivery**, the payment method is automatically selected.

## License

This project is licensed under the GNU AFFERO GENERAL PUBLIC LICENSE. – find further information in the [LICENSE.md](https://github.com/plentymarkets/plugin-payment-invoice/blob/master/LICENSE.md).
