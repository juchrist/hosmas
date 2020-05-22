<?php
namespace Hms\Models;

use Phalcon\Validation as Validation;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;

class Staffs extends \Phalcon\Mvc\Model
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
     * @Column(type="string", nullable=false)
     */
    public $rank;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    public $staff_id;

    /**
     *
     * @var string
     * @Column(type="string", length=40, nullable=false)
     */
    public $password;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    public $fone;

    /**
     *
     * @var string
     * @Column(type="string", length=70, nullable=false)
     */
    public $email;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
/*    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );

        return $this->validate($validator);
    }*/

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
        return 'Staffs';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Staffs[]|Staffs
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Staffs
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
