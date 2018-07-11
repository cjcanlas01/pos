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

    public function renderhpageprod()
    {
        $this->render('/Pages/hpageprod');
    }

    public function renderreports()
    {
        $this->render('/Pages/reports');
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

    public function addproductinv()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $name = $this->request->data('name');
        $unitprice = $this->request->data('unitprice');
        $id = $this->Auth->user('id');
        $date = date('Y-m-d H:i:s');

        if ($connection->execute("INSERT INTO product (name, unitprice, created, userid) VALUES ('$name', '$unitprice', '$date', '$id')")) {
            $this->redirect(['action' => 'renderprod']);
            $this->Flash->success(__('Product succesfully added.'));
        } else {
            $this->Flash->error(__('Unable to add the product.'));
            return $this->redirect(['action' => 'renderprod']);
        }
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

        if ($connection->execute("UPDATE users SET username = '$varusern', password = '$varpass', lastname = '$varln', firstname = '$varfn', middlename = '$varmn', role = '$varrole', position = '$varpos', branch = '$varbranch', modified = UTC_TIMESTAMP()  WHERE  id = '$varid'")) {
            $this->redirect(['action' => 'renderusers']);
            $this->Flash->success(__('User succesfully updated.'));
        } else {
            $this->Flash->error(__('Unable to add the user.'));
            return $this->redirect(['action' => 'renderusers']);
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
            $this->Flash->success(__('Product succesfully updated.'));
        } else {
            $this->Flash->error(__('Unable to update the product.'));
            return $this->redirect(['action' => 'renderprod']);
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

    public function userloaderdetails()
    {
        $this->autoRender = false;
        $results = $this->Auth->user('id');
        echo json_encode($results);
    }

    public function addinventory()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $productid = $this->request->data('productid');
        $sourceid = $this->request->data('sourceid');
        $userid = $this->request->data('userid');

        $totalinventory = $this->request->data('totalinventory'); //new record for inventory

        $weight = $this->request->data('weight');
        $unitprice = $this->request->data('unitprice');
        $date = date('Y-m-d H:i:s');
        $id = $this->Auth->user('id');

        if ($connection->execute("INSERT INTO inventory SET productid = '$productid', sourceid = '$sourceid', weight = '$weight', unitprice = '$unitprice', totalinventory = '$totalinventory', dateissued = '$date', userid = '$id'")) {
            $this->redirect(['action' => 'renderhpageprod']);
            $this->Flash->success(__('Inventory succesfully added.'));
        } else {
            $this->Flash->error(__('Unable to add the inventory.'));
            return $this->redirect(['action' => 'renderhpageprod']);
        }
    }

    public function addsales()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $productid = $this->request->data('productid');
        $price = $this->request->data('price');
        $weight = $this->request->data('weight');

        $amountdue = $this->request->data('amountdue'); //new record for inventory

        $lessdiscount = $this->request->data('lessdiscount');
        $netamountdue = $this->request->data('netamountdue');
        $amounttender = $this->request->data('amounttender');
        $change = $this->request->data('change');

        $date = date('Y-m-d H:i:s');
        $id = $this->Auth->user('id');

        if ($connection->execute("INSERT INTO sales SET productid = '$productid', price = '$price', weight = '$weight', amountdue = '$amountdue', lessdiscount = '$lessdiscount', netamountdue = '$netamountdue', amounttender = '$amounttender', amountchange = '$change', dateissued = '$date', userid = '$id'")) {
            $this->redirect(['action' => 'renderhpageprod']);
            $this->Flash->success(__('Sale succesfully added.'));
        } else {
            $this->Flash->error(__('Unable to add the sale.'));
            return $this->redirect(['action' => 'renderhpageprod']);
        }
    }

    public function genreportsales()
    {
        $test = $this->request->data('product_');
        $output_layout = '';
        //echo $test;
        //echo "<br />";
        //$this->render('/Store/genreport');
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');
        $sales = $connection->execute("SELECT sales.salesid, product.name, sales.price, sales.weight, sales.amountdue, sales.lessdiscount, sales.netamountdue, sales.amounttender, sales.amountchange, sales.dateissued, users.username FROM sales INNER JOIN product ON sales.productid=product.productid INNER JOIN users ON sales.id=users.id WHERE sales.productid='$test'");
        $output_layout .= "<table border='2' style='width: 100%; text-align: center;'>";
        echo "<thead style='font-weight: 1000;'>";
            echo "<td>Sales ID</td>";
            echo "<td>Product Name</td>";
            echo "<td>Price</td>";
            echo "<td>Weight</td>";
            echo "<td>Amount Due</td>";
            echo "<td>Less Discount</td>";
            echo "<td>Net Amount Due</td>";
            echo "<td>Amount Tender</td>";
            echo "<td>Amount Change</td>";
            echo "<td>Date Issued</td>";
            echo "<td>User</td>";
        echo "</thead>";
        foreach ($sales as $fields) {
            echo "<tr>";
            echo "<td>".$fields['salesid']."</td>";
            echo "<td>".$fields['name']."</td>";
            echo "<td>".$fields['price']."</td>";
            echo "<td>".$fields['weight']."</td>";
            echo "<td>".$fields['amountdue']."</td>";
            echo "<td>".$fields['lessdiscount']."</td>";
            echo "<td>".$fields['netamountdue']."</td>";
            echo "<td>".$fields['amounttender']."</td>";
            echo "<td>".$fields['amountchange']."</td>";
            echo "<td>".$fields['dateissued']."</td>";
            echo "<td>".$fields['username']."</td>";
            echo "<tr/>";
        }
        echo "<table/>";
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
