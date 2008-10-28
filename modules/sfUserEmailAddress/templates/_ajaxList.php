<?php use_helper('I18N', 'Javascript', 'Form') ?>
<h2><?php echo __('Email Address') ?></h2>

  <?php foreach( $sf_user_user['EmailAddresses'] as $email_address ) : ?>
<div class="form-row">
  <div style="float: left;">
    <?php echo link_to_function(image_tag('/sf/sf_admin/images/edit_icon.png', array('alt' => __('edit'), 'title' => __('edit'))), remote_function(array(
    'update'  => 'lightbox',
    'url'     => 'sfUserEmailAddress/ajaxEdit?id=' . $email_address['id'],
    'complete' => "$('overlay', 'lightbox').invoke('show')",
    'method'  => 'get',
  ))) ?>
    <?php echo link_to_remote(image_tag('/sf/sf_admin/images/delete_icon.png', array('alt' => __('delete'), 'title' => __('delete'))), array(
    'url' => 'sfUserEmailAddress/ajaxDelete?id='.$email_address['id'], 
    'post' => true,
    'confirm' => __('Are you sure?'),
    'update' => "sfUserEmailAddress",
)) ?>
  </div>  
  <div class="content">
    <?php echo $email_address ?>
  </div>
</div>
  <?php endforeach; ?>

  <ul class="sf_admin_actions">
      <li><?php echo button_to_function(__('Add Email Address'), 
    !$sf_user_user->exists() ? "alert('You must save the user before adding properties')" : remote_function(array(
    'update'  => 'lightbox',
    'url'     => 'sfUserEmailAddress/ajaxEdit?sf_user_id=' . $sf_user_user['id'],
    'complete' => "$('overlay', 'lightbox').invoke('show');",
    'method'  => 'get',
  )), array (
  'class' => 'sf_admin_action_create',
)) ?></li>
  </ul>