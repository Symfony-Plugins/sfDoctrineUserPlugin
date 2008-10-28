<?php
/*
 *  $Id$
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information, see
 * <http://www.phpdoctrine.com>.
 */

/**
 * Doctrine_Template_Timestampable
 *
 * Easily add created and updated at timestamps to your doctrine records
 *
 * @package     Doctrine
 * @subpackage  Template
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.phpdoctrine.com
 * @since       1.0
 * @version     $Revision$
 * @author      Konsta Vesterinen <kvesteri@cc.hut.fi>
 */
class Rankable extends Doctrine_Template
{
    /**
     * Array of timestampable options
     *
     * @var string
     */
    protected $_options = array('rank' =>  array('name'    =>  'rank',
                                                    'type'    =>  'integer',
                                                    'length'    =>  '2',
                                                    'options' =>  array('default' => '1')
                                                ),
                                );

    /**
     * __construct
     *
     * @param string $array
     * @return void
     */
    public function __construct(array $options)
    {
        $this->_options = array_merge($options, $this->_options);
    }

    /**
     * setTableDefinition
     *
     * @return void
     */
    public function setTableDefinition()
    {
        $this->hasColumn($this->_options['rank']['name'], $this->_options['rank']['type'], $this->_options['rank']['length']);
        
        
        $this->addListener(new Listener_Rankable($this->_options));
    }
    

    /**
     * Returns whether the rank of this is 1 making it primary
     *
     * @return boolean
     */
    public function getIsPrimary()
    {
      return ( $this->getInvoker()->get('rank') == 1 );
    }

    public function makePrimary()
    {
      $curret_record = $this->getInvoker();
      
      $table = $this->getTable()->getClassnameToReturn();
      $user = $curret_record->get('User');
      $current_rank = $curret_record->get('rank');
      
      Doctrine_Query::create()
        ->update($table . ' t')
        ->set('rank', 'rank + 1')
        ->addWhere('t.user_id = ?', $user['id'])
        ->addWhere('t.rank < ?', $current_rank)
        ->execute();
        
      $curret_record->set('rank', 1);
      $curret_record->save();

    }
}