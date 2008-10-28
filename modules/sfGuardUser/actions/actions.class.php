<?php

/**
 * sfUserAddress actions.
 *
 * @package    sfDoctrineUserPlugin
 * @subpackage sfUserAddress
 * @author     Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class sfGuardUserActions extends autosfGuardUserActions
{
  public function executeAjaxSave()
  {
    $this->forward('sfGuardUser', 'ajaxEdit');
  }

  public function executeAjaxEdit ()
  {
    $this->sf_guard_user = $this->getsfGuardUserOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updatesfGuardUserFromRequest();

      $this->savesfGuardUser($this->sf_guard_user);

      $this->setFlash('notice', 'Your modifications have been saved');

      $this->sf_user_user = $this->sf_guard_user['User'];
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
}
