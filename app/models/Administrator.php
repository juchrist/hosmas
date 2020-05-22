<?php
namespace Hms\Models;

class Administrator extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $username;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    public $password;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $image;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $session_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("hms");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'administrator';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Administrator[]|Administrator
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Administrator
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
