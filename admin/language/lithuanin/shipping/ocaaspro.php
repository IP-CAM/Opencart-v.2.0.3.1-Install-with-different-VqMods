<?php
//==============================================//
// Product:	Advanced Shipping PRO              	//
// Author: 	Joel Reeds                        	//
// Company: OpenCart Addons                  	//
// Website: http://opencartaddons.com        	//
// Contact: http://opencartaddons.com/contact  	//
//==============================================//

// Heading
$_['heading_title']    			= 'Advanced Shipping PRO | <a href="http://opencartaddons.com" target="_blank">OpenCartAddons</a> |';
$_['heading_system_settings']	= 'System Settings';

//BreadCrumbs
$_['text_shipping']    			= 'Shipping';
$_['text_name']    				= 'Advanced Shipping PRO';

//General Text
$_['text_min']     				= 'Min';
$_['text_max']     	 			= 'Max';
$_['text_add']     	 			= 'Add';
$_['text_width']				= 'Width';
$_['text_height']				= 'Height';
$_['text_select_all']     		= 'Select All';
$_['text_unselect_all']     	= 'Unselect All';
$_['text_add_new']     	 		= 'Add New';
$_['text_confirm_delete']   	= 'Are you sure you want to delete this shipping rate?';
$_['text_confirm_delete_all']   = 'You are about to delete ALL of your shipping rates. Do you wish to continue?';

$_['text_all_customers']   		= 'All Customer Groups';
$_['text_guest_checkout']   	= 'Guest Checkout';
$_['text_all_zones']     		= 'All Other Zones';
$_['text_all_currencies']     	= 'All Currencies';
$_['text_all_categories']   	= 'All Categories';
$_['text_example']   			= 'Click For More Information';
$_['text_image_manager']   		= 'Image Manager';
$_['text_browse']   			= 'Browse Files';
$_['text_clear'] 	  			= 'Clear Image';

$_['text_loading']   			= 'Loading ...';
$_['text_saving']   			= 'Saving ...';
$_['text_demo']   				= 'The Extension Is Currently In Demo Mode. Some Features Are Disabled.';
$_['text_welcome']				= '<p>Thank you for purchasing ' . $_['text_name'] . ' by <a href="http://www.opencartaddons.com" target="_blank">OpenCart Addons</a>!<br/>Get started by clicking on the "Add New Shipping Rate" button in the toolbar!</p>';

//Tabs
$_['tab_rate']					= 'Shipping Rates';
$_['tab_combination']			= 'Combine Shipping Rates';
$_['tab_tutorial']				= 'Setup Guide & Tutorials';
$_['tab_support']				= 'Import / Export Rates & Support';
$_['tab_debug']					= 'Debug Log';

//Buttons
$_['button_save_all']			= 'Save All Shipping Rates';
$_['button_delete']				= 'Delete All Shipping Rates';
$_['button_tooltip']	 		= 'Tooltip Status';
$_['button_debug_download']	 	= 'Download Debug Log';
$_['button_debug_clear']	 	= 'Clear Debug Log';
$_['button_debug_reload']	 	= 'Reload Debug Log';
$_['button_rate_import']	 	= 'Import Shipping Rates';
$_['button_rate_export']	 	= 'Export Shipping Rates';
$_['button_feedback']	 		= 'Rate Extension';
$_['button_facebook']	 		= 'Like';
$_['button_twitter']	 		= 'Follow';
$_['button_submit']     		= 'Submit';
$_['button_close']     			= 'Close';
$_['button_demo']	 			= 'Purchase This Extension';
$_['button_rate_add']	 		= 'Add New Shipping Rate';
$_['button_rate_edit']	 		= 'Edit Shipping Rate';
$_['button_rate_save']			= 'Save & Close Shipping Rate';
$_['button_rate_close']			= 'Close Shipping Rate Without Saving';
$_['button_rate_copy']			= 'Create A Copy of This Shipping Rate';
$_['button_rate_delete']		= 'Delete Shipping Rate';

//Footers
$_['text_footer']      			= '<span class="help">Copyright &copy; 2011-' . date('Y') . ' <a href="http://www.opencartaddons.com" target="_blank">OpenCart Addons</a> - ' . $_['text_name'] . ' v%s</span>';
$_['text_rate_footer']			= 'Shipping Rate ID %s - This shipping rate was created on %s and was last modified on %s by %s.';

//Dynamic Options
$_['sort_quote_0']				= 'Sort Order (Ascending)';
$_['sort_quote_1']				= 'Sort Order (Descending)';
$_['sort_quote_2']				= 'Cost (Lowest To Highest)';
$_['sort_quote_3']				= 'Cost (Highest To Lowest)';

$_['title_display_0']			= 'First Shipping Name (e.g. Rate 1)';
$_['title_display_1']			= 'Last Shipping Name (e.g. Rate 2)';
$_['title_display_2']			= 'Combine Shipping Names Without Costs (e.g. Rate 1 + Rate 2)';
$_['title_display_3']			= 'Combine Shipping Names With Costs (e.g. Rate 1($1.00) + Rate 2($2.00))';

$_['calculation_method_0']		= 'Sum';
$_['calculation_method_1']		= 'Average';
$_['calculation_method_2']		= 'Lowest';
$_['calculation_method_3']		= 'Highest';

$_['final_cost_0']				= 'Single';
$_['final_cost_1']				= 'Cumulative';

