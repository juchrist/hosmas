<?php
namespace Hms\Modules\Accountant\Controllers;

use Hms\Models\Staffs; 
use Hms\Models\Laboratory;
use Hms\Models\Patients;
use Hms\Models\Billings; 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Dispatcher;


class AccountantController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for billings
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'billings', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $billings = billings::find($parameters);
        if (count($billings) == 0) {
            $this->flash->notice("The search did not find any billings");

            $this->dispatcher->forward([
                "controller" => "billings",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $billings,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    public function create_newAction($id)
    {
       $patient = Patients::findFirstByid($id);
        $this->view->surname = $patient->surname;
        $this->view->firstname = $patient->firstname;
        $this->view->lastname = $patient->othernames;
        $this->view->id = $patient->p_id;
        $sid = $patient->p_id;

    }

    /*
    *billings : Manage billings View
    */
    public function viewAction(){
       $billings = Billings::find(null);
       $this->view->setVar("bills",$billings);

    }

    public function create_billAction(){
       $patients = Patients::find(null);
       $this->view->setVar("patients",$patients);

    }

    public function select_patientAction(){
       $patients = Patients::find(null);
       $this->view->setVar("patients",$patients);

    }


    public function view_recordsAction($id){
       $patient = Patients::findFirstByid($id);
        $this->view->surname = $patient->surname;
        $this->view->firstname = $patient->firstname;
        $this->view->lastname = $patient->othernames;
        $this->view->id = $patient->p_id;
        $sid = $patient->p_id;
        $billings = Billings::find([
            'conditions'=> 'p_id = "'.$sid.'"',
            'columns'  => '*'
         ] );
        $this->view->setVar("bills",$billings);
    }
    
    public function view_billingsAction(){
       $billings = Billings::find(null);
       $this->view->setVar("billings",$billings);

    }

    public function manage_staffsAction(){
       $staffs = Staffs::find(null);
       $this->view->setVar("staffs",$staffs);

/*            $this->view->id = $staff->id;
            $this->view->firstname = $staff->firstname;
            $this->view->othernames = $staff->othernames;
            $this->view->rank = $staff->rank;
            */ 
    }

    public function dashboardAction(){

    }

    public function print_receiptAction(){

    }
    public function add_new_staffAction(){

    }


/*    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $billings = billings::findFirstByid($id);
            if (!$billings) {
                $this->flash->error("billings was not found");

                $this->dispatcher->forward([
                    'controller' => "billings",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $billings->id;

            $this->tag->setDefault("id", $billings->id);
            $this->tag->setDefault("username", $billings->username);
            $this->tag->setDefault("password", $billings->password);
            $this->tag->setDefault("image", $billings->image);
            $this->tag->setDefault("session_id", $billings->session_id);
            
        }
    } */

    /**
     * Creates a new billings
     */
     
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "billings",
                'action' => 'index'
            ]);

            return;
        }

        $billings = new Billings();
        $billings->p_id = $this->request->getPost("p_id");
        $billings->patient_name = $this->request->getPost("patient_name");
        $billings->bill_name = $this->request->getPost("bill_name");
        $billings->payer = $this->request->getPost("payed_by");
        $billings->dop = $this->request->getPost("dop");
        $billings->price = $this->request->getPost("price");
        $billings->recieved_by = $this->request->getPost("recieved_by");
        $billings->payment_status = $this->request->getPost("payment_status");

        if (!$billings->save()) {
            foreach ($billings->getMessages() as $message) {
                $this->flash->error($message);
            }

//            return $this->response->redirect($config->application->baseUrl."/modules/Accountant/createNewBill?err_msg=Bill+Couldn't+be+added+.+Check+and+Try+Again");

            return $this->response->redirect($config->application->baseUrl."/modules/Accountant/createNewBill/patient/".$billings->p_id."?err_msg=Test+Result+Couldn't+be+added+.+Check+and+Try+Again");
        }

//            return $this->response->redirect($config->application->baseUrl."/modules/Accountant/createNewBill?msg=Bill+added+Successfully.");
            return $this->response->redirect($config->application->baseUrl."/modules/Accountant/createNewBill/patient/".$billings->p_id."?msg=Bill+added+Successfully.");
    }

    /**
     * Saves a billings edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "billings",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $billings = billings::findFirstByid($id);

        if (!$billings) {
            $this->flash->error("billings does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "billings",
                'action' => 'index'
            ]);

            return;
        }

        $billings->username = $this->request->getPost("username");
        $billings->password = $this->request->getPost("password");
        $billings->image = $this->request->getPost("image");
        $billings->session_id = $this->request->getPost("session_id");
        

        if (!$billings->save()) {

            foreach ($billings->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "billings",
                'action' => 'edit',
                'params' => [$billings->id]
            ]);

            return;
        }

        $this->flash->success("billings was updated successfully");

        $this->dispatcher->forward([
            'controller' => "billings",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a billings
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $billings = billings::findFirstByid($id);
        if (!$billings) {
            $this->flash->error("billings was not found");

            $this->dispatcher->forward([
                'controller' => "billings",
                'action' => 'index'
            ]);

            return;
        }

        if (!$billings->delete()) {

            foreach ($billings->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "billings",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("billings was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "billings",
            'action' => "index"
        ]);
    }

}
