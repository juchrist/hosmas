<?php
namespace Hms\Modules\Receptionist\Controllers;

use Hms\Models\Patients; 
use Hms\Models\Admissions; 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Dispatcher;


class PatientController extends ControllerBase{


    /**
     * Edits a patient
     *
     * @param string $id
     */
    public function editAction($id)
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

            $this->view->id = $patient->id;
            $this->view->firstname = $patient->firstname;
            $this->view->othernames = $patient->othernames;
            $this->view->rank = $patient->rank;
            $this->view->patient_id = $patient->patient_id;
            $this->view->email = $patient->email;
            $this->view->fone = $patient->fone;
            
        }
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
        $this->view->status = $patient->status;
        $this->view->id = $patient->id;
            
        }
    }
    /**
     * Creates a new patient
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {      
                    return $this->response->redirect('Dashboard/?err_msg=Patient+couldnt+be+created+Try+again+later');
        }

        $patient = new Patients();
        $patient->surname = $this->request->getPost("surname");
        $patient->firstname = $this->request->getPost("firstname");
        $patient->othernames = $this->request->getPost("lastname");
        $patient->telephone = $this->request->getPost("fone");
        $patient->email = $this->request->getPost("email");
        $patient->address = $this->request->getPost("address");
        $patient->dob = $this->request->getPost("age");
        $patient->gender = $this->request->getPost("gender");
//        $patient->stateoforigin = $this->request->getPost("stateoforigin");
        $patient->profession = $this->request->getPost("profession");
        $patient->marital_status = $this->request->getPost("marital_status");
/*        $patient->father_name = $this->request->getPost("father_name");
        $patient->mother_name = $this->request->getPost("mother_name"); */
        $patient->nok = $this->request->getPost("nok");
        $patient->nok_tel = $this->request->getPost("nok_tel");
        $patient->nok_rel = $this->request->getPost("nok_rel");
        $patient->status = "out";

        if (!$patient->save()) {
            foreach ($patient->getMessages() as $message) {
                $this->flash->error($message);
            }

                    return $this->response->redirect('/modules/Receptionist/addPatient?err_msg=There+is+an+error+in+your+form+fill+it+and+try+again');
        }

                    return $this->response->redirect('/modules/Receptionist/addPatient?msg=Patient+Added+Successfully');
    }

    /**
     * Saves a patient edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "patient",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $patient = Patients::findFirstByid($id);

        if (!$patient) {
                    return $this->response->redirect('Dashboard/?err_msg=patient+doesnt+exist');

            $this->dispatcher->forward([
                'controller' => "patient",
                'action' => 'index'
            ]);

            return;
        }


        $patient->surname = $this->request->getPost("surname");
        $patient->firstname = $this->request->getPost("firstname");
        $patient->othernames = $this->request->getPost("othernames");
        $patient->password = $this->request->getPost("password");
        $patient->telephone = $this->request->getPost("fone");
        $patient->email = $this->request->getPost("email");
        $patient->address = $this->request->getPost("address");
        $patient->dob = $this->request->getPost("dob");
        $patient->gender = $this->request->getPost("gender");
        $patient->stateoforigin = $this->request->getPost("stateoforigin");
        $patient->profession = $this->request->getPost("profession");
        $patient->marital_status = $this->request->getPost("marital_status");
        $patient->father_name = $this->request->getPost("father_name");
        $patient->mother_name = $this->request->getPost("mother_name");
        $patient->nok = $this->request->getPost("nok");
        $patient->nok_tel = $this->request->getPost("nok_tel");
        $patient->nok_rel = $this->request->getPost("nok_rel");
        

        if (!$patient->save()) {

            foreach ($patient->getMessages() as $message) {
                $this->flash->error($message);
            }

        return $this->response->redirect('Dashboard/?err_msg=patient+details+couldnt+be+updated');
        }

//        $this->flash->success("patient was updated successfully");
        return $this->response->redirect('/modules/Admin/editpatient/'.$patient->id.'?msg=User+details+successfully+editted');
    }

    /**
     * Deletes a patient
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $patient = Patients::findFirstByid($id);
        if (!$patient) {

        return $this->response->redirect('Dashboard/?err_msg=patient+not+Found');

            return;
        }

        if (!$patient->delete()) {

            foreach ($patient->getMessages() as $message) {
                $this->flash->error($message);
            }

        return $this->response->redirect('Dashboard/?err_msg=patient+couldnt+be+deleted');
        }

//        $this->flash->success("patient was deleted successfully");

    return $this->response->redirect('/modules/Admin/managepatients?msg=User+successfully+deleted');
    }

    public function mark_patientAction(){
        $id = $this->request->getPost("patient");
        $patient = Patients::findFirstByid($id);
        $patient->status = $this->request->getPost("status");
        $patient->save();
        if(!$patient->save())
           foreach ($patient->getMessages() as $message) {
                echo $message;
            }
        if($this->request->getPost("status")=="in"){
        $admission = new Admissions();
        $admission->patient_name = $patient->surname." ".$patient->firstname." ".$patient->othernames;
        $admission->date_admitted = date("d, M Y");
        $admission->time_admitted = date("H:i a");
        $admission->date_discharged = "no";
        $admission->time_discharged = "no";
        $admission->patient_id = $patient->p_id;
        $admission->save();
        }
       if($this->request->getPost("status")=="out"){
        $admissions = Admissions::findFirst([
            'conditions'=> 'patient_id="'.$patient->p_id.'" AND date_discharged ="no" AND time_discharged ="no" ',
            'columns'=>'*',
        ]);
//      $admission->patient_name = $patient->surname." ".$patient->firstname." ".$patient->othernames;
        $admissions->date_discharged = date("d, M Y");
        $admissions->time_discharged = date("H:i a");
        $admissions->save();
        if(!$admissions->save())
           foreach ($patient->getMessages() as $message) {
                echo $message;
            }
        }
    }

}
