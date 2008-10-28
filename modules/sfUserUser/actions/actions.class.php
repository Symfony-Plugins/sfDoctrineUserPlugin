<?php

/**
 * sfUserUser actions.
 *
 * @package    sfDoctrineUserPlugin
 * @subpackage sfUserUser
 * @author     Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class sfUserUserActions extends autosfUserUserActions
{
  public function executeSearch()
  {

    $search_string = trim( $this->getRequestParameter('search_string') );
    
    # Check for spaces for first and last names
    $words = explode(" ", str_replace(',', '', $search_string));
    if ( count($words) == 1 )
    {
      $query = 'first_name LIKE ? OR last_name LIKE ?';
      $params = array('%'.$words[0].'%', '%'.$words[0].'%');
    }
    else
    {
      if ( !stristr( $search_string, ',' ) )
      {
        $query = 'first_name LIKE ? AND last_name LIKE ?';
        $params = array('%'.$words[0].'%', '%'.$words[1].'%');
      }
      else
      {
        $query = 'first_name LIKE ? AND last_name LIKE ?';
        $params = array('%'.$words[1].'%', '%'.$words[0].'%');
      }
    }
    
    $users = Doctrine_Query::create()
        ->from('sfUserUser')
        ->addWhere( $query, $params )
        ->execute();
        
    $return ="<ul>";
    $return .= "<li><b>" . count($users). " result(s) for \"$search_string\"</b></li>";
    foreach ( $users as $user )
    {
      $return .= "<li><div style='display: none;'>{$user['id']}</div><div>{$user['last_name']}, {$user['first_name']}</div></li>";
    }
    $return .="</li>";
    
    return $this->renderText($return);
  }
  
  public function executeGuardSearch()
  {

    $search_string = trim( $this->getRequestParameter('search_string') );
    
    $guard_users = Doctrine_Query::create()
        ->from('sfGuardUser')
        ->where( 'username LIKE ?', '%'.$search_string.'%' )
        ->execute();
        
    $return ="<ul>";
    $return .= "<li><b>" . count($guard_users). " result(s) for \"$search_string\"</b></li>";
    foreach ( $guard_users as $guard_user )
    {
      $return .= "<li><div style='display: none;'>{$guard_user['id']}</div><div>{$guard_user['username']}</div></li>";
    }
    $return .="</li>";
    
    return $this->renderText($return);
  }
  
}
