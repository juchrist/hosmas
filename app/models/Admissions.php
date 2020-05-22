<?php
namespace Hms\Models;

class Admissions extends \Phalcon\Mvc\Model
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
    public $patient_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $patient_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    public $date_admitted;

    /**
     *
     * @var string
     * @Column(type="string", length=40, nullable=false)
     */
    public $time_admitted;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $date_discharged;

    /**
     *
     * @var string
     * @Column(type="string", length=40, nullable=true)
     */
    public $time_discharged;

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
        return 'admissions';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Admissions[]|Admissions
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Admissions
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
