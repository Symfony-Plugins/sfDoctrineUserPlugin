<?php use_helper('I18N', 'Javascript', 'Form') ?>
<h2><?php echo __('IM Account') ?></h2>

  <?php foreach( $sf_user_user['ImAccounts'] as $im_account ) : ?>
<div class="form-row">
  <div style="float: left;">
    <?php echo link_to_function(image_tag('/sf/sf_admin/images/edit_icon.png', array('alt' => __('edit'), 'title' => __('edit'))), remote_function(array(
    'update'  => 'lightbox',
    'url'     => 'sfUserImAccount/ajaxEdit?id=' . $im_account['id'],
    'complete' => "$('overlay', 'lightbox').invoke('show')",
    'method'  => 'get',
  ))) ?>
    <?php echo link_to_remote(image_tag('/sf/sf_admin/images/delete_icon.png', array('alt' => __('delete'), 'title' => __('delete'))), array(
    'url' => 'sfUserImAccount/ajaxDelete?id='.$im_account['id'], 
    'post' => true,
    'confirm' => __('Are you sure?'),
    'update' => "sfUserImAccount",
)) ?>
  </div>  
  <div class="content">
    <?php echo $im_account ?>
  </div>
</div>
  <?php endforeach; ?>

  <ul class="sf_admin_actions">
      <li><?php echo button_to_function(__('Add IM Account'), 
    !$sf_user_user->exists() ? "alert('You must save the user before adding properties')" : remote_function(array(
    'update'  => 'lightbox',
    'url'     => 'sfUserImAccount/ajaxEdit?sf_user_id=' . $sf_user_user['id'],
    'complete' => "$('overlay', 'lightbox').invoke('show');",
    'method'  => 'get',
  )), array (
  'class' => 'sf_admin_action_create',
)) ?></li>
  </ul>