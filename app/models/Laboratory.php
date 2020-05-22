<?php
namespace Hms\Models;

class Laboratory extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=10, nullable=false)
     */
    public $p_id;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    public $r_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $test_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $test_result;

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
        return 'laboratory';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Laboratory[]|Laboratory
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Laboratory
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