$_['total_type_0']				= 'Total';
$_['total_type_1']				= 'Sub-Total';
$_['total_type_2']				= 'Sub-Total with Tax';

$_['requirement_match_any']		= 'Any Requirement Below Must Be Satisfied';
$_['requirement_match_all']		= 'All Requirements Below Must Be Satisfied';
$_['requirement_match_none']	= 'None Of The Requirements Below Must Be Satisfied';

$_['requirement_cost_every']	= 'Include All Products In Shipping Calculation Regardless Of Product Requirements';
$_['requirement_cost_any']		= 'Only Include Products In Shipping Calculation That Satisfy Any Product Requirement Below';
$_['requirement_cost_all']		= 'Only Include Products In Shipping Calculation That Satisfy All Product Requirements Below';
$_['requirement_cost_none']		= 'Only Include Products In Shipping Calculation That Satisfy None Of The Product Requirements Below';

$_['day_1']						= 'Sunday';
$_['day_2']						= 'Monday';
$_['day_3']						= 'Tuesday';
$_['day_4']						= 'Wednesday';
$_['day_5']						= 'Thursday';
$_['day_6']						= 'Friday';
$_['day_7']						= 'Saturday';

//Rate Types
$_['text_rate_group_cart']					= 'Cart Values';
$_['text_rate_type_cart_quantity']			= 'Cart Quantity';
$_['text_rate_type_cart_total']				= 'Cart Total';
$_['text_rate_type_cart_weight']			= 'Cart Weight';
$_['text_rate_type_cart_volume']			= 'Cart Volume';
$_['text_rate_type_cart_dim_weight']		= 'Cart Dimensional Weight';
$_['text_rate_type_cart_distance']			= 'Cart Distance (km)';
$_['text_rate_group_product']				= 'Product Values';
$_['text_rate_type_product_quantity']		= 'Product Quantity';
$_['text_rate_type_product_total']			= 'Product Total';
$_['text_rate_type_product_weight']			= 'Product Weight';
$_['text_rate_type_product_volume']			= 'Product Volume';
$_['text_rate_type_product_dim_weight']		= 'Product Dimensional Weight';
$_['text_rate_group_other']					= 'Other Shipping Methods';

//Requirement Types
$_['text_requirement_group_cart']					= 'Cart Requirements';
$_['text_requirement_type_cart_quantity']			= 'Cart Quantity';
$_['text_requirement_type_cart_total']				= 'Cart Total';
$_['text_requirement_type_cart_weight']				= 'Cart Weight (%s)';
$_['text_requirement_type_cart_volume']				= 'Cart Volume (%s)';
$_['text_requirement_type_cart_dim_weight']			= 'Cart Dimensional Weight (%s)';
$_['text_requirement_type_cart_distance']			= 'Cart Distance (km)';
$_['text_requirement_type_cart_length']				= 'Cart Length (%s)';
$_['text_requirement_type_cart_width']				= 'Cart Width (%s)';
$_['text_requirement_type_cart_height']				= 'Cart Height (%s)';
$_['text_requirement_group_product']				= 'Product Requirements';
$_['text_requirement_type_product_quantity']		= 'Product Quantity';
$_['text_requirement_type_product_total']			= 'Product Total';
$_['text_requirement_type_product_weight']			= 'Product Weight (%s)';
$_['text_requirement_type_product_volume']			= 'Product Volume (%s)';
$_['text_requirement_type_product_dim_weight']		= 'Product Dimensional Weight (%s)';
$_['text_requirement_type_product_length']			= 'Product Length (%s)';
$_['text_requirement_type_product_width']			= 'Product Width (%s)';
$_['text_requirement_type_product_height']			= 'Product Height (%s)';
$_['text_requirement_type_product_name']			= 'Product Name';
$_['text_requirement_type_product_model']			= 'Product Model';
$_['text_requirement_type_product_sku']				= 'Product SKU';
$_['text_requirement_type_product_upc']				= 'Product UPC';
$_['text_requirement_type_product_ean']				= 'Product EAN';
$_['text_requirement_type_product_jan']				= 'Product JAN';
$_['text_requirement_type_product_isbn']			= 'Product ISBN';
$_['text_requirement_type_product_mpn']				= 'Product MPN';
$_['text_requirement_type_product_location']		= 'Product Location';
$_['text_requirement_type_product_stock']			= 'Product Stock';
$_['text_requirement_type_product_category']		= 'Product Categories';
$_['text_requirement_type_product_manufacturer']	= 'Product Manufacturer';
$_['text_requirement_group_customer']				= 'Customer Requirements';
$_['text_requirement_type_customer_name']			= 'Customer Name';
$_['text_requirement_type_customer_email']			= 'Email';
$_['text_requirement_type_customer_telephone']		= 'Telephone';
$_['text_requirement_type_customer_fax']			= 'Fax';
$_['text_requirement_type_customer_company']		= 'Company';
$_['text_requirement_type_customer_address']		= 'Address';
$_['text_requirement_type_customer_city']			= 'City';
$_['text_requirement_type_customer_postcode']		= 'Postal Code';
$_['text_requirement_group_other']					= 'Other Requirements';
$_['text_requirement_type_currency']				= 'Currency';
$_['text_requirement_type_day']						= 'Day of The Week';
$_['text_requirement_type_date']					= 'Date';
$_['text_requirement_type_time']					= 'Time';

