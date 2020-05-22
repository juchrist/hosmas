<?php
namespace Hms\Modules\Administrator\Controllers;

use Hms\Models\Staffs; 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Dispatcher;


class StaffController extends ControllerBase{


    /**
     * Edits a staff
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $staff = Staffs::findFirstByid($id);
            if (!$staff) {
                $this->flash->error("staff was not found");

                $this->dispatcher->forward([
                    'controller' => "staff",
                    'action' => 'index'
                ]);

                return;
            }
//       $this->view->setVar("staffs",$staff);

            $this->view->id = $staff->id;
            $this->view->firstname = $staff->firstname;
            $this->view->othernames = $staff->othernames;
            $this->view->rank = $staff->rank;
            $this->view->staff_id = $staff->staff_id;
            $this->view->email = $staff->email;
            $this->view->fone = $staff->fone;
            
        }
    }


    public function viewAction($id)
    {
        if (!$this->request->isPost()) {

            $staff = Staffs::findFirstByid($id);
            if (!$staff) {
                $this->flash->error("staff was not found");

                $this->dispatcher->forward([
                    'controller' => "staff",
                    'action' => 'index'
                ]);

                return;
            }
//       $this->view->setVar("staffs",$staff);

            $this->view->id = $staff->id;
            $this->view->firstname = $staff->firstname;
            $this->view->othernames = $staff->othernames;
            $this->view->rank = $staff->rank;
            $this->view->staff_id = $staff->staff_id;
            $this->view->email = $staff->email;
            $this->view->fone = $staff->fone;
            
        }
    }
    /**
     * Creates a new staff
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {      
                    return $this->response->redirect('/modules/Admin/addNewStaff');
        }

        $staff = new Staffs();
        $staff->firstname = $this->request->getPost("firstname");
        $staff->othernames = $this->request->getPost("othernames");
        $staff->staff_id = $this->request->getPost("staff_id");
        $staff->password = $this->request->getPost("password");
        $staff->fone = $this->request->getPost("fone");
        $staff->email = $this->request->getPost("email");
        $staff->rank = $this->request->getPost("rank");
        

        if (!$staff->save()) {
            foreach ($staff->getMessages() as $message) {
                $this->flash->error($message);
            }

                    return $this->response->redirect('/modules/Admin/addNewStaff');
        }

        $this->flash->success("staff was created successfully");

                    return $this->response->redirect('/modules/Admin/addNewStaff');
    }

    /**
     * Saves a staff edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "staff",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $staff = Staffs::findFirstByid($id);

        if (!$staff) {
                    return $this->response->redirect('Dashboard/?err_msg=Staff+doesnt+exist');

            $this->dispatcher->forward([
                'controller' => "staff",
                'action' => 'index'
            ]);

            return;
        }

        if($this->request->getPost("password"))
        $staff->password = $this->request->getPost("password");

        $staff->firstname = $this->request->getPost("firstname");
        $staff->othernames = $this->request->getPost("othernames");
        $staff->staff_id = $this->request->getPost("staff_id");
        $staff->fone = $this->request->getPost("fone");
        $staff->email = $this->request->getPost("email");
        $staff->rank = $this->request->getPost("rank");
        

        if (!$staff->save()) {

            foreach ($staff->getMessages() as $message) {
                $this->flash->error($message);
            }

        return $this->response->redirect('Dashboard/?err_msg=Staff+details+couldnt+be+updated');
        }

//        $this->flash->success("staff was updated successfully");
        return $this->response->redirect('/modules/Admin/editStaff/'.$staff->id.'?msg=User+details+successfully+editted');
    }

    /**
     * Deletes a staff
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $staff = Staffs::findFirstByid($id);
        if (!$staff) {

        return $this->response->redirect('Dashboard/?err_msg=Staff+not+Found');

            return;
        }

        if (!$staff->delete()) {

            foreach ($staff->getMessages() as $message) {
                $this->flash->error($message);
            }

        return $this->response->redirect('Dashboard/?err_msg=Staff+couldnt+be+deleted');
        }

//        $this->flash->success("staff was deleted successfully");

    return $this->response->redirect('/modules/Admin/manageStaffs?msg=User+successfully+deleted');
    }

}
