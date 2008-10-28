<?php

/**
 * sfUserPhone actions.
 *
 * @package    sfDoctrineUserPlugin
 * @subpackage sfUserPhone
 * @author     Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class sfUserPhoneActions extends autosfUserPhoneActions
{
  
  public function executeAjaxSave ()
  {
    return $this->forward('sfUserPhone', 'ajaxEdit');
  }

  public function executeAjaxEdit ()
  {
    $this->sf_user_phone = $this->getsfUserPhoneOrCreate();
    
    if ( !$this->sf_user_phone['id'] && $this->hasRequestParameter('sf_user_id') )
      $this->sf_user_phone->set('user_id', $this->getRequestParameter('sf_user_id'));

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updatesfUserPhoneFromRequest();

      $this->savesfUserPhone($this->sf_user_phone);

      $this->setFlash('notice', 'Your modifications have been saved');

      $this->sf_user_user = $this->sf_user_phone['User'];
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
    $this->sf_user_phone = Doctrine::getTable('sfUserPhone')->find($this->getRequestParameter('id'));
    $this->sf_user_user = $this->sf_user_phone['User'];
    
    $this->forward404Unless($this->sf_user_phone);

    try
    {
      $this->deletesfUserPhone($this->sf_user_phone);
    }
    catch (Doctrine_Exception $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Sf user phone. Make sure it does not have any associated items.');
      return $this->forward('sfUserPhone', 'list');
    }

    $this->setTemplate('ajaxList');
    return sfView::SUCCESS;
  }
  
  
}