//Operators
$_['text_operator_eq']								= 'Equals';
$_['text_operator_neq']								= 'Does Not Equal';
$_['text_operator_gte']								= 'Greater Than Or Equals';
$_['text_operator_lte']								= 'Less Than Or Equals';
$_['text_operator_strpos']							= 'Contains';
$_['text_operator_nstrpos']							= 'Does Not Contain';
$_['text_operator_add']								= 'Add';
$_['text_operator_sub']								= 'Subtract';

//Parameters
$_['text_product_match_any']						= 'Any Product In The Cart Must Satisfy This Requirement';
$_['text_product_match_all']						= 'All Products In The Cart Must Satisfy This Requirement';
$_['text_product_match_none']						= 'No Products In The Cart Must Satisfy This Requirement';

$_['text_postcode_type_other']						= 'Non UK Postal Code Format';
$_['text_postcode_type_uk']							= 'UK Postal Code Format';

//System Settings
$_['entry_status']				= 'System Status';
$_['entry_title'] 				= 'Shipping Option Group Title <span class="optional">(Optional)</span>';
$_['entry_sort_order'] 			= 'Sort Order';
$_['entry_sort_quotes'] 		= 'Sort Shipping Rates';
$_['entry_title_display'] 		= 'Shipping Name When Combining Rates';
$_['entry_ocapps_status'] 		= 'Per Product Shipping Integration';
$_['entry_display_value'] 		= 'Display Cart Value';

//Combination Settings
$_['column_rate_group']			= 'Rate Group';
$_['column_calculation_method']	= 'Calculation Method';

//Tools & Support
$_['entry_import']  			= 'CSV Import File';
$_['entry_email']  				= 'Email';
$_['entry_order_id']  			= 'Order ID';
$_['entry_enquiry']  			= 'Enquiry';

//Debug
$_['entry_debug']  				= 'Debug Status';

//Rate Headings
$_['header_general']			= 'General';
$_['header_display']			= 'Checkout Display <span class="optional">(Optional)</span>';
$_['header_category']			= 'Category Settings <span class="optional">(Optional)</span>';
$_['header_rate']				= 'Shipping Calculation';
$_['header_requirements']		= 'Requirements <span class="optional">(Optional)</span>';

//Rate Settings
$_['entry_description']			= 'Rate Description';
$_['entry_rate_status'] 		= 'Shipping Rate Status';
$_['entry_group']				= 'Rate Group:';
$_['entry_tax']        			= 'Tax Class';
$_['entry_total_type']      	= 'Total Type';

$_['entry_name'] 				= 'Shipping Name';
$_['entry_instruction'] 		= 'Shipping Instructions';
$_['entry_image'] 				= 'Shipping Image';
$_['entry_image_size']			= 'Shipping Image Size';

$_['entry_stores']				= 'Stores';
$_['entry_customer_groups']		= 'Customer Groups';
$_['entry_geo_zones']			= 'Geo Zones';

$_['entry_rate_type'] 			= 'Shipping Cost Based On:';
$_['entry_final_cost']  		= 'Final Shipping Cost:';
$_['entry_shipping_factor'] 	= 'Shipping Factor:<br/><span class="help">(%s&sup3;/%s)</span>';
$_['entry_origin'] 				= 'Origin Address:';
$_['entry_shipping_method']  	= 'Shipping Method';
$_['entry_split']  		 		= 'Split Package:';
$_['entry_rate_currency']       = 'Currency:';
$_['entry_rates']  		 		= 'Shipping Rates';
$_['entry_cost']				= 'Shipping Cost Adjustments <span class="optional">(Optional)</span>';
$_['entry_freight_fee']  		= 'Handling Fee / Fuel Surcharge <span class="optional">(Optional)</span>';

$_['entry_requirement_match']	= 'Below Requirement Settings Must Be Met';
$_['entry_paramter']			= 'Parameter';
$_['entry_operator']			= 'Operation';
$_['entry_value']				= 'Value';

// Error
$_['error_permission'] 	 					= 'Warning: You do not have permission to modify ' . $_['text_name'] . '!';
$_['error_sort_order']      				= 'Warning: Sort order required in General Settings!';
$_['error_rate']    	 					= '<i class="fa fa-exclamation-circle fa-lg"></i> There Are Errors In Your Shipping Rate Settings. Please See The Shipping Rate Form For Details!';
$_['error_rate_stores']    	 				= '<i class="fa fa-exclamation-circle fa-lg"></i> No Stores Selected!';
$_['error_rate_customer_groups']			= '<i class="fa fa-exclamation-circle fa-lg"></i> No Customer Groups Selected!';
$_['error_rate_geo_zones']					= '<i class="fa fa-exclamation-circle fa-lg"></i> No Geo Zones Selected!';
$_['error_rate_shipping_factor']			= '<i class="fa fa-exclamation-circle fa-lg"></i> No Shipping Factor Defined!';
$_['error_rate_origin']						= '<i class="fa fa-exclamation-circle fa-lg"></i> No Origin Address Defined!';
$_['error_rate_postcode_range_formatting']	= '<i class="fa fa-exclamation-circle fa-lg"></i> Postal Code Range "%s" Is Not A Valid Format!';
$_['error_rate_postcode_formatting'] 		= '<i class="fa fa-exclamation-circle fa-lg"></i> Postal Code "%s" Is Not A Valid UK Format!<br/><br/>Valid UK Formats Include:<br/>AA0A0AA, A0A0AA, A00AA, A000AA, AA00AA, AA000AA<br/><br/>A - Any Letter, 0 - Any Single Number';
$_['error_rate_rates']						= '<i class="fa fa-exclamation-circle fa-lg"></i> No Shipping Rates Defined!';
$_['error_rate_rates_formatting']			= '<i class="fa fa-exclamation-circle fa-lg"></i> Shipping Rate "%s" Is Not A Valid Format!';
$_['error_rate_requirement']				= '<i class="fa fa-exclamation-circle fa-lg"></i> No Requirement Value Defined!';
$_['error_support']							= 'Error: Your support request failed to send. Make sure all fields are filled out and try again';
$_['error_debug']	   						= 'Warning: Your debug log file %s is %s. You must clear your debug log file. It is recommended that you download a copy first.';

