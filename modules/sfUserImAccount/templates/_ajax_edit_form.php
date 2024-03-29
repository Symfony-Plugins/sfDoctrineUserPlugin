<?php
// auto-generated by sfDoctrineAdmin
// date: 2008/03/28 16:36:49
?>
<?php use_helper('Javascript', 'Form') ?>
<?php echo form_remote_tag(array(
    'complete'   => "$('overlay', 'lightbox').invoke('hide')",
    'update'   => "sfUserImAccount",
    'url'      => 'sfUserImAccount/ajaxSave',
), array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($sf_user_im_account, 'getid') ?>
<?php echo input_hidden_tag('sf_user_im_account[User]', $sf_user_im_account['user_id']) ?>

<fieldset id="sf_fieldset_details" class="">
<h2><?php echo __('Details') ?></h2>

<div class="form-row">
  <?php echo label_for('sf_user_im_account[ImAccountType]', __($labels['sf_user_im_account{ImAccountType}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('sf_user_im_account{ImAccountType}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('sf_user_im_account{ImAccountType}')): ?>
    <?php echo form_error('sf_user_im_account{ImAccountType}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_select_tag($sf_user_im_account, array (
  0 => 'get',
  1 => 
  array (
    0 => 'im_account_type_id',
  ),
), array (
  'related_class' => 'sfUserImAccountType',
  'control_name' => 'sf_user_im_account[ImAccountType]',
  'include_blank' => true,
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('sf_user_im_account[rank]', __($labels['sf_user_im_account{rank}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('sf_user_im_account{rank}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('sf_user_im_account{rank}')): ?>
    <?php echo form_error('sf_user_im_account{rank}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($sf_user_im_account, array (
  0 => 'get',
  1 => 
  array (
    0 => 'rank',
  ),
), array (
  'size' => 7,
  'control_name' => 'sf_user_im_account[rank]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('sf_user_im_account[nickname]', __($labels['sf_user_im_account{nickname}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('sf_user_im_account{nickname}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('sf_user_im_account{nickname}')): ?>
    <?php echo form_error('sf_user_im_account{nickname}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($sf_user_im_account, array (
  0 => 'get',
  1 => 
  array (
    0 => 'nickname',
  ),
), array (
  'size' => 80,
  'control_name' => 'sf_user_im_account[nickname]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('sf_user_im_account[updated_at]', __($labels['sf_user_im_account{updated_at}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('sf_user_im_account{updated_at}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('sf_user_im_account{updated_at}')): ?>
    <?php echo form_error('sf_user_im_account{updated_at}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = ($sf_user_im_account->updated_at !== null && $sf_user_im_account->updated_at !== '') ? format_date($sf_user_im_account->updated_at, "MM/dd/yy hh:mm a") : ''; echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('sf_user_im_account[UpdatedBy]', __($labels['sf_user_im_account{UpdatedBy}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('sf_user_im_account{UpdatedBy}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('sf_user_im_account{UpdatedBy}')): ?>
    <?php echo form_error('sf_user_im_account{UpdatedBy}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = $sf_user_im_account->UpdatedBy; echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('sf_user_im_account[created_at]', __($labels['sf_user_im_account{created_at}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('sf_user_im_account{created_at}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('sf_user_im_account{created_at}')): ?>
    <?php echo form_error('sf_user_im_account{created_at}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = ($sf_user_im_account->created_at !== null && $sf_user_im_account->created_at !== '') ? format_date($sf_user_im_account->created_at, "MM/dd/yy hh:mm a") : ''; echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('sf_user_im_account[CreatedBy]', __($labels['sf_user_im_account{CreatedBy}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('sf_user_im_account{CreatedBy}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('sf_user_im_account{CreatedBy}')): ?>
    <?php echo form_error('sf_user_im_account{CreatedBy}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = $sf_user_im_account->CreatedBy; echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<?php include_partial('ajax_edit_actions', array('sf_user_im_account' => $sf_user_im_account)) ?>

</form>

<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($sf_user_im_account->id): ?>
<?php echo button_to(__('delete'), 'sfUserImAccount/delete?id='.$sf_user_im_account->id, array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>
