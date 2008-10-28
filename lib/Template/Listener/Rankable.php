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
 * Doctrine_Template_Listener_Timestampable
 *
 * @package     Doctrine
 * @subpackage  Template
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.phpdoctrine.com
 * @since       1.0
 * @version     $Revision$
 * @author      Konsta Vesterinen <kvesteri@cc.hut.fi>
 */
class Listener_Rankable extends Doctrine_Record_Listener
{
    /**
     * Array of timestampable options
     *
     * @var string
     */
    protected $_options = array();

    /**
     * __construct
     *
     * @param string $options
     * @return void
     */
    public function __construct(array $options)
    {
        $this->_options = $options;
    }

    /**
     * preInsert
     *
     * @param object $Doctrine_Event
     * @return void
     */
    public function preInsert(Doctrine_Event $event)
    {
        $user = $event->getInvoker()->User;
        if( $user['id'])
        {
          $user_records = $event->getInvoker()->getTable()->findByUserId($user['id']);
          $event->getInvoker()->rank = count($user_records) + 1;   
        }
    }

    /**
     * preUpdate
     *
     * @param object $Doctrine_Event
     * @return void
     */
    /*public function preUpdate(Doctrine_Event $event)
    {
        $updatedName = $this->_options['updated']['name'];

        $event->getInvoker()->$updatedName = $this->getCurrentUser();
    }*/

    /**
     * getTimestamp
     *
     * Gets the timestamp in the correct format
     *
     * @param string $type
     * @return void
     */
    public function getCurrentUser()
    {
       return (sfContext::hasInstance() && sfContext::getInstance()->getUser()->getUser() !== false) ? sfContext::getInstance()->getUser()->getUser() : null;
    }
}
