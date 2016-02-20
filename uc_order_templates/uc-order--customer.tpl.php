<?php

/**
 * @file
 * This file is the default customer invoice template for Ubercart.
 * - $op: 'view', 'print', 'checkout-mail' or 'admin-mail', depending on
 *   which variant of the invoice is being rendered.
 * - $business_header: TRUE if the invoice header should be displayed.
 * - $shipping_method: TRUE if shipping information should be displayed.
 * - $help_text: TRUE if the store help message should be displayed.
 * - $email_text: TRUE if the "do not reply to this email" message should
 *   be displayed.
 * - $store_footer: TRUE if the store URL should be displayed.
 * - $thank_you_message: TRUE if the 'thank you for your order' message
 *   should be displayed.
 *
 * @see template_preprocess_uc_order()
 * customized for Neruda Arts
 *    to add ticket types (attributes) in the invoice
 *    to display price with attributes instead of list price
 *    to change table colour
 *    to note the guest list for tickets
 */
?>

<table width="95%" border="0" cellspacing="0" cellpadding="1" align="center" bgcolor="#BA5431" style="font-family: verdana, arial, helvetica; font-size: small;">  
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#FFFFFF" style="font-family: verdana, arial, helvetica; font-size: small;">
        <?php if ($business_header): ?>
        <tr valign="top">
          <td>
            <table width="100%" style="font-family: verdana, arial, helvetica; font-size: small;">
              <tr>
                <td>
                  <?php print $site_logo; ?>
                </td>
                <td width="98%">
                  <div style="padding-left: 1em;">
                  <span style="font-size: large;"><?php print $store_name; ?></span><br />
                  <?php print $site_slogan; ?>
                  </div>
                </td>
                <td nowrap="nowrap">
                  <?php print $store_address; ?><br /><?php print $store_phone; ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <?php endif; ?>

        <tr valign="top">
          <td>

            <?php if ($thank_you_message): ?>
            <p><b><?php print t('Thanks for your order, !order_first_name!', array('!order_first_name' => $order_first_name)); ?></b></p>

            <?php if (isset($order->data['new_user'])): ?>
            <p><b><?php print t('An account has been created for you with the following details:'); ?></b></p>
            <p><b><?php print t('Username:'); ?></b> <?php print $order_new_username; ?><br />
            <b><?php print t('Password:'); ?></b> <?php print $order_new_password; ?></p>
            <?php endif; ?>
			
			<p><b><?php echo t('This email is your receipt.  Your email address will be on the guest list at the front door.  Enjoy the show!'); ?></b></p>

            <p><b><?php print t('Want to manage your order online?'); ?></b><br />
            <?php print t('If you need to check the status of your order, please visit our home page at !store_link and click on "My account" in the menu or login with the following link:', array('!store_link' => $store_link)); ?>
            <br /><br /><?php print $site_login_link; ?></p>
            <?php endif; ?>

            <table cellpadding="4" cellspacing="0" border="0" width="100%" style="font-family: verdana, arial, helvetica; font-size: small;">
              <tr>
                <td colspan="2" bgcolor="#BA5431" style="color: white;">
                  <b><?php print t('Purchasing Information:'); ?></b>
                </td>
              </tr>
              <tr>
                <td nowrap="nowrap">
                  <b><?php print t('E-mail Address:'); ?></b>
                </td>
                <td width="98%">
                  <?php print $order_email; ?>
                </td>
              </tr>
              <tr>
                <td colspan="2">

                  <table width="100%" cellspacing="0" cellpadding="0" style="font-family: verdana, arial, helvetica; font-size: small;">
                    <tr>
                      <td valign="top" width="50%">
                        <b><?php print t('Billing Address:'); ?></b><br />
                        <?php print $order_billing_address; ?><br />
                        <br />
                        <b><?php print t('Billing Phone:'); ?></b><br />
                        <?php print $order_billing_phone; ?><br />
                      </td>
                      <?php if ($shippable): ?>
                      <td valign="top" width="50%">
                        <b><?php print t('Shipping Address:'); ?></b><br />
                        <?php print $order_shipping_address; ?><br />
                        <br />
                        <b><?php print t('Shipping Phone:'); ?></b><br />
                        <?php print $order_shipping_phone; ?><br />
                      </td>
                      <?php endif; ?>
                    </tr>
                  </table>

                </td>
              </tr>
              <tr>
                <td nowrap="nowrap">
                  <b><?php print t('Order Grand Total:'); ?></b>
                </td>
                <td width="98%">
                  <b><?php print $order_total; ?></b>
                </td>
              </tr>
              <tr>
                <td nowrap="nowrap">
                  <b><?php print t('Payment Method:'); ?></b>
                </td>
                <td width="98%">
                  <?php print $order_payment_method; ?>
                </td>
              </tr>

              <tr>
                <td colspan="2" bgcolor="#BA5431" style="color: white;">
                  <b><?php print t('Order Summary:'); ?></b>
                </td>
              </tr>

              <?php if ($shippable): ?>
              <tr>
                <td colspan="2" bgcolor="#EEEEEE">
                  <font color="#CC6600"><b><?php print t('Shipping Details:'); ?></b></font>
                </td>
              </tr>
              <?php endif; ?>

              <tr>
                <td colspan="2">

                  <table border="0" cellpadding="1" cellspacing="0" width="100%" style="font-family: verdana, arial, helvetica; font-size: small;">
                    <tr>
                      <td nowrap="nowrap">
                        <b><?php print t('Order #:'); ?></b>
                      </td>
                      <td width="98%">
                        <?php print $order_link; ?>
                      </td>
                    </tr>

                    <tr>
                      <td nowrap="nowrap">
                        <b><?php print t('Order Date: '); ?></b>
                      </td>
                      <td width="98%">
                        <?php print $order_created; ?>
                      </td>
                    </tr>

                    <?php if ($shipping_method && $shippable): ?>
                    <tr>
                      <td nowrap="nowrap">
                        <b><?php print t('Shipping Method:'); ?></b>
                      </td>
                      <td width="98%">
                        <?php print $order_shipping_method; ?>
                      </td>
                    </tr>
                    <?php endif; ?>

                    <tr>
                      <td nowrap="nowrap">
                        <?php print t('Products Subtotal:'); ?>&nbsp;
                      </td>
                      <td width="98%">
                        <?php print $order_subtotal; ?>
                      </td>
                    </tr>

                    <?php
                    $context = array(
                      'revision' => 'themed',
                      'type' => 'line_item',
                      'subject' => array(
                        'order' => $order,
                      ),
                    );
                    foreach ($line_items as $item) {
                    if ($item['line_item_id'] == 'subtotal' || $item['line_item_id'] == 'total') {
                      continue;
                    }?>

                    <tr>
                      <td nowrap="nowrap">
                        <?php print $item['title']; ?>:
                      </td>
                      <td>
                        <?php
                          $context['subject']['line_item'] = $item;
                          print uc_price($item['amount'], $context);
                        ?>
                      </td>
                    </tr>

                    <?php } ?>

                    <tr>
                      <td>&nbsp;</td>
                      <td>------</td>
                    </tr>

                    <tr>
                      <td nowrap="nowrap">
                        <b><?php print t('Total for this Order:'); ?>&nbsp;</b>
                      </td>
                      <td>
                        <b><?php print $order_total; ?></b>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="2">
                        <br /><br /><b><?php print t('Products on order:'); ?>&nbsp;</b>

                        <table width="100%" style="font-family: verdana, arial, helvetica; font-size: small;">

                          <?php if (is_array($order->products)) {
                            $context = array(
                              'revision' => 'formatted',
                              'type' => 'order_product',
                              'subject' => array(
                                'order' => $order,
                              ),
                            );
                            foreach ($order->products as $product) {
                              $price_info = array(
                                'price' => $product->price,
                                'qty' => $product->qty,
                              );
                              $context['subject']['order_product'] = $product;
                              $context['subject']['node'] = node_load($product->nid);
                              ?>
                          <tr>
                            <td valign="top" nowrap="nowrap">
                              <b><?php print $product->qty; ?> x </b>
                            </td>
                            <td width="98%">
                              <b><?php print $product->title .' - '. uc_price($price_info, $context); ?></b>
                              <?php if ($product->qty > 1) {
                                $price_info['qty'] = 1;
                                print t('(!price each)', array('!price' => uc_price($price_info, $context)));
                              } ?>
                              <br />
                              <?php if (isset($product->data['attributes']) && is_array($product->data['attributes']) && count($product->data['attributes']) > 0) {?>
                              <?php foreach ($product->data['attributes'] as $attribute => $option) {
                                print '<li>'. t('@attribute: @options', array('@attribute' => $attribute, '@options' => implode(', ', (array)$option))) .'</li>';
                              } ?>
                              <?php } ?>                              <?php 
								$productnode = node_load($product->nid);
								
								$image_path = $productnode->field_image_cache[0]['filepath'];
								?>
								<div style="float:left";>
								<?php
								print theme('imagecache', 'product', $image_path, $productnode->title, '');	
								?>
								</div>
								<?php
								
								// print "<pre>".print_r($product)."</pre>";
								if ($product->shippable == 0) {
								   print $productnode->body; 
								   
								  $view = views_get_view('uc_products');
								  $view->set_display('block_3');
								  $view->set_arguments(array($product->nid));
								  // change the amount of items to show
								  $view->set_items_per_page(4);
								  $view->pre_execute();
								  $view->execute();
								  print $view->render();								   
								}
							  ?>
							  <br />
								
								
							  <?php 
							  
//							  drupal_set_message("<pre>".print_r($productnode)."</pre>");


									?>

                              <br />
                            </td>
                          </tr>
                          <?php }
                              }?>
                        </table>

                      </td>
                    </tr>
                  </table>

                </td>
              </tr>

              <?php if ($help_text || $email_text || $store_footer): ?>
              <tr>
                <td colspan="2">
                  <hr noshade="noshade" size="1" /><br />

                  <?php if ($help_text): ?>
                  <p><b><?php print t('Where can I get help with reviewing my order?'); ?></b><br />
                  <?php print t('To learn more about managing your orders on !store_link, please visit our <a href="!store_help_url">help page</a>.', array('!store_link' => $store_link, '!store_help_url' => $store_help_url)); ?>
                  <br /></p>
                  <?php endif; ?>

                  <?php if ($email_text): ?>
                  <p><?php print t('Please note: This e-mail message is an automated notification. Please do not reply to this message.'); ?></p>

                  <p><?php print t('Thanks again for shopping with Neruda Arts.'); ?></p>
                  <?php endif; ?>

                  <?php if ($store_footer): ?>
                  <p><b><?php print $store_link; ?></b><br /><b><?php print $site_slogan; ?></b></p>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endif; ?>

            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
