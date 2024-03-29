<?php
// auto-generated by sfDoctrineAdmin
// date: 2008/03/26 18:54:23
?>
<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo __('Editing Email Address For "%%User%%"', 
array('%%User%%' => $sf_user_email_address->User)) ?></h1>

<div id="sf_admin_header">
<?php include_partial('sfUserEmailAddress/edit_header', array('sf_user_email_address' => $sf_user_email_address)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('sfUserEmailAddress/edit_messages', array('sf_user_email_address' => $sf_user_email_address, 'labels' => $labels)) ?>
<?php include_partial('sfUserEmailAddress/ajax_edit_form', array('sf_user_email_address' => $sf_user_email_address, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('sfUserEmailAddress/edit_footer', array('sf_user_email_address' => $sf_user_email_address)) ?>
</div>

</div>
