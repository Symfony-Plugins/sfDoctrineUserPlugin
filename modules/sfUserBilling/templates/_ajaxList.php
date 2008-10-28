<?php use_helper('I18N', 'Javascript', 'Form') ?>
<h2><?php echo __('Billings') ?></h2>

  <?php foreach( $sf_user_user['Billings'] as $billing) : ?>
<div class="form-row">
  <div style="float: left;">
    <?php echo link_to_function(image_tag('/sf/sf_admin/images/edit_icon.png', array('alt' => __('edit'), 'title' => __('edit'))), remote_function(array(
    'update'  => 'lightbox',
    'url'     => 'sfUserBilling/ajaxEdit?id=' . $billing['id'],
    'complete' => "$('overlay', 'lightbox').invoke('show')",
    'method'  => 'get',
  ))) ?>
    <?php echo link_to_remote(image_tag('/sf/sf_admin/images/delete_icon.png', array('alt' => __('delete'), 'title' => __('delete'))), array(
    'url' => 'sfUserBilling/ajaxDelete?id='.$billing['id'], 
    'post' => true,
    'confirm' => __('Are you sure?'),
    'update' => "sfUserBilling",
)) ?>
  </div>  
  <div class="content">
    <?php echo $billing ?>
  </div>
</div>
  <?php endforeach; ?>

  <ul class="sf_admin_actions">
      <li><?php echo button_to_function(__('Add Billing'), 
    !$sf_user_user->exists() ? "alert('You must save the user before adding properties')" : remote_function(array(
    'update'  => 'lightbox',
    'url'     => 'sfUserBilling/ajaxEdit?sf_user_id=' . $sf_user_user['id'],
    'complete' => "$('overlay', 'lightbox').invoke('show');",
    'method'  => 'get',
  )), array (
  'class' => 'sf_admin_action_create',
)) ?></li>
  </ul>