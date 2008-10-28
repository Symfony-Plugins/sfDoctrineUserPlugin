<?php

class sfUserSecurityUser extends sfGuardSecurityUser
{

    public function getUser()
    {
      if ( !$this->user && $id = $this->getAttribute( 'user_id', null, 'sfGuardSecurityUser' ) )
      {
        $q = new Doctrine_Query();
        $q->select('sfGuardUser.*');
        $q->from('sfGuardUser');

        $q->leftJoin('sfGuardUser.User');
/**
        $q->leftJoin('u.CreatedBy uc')->leftJoin('u.UpdatedBy uu');
        $q->leftJoin('u.EmailAddress e')->addOrderBy('e.rank asc');
        $q->leftJoin('e.CreatedBy ec')->leftJoin('e.UpdatedBy eu');

        $q->leftJoin('u.Phone p')->leftJoin('p.PhoneType')->addOrderBy('p.rank asc');
        $q->leftJoin('u.Address a')->leftJoin('a.AddressType at')->addOrderBy('a.rank asc');
        $q->leftJoin('a.State as')->leftJoin('as.Country ac');
**/

        $q->where('sfGuardUser.id = ?', $id);

        $this->user = $q->execute()->getFirst();

        if ( !$this->user )
        {
          // the user does not exist anymore in the database
          $this->signOut();

          throw new sfException( 'The user does not exist anymore in the database.' );
        }
      }

      return $this->user;
    }

/*    public function getUserId()
    {
      return $this->user->getUser()->get('id');
    }*/
}