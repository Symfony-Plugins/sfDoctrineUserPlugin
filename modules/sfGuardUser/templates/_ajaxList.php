<?php use_helper('I18N', 'Javascript', 'Form') ?>
<h2><?php echo __('Security') ?></h2>

<div class="form-row">
  <div style="float: left;">
    <?php echo link_to_function(image_tag('/sf/sf_admin/images/edit_icon.png', array('alt' => __('edit'), 'title' => __('edit'))), 
    !$sf_user_user->exists() ? "alert('You must save the user before adding properties')" : remote_function(array(
    'update'  => 'lightbox',
    'url'     => 'sfGuardUser/ajaxEdit?id=' . $sf_user_user['sfGuardUser']['id'],
    'complete' => "$('overlay', 'lightbox').invoke('show')",
    'method'  => 'get',
  ))) ?>
  </div>  
  <div class="content">
    <label for="username">Username:</label> <?php echo $sf_user_user['sfGuardUser']['username'] ?><br />
    <br />
    <label for="active">Active:</label> <?php echo $sf_user_user['sfGuardUser']['is_active'] ? 'Yes' : 'No' ?><br />
    <br />
    <label for="groups">Groups:</label>
    <select size="5" id="groups"">
      <?php foreach ( $sf_user_user['sfGuardUser']['groups'] as $group ) : ?>
      <option><?php echo $group['name'] ?></option>
      <?php endforeach; ?>
    </select>
    <br />
    <label for="permissions">Permissions:</label>
    <select size="5" id="permissions">
      <?php foreach ( $sf_user_user['sfGuardUser']['permissions'] as $permission ) : ?>
      <option><?php echo $permission['name'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>
</div>