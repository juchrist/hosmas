<?php
namespace Hms\Modules\Administrator\Controllers;

use Hms\Models\Administrator; 
use Hms\Models\Staffs; 
use Hms\Models\Patients;
use Hms\Models\Billings;
use Hms\Models\Appointments;
use Hms\Models\Duties;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Dispatcher;


class AdministratorController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    public function dashboardAction()
    {

    }

    /*
    *Administrator : Manage Patients View
    */
    public function manage_patientsAction(){
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


    public function viewAction($id)
    {
        if (!$this->request->isPost()) {

            $patient = patients::findFirstByid($id);
            if (!$patient) {
                $this->flash->error("patient was not found");

                $this->dispatcher->forward([
                    'controller' => "patient",
                    'action' => 'index'
                ]);

                return;
            }
//       $this->view->setVar("patients",$patient);

        $this->view->surname = $patient->surname;
        $this->view->firstname = $patient->firstname;
        $this->view->lastname = $patient->othernames;
        $this->view->fone = $patient->telephone;
        $this->view->email = $patient->email;
        $this->view->address = $patient->address;
        $this->view->age = $patient->dob;
        $this->view->gender = $patient->gender;
        $this->view->profession = $patient->profession;
        $this->view->marital_status = $patient->marital_status;
        $this->view->nok = $patient->nok;
        $this->view->nok_tel = $patient->nok_tel;
        $this->view->nok_rel = $patient->nok_rel;
        $sid = $patient->p_id;
        $billings = Billings::find([
                'conditions'=> 'p_id = "'.$sid.'"',
                'columns'  => '*'
            ] );
            $this->view->setVar("bills",$billings);
            
        }
    }

    /**
     * Creates a new administrator
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "administrator",
                'action' => 'index'
            ]);

            return;
        }

        $administrator = new Administrator();
        $administrator->username = $this->request->getPost("username");
        $administrator->password = $this->request->getPost("password");
        $administrator->image = $this->request->getPost("image");
        $administrator->session_id = $this->request->getPost("session_id");
        

        if (!$administrator->save()) {
            foreach ($administrator->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "administrator",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("administrator was created successfully");

        $this->dispatcher->forward([
            'controller' => "administrator",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a administrator edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "administrator",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $administrator = Administrator::findFirstByid($id);

        if (!$administrator) {
            $this->flash->error("administrator does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "administrator",
                'action' => 'index'
            ]);

            return;
        }

        $administrator->username = $this->request->getPost("username");
        $administrator->password = $this->request->getPost("password");
        $administrator->image = $this->request->getPost("image");
        $administrator->session_id = $this->request->getPost("session_id");
        

        if (!$administrator->save()) {

            foreach ($administrator->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "administrator",
                'action' => 'edit',
                'params' => [$administrator->id]
            ]);

            return;
        }

        $this->flash->success("administrator was updated successfully");

        $this->dispatcher->forward([
            'controller' => "administrator",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a administrator
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $administrator = Administrator::findFirstByid($id);
        if (!$administrator) {
            $this->flash->error("administrator was not found");

            $this->dispatcher->forward([
                'controller' => "administrator",
                'action' => 'index'
            ]);

            return;
        }

        if (!$administrator->delete()) {

            foreach ($administrator->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "administrator",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("administrator was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "administrator",
            'action' => "index"
        ]);
    }

/*
*
* Schedule Duties
*
*/
    public function schedule_dutiesAction(){
        $staffs = Staffs::find();
        $this->view->setVar("staffs",$staffs);
    }

    public function get_dutiesAction(){
    $con = mysqli_connect("localhost","root","","hms");
    if($this->request->getPost('type') == 'new')
    {
	$startdate = $this->request->getPost('startdate').'+'.$this->request->getPost('zone');
	$title = $this->request->getPost('title');
	$insert = mysqli_query($con,"INSERT INTO duties(`staff`, `startdate`, `enddate`, `allDay`) VALUES('$title','$startdate','$startdate','false')");
	$lastid = mysqli_insert_id($con);
	echo json_encode(array('status'=>'success','eventid'=>$lastid));
    }

    if($this->request->getPost('type') == 'changetitle'){
	$eventid = $this->request->getPost('eventid');
	$title = $this->request->getPost('title');
	$update = mysqli_query($con,"UPDATE duties SET staff='$title' where id='$eventid'");
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

    if($this->request->getPost('type') == 'resetdate'){
	$title = $this->request->getPost('title');
	$startdate = $this->request->getPost('start');
	$enddate = $this->request->getPost('end');
	$eventid = $this->request->getPost('eventid');
	$update = mysqli_query($con,"UPDATE duties SET staff='$title', startdate = '$startdate', enddate = '$enddate' where id='$eventid'");
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

    if($this->request->getPost('type') == 'remove'){
	$eventid = $this->request->getPost('eventid');
	$delete = mysqli_query($con,"DELETE FROM duties where id='$eventid'");
	if($delete)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($this->request->getPost("type") == 'fetch')
{
	$events = array();
	$query = mysqli_query($con, "SELECT * FROM duties");
	while($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$e = array();
    $e['id'] = $fetch['id'];
    $e['title'] = $fetch['staff'];
    $e['start'] = $fetch['startdate'];
    $e['end'] = $fetch['enddate'];

    $allday = ($fetch['allDay'] == "true") ? true : false;
    $e['allDay'] = $allday;
    array_push($events, $e);
	}
	echo json_encode($events);
}

    }

}
