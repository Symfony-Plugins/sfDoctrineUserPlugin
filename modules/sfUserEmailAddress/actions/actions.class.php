<?php

/**
 * sfUserEmailAddress actions.
 *
 * @package    sfDoctrineUserPlugin
 * @subpackage sfUserEmailAddress
 * @author     Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class sfUserEmailAddressActions extends autosfUserEmailAddressActions
{
  public function executeAjaxSave()
  {
    $this->forward('sfUserEmailAddress', 'ajaxEdit');
  }

  public function executeAjaxEdit ()
  {
    $this->sf_user_email_address = $this->getsfUserEmailAddressOrCreate();
    
    if ( !$this->sf_user_email_address['id'] && $this->hasRequestParameter('sf_user_id') )
      $this->sf_user_email_address->set('user_id', $this->getRequestParameter('sf_user_id'));
    
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updatesfUserEmailAddressFromRequest();

      $this->savesfUserEmailAddress($this->sf_user_email_address);

      $this->sf_user_user = $this->sf_user_email_address['User'];
      $this->setTemplate('ajaxList');
      return sfView::SUCCESS;
    }
    else
    {
      $this->addJavascriptsForEdit();

      $this->labels = $this->getLabels();
    }
    
    // temporary fix to avoid using a distinct editSuccess.php template
    sfLoader::loadHelpers(array('Helper', 'ObjectDoctrineAdmin'));
  }

  public function executeAjaxDelete ()
  {
    $this->sf_user_email_address = Doctrine::getTable('sfUserEmailAddress')->find($this->getRequestParameter('id'));
    $this->sf_user_user = $this->sf_user_email_address['User'];
    
    $this->forward404Unless($this->sf_user_email_address);

    try
    {
      $this->deletesfUserEmailAddress($this->sf_user_email_address);
    }
    catch (Doctrine_Exception $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Sf user email address. Make sure it does not have any associated items.');
      return $this->forward('sfUserEmailAddress', 'list');
    }

    
    $this->setTemplate('ajaxList');
    return sfView::SUCCESS;
  }  
}