// Success
$_['success_rate_import']      				= 'Success: %s shipping rates have been added and %s shipping rates have been updated!';
$_['success_support']						= 'Success: Your support request has been received. Please allow 1-2 business days for a response';
$_['success_debug_clear']      				= 'Success: Debug log has been cleared!';
$_['success_debug_reload']      			= 'Success: Debug log has been reloaded!';

//Modals
$_['modal_feedback_header']					= 'Rate & Leave Feedback';
$_['modal_feedback_body']					= '<p>We are always looking for ideas for new features and ways to improve my extensions. If you have an idea we would love to hear it!</p><p>Please select the website that you purchased this extension from to rate this extension and leave feedback.</p><p>Thanks!</p>';

$_['modal_tutorial_header']					= 'Shipping Rate Setup Tips';
$_['modal_tutorial_body']					= '<p>Setting up a shipping rate in ' . $_['text_name'] . ' can be very intimidating at first. If you follow these tips you will be a shipping rate master in no time!</p><h4>Tooltips</h4><p>Almost all fields are complete with pop-up tooltips that explain how that field works</p><h4>More Information</h4>Some sections contain a <i class="fa fa-info-circle" style="color: #3299BB;"> </i> icon which you can click on to get a more in-depth description as well as examples of how the section works and the types of settings to use.</p><h4>OpenCart Addons Blog</h4><p>For examples of different ways to utilize ' . $_['text_name'] . ', check out our <a href="https://www.opencartaddons.com/blog/category/shipping-setup-examples" alt="OpenCart Addons Blog" target="_blank">Blog</a>.';

$_['modal_rate_type_header']				= 'Shipping Cost Based On';
$_['modal_rate_type_body']					= '<p>Select what value will be used to calculate the shipping cost.</p><h4>Cart Values</h4><ul><li>Cart Quantity: The Shipping Rates will be based on the total Cart Quantity</li><li>Cart Total: The Shipping Rates will be based on the the Cart Total. The type of Total used is determined by the Total Type setting</li><li>Cart Weight: The Shipping Rates will be based on the total Cart Weight</li><li>Cart Volume: The Shipping Rates will be calculated based on the total physical Volume of all the products within the cart</li><li>Cart Dimensional Weight: The Shipping Rates will be based on the total Dimensional Weight of the cart. Dimensional Weight takes into account the length, width, and height of each product. If the product\'s Dimensional Weight is greater than the actual product weight, then the Dimensional Weight is used. If the actual product weight of greater than the Dimensional Weight of the product, then the actual product weight is used. A Shipping Factor must be defined when using Cart Dimensional Weight</li><li>Cart Distance: The Shipping Rates will be calculated based on the total distance between the Origin Address and the customer\'s address. The system will first attempt to calculate the distance using Google\'s Directions API. If a distance cannot be calculated, the system will automatically perform a straight line distance calculation based on coordinates and the curvature of the Earth. An Origin Address must be defined when using Cart Distance</li></ul><h4>Product Values</h4><ul><li>Product Quantity: The Shipping Rates will be based on the individual Product Quantity, then added together</li><li>Product Total: The Shipping Rates will be based on the individual Product Total, then added together. The type of Total used is determined by the Total Type setting</li><li>Product Weight: The Shipping Rates will be based on the individual Product Weight. then added together</li><li>Product Volume: The Shipping Rates will be calculated based on the individual physical Volume of each within the cart, then added together</li></ul><h4>Other Shipping Methods</h4><p>The list of other shipping methods will load dynamically based on the shipping extensions you have installed. If the shipping method you have selected has more than one shipping option, you must define the name of the shipping option in the Shipping Method field.';

$_['modal_shipping_factor_header']			= 'Shipping Factor';
$_['modal_shipping_factor_body']			= '<p>A Shipping Factor is only required when using Dimensional Weight to calculate the shipping cost. The Shipping Factor is used to determine the Dimensional Weight of a product (e.g. (length * width * height)/shipping factor). Here are some of the most common shipping factors used by freight carriers:<table class="table"><thead><tr><th>Metric</th><th>Imperial</th></tr></thead><tbody><tr><td>5000 cm&sup3;/kg = 200 kg/m&sup3;<br />6000 cm&sup3;/kg = 166.667 kg/m&sup3;<br />7000 cm&sup3;/kg = 142.857 kg/m&sup3;</td><td>166 in&sup3;/lb = 10.4 lb/ft&sup3; - common for IATA shipments<br />194 in&sup3;/lb = 8.9 lb/ft&sup3; - common for domestic shipments<br />216 in&sup3;/lb = 8.0 lb/ft&sup3;<br />225 in&sup3;/lb = 7.7 lb/ft&sup3;<br />250 in&sup3;/lb = 6.9 lb/ft&sup3;</td></tr></tbody></table>';

