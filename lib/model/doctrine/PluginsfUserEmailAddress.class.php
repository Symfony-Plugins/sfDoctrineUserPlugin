<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginsfUserEmailAddress extends BasesfUserEmailAddress
{

  public function __toString()
  {
    return $this['address'];
  }
  
  public function getIsPrimary()
  {
    return ( $this['rank'] == 1 );
  }
  
  public function makePrimary()
  {
    
  }
  
}