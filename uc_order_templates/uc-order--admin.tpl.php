<?php

/**
 * @file
 * This file is the default admin notification template for Ubercart.
 */
?>

<p>
<?php print t('Order number:'); ?> <?php print $order_admin_link; ?><br />
<?php print t('Customer:'); ?> <?php print $order_first_name; ?> <?php print $order_last_name; ?> - <?php print $order_email; ?><br />
<?php print t('Order total:'); ?> <?php print $order_total; ?><br />
<?php print t('Shipping method:'); ?> <?php print $order_shipping_method; ?>
</p>

<p>
<?php print t('Products:'); ?><br />
<?php
$context = array(
  'revision' => 'themed',
  'type' => 'order_product',
  'subject' => array(
    'order' => $order,
  ),
);
foreach ($products as $product) {
  $price_info = array(
    'price' => $product->price,
    'qty' => $product->qty,
  );
  $context['subject']['order_product'] = $product;
?>
- <?php print $product->qty; ?> x <?php print $product->title .' - '. uc_price($price_info, $context); ?><br />
&nbsp;&nbsp;<?php print t('SKU: ') . $product->model; ?><br />
    <?php if (isset($product->data['attributes']) && is_array($product->data['attributes']) && count($product->data['attributes']) > 0) {?>
    <?php foreach ($product->data['attributes'] as $attribute => $option) {
      print '&nbsp;&nbsp;'. t('@attribute: @options', array('@attribute' => $attribute, '@options' => implode(', ', (array)$option))) .'<br />';
    } ?>
    <?php } ?>
<br />
<?php } ?>
</p>

<p>
<?php print t('Order comments:'); ?><br />
<?php print $order_comments; ?>
</p>