$_['modal_final_cost_header']				= 'Final Cost';
$_['modal_final_cost_body']					= '<p>Final cost determines how the shipping cost is generated based on the Shipping Rates.</p><ul><li>Single: The shipping cost is based on only the highest valid shipping rate bracket</li><li>Cumulative: The shipping cost is based on the highest valid shipping rate bracket, plus all lesser shipping rate brackets</li></ul>';

$_['modal_rates_header']					= 'Shipping Rates';
$_['modal_rates_body']						= '<h4>Shipping Rate Formats</h4><p>There are three valid Shipping Rate formats available:</p><ul><li>Flat Rate (value:cost)</li><li>Percentage (value:cost%)</li><li>Per Unit (value:cost/per)</li><li>Shipping Rate Fee (+fee - Added to end of shipping rate formula - e.g. value:cost+fee)</li></ul><p>You can use any combination of shipping rate formats in the Shipping Rates field to calculate the shipping cost.</p><h4>Flat Rate:</h4><table class="table"><thead><tr><th>Example</th><th>Shipping Rate Settings</th></tr></thead><tbody><tr><td>Shipping Charges:<br />1 to 5 Products = $5.00<br />5 to 10 Products = $12.00<br />10 to 20 Products = $25.00<br />20+ Products = $50.00</td><td>Calculate Shipping Based On: Quantity<br />Final Cost: Single<br />Shipping Rates: 5:5.00, 10:12.00, 20:25.00, ~:50.00</td></tr></tbody></table><h4>Percentage:</h4><table class="table"><thead><tr><th>Example</th><th>Shipping Rate Settings</th></tr></thead><tbody><tr><td>Shipping Charges:<br />$0.00 to $100.00 = $5.00<br />$100.00 to $200.00 = $35.00<br />$200.00 to $300.00 = $55.00<br />$300.00+ = 20% of Total + $35.00 Fee</td><td>Calculate Shipping Based On: Total<br />Final Cost: Single<br />Shipping Rates: 100:5.00, 200:35.00, 300:55.00, ~:20%+35.00</td></tr></tbody></table><h4>Per Unit</h4><table class="table"><thead><tr><th>Example</th><th>Shipping Rate Settings</th></tr></thead><tbody><tr><td>Shipping Charges:<br />$5.00 per kg</td> <td>Calculate Shipping Based On: Weight<br />Final Cost: Single<br />Shipping Rates: ~:5.00/1</td></tr></tbody></table><h4>Combining Rate Formats</h4><table class="table"><thead><tr><th>Example</th><th>Shipping Rate Settings</th></tr></thead><tbody><tr><td>Shipping Charges:<br />0kg to 1kg = $5.00<br />1kg to 5kg = $10.00<br />5kg to 10kg = $20.00<br />$2.50 Per Additional kg</td><td>Calculate Shipping Based On: Weight<br />Final Cost: Single<br />Shipping Rates: 1:5.00, 5:10.00, 10:20.00, ~:2.50/1</td></tr></tbody></table>';

$_['modal_requirements_header']				= 'Requirements';
$_['modal_requirements_body']				= '<p>Requirements allow you to dynamically create parameters that the customer’s shopping cart, or the customer themselves must meet in order to see the shipping rate. The parameters set also allow you to determine what products will be included in the shipping calculation.</p><p>You can add and remove requirements dynamically as required for each shipping rate individually. There are a variety of different requirement parameters that can be assigned, giving you virtually unlimited possibilities for tailoring ' . $_['text_name'] . ' to your needs.</>';

$_['modal_cart_requirements_header']		= 'Cart Requirements';
$_['modal_cart_requirements_body']			= '<p>Cart requirements allow you to activate or deactivate the shipping rate based on particular cart values.  You can also adjust the cart values for the shipping calculation.</p><p>Example, if you want to add 10% to the cart weight to account for the packaging material, you would create the requirement Cart Weight Add 10%.</p>';

$_['modal_product_requirements_header']		= 'Product Requirements';
$_['modal_product_requirements_body']		= '<p>Product requirements allow you to activate or deactivate the shipping rate based on particular product values, as well as determine what products are included in the shipping calculation.  You are also able to adjust some of the product values for the shipping calculation.</p><p>Example, if you want to add 0.5kg to each product, create the requirement Product Weight Add 0.5.  Product requirements support comma separated values, which means you can add multiple values to the value field. For example, if you want to look for products that contains either “iPod”, “iPad” or “iPhone” within the product name, create the requirement Product Name Contains iPod, iPad, iPhone.</p>';

$_['modal_customer_requirements_header']	= 'Customer Requirements';
$_['modal_customer_requirements_body']		= '<p>Customer requirements allow you to activate or deactivate a shipping rate based on particular customer values.</p><p>Example: You are able to assign a shipping rate to a particular city using the Requirement City, or set a delivery option based on the customer’s address.  You can even assign custom shipping costs for customers from a particular company using the customer requirement Company.</p><p>Also built into the customer requirements is an extensive postal code system. See below for more details.</p>';

