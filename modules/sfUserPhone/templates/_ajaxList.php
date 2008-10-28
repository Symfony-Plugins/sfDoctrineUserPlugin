<?php use_helper('I18N', 'Javascript', 'Form') ?>
<h2><?php echo __('Phones') ?></h2>

  <?php foreach( $sf_user_user['Phones'] as $phone) : ?>
<div class="form-row">
  <div style="float: left;">
    <?php echo link_to_function(image_tag('/sf/sf_admin/images/edit_icon.png', array('alt' => __('edit'), 'title' => __('edit'))), remote_function(array(
    'update'  => 'lightbox',
    'url'     => 'sfUserPhone/ajaxEdit?id=' . $phone['id'],
    'complete' => "$('overlay', 'lightbox').invoke('show')",
    'method'  => 'get',
  ))) ?>
    <?php echo link_to_remote(image_tag('/sf/sf_admin/images/delete_icon.png', array('alt' => __('delete'), 'title' => __('delete'))), array(
    'url' => 'sfUserPhone/ajaxDelete?id='.$phone['id'], 
    'post' => true,
    'confirm' => __('Are you sure?'),
    'update' => "sfUserPhone",
)) ?>
  </div>  
  <div class="content">
    <?php echo $phone ?>
  </div>
</div>
  <?php endforeach; ?>

  <ul class="sf_admin_actions">
      <li><?php echo button_to_function(__('Add Phone'), 
    !$sf_user_user->exists() ? "alert('You must save the user before adding properties')" : remote_function(array(
    'update'  => 'lightbox',
    'url'     => 'sfUserPhone/ajaxEdit?sf_user_id=' . $sf_user_user['id'],
    'complete' => "$('overlay', 'lightbox').invoke('show');",
    'method'  => 'get',
  )), array (
  'class' => 'sf_admin_action_create',
)) ?></li>
  </ul>