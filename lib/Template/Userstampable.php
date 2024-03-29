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
class Userstampable extends Doctrine_Template
{
    /**
     * Array of timestampable options
     *
     * @var string
     */
    protected $_options = array('created' =>  array('name'    =>  'created_by_user_id',
                                                    'type'    =>  'integer',
                                                    'length'    =>  '4',
                                                    'options' =>  array()),
                                'updated' =>  array('name'    =>  'updated_by_user_id',
                                                    'type'    =>  'integer',
                                                    'length'    =>  '4',
                                                    'options' =>  array()));

    /**
     * __construct
     *
     * @param string $array
     * @return void
     */
    public function __construct(array $options = array())
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
        $this->hasColumn($this->_options['created']['name'], $this->_options['created']['type'], $this->_options['created']['length']);
        $this->hasColumn($this->_options['updated']['name'], $this->_options['updated']['type'], $this->_options['updated']['length']);

        $this->addListener(new Listener_Userstampable($this->_options));
    }

    public function setUp()
    {
      $this->hasOne('sfUserUser as CreatedBy', array('local' => $this->_options['created']['name'],
                                                     'foreign' => 'id'));

      $this->hasOne('sfUserUser as UpdatedBy', array('local' => $this->_options['updated']['name'],
                                                     'foreign' => 'id'));
    }
}
