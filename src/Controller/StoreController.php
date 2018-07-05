<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

/**
 * Store Controller
 *
 *
 * @method \App\Model\Entity\Store[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StoreController extends AppController
{

    public function renderprod()
    {
        $this->render('/Pages/product');
    }

    public function rendersofi()
    {
         $this->render('/Pages/sourceofinventory');
    }

    public function renderusers()
    {
        $this->render('/Users/addusers');
    }

    public function adduser()
    {
        $this->loadModel('Users');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been added.'));
                return $this->redirect(['action' => 'renderusers']);
            }
            $this->Flash->error(__('Unable to add the user.'));
            return $this->redirect(['action' => 'renderusers']);
        }
        $this->set('Users', $user);
        $this->render('renderusers');
    }

    public function addproduct()
    {
        $this->loadModel('Product');
        $prod = $this->Product->newEntity();
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            $prod = $this->Product->patchEntity($prod, $this->request->getData());
            if ($this->Product->save($prod)) {
                $this->Flash->success(__('The product has been added.'));
                return $this->redirect(['action' => 'renderprod']);
            }
            $this->Flash->error(__('Unable to add the product.'));
            return $this->redirect(['action' => 'renderprod']);
        }
        $this->set('Product', $prod);
        $this->render('renderprod');
    }

    public function addsofi()
    {
        $this->loadModel('Sourceofinventory');
        $sofi = $this->Sourceofinventory->newEntity();
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            $sofi = $this->Sourceofinventory->patchEntity($sofi, $this->request->getData());
            if ($this->Sourceofinventory->save($sofi)) {
                $this->Flash->success(__('The source has been added.'));
                return $this->redirect(['action' => 'rendersofi']);
            }
            $this->Flash->error(__('Unable to add the source.'));
            return $this->redirect(['action' => 'rendersofi']);
        }
        $this->set('Sourceofinventory', $sofi);
        $this->render('rendersofi');
    }

    public function viewuser()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');
        $results = $connection->execute("SELECT * FROM users")->fetchAll('assoc');
        echo json_encode($results);
    }

    public function viewprod()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');
        $results = $connection->execute("SELECT * FROM product")->fetchAll('assoc');
        echo json_encode($results);
    }

    public function viewsofi()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');
        $results = $connection->execute("SELECT * FROM sourceofinventory")->fetchAll('assoc');
        echo json_encode($results);
    }

    public function updateuser()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $varid = (int) $this->request->data('id');

        $varusern = $this->request->data('username');
        $varpass = $this->request->data('password');
        $varln = $this->request->data('lastname');
        $varfn = $this->request->data('firstname');
        $varmn = $this->request->data('middlename');
        $varrole = $this->request->data('role');
        $varpos = $this->request->data('position');
        $varbranch = $this->request->data('branch');

        //$vardate = UTC_TIMESTAMP();
        //date("Y-m-d h:i:sa");

        if ($connection->execute("UPDATE users SET username = '$varusern', password = '$varpass', lastname = '$varln', firstname = '$varfn', middlename = '$varmn', role = '$varrole', position = '$varpos', branch = '$varbranch', modified = UTC_TIMESTAMP()  WHERE  id = '$varid'")) {
            $this->redirect(['action' => 'renderusers']);
            $this->Flash->success(__('User succesfully updated.'));
        }
    }

    public function updateprod()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $varid = (int) $this->request->data('productid');

        $varname = $this->request->data('name');
        $varunitprice = $this->request->data('unitprice');

        if ($connection->execute("UPDATE product SET name = '$varname', unitprice = '$varunitprice' WHERE  productid = '$varid'")) {
            $this->redirect(['action' => 'renderprod']);
            $this->Flash->success(__('User succesfully updated.'));
        }
    }

    public function sourceloader()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');
        $results = $connection->execute("SELECT * FROM sourceofinventory")->fetchAll('assoc');
        echo json_encode($results);
    }

    public function prodloader()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');
        $results = $connection->execute("SELECT * FROM product")->fetchAll('assoc');
        echo json_encode($results);
    }

     /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function index()
    {
        $store = $this->paginate($this->Product);

        $this->set(compact('store'));
    }

    /**
     * View method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $store = $this->Store->get($id, [
            'contain' => []
        ]);

        $this->set('store', $store);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $store = $this->Store->newEntity();
        if ($this->request->is('post')) {
            $store = $this->Store->patchEntity($store, $this->request->getData());
            if ($this->Store->save($store)) {
                $this->Flash->success(__('The store has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The store could not be saved. Please, try again.'));
        }
        $this->set(compact('store'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $store = $this->Store->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $store = $this->Store->patchEntity($store, $this->request->getData());
            if ($this->Store->save($store)) {
                $this->Flash->success(__('The store has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The store could not be saved. Please, try again.'));
        }
        $this->set(compact('store'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $store = $this->Store->get($id);
        if ($this->Store->delete($store)) {
            $this->Flash->success(__('The store has been deleted.'));
        } else {
            $this->Flash->error(__('The store could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
