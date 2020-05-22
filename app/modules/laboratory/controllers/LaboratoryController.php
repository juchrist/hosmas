<?php
namespace Hms\Modules\Laboratory\Controllers;

use Hms\Models\Staffs; 
use Hms\Models\Patients;
use Hms\Models\Laboratory;
use Hms\Models\Duties;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Dispatcher;


class LaboratoryController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for laboratory
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'laboratory', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $laboratory = laboratory::find($parameters);
        if (count($laboratory) == 0) {
            $this->flash->notice("The search did not find any laboratory");

            $this->dispatcher->forward([
                "controller" => "laboratory",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $laboratory,
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

    public function create_newAction()
    {

    }

    public function dashboardAction(){

    }
    /*
    *laboratory : Manage Patients View
    */
    public function viewAction(){
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
        $laboratory = Laboratory::find([$p_id=>$sid]);
        $this->view->setVar("lab_tests",$laboratory);

    }
    
    public function view_patientsAction(){
       $patients = Patients::find(null);
       $this->view->setVar("patients",$patients);

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

    public function add_new_staffAction(){

    }


/*    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $laboratory = laboratory::findFirstByid($id);
            if (!$laboratory) {
                $this->flash->error("laboratory was not found");

                $this->dispatcher->forward([
                    'controller' => "laboratory",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $laboratory->id;

            $this->tag->setDefault("id", $laboratory->id);
            $this->tag->setDefault("username", $laboratory->username);
            $this->tag->setDefault("password", $laboratory->password);
            $this->tag->setDefault("image", $laboratory->image);
            $this->tag->setDefault("session_id", $laboratory->session_id);
            
        }
    } */

    /**
     * Creates a new laboratory
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "laboratory",
                'action' => 'index'
            ]);

            return;
        }

        $laboratory = new Laboratory();
        $laboratory->p_id = $this->request->getPost("p_id");
        $laboratory->r_id = $this->request->getPost("r_id");
        $laboratory->test_name = $this->request->getPost("test_name");
        $laboratory->test_result = $this->request->getPost("test_result");
        $laboratory->date = $this->request->getPost("date");

        if (!$laboratory->save()) {
            foreach ($laboratory->getMessages() as $message) {
                $this->flash->error($message);
            }


            return $this->response->redirect($config->application->baseUrl."createLabResult/patient/".$laboratory->pid."?err_msg=Test+Result+Couldn't+be+added+.+Check+and+Try+Again");
        }

            return $this->response->redirect($config->application->baseUrl."/modules/Laboratory/createLabResult/patient/".$laboratory->pid."?err_msg=Test+result+for+the+Patient+was+added+successfully.");
    }

    /**
     * Saves a laboratory edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "laboratory",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $laboratory = laboratory::findFirstByid($id);

        if (!$laboratory) {
            $this->flash->error("laboratory does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "laboratory",
                'action' => 'index'
            ]);

            return;
        }

        $laboratory->username = $this->request->getPost("username");
        $laboratory->password = $this->request->getPost("password");
        $laboratory->image = $this->request->getPost("image");
        $laboratory->session_id = $this->request->getPost("session_id");
        

        if (!$laboratory->save()) {

            foreach ($laboratory->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "laboratory",
                'action' => 'edit',
                'params' => [$laboratory->id]
            ]);

            return;
        }

        $this->flash->success("laboratory was updated successfully");

        $this->dispatcher->forward([
            'controller' => "laboratory",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a laboratory
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $laboratory = laboratory::findFirstByid($id);
        if (!$laboratory) {
            $this->flash->error("laboratory was not found");

            $this->dispatcher->forward([
                'controller' => "laboratory",
                'action' => 'index'
            ]);

            return;
        }

        if (!$laboratory->delete()) {

            foreach ($laboratory->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "laboratory",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("laboratory was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "laboratory",
            'action' => "index"
        ]);
    }

}
