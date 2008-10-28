<?php

/**
 * sfUserImAccount actions.
 *
 * @package    sfDoctrineUserPlugin
 * @subpackage sfUserImAccount
 * @author     Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class sfUserImAccountActions extends autosfUserImAccountActions
{
  public function executeAjaxSave()
  {
    $this->forward('sfUserImAccount', 'ajaxEdit');
  }

  public function executeAjaxEdit ()
  {
    $this->sf_user_im_account = $this->getsfUserImAccountOrCreate();
    
    if ( !$this->sf_user_im_account['id'] && $this->hasRequestParameter('sf_user_id') )
      $this->sf_user_im_account->set('user_id', $this->getRequestParameter('sf_user_id'));

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updatesfUserImAccountFromRequest();

      $this->savesfUserImAccount($this->sf_user_im_account);

//      $this->setFlash('notice', 'Your modifications have been saved');

      $this->sf_user_user = $this->sf_user_im_account['User'];
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
    $this->sf_user_im_account = Doctrine::getTable('sfUserImAccount')->find($this->getRequestParameter('id'));
    $this->sf_user_user = $this->sf_user_im_account['User'];
    
    $this->forward404Unless($this->sf_user_im_account);

    try
    {
      $this->deletesfUserImAccount($this->sf_user_im_account);
    }
    catch (Doctrine_Exception $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Sf user im account. Make sure it does not have any associated items.');
      return $this->forward('sfUserImAccount', 'list');
    }
    
    $this->setTemplate('ajaxList');
    return sfView::SUCCESS;
  }
}
