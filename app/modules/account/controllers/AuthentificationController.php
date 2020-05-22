<?php
namespace Hms\Modules\Account\Controllers;

use Hms\Models\Staffs;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Dispatcher;


class AuthentificationController extends ControllerBase
{


    /**
     * Login Method
     *
     * @param string $id
     */
    public function loginAction()
    {
        if (!$this->request->isPost()) {
                return $this->response->redirect("/?err_msg=Input+Username+and+Password");
        }else{
            $staff_id = ucwords($this->request->getPost("staff_id"));
            $password = $this->request->getPost("password");

            $staff = Staffs::findFirstBystaff_id($staff_id);
            if (!$staff) {
                return $this->response->redirect("/?err_msg=Staff+not+Found");
            }
            else{
                if($password != $staff->password){
                return $this->response->redirect("/?err_msg=Incorrect+Password+,Check+and+try+again");    
                 }
                else{
                $this->session->set("id",$staff->id);
                $this->session->set("name",$staff->firstname." ".$staff->othernames);
                $this->session->set("position",$staff->rank);
                $this->session->set("fone",$staff->id);
                $this->session->set("email",$staff->email);
                $this->session->set("staff_id",$staff->staff_id);
//                var_dump($staff->rank);
                return $this->response->redirect($config->application->baseUrl."AuthentificationController/authentificated/selectAccount");    
                }
            }
        }
    }

    /**
     * Creates a new administrator
     */
    public function selectAction()
    {
        if ($this->session->get("position")=="Labouratory Technician") {
            return $this->response->redirect($application->config->baseUrl."modules/Laboratory/Dashboard");
        }
        if ($this->session->get("position")=="Receptionist") {
            return $this->response->redirect($application->config->baseUrl."modules/Receptionist/Dashboard");
        }
        if ($this->session->get("position")=="Administrator") {
            return $this->response->redirect($application->config->baseUrl."modules/Administrator/Dashboard");
        }
        if ($this->session->get("position")=="Accountant") {
            return $this->response->redirect($application->config->baseUrl."modules/Accountant/Dashboard");
        }
        if ($this->session->get("position")=="Doctor") {
            return $this->response->redirect($application->config->baseUrl."modules/Doctor/Dashboard");
        }        
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

}