$_['modal_postalcode_header']				= 'Postal Codes';
$_['modal_postalcode_body']					= '<p>Using Postal Code Ranges, you can assign shipping costs to specific areas within a geo zone. This is especially useful for limiting shipping rates to specific areas within a city (e.g. Same-day delivery).</p><h4>Postal Code Type</h4><p>Select the type of postal codes that are defined within the postal code range field.  There are two postal code types:</p><ul><li>UK Postal Code Format: Select this option when using UK Postal Code ranges. This is very important as there is a separate validation process for UK Postal Codes. You must input the full postal code formating (e.g. A11A1A:Z999Z9Z) the ranges when using this type of postal code. The postal code itself does not have to be valid, as long as the formatting is correct.</li><li>Non UK Postal Code Format: Use this option for all postal codes outside of the UK. The postal codes can be any format.</li></ul>';

$_['modal_other_requirements_header']		= 'Other Requirements';
$_['modal_other_requirements_body']			= '<p>Other requirements allow you to activate or deactivate the shipping rate based on parameters such as the date, day of the week, time of day, or even the currency that a customer has selected.</p><p>Example: You want to make a shipping rate only available on Monday from 9:00am to 5:00pm. To accomplish this, three Requirements would be created: Day of the Week Equals Monday, Time Greater Than Or Equals 9:00, and Time Less Than Or Equals 5:00.</p>';

$_['modal_requirement_match_header']		= 'Requirement Match Setting';
$_['modal_requirement_match_body']			= '<p>Define when the shipping rate is active based on the requirement settings.  Below are examples of how to use each setting.</p><h4>Any Requirement Below Must Be Satisfied</h4><p>This option is ideal for setting up requirements where only one requirement must be satisfied.</p><p>Example: When, creating a shipping rate where the product name or product model must contain the phrase “iPod”.  In this scenario, you would create two requirements: Product Name Contains iPod, and Product Model Contains iPod.  Now the shipping rate will become available if a product within the cart contains the phrase “iPod” within either the product name or the product model.</p><h4>All Requirements Below Must Be Satisfied</h4><p>This type of situation would occur if you have one or more requirements that must be met in order for the shipping rate to appear.</p><p>Example: You have a free shipping rate that requires the cart total to exceed $100.00, but the cart weight cannot exceed 20kg.  In this scenario, you would create two requirements: Cart Total Greater Than Or Equals 100, and Cart Weight Less Than Or Equals 20.</p><h4>None of the Requirements Below Must Be Satisfied</h4><p>This option is useful when dealing with situations where you don’t want any of the requirement settings to be met.  If any one of the requirement settings is met, the shipping rate will return false.</p><p>Example: A shipping rate that cannot exceed a cart length of 50cm, cart width of 75cm and a cart height of 100cm.  In this scenario, you would create three requirements: Cart Length Greater Than Or Equals 50, Cart Width Greater Than Or Equals 75, and Cart Height Greater Than Or Equals 100.</p>';

$_['modal_requirement_cost_header']			= 'Requirement Product Inclusion Setting';
$_['modal_requirement_cost_body']			= '<p>The product inclusion setting is used to determine which products are included in the shipping calculation based on the product requirements settings.  This setting does not determine whether a shipping rate is active or not.  Below are examples of how to use each setting.</p><h4>Include All Products in Shipping Calculation Regardless Of Product Requirements</h4><p>This option tells the system that all products within the cart are included in the shipping calculation, regardless of whether or not the product meets all or any of the product requirements.</p><h4>Only Include Products in Shipping Calculation That Satisfy Any Product Requirement Below</h4><p>In order for the product to be included in the shipping calculation, it must satisfy at least one of the product requirements that you have assigned to the shipping rate.  An example of this would be to only include products that contain the phrase iPod in the product name or product model as part of the shipping calculation.  In this example, you create two product requirements; Product Name Contains iPod, and Product Model Contains iPod.</p><h4>Only Include Products in Shipping Calculation That Satisfy All Product Requirements Below</h4><p>In order for the product to be included in the shipping calculation, it must satisfy all of the product requirements that you have assigned to the shipping rate.  An example of this would be to only include products with a product total greater than $100, and a product weight greater than 2kg.  For this example, you would create two product requirements: Product Total Greater Than Or Equals 100, and Product Weight Greater Than Or Equals 2.</p><h4>Only Include Products in Shipping Calculation That Satisfy None Of The Product Requirements Below</h4><p>Only products that do not satisfy any of the product requirements will be included in the shipping calculation.  An example of this would be to exclude all products with the phrase “iPod” within either the product name or product model from the shipping calculation.  In this example you would create two product requirements: Product Name Contains iPod, and Product Model Contains iPod.</p>';

