<?php

/**
 * sfUserBilling actions.
 *
 * @package    sfDoctrineUserPlugin
 * @subpackage sfUserBilling
 * @author     Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class sfUserBillingActions extends autosfUserBillingActions
{
  public function executeAjaxSave()
  {
    $this->forward('sfUserBilling', 'ajaxEdit');
  }

  public function executeAjaxEdit ()
  {
    $this->sf_user_billing = $this->getsfUserBillingOrCreate();
    
    if ( !$this->sf_user_billing['id'] && $this->hasRequestParameter('sf_user_id') )
      $this->sf_user_billing->set('user_id', $this->getRequestParameter('sf_user_id'));

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updatesfUserBillingFromRequest();

      $this->savesfUserBilling($this->sf_user_billing);

      $this->setFlash('notice', 'Your modifications have been saved');

      $this->sf_user_user = $this->sf_user_billing['User'];
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
    $this->sf_user_billing = Doctrine::getTable('sfUserBilling')->find($this->getRequestParameter('id'));
    $this->sf_user_user = $this->sf_user_billing['User'];
    
    $this->forward404Unless($this->sf_user_billing);

    try
    {
      $this->deletesfUserBilling($this->sf_user_billing);
    }
    catch (Doctrine_Exception $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Sf user billing. Make sure it does not have any associated items.');
      return $this->forward('sfUserBilling', 'list');
    }

    $this->setTemplate('ajaxList');
    return sfView::SUCCESS;
  }
}
