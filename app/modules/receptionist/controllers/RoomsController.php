<?php
namespace Hms\Modules\Receptionist\Controllers;

use Hms\Models\Receptionist; 
use Hms\Models\Staffs; 
use Hms\Models\Patients;
use Hms\Models\Rooms;
use Hms\Models\Beds;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Dispatcher;


class RoomsController extends ControllerBase
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
    public function add_new_roomAction()
    {

    }

    public function create_new_roomAction(){

        if (!$this->request->isPost()) {
            return $this->response->redirect($config->application->baseUrl."/modules/Receptionist/addNewRoom"); 
        }
        
        $room = new Rooms();
        $room->name = $this->request->getPost("room_name");
        $room->type = $this->request->getPost("type");
        $room->beds = $this->request->getPost("nos");
/*        if (!$room->save()) {

                foreach ($room->getMessages() as $message) {
                    $this->flash->error($message);
                }

            return $this->response->redirect($config->application->baseUrl."/modules/Receptionist/addNewRoom?msg=Room+could+not+be+created+,Try+again"); 
            }
            */
            for($i=1;$i<=$this->request->getPost("nos");++$i){
            $bed = new Beds();
            $bed->bed_id = $i;
            $bed->status = "Not taken";
            $bed->room_name = $this->request->getPost("room_name");
            $bed->save();
/*            if (!$bed->save()) {

                    foreach ($bed->getMessages() as $message) {
                        $this->flash->error($message);
                    }

                return $this->response->redirect($config->application->baseUrl."/modules/Receptionist/addNewRoom?msg=Bed+Space+could+not+be+created+,Try+again"); 
                }*/
        }

                $room->save();

                return $this->response->redirect($config->application->baseUrl."/modules/Receptionist/addNewRoom?msg=Room+Successfully+created"); 
    }

    /*
    *Administrator : Manage Patients View
    */
    public function viewAction($id){
       $room = Rooms::findFirstByid($id);
       $this->view->name = $room->name;
       $this->view->type = $room->type;
       $this->view->no_of_beds = $room->beds;
       $this->view->p_id = $room->p_id;
       $this->view->patient_name = $room->patient_name;

       $beds = Beds::find([
           'conditions'=>'room_name="'.$room->name.'"',
           'columns' => '*'
       ]);
        $this->view->setVar("beds",$beds);


    }

    public function allocate_bedAction($id){
       $bed = Beds::findFirstByid($id);
       $this->view->name = $bed->room_name;
       $this->view->status = $bed->status;
       $this->view->bed_id = $bed->bed_id;
       $this->view->id = $bed->id;
       $this->view->patient = $bed->patient;
       $this->view->p_id = $bed->p_id;

       $patients = Patients::find();
        $this->view->setVar("patients",$patients);


    }

    public function bed_allocatorAction(){
    
       $id = $this->dispatcher->getParam("id");
       $p_id = $this->dispatcher->getParam("p_id");
       $bed = Beds::findFirstByid($id);
       $patient = Patients::findFirstByid($p_id);
       $bed->patient = $patient->surname." ".$patient->firstname." ".$patient->othernames;
       $bed->p_id = $patient->p_id;
       $bed->status= "Taken";
       $bed->save();
       return $this->response->redirect($config->application->baseUrl."/modules/Receptionist/viewRoom/allocateBed/".$id."?msg=Room+Allocated+to+Patient+successfully");
    }

    public function deallocate_bedAction(){   
       $id = $this->dispatcher->getParam("id");
       $bed = Beds::findFirstByid($id);
       $bed->patient = " ";
       $bed->p_id = " ";
       $bed->status= "Not taken";
       $bed->save();
       return $this->response->redirect($config->application->baseUrl."/modules/Receptionist/viewRoom/allocateBed/".$id."?msg=Room+Deallocated+to+Patient+successfully");
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

    public function manage_roomsAction(){
       $rooms = Rooms::find(null);
       $this->view->setVar("rooms",$rooms);

    }

}
