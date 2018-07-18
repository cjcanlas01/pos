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

    public function posmenupage()
    {
        $this->render('pos');
    }

    public function productpage()
    {
        $this->render('product');
    }

    public function sofipage()
    {
         $this->render('sourceofinventory');
    }

    public function userspage()
    {
        $this->render('addusers');
    }

    public function salesreportspage()
    {
        $this->render('salesreport');
    }

        public function inventoryreportspage()
    {
        $this->render('inventoryreport');
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
                return $this->redirect(['action' => 'userspage']);
            }
            $this->Flash->error(__('Unable to add the user.'));
            return $this->redirect(['action' => 'userspage']);
        }
        $this->set('Users', $user);
        $this->render('renderusers');
    }

    public function addproduct()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $name = $this->request->data('name');
        $unitprice = $this->request->data('unitprice');
        $id = $this->Auth->user('id');
        $date = date('Y-m-d H:i:s');

        if ($connection->execute("INSERT INTO product (name, unitprice, created, userid) VALUES ('$name', '$unitprice', '$date', '$id')")) {
            $this->redirect(['action' => 'productpage']);
            $this->Flash->success(__('Product succesfully added.'));
        } else {
            $this->Flash->error(__('Unable to add the product.'));
            return $this->redirect(['action' => 'productpage']);
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
                return $this->redirect(['action' => 'sofipage']);
            }
            $this->Flash->error(__('Unable to add the source.'));
            return $this->redirect(['action' => 'sofipage']);
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

    public function viewproduct()
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
            $this->redirect(['action' => 'userspage']);
            $this->Flash->success(__('User succesfully updated.'));
        } else {
            $this->Flash->error(__('Unable to add the user.'));
            return $this->redirect(['action' => 'userspage']);
        }
    }

    public function updateproduct()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $varid = (int) $this->request->data('productid');

        $varname = $this->request->data('name');
        $varunitprice = $this->request->data('unitprice');

        if ($connection->execute("UPDATE product SET name = '$varname', unitprice = '$varunitprice' WHERE  productid = '$varid'")) {
            $this->redirect(['action' => 'productpage']);
            $this->Flash->success(__('Product succesfully updated.'));
        } else {
            $this->Flash->error(__('Unable to update the product.'));
            return $this->redirect(['action' => 'productpage']);
        }
    }

    public function updatesofi()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $varid = (int) $this->request->data('editid');
        $varname = $this->request->data('name');

        if ($connection->execute("UPDATE sourceofinventory SET name = '$varname' WHERE  sourceid = '$varid'")) {
            $this->redirect(['action' => 'sofipage']);
            $this->Flash->success(__('Source succesfully updated.'));
        } else {
            $this->Flash->error(__('Unable to update the source.'));
            return $this->redirect(['action' => 'sofipage']);
        }
    }

    public function userdetailsloader()
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
        $id = $this->Auth->user('id');

        $weight = $this->request->data('weight');
        $unitprice = $this->request->data('unitprice');

        $totalinventory = $this->request->data('totalinventory'); //new record for inventory

        date_default_timezone_set('Asia/Manila');

        //$date = date('m-d-Y');
        //$time = date('H:i:s');

        $time = date('H:i:s');

        if ($connection->execute("INSERT INTO inventory SET productid = '$productid', sourceid = '$sourceid', weight = '$weight', unitprice = '$unitprice', totalinventory = '$totalinventory', dateissued = CURDATE(), timeissued = '$time', id = '$id'")) {
            $this->redirect(['action' => 'posmenupage']);
            $this->Flash->success(__('Inventory succesfully added.'));
        } else {
            $this->Flash->error(__('Unable to add the inventory.'));
            return $this->redirect(['action' => 'posmenupage']);
        }
    }

    public function addsales()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $productid = $this->request->data('productid');
        $id = $this->Auth->user('id');

        $price = $this->request->data('price');
        $weight = $this->request->data('weight');
        $amountdue = $this->request->data('amountdue');
        $lessdiscount = $this->request->data('lessdiscount');
        $netamountdue = $this->request->data('netamountdue');
        $amounttender = $this->request->data('amounttender');

        $change = $this->request->data('change');

        date_default_timezone_set('Asia/Manila');

        //$date = date('m-d-Y');
        //$time = date('H:i:s');
        //
        $time = date('H:i:s');

        if ($connection->execute("INSERT INTO sales SET productid = '$productid', price = '$price', weight = '$weight', amountdue = '$amountdue', lessdiscount = '$lessdiscount', netamountdue = '$netamountdue', amounttender = '$amounttender', amountchange = '$change', dateissued = CURDATE(), timeissued = '$time', id = '$id'")) {
            $this->redirect(['action' => 'posmenupage']);
            $this->Flash->success(__('Sale succesfully added.'));
        } else {
            $this->Flash->error(__('Unable to add the sale.'));
            return $this->redirect(['action' => 'posmenupage']);
        }
    }

    public function genreportsales()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $startdate = $this->request->data('startdate');
        $enddate = $this->request->data('enddate');
        $productid = $this->request->data('productid');

        $dateA = date("Y-m-d", strtotime($startdate));
        $dateB = date("Y-m-d", strtotime($enddate));

        $output_layout = '';

        if (!$startdate == "" && $enddate == "" && $productid == "") {
            $sales = $connection->execute("SELECT sales.salesid, product.name, sales.price, sales.weight, sales.amountdue, sales.lessdiscount, sales.netamountdue, sales.amounttender, sales.amountchange, sales.dateissued, sales.timeissued, users.username FROM sales INNER JOIN product ON sales.productid=product.productid INNER JOIN users ON sales.id=users.id WHERE sales.dateissued LIKE '$dateA'");
        } elseif (!$startdate == "" && !$enddate == "" && $productid == "") {
            $sales = $connection->execute("SELECT sales.salesid, product.name, sales.price, sales.weight, sales.amountdue, sales.lessdiscount, sales.netamountdue, sales.amounttender, sales.amountchange, sales.dateissued, sales.timeissued, users.username FROM sales INNER JOIN product ON sales.productid=product.productid INNER JOIN users ON sales.id=users.id WHERE sales.dateissued >= '$dateA' AND sales.dateissued <= '$dateB'");
        } elseif (!$startdate == "" && !$enddate == "" && !$productid == "") {
            if ($productid == "ALL") {
                $sales = $connection->execute("SELECT sales.salesid, product.name, sales.price, sales.weight, sales.amountdue, sales.lessdiscount, sales.netamountdue, sales.amounttender, sales.amountchange, sales.dateissued, sales.timeissued, users.username FROM sales INNER JOIN product ON sales.productid=product.productid INNER JOIN users ON sales.id=users.id WHERE sales.dateissued >= '$dateA' AND sales.dateissued <= '$dateB'");
            } else {
                $sales = $connection->execute("SELECT sales.salesid, product.name, sales.price, sales.weight, sales.amountdue, sales.lessdiscount, sales.netamountdue, sales.amounttender, sales.amountchange, sales.dateissued, sales.timeissued, users.username FROM sales INNER JOIN product ON sales.productid=product.productid INNER JOIN users ON sales.id=users.id WHERE sales.dateissued >= '$dateA' AND sales.dateissued <= '$dateB' AND sales.productid = '$productid'");
            }
        } else {
            /*
            $sales = $connection->execute("SELECT sales.salesid, product.name, sales.price, sales.weight, sales.amountdue, sales.lessdiscount, sales.netamountdue, sales.amounttender, sales.amountchange, sales.dateissued, sales.timeissued, users.username FROM sales INNER JOIN product ON sales.productid=product.productid INNER JOIN users ON sales.id=users.id");
             */
        }
        //debug($sales);

        try {
            $output_layout .= "<table class='table table-bordered' style='width: 100%; text-align: center;'>";
            $output_layout .= "<thead style='font-weight: 1000;'>";
            $output_layout .= "<td>Sales ID</td>";
            $output_layout .= "<td>Product Name</td>";
            $output_layout .= "<td>Price</td>";
            $output_layout .= "<td>Weight</td>";
            $output_layout .= "<td>Amount Due</td>";
            $output_layout .= "<td>Less Discount</td>";
            $output_layout .= "<td>Net Amount Due</td>";
            $output_layout .= "<td>Amount Tender</td>";
            $output_layout .= "<td>Amount Change</td>";
            $output_layout .= "<td>Date Issued</td>";
            $output_layout .= "<td>User</td>";
            $output_layout .= "</thead>";
            foreach ($sales as $fields) {
                $output_layout .= "<tr>";
                $output_layout .= "<td>".$fields['salesid']."</td>";
                $output_layout .= "<td>".$fields['name']."</td>";
                $output_layout .= "<td>".$fields['price']."</td>";
                $output_layout .= "<td>".$fields['weight']."</td>";
                $output_layout .= "<td>".$fields['amountdue']."</td>";
                $output_layout .= "<td>".$fields['lessdiscount']."</td>";
                $output_layout .= "<td>".$fields['netamountdue']."</td>";
                $output_layout .= "<td>".$fields['amounttender']."</td>";
                $output_layout .= "<td>".$fields['amountchange']."</td>";
                $output_layout .= "<td>".$fields['dateissued']." ".$fields['timeissued'].".</td>";
                $output_layout .= "<td>".$fields['username']."</td>";
                $output_layout .= "<tr/>";
            }
            $output_layout .= "</table>";
            echo $output_layout;
        } catch (\Exception $e) {
            echo $e;
        }
    }

    public function genreportinventory()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $startdate = $this->request->data('startdate');
        $enddate = $this->request->data('enddate');
        $productid = $this->request->data('productid');
        $sourceid = $this->request->data('sourceid');

        $dateA = date("Y-m-d", strtotime($startdate));
        $dateB = date("Y-m-d", strtotime($enddate));

        $output_layout = '';
        echo $dateA;
        echo $dateB;
        // WHERE inventory.dateissued LIKE '$dateA'
        if (!$startdate == "") {
            $inv = $connection->execute("SELECT inventory.inventoryid, product.name, sourceofinventory.name, inventory.weight, inventory.unitprice, inventory.totalinventory, inventory.dateissued, users.username FROM inventory INNER JOIN product ON inventory.productid=product.productid INNER JOIN sourceofinventory ON inventory.sourceid=sourceofinventory.sourceid INNER JOIN users ON inventory.id=users.id WHERE inventory.dateissued LIKE '$dateA'");
        } else {
            /*
            $sales = $connection->execute("SELECT sales.salesid, product.name, sales.price, sales.weight, sales.amountdue, sales.lessdiscount, sales.netamountdue, sales.amounttender, sales.amountchange, sales.dateissued, sales.timeissued, users.username FROM sales INNER JOIN product ON sales.productid=product.productid INNER JOIN users ON sales.id=users.id WHERE sales.dateissued >= '$dateA' AND sales.dateissued <= '$dateB' AND sales.productid = '$productid'");

             */
            $inv = $connection->execute("SELECT inventory.inventoryid, product.name, sourceofinventory.name, inventory.weight, inventory.unitprice, inventory.totalinventory, inventory.dateissued, users.username FROM inventory INNER JOIN product ON inventory.productid=product.productid INNER JOIN sourceofinventory ON inventory.sourceid=sourceofinventory.sourceid INNER JOIN users ON inventory.id=users.id");
        }
        //debug($inv);

        try {
            $output_layout .= "<table class='table table-bordered' style='width: 100%; text-align: center;'>";
            $output_layout .= "<thead style='font-weight: 1000;'>";
            $output_layout .= "<td>Inventory ID</td>";
            $output_layout .= "<td>Product Name</td>";
            $output_layout .= "<td>Source</td>";
            $output_layout .= "<td>Weight</td>";
            $output_layout .= "<td>Unit Price Due</td>";
            $output_layout .= "<td>Total Inventory</td>";
            $output_layout .= "<td>Date</td>";
            $output_layout .= "<td>User</td>";
            $output_layout .= "</thead>";
            foreach ($inv as $fields) {
                $output_layout .= "<tr>";
                $output_layout .= "<td>".$fields['inventoryid']."</td>";
                $output_layout .= "<td>".$fields['name']."</td>";
                $output_layout .= "<td>".$fields['name']."</td>";
                $output_layout .= "<td>".$fields['weight']."</td>";
                $output_layout .= "<td>".$fields['unitprice']."</td>";
                $output_layout .= "<td>".$fields['totalinventory']."</td>";
                $output_layout .= "<td>".$fields['dateissued']."</td>";
                $output_layout .= "<td>".$fields['username']."</td>";
                $output_layout .= "<tr/>";
            }
            $output_layout .= "</table>";
            echo $output_layout;
        } catch (\Exception $e) {
            echo $e;
        }
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