//Help Text
$_['help_general']							= '<ul><li>All fields, with the exception of shipping rates, will save automatically.</li><li>Shipping Rates <strong>MUST</strong> be saved using the <i class="fa fa-floppy-o" style="color: #3299BB;"></i> icon.</li><li>A <span class="text-warning"><strong>Yellow</strong></span> box around a field indicates that the field is saving.</li><li>A <span class="text-success"><strong>Green</strong></span> box around a field indicates that the field was saved successfully.</li><li>A <span class="text-danger"><strong>Red</strong></span> box around a field indicates that the field failed to save. You can re-save the field by either updating the value or selecting the field and pressing "Enter".</li><li>Most fields are complete with a pop-up tooltip that explains the field</li><li>Clicking on the <i class="fa fa-info-circle" style="color: #3299BB;"></i> icon will display additional information about the settings.</li></ul>';
$_['help_combinations']						= '<h3>Combining Rates</h3><p>Combining shipping rates is very useful when you wish to charge separate shipping costs based on specific criteria, and combine those costs with another shipping rate. To group shipping rates together, both shipping rates must have the same Rate Group value and the same Calculation Method selected.</p><h4>Rate Group</h4><p>The first step to combining shipping rates is to assign the same Rate Group value to all of the shipping rates you wish to group together.</p><h4>Calculation Method</h4><p>The Calculation Method determines how the shipping rates are to be combined.<ul><li>Single: The shipping rate will appear as an individual shipping quote regardless of the Rate Group value</li><li>Sum: All shipping rates within the Rate Group will have their shipping costs added together for a total shipping cost</li><li>Average: All shipping rates within the Rate Group will have their shipping costs averaged together</li><li>Lowest: Only the shipping rate with the lowest shipping cost in the Rate Group will be used</li><li>Highest: Only the shipping rate with the highest shipping cost in the Rate Group will be used</li></ul>';
$_['help_import']							= '<h3>Import / Export Rates</h3><p>Export your shipping rates to a CSV file to share settings with other customers or to create a backup.</p>';
$_['help_support']							= '<h3>Support Request</h3><p>Having difficulty setting up your shipping rates? Send us a support request and we will walk you through the required settings to get the results you\'re looking for.</p><p>Please include a detailed description of your shipping requirements.</p>';
$_['help_debug']							= '<h3>Debug Log</h3><p>Enable debug mode to track the shipping rate validation process if your shipping rates are not appearing during checkout. It is not recommended to leave the debug mode on for live shops.</p>';

//Tooltips
$_['tooltip_status']				= 'Overall status of the extension. If this is set to disabled, ' . $_['text_name'] . ' will not be available during checkout';
$_['tooltip_title']					= 'This is the title that appears above the shipping rates';
$_['tooltip_sort_order']			= 'The order that the ' . $_['text_name'] . ' extension will appear amongst other shipping extensions during checkout';
$_['tooltip_ocapps_status']			= 'When enabled and Per Product Shipping is installed, ' . $_['text_name'] . ' will automatically add the Per Product Shipping costs to the final shipping calculation';
$_['tooltip_sort_quotes']			= 'Select the shipping rate sorting method';
$_['tooltip_title_display']			= 'Select how the shipping name will appear when combining multiple shipping rates together using either Sum or Average.';
$_['tooltip_display_value']			= 'When enabled the cart value (e.g. weight) used for calculation will appear in brackets after the shipping name (e.g. Next Day Delivery (2.75kg)). The cart value will not display when combining shipping names together and combining shipping rates together with either Sum or Average';

$_['tooltip_description'] 			= 'Give the rate a description that will appear in the shipping rate list in the administrator panel. The description is only visible by administrators';
$_['tooltip_rate_status']			= 'If this is set to disabled, this shipping rate will not be available to customers';
$_['tooltip_rate_sort_order'] 		= 'The order that this shipping rate will appear in the list';
$_['tooltip_group']					= 'Rate Group values are used to combine shipping rates together based on the Combining Rates settings. You must comma separate values when assigning multiple Rate Groups. Rate Groups are case sensitive. Leave this field blank to keep this rate single';
$_['tooltip_tax']					= 'Apply a tax charge to the shipping cost. Tax classes are loaded dynamically from your store settings';
$_['tooltip_total_type']			= 'Total is the running shopping cart total based on the order total extensions sort orders';

$_['tooltip_name']					= 'The name of the shipping rate that the customer sees';
$_['tooltip_instruction']			= 'A custom description that appears below the shipping name for the customer.  The shipping description will not display when combining shipping names together and combining shipping rates together with either Sum or Average.  HTML markup is supported';
$_['tooltip_image']					= 'A custom shipping image that displays before the shipping name. The shipping image will not display when combining shipping names together and combining shipping rates together with either Sum or Average. Warning: Using a shipping image may result in HTML markup showing in the shipping method name in order invoices';
$_['tooltip_image_width']			= 'The width of the shipping image';
$_['tooltip_image_height']			= 'The height of the shipping image';
	
$_['tooltip_stores'] 				= 'Select which stores this shipping rate is available for. The stores list is loaded dynamically from your store settings. To add a new store, click the Add New button below';
$_['tooltip_customer_groups']		= 'Select which customer groups are able to see this shipping rate. The customer groups list is loaded dynamically from your store settings. To add a new customer group, click the Add New button below';
$_['tooltip_geo_zones']				= 'Select which geo zones this shipping rate is available for. The geo zones list is loaded dynamically from your store settings. To add a new geo zone, click the Add New button below';

$_['tooltip_rate_type']				= 'Select the type of cart value to be used to calculate the shipping cost';
$_['tooltip_final_cost']			= 'Select whether to use a single shipping rate bracket, or to cumulate all valid shipping rate brackets together';
$_['tooltip_shipping_factor']		= 'The shipping factor is required when using Dimensional Weight. Click the info icon to see the most common shipping factor values';
$_['tooltip_origin']				= 'The origin address is required when calculating shipping based on Distance. Example: 123 Main Street Beverly Hills 90210 California United States';
$_['tooltip_split']					= 'The cart value will be split into multiple packages based on the highest shipping rate bracket that is setup in the shipping rates. The shipping cost will then be calculated for each individual package and added together for a final shipping cost';
$_['tooltip_shipping_method']		= 'Enter the full or partial name of the shipping method or the shipping code that the shipping cost will be pulled from (e.g. express)';
$_['tooltip_rate_currency']			= 'Select the currency that the shipping rates are based on. The shipping costs will be converted from this currency to the currency selected by the customer';
$_['tooltip_rates']					= 'Assign shipping costs using various rate formats. Click the info icon for more information on setting up shipping rates';

