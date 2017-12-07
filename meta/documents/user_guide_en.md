# plentymarkets Payment&nbsp;– Invoice

With this plugin, you integrate the payment method **Invoice** into your online store.

## Setting up a payment method

In order to make this payment method available in your online store, you have to carry out the settings in the plentymarkets back end.

##### Setting up a payment method:

1. Go to **Settings&nbsp;» Orders&nbsp;» Payment » Invoice » Invoice**. 
2. Select a Client (store). 
3. Carry out the settings. Pay attention to the information given in table 1. 
4. **Save** the settings.

<table>
<caption>Table 1: Carrying out settings for the payment method</caption>
	<thead>
		<th>
			Setting
		</th>
		<th>
			Explanation
		</th>
	</thead>
	<tbody>
        <tr>
			<td>
				<b>Language</b>
			</td>
			<td>
				Select a language. Other settings, such as name, info page, etc., will be saved depending on the selected language.
			</td>
		</tr>
        <tr>
			<td>
				<b>Name</b>
			</td>
			<td>
				The name of the payment method that will be displayed in the overview of payment methods in the checkout.
			</td>
		</tr>
		<tr>
			<td>
				<b>Info page</b>
			</td>
			<td>
				Select a category page of the type <strong>content</strong> or an external website to provide <strong><a href="https://knowledge.plentymarkets.com/en/order-processing/payment/managing-bank-details#40">information about the payment method</a></strong>.
			</td>
		</tr>
		<tr>
			<td>
				<b>Info page internal/<br />Info page external</b>
			</td>
			<td>In the description of the payment method, a link to the <strong>details</strong> of the payment method is displayed.<br /><strong>Infopage (internal):</strong> By entering the category ID or using the selector, pick a category page of the type <strong>content</strong> to provide additional information on the payment method.<br /><strong>Info page (external):</strong> Enter the URL of an external information page. <strong><i>Important:</i></strong>Use either http:// or https://.<br />If no input is made, no link will be shown.
			</td>
		</tr>
        <tr>
			<td>
				<b>Logo</b>
			</td>
			<td>
			Select if the <strong>Standard logo</strong> of the payment method provided by the plugin or an individual logo is displayed.
			</td>
		</tr>				
		<tr>
			<td>
				<b>Logo-URL</b>
			</td>
			<td>
			An https URL that leads to the logo. Valid file formats are .gif, .jpg or .png. The image may not exceed a maximum size of 190 pixels in width and 60 pixels in height.
			</td>
		</tr>
		<tr>
			<td>
				<b>Description</b>
			</td>
			<td>
				Enter a description for the payment method to inform the customer in the checkout. The text will be cut with an ellipsis after 150 characters.
			</td>
		</tr>
		<tr>
			<td>
				<b>Countries of delivery</b>
			</td>
			<td>
				This payment method is active only for the countries in this list.
			</td>
		</tr>
		<tr>
			<td colspan="2" class="th">Display data</td>  
		</tr>
		<tr>
			<td>
				<b>Minimum number of orders</b>
			</td>  
			<td>
Enter a minimum number of orders to be completed by the customer with a different payment method before allowing the purchase on invoice.
			</td>
		</tr>
		<tr>
			<td>
				<b>Minimum amount for purchase on invoice</b>
			</td>  
			<td>
			Enter the amount, that must be exceeded when purchasing on invoice.
			</td>
		</tr> 
		<tr>
			<td>
				<b>Maximum invoice amount</b>
			</td>  
			<td>
			Enter the amount, that may not be exceeded when purchasing on invoice.
			</td>
		</tr>
		<tr>
			<td>
				<b>Designated use</b>
			</td>  
			<td>
			Enter designated use for purchase on invoice.
			</td>
		</tr>
		<tr>
			<td>
				<b>Show designated use</b>
			</td>  
			<td>
			Activate to display the designated use on the order confirmation page. This information must be linked with the respective <a href="#10."><strong>template container</strong></a>.
			</td>
		</tr>
		<tr>
			<td>
				<b>Show bank details</b>
			</td>  
			<td>
			Activate to display the bank details on the order confirmation page. Go to <strong>Settings » Basic settings » Bank</strong> to save bank details.
			</td>
		</tr>
		<tr>
			<td>
				<b>Invoice address and delivery address must match</b>
			</td>  
			<td>
			Activate if the invoice address and the delivery address must match when purchasing on invoice.
			</td>
		</tr>
		<tr>
			<td>
				<b>Do not allow purchase on invoice for guest accounts</b>
			</td>  
			<td>
			Activate to allow the purchase on invoice for registered and logged in users only.
			</td>
		</tr> 
	</tbody>
</table>

## Displaying the logo of the payment method on the homepage

The template plugin **Ceres** allows you to display the logo of your payment method on the homepage by using template containers. Proceed as described below to link the logo of the payment method.

##### Linking the logo with a template container:

1. Go to **Plugins » Content**. 
3. Click on **Invoice icon**. 
4. Activate the container **Homepage: Payment method container**. 
5. **Save** the settings.<br />→ The logo of the payment method will be displayed on the homepage of the online store.

## Displaying the bank details on the order confirmation page <a id="10." name="10."></a>

Proceed as follows to display the bank details that are saved in the system as well as a designated use on the order confirmation page.

##### Displaying bank details:

1. Go to **Settings&nbsp;» Orders&nbsp;» Payment » Invoice » Invoice**. 
2. Select a Client (store). 
3. Enter the **Designated use** in the **Display data** area. 
4. Activate the option **Show designated use**. 
5. Activate the option **Show bank details**. 
6. **Save** the settings.

After these settings, link the bank details with a template container.

##### Linking the bank details with a template container:

1. Go to **Plugins » Content**. 
3. Click on **Invoice bank details**. 
4. Activate the container **Order confirmation: Additional payment information**. 
5. **Save** the settings.<br />→ The bank details will be displayed on the order confirmation page.

## Generating invoice documents

Learn how to create [templates for invoice documents](https://www.plentymarkets.co.uk/manual/client-store/standard/documents/invoice/#3).

## License

This project is licensed under the GNU AFFERO GENERAL PUBLIC LICENSE. – find further information in the [LICENSE.md](https://github.com/plentymarkets/plugin-payment-invoice/blob/master/LICENSE.md).
