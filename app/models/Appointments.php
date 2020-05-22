<?php

class Appointments extends \Phalcon\Mvc\Model
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
    public $doctor;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $patient;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $startdate;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $enddate;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    public $allday;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $title;

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
        return 'appointments';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Appointments[]|Appointments
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Appointments
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
