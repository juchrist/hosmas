<?php
namespace Hms\Models;

class Patients extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $surname;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $firstname;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $othernames;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    public $dob;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $gender;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    public $telephone;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $address;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $state_of_origin;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $profession;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $marital_status;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $father_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $mother_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $nok;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $nok_rel;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $nok_tel;

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

     public $status;

     public $email;
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
        return 'patients';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Patients[]|Patients
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Patients
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
