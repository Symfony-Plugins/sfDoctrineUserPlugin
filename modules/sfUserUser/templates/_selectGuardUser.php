<?php use_helper('Form', 'Javascript') ?>
<?php if ( !isset($alias) ) $alias = 'sfGuardUser'; ?>
<?php echo input_tag('display_only', $object[$alias], 'disabled=disabled') ?>
<?php echo input_hidden_tag($super . "[$alias]", $object[$alias]['id']) ?>

<?php echo javascript_tag('
  function update(textbox_object, li_object) {
    textbox_object.value = "";
    $("display_only").value = li_object.lastChild.innerHTML;
    $("' . $super . '_' . $alias .'").value = li_object.firstChild.innerHTML;
  }
') ?>

<?php echo input_auto_complete_tag('search_string', '',
  'sfUserUser/guardSearch',
  array('autocomplete' => 'off',
        'class' => 'ac_field'
  ),
  array('use_style' => 'true',
    'indicator'  => 'indicator',
    'after_update_element' => 'update',
  )
) ?>
<div id="indicator" style="display: none">Loading...</div>