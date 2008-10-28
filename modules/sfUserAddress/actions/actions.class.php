<?php

/**
 * sfUserAddress actions.
 *
 * @package    sfDoctrineUserPlugin
 * @subpackage sfUserAddress
 * @author     Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class sfUserAddressActions extends autosfUserAddressActions
{
  public function executeAjaxSave()
  {
    $this->forward('sfUserAddress', 'ajaxEdit');
  }
    
  public function executeAjaxEdit()
  {
    $this->sf_user_address = $this->getsfUserAddressOrCreate();
    
    if ( !$this->sf_user_address['id'] && $this->hasRequestParameter('sf_user_id') )
      $this->sf_user_address->set('user_id', $this->getRequestParameter('sf_user_id'));

    if ( $this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updatesfUserAddressFromRequest();

      $this->savesfUserAddress($this->sf_user_address);

      //$this->setFlash('notice', 'Your modifications have been saved');

      $this->sf_user_user = $this->sf_user_address['User'];
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
    $this->sf_user_address = Doctrine::getTable('sfUserAddress')->find($this->getRequestParameter('id'));
    $this->sf_user_user = $this->sf_user_address['User'];
    
    $this->forward404Unless($this->sf_user_address);

    try
    {
      $this->deletesfUserAddress($this->sf_user_address);
    }
    catch (Doctrine_Exception $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Sf user address. Make sure it does not have any associated items.');
      return $this->forward('sfUserAddress', 'list');
    }
    
    $this->setTemplate('ajaxList');
    return sfView::SUCCESS;
  }
}
