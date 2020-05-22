<?php
namespace Hms\Modules\Account\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Dispatcher;


class AccountController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {


    }

    /**
     * Searches for administrator
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Administrator', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $administrator = Administrator::find($parameters);
        if (count($administrator) == 0) {
            $this->flash->notice("The search did not find any administrator");

            $this->dispatcher->forward([
                "controller" => "administrator",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $administrator,
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

    public function dashboardAction()
    {

    }

    /**
     * Edits a administrator
     *
     * @param string $id
     */
    public function editAction($id)
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

}
