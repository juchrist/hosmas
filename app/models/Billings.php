<?php
namespace Hms\Models;

class Billings extends \Phalcon\Mvc\Model
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
     * @Column(type="string", nullable=false)
     */
    public $patients_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $bill_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $payer;

    /**
     *2
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    public $dop;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $payment_status;

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
        return 'billings';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Billings[]|Billings
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Billings
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
