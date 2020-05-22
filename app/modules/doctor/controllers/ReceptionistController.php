<?php
namespace Hms\Modules\Doctor\Controllers;

use Hms\Models\Receptionist; 
use Hms\Models\Staffs; 
use Hms\Models\Patients;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Dispatcher;


class ReceptionistController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    public function schedule_appointmentsAction(){
/*        $staffs = Staffs::find([
        'conditions' => 'rank="Physician"',
        'columns'   => '*'
        ]            
        ); */
        $staffs = Staffs::find();
        $this->view->setVar("staffs",$staffs);

        $patients = Patients::find();
        $this->view->setVar("patients",$patients);
    }

    public function get_appointmentsAction(){
    $con = mysqli_connect("localhost","root","","test");
    if($this->request->getPost('type') == 'new')
    {
	$startdate = $this->request->getPost('startdate').'+'.$this->request->getPost('zone');
	$title = $this->request->getPost('title');
	$insert = mysqli_query($con,"INSERT INTO calendar(`title`, `startdate`, `enddate`, `allDay`) VALUES('$title','$startdate','$startdate','false')");
	$lastid = mysqli_insert_id($con);
	echo json_encode(array('status'=>'success','eventid'=>$lastid));
    }

    if($this->request->getPost('type') == 'changetitle'){
	$eventid = $this->request->getPost('eventid');
	$title = $this->request->getPost('title');
	$update = mysqli_query($con,"UPDATE calendar SET title='$title' where id='$eventid'");
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
	$update = mysqli_query($con,"UPDATE calendar SET title='$title', startdate = '$startdate', enddate = '$enddate' where id='$eventid'");
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

    if($this->request->getPost('type') == 'remove'){
	$eventid = $this->request->getPost('eventid');
	$delete = mysqli_query($con,"DELETE FROM calendar where id='$eventid'");
	if($delete)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($this->request->getPost("type") == 'fetch')
{
	$events = array();
	$query = mysqli_query($con, "SELECT * FROM calendar");
	while($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$e = array();
    $e['id'] = $fetch['id'];
    $e['title'] = $fetch['title'];
    $e['start'] = $fetch['startdate'];
    $e['end'] = $fetch['enddate'];

    $allday = ($fetch['allDay'] == "true") ? true : false;
    $e['allDay'] = $allday;
    array_push($events, $e);
	}
	echo json_encode($events);
}

    }
    /**
     * Displays the creation form
     */
    public function add_new_patientAction()
    {

    }

    public function dashboardAction()
    {

    }

    /*
    *Administrator : Manage Patients View
    */
    public function viewAction(){
       $patients = Patients::find(null);
       $this->view->setVar("patients",$patients);

    }

    public function add_new_staffAction(){

    }

    /**
     * Edits a administrator
     *
     * @param string $id
     */
/*    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $administrator = Administrator::findFirstByid($id);
            if (!$administrator) {
                $this->flash->error("administrator was not found");

                $this->dispatcher->forward([
                    'controller' => "administrator",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $administrator->id;

            $this->tag->setDefault("id", $administrator->id);
            $this->tag->setDefault("username", $administrator->username);
            $this->tag->setDefault("password", $administrator->password);
            $this->tag->setDefault("image", $administrator->image);
            $this->tag->setDefault("session_id", $administrator->session_id);
            
        }
    } */

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

    public function manage_patientsAction(){
       $patients = Patients::find(null);
       $this->view->setVar("patients",$patients);

    }

}