$_['tooltip_cost_min']				= 'The minimum allowed shipping cost. If the shipping cost is less than the minimum, the system will automatically increase the shipping cost';
$_['tooltip_cost_max']				= 'The maximum allowed shipping cost. If the shipping cost is greater than the maximum, the system will automatically reduce the shipping cost';
$_['tooltip_cost_add']				= 'Add an additional amount to the shipping cost. This value can be a whole number (e.g. 2.00) or a percentage of the shipping cost (e.g. 10%)';

$_['tooltip_freight_fee']			= 'Add a handling fee or fuel surcharge to the total shipping cost after the shipping cost adjustments. This value can be a whole number (e.g. 2.00) or a percentage of the total shipping cost after the shipping cost adjustments (e.g. 10%)';

$_['tooltip_requirement_match']		= 'Define when the shipping rate is active based on the requirement settings';
$_['tooltip_requirement_cost']		= 'Define which products are included in the shipping calculation based on the product requirements settings';

$_['tooltip_cart_quantity']			= 'Enter A Number';
$_['tooltip_cart_total']			= 'Enter A Number';
$_['tooltip_cart_weight']			= 'Enter A Number';
$_['tooltip_cart_volume']			= 'Enter A Number';
$_['tooltip_cart_distance']			= 'Enter A Number';
$_['tooltip_cart_length']			= 'Enter A Number';
$_['tooltip_cart_width']			= 'Enter A Number';
$_['tooltip_cart_height']			= 'Enter A Number';

$_['tooltip_product_quantity']		= 'Enter A Number';
$_['tooltip_product_total']			= 'Enter A Number';
$_['tooltip_product_weight']		= 'Enter A Number';
$_['tooltip_product_volume']		= 'Enter A Number';
$_['tooltip_product_length']		= 'Enter A Number';
$_['tooltip_product_width']			= 'Enter A Number';
$_['tooltip_product_height']		= 'Enter A Number';
$_['tooltip_product_name']			= 'Supports Comma Separated Values';
$_['tooltip_product_model']			= 'Supports Comma Separated Values';
$_['tooltip_product_sku']			= 'Supports Comma Separated Values';
$_['tooltip_product_upc']			= 'Supports Comma Separated Values';
$_['tooltip_product_ean']			= 'Supports Comma Separated Values';
$_['tooltip_product_jan']			= 'Supports Comma Separated Values';
$_['tooltip_product_isbn']			= 'Supports Comma Separated Values';
$_['tooltip_product_mpn']			= 'Supports Comma Separated Values';
$_['tooltip_product_location']		= 'Supports Comma Separated Values';
$_['tooltip_product_stock']			= 'Enter A Number';
$_['tooltip_product_category']		= 'Select Categories From The List';
$_['tooltip_product_stock']			= 'Select A Manufacturer';

$_['tooltip_customer_name']			= 'Supports Comma Separated Values';
$_['tooltip_customer_email']		= 'Supports Comma Separated Values';
$_['tooltip_customer_telephone']	= 'Supports Comma Separated Values';
$_['tooltip_customer_fax']			= 'Supports Comma Separated Values';
$_['tooltip_customer_company']		= 'Supports Comma Separated Values';
$_['tooltip_customer_address']		= 'Supports Comma Separated Values';
$_['tooltip_customer_city']			= 'Supports Comma Separated Values';
//$_['tooltip_customer_postcode']		= 'Define postal code ranges. You must use the full postal code format when using United Kingdom postal codes (e.g. A0A0AA:Z9Z9ZZ). You can create a postal code range using the format from:to, or single postal codes. All ranges must be comma separated';
$_['tooltip_customer_postcode']		= 'Define The Postal Code Ranges. Supports Comma Separated Values. Click The Info Icon Next To The Requirements Header For More Information';
$_['tooltip_customer_postcode_type']= 'Select The Postal Code Format Type';

$_['tooltip_currency']				= 'Select A Currency';
$_['tooltip_day']					= 'Select A Day';
$_['tooltip_date']					= 'Choose A Date';
$_['tooltip_time']					= 'Choose A Time';

//Advanced Shipping PRO & Per Product Shipping Integration
$_['text_ocapps_true']				= $_['text_name'] . ' is currently integrated with Per Product Shipping. Visit our <a href="http://opencartaddons.com/advanced-shipping-pro-per-product-shipping-integration" target="_blank">Integration Page</a> for more information on settings and functionality.';
$_['text_ocapps_false']				= 'Combine ' . $_['text_name'] . ' with <a href="http://opencartaddons.com/shipping/per-product-shipping" target="_blank">Per Product Shipping</a> for the ultimate shipping solution! Visit our <a href="http://opencartaddons.com/advanced-shipping-pro-per-product-shipping-integration" target="_blank">Integration Page</a> for more information on settings and functionality.';
?>