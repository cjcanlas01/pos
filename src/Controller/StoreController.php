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

    public function purchasesreportspage()
    {
        $this->render('purchasesreport');
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
        //$this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $name = $this->request->getData('name');
        $unitprice = $this->request->getData('unitprice');
        $id = $this->Auth->user('id');
        $date = date('Y-m-d H:i:s');

        $fileName = $this->request->getParam('controller');
        $uploadPath =  WWW_ROOT.'img/';
        $uploadFile = $uploadPath.$fileName;

        if (move_uploaded_file($this->request->getParam('controller'), $uploadFile)) {
            //DB query goes here
            $connection->execute("INSERT INTO product (productname, unitprice, created, userid, image) VALUES ('$name', '$unitprice', '$date', '$id', '$uploadFile')");
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
        die();
    }

    public function viewproduct()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');
        $results = $connection->execute("SELECT * FROM product")->fetchAll('assoc');
        echo json_encode($results);
        die();
    }

    public function viewsofi()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');
        $results = $connection->execute("SELECT * FROM sourceofinventory")->fetchAll('assoc');
        echo json_encode($results);
        die();
    }

    public function updateuser()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $varid = (int) $this->request->getData('id');

        $varusern = $this->request->getData('username');
        $varpass = $this->request->getData('password');
        $varln = $this->request->getData('lastname');
        $varfn = $this->request->getData('firstname');
        $varmn = $this->request->getData('middlename');
        $varrole = $this->request->getData('role');
        $varpos = $this->request->getData('position');
        $varbranch = $this->request->getData('branch');

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

        $varid = (int) $this->request->getData('productid');

        $varname = $this->request->getData('name');
        $varunitprice = $this->request->getData('unitprice');

        if ($connection->execute("UPDATE product SET productname = '$varname', unitprice = '$varunitprice' WHERE  productid = '$varid'")) {
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

        $varid = (int) $this->request->getData('editid');
        $varname = $this->request->getData('name');

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
        die();
    }

    public function addinventory()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $productid = $this->request->getData('productid');
        $sourceid = $this->request->getData('sourceid');
        $userid = $this->request->getData('userid');
        $id = $this->Auth->user('id');

        $weight = $this->request->getData('weight');
        $unitprice = $this->request->getData('unitprice');

        $totalinventory = $this->request->getData('totalinventory'); //new record for inventory

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

        $productid = $this->request->getData('productid');
        $id = $this->Auth->user('id');

        $price = $this->request->getData('price');
        $weight = $this->request->getData('weight');
        $currentinv = $this->request->getData('currentinv');
        $amountdue = $this->request->getData('amountdue');
        $lessdiscount = $this->request->getData('lessdiscount');
        $netamountdue = $this->request->getData('netamountdue');
        $amounttender = $this->request->getData('amounttender');

        $change = $this->request->getData('change');

        date_default_timezone_set('Asia/Manila');

        $time = date('H:i:s');

        if ($weight < $currentinv && $amounttender == $amountdue) {
            $connection->execute("INSERT INTO sales SET productid = '$productid', price = '$price', weight = '$weight', amountdue = '$amountdue', lessdiscount = '$lessdiscount', netamountdue = '$netamountdue', amounttender = '$amounttender', amountchange = '$change', dateissued = CURDATE(), timeissued = '$time', id = '$id'");
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

        $startdate = $this->request->getData('startdate');
        $enddate = $this->request->getData('enddate');
        $productid = $this->request->getData('productid');

        $dateA = date("Y-m-d", strtotime($startdate));
        $dateB = date("Y-m-d", strtotime($enddate));

        if ($startdate == $enddate) {
            if ($productid == "ALL") {
                $sales = $connection->execute("SELECT product.productname, sales.price, sales.weight, sales.amountdue, sales.lessdiscount, sales.netamountdue, sales.amounttender, sales.amountchange, DATE_FORMAT(sales.dateissued, '%m-%d-%Y') as dateissued, sales.timeissued FROM sales INNER JOIN product ON sales.productid=product.productid WHERE dateissued = '$dateA'")->fetchAll('assoc');
            } elseif ($productid != "ALL") {
                 $sales = $connection->execute("SELECT product.productname, sales.price, sales.weight, sales.amountdue, sales.lessdiscount, sales.netamountdue, sales.amounttender, sales.amountchange, DATE_FORMAT(sales.dateissued, '%m-%d-%Y') as dateissued, sales.timeissued FROM sales INNER JOIN product ON sales.productid=product.productid WHERE dateissued = '$dateA' AND sales.productid = '$productid'")->fetchAll('assoc');
            }
        } else {
            if ($productid == "ALL") {
                $sales = $connection->execute("SELECT product.productname, sales.price, sales.weight, sales.amountdue, sales.lessdiscount, sales.netamountdue, sales.amounttender, sales.amountchange, DATE_FORMAT(sales.dateissued, '%m-%d-%Y') as dateissued, sales.timeissued FROM sales INNER JOIN product ON sales.productid=product.productid WHERE dateissued BETWEEN '$dateA' AND '$dateB'")->fetchAll('assoc');
            } elseif ($productid != "ALL") {
                 $sales = $connection->execute("SELECT product.productname, sales.price, sales.weight, sales.amountdue, sales.lessdiscount, sales.netamountdue, sales.amounttender, sales.amountchange, DATE_FORMAT(sales.dateissued, '%m-%d-%Y') as dateissued, sales.timeissued FROM sales INNER JOIN product ON sales.productid=product.productid WHERE dateissued BETWEEN '$dateA' AND '$dateB' AND sales.productid = '$productid'")->fetchAll('assoc');
            }
        }
        echo json_encode($sales);
        die();
    }

    public function genreportpurchases()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $startdate = $this->request->getData('startdate');
        $enddate = $this->request->getData('enddate');
        $productid = $this->request->getData('productid');
        $sourceid = $this->request->getData('sourceid');

        $dateA = date("Y-m-d", strtotime($startdate));
        $dateB = date("Y-m-d", strtotime($enddate));

        if ($startdate == $enddate) {
            if ($productid == "ALL" && $sourceid == "ALL") {
                $purchases = $connection->execute("SELECT product.productname, sourceofinventory.name, inventory.weight, inventory.unitprice, inventory.totalinventory, DATE_FORMAT(inventory.dateissued, '%m-%d-%Y') as dateissued, inventory.timeissued FROM inventory INNER JOIN product ON inventory.productid=product.productid INNER JOIN sourceofinventory ON inventory.sourceid=sourceofinventory.sourceid WHERE dateissued = '$dateA'")->fetchAll('assoc');
            } elseif ($productid != "ALL" && $sourceid == "ALL") {
                 $purchases = $connection->execute("SELECT product.productname, sourceofinventory.name, inventory.weight, inventory.unitprice, inventory.totalinventory, DATE_FORMAT(inventory.dateissued, '%m-%d-%Y') as dateissued, inventory.timeissued FROM inventory INNER JOIN product ON inventory.productid=product.productid INNER JOIN sourceofinventory ON inventory.sourceid=sourceofinventory.sourceid WHERE dateissued = '$dateA' AND inventory.productid = '$productid'")->fetchAll('assoc');
            } elseif ($productid != "ALL" && $sourceid != "ALL") {
                $purchases = $connection->execute("SELECT product.productname, sourceofinventory.name, inventory.weight, inventory.unitprice, inventory.totalinventory, DATE_FORMAT(inventory.dateissued, '%m-%d-%Y') as dateissued, inventory.timeissued FROM inventory INNER JOIN product ON inventory.productid=product.productid INNER JOIN sourceofinventory ON inventory.sourceid=sourceofinventory.sourceid WHERE dateissued = '$dateA' AND inventory.productid = '$productid' AND inventory.sourceid = '$sourceid'")->fetchAll('assoc');
            }
        } else {
            if ($productid == "ALL" && $sourceid == "ALL") {
                $purchases = $connection->execute("SELECT product.productname, sourceofinventory.name, inventory.weight, inventory.unitprice, inventory.totalinventory, DATE_FORMAT(inventory.dateissued, '%m-%d-%Y') as dateissued, inventory.timeissued FROM inventory INNER JOIN product ON inventory.productid=product.productid INNER JOIN sourceofinventory ON inventory.sourceid=sourceofinventory.sourceid WHERE dateissued BETWEEN '$dateA' AND '$dateB'")->fetchAll('assoc');
            } elseif ($productid != "ALL" && $sourceid == "ALL") {
                 $purchases = $connection->execute("SELECT product.productname, sourceofinventory.name, inventory.weight, inventory.unitprice, inventory.totalinventory, DATE_FORMAT(inventory.dateissued, '%m-%d-%Y') as dateissued, inventory.timeissued  FROM inventory INNER JOIN product ON inventory.productid=product.productid INNER JOIN sourceofinventory ON inventory.sourceid=sourceofinventory.sourceid WHERE dateissued BETWEEN '$dateA' AND '$dateB' AND inventory.productid = '$productid'")->fetchAll('assoc');
            } elseif ($productid != "ALL" && $sourceid != "ALL") {
                $purchases = $connection->execute("SELECT product.productname, sourceofinventory.name, inventory.weight, inventory.unitprice, inventory.totalinventory, DATE_FORMAT(inventory.dateissued, '%m-%d-%Y') as dateissued, inventory.timeissued FROM inventory INNER JOIN product ON inventory.productid=product.productid INNER JOIN sourceofinventory ON inventory.sourceid=sourceofinventory.sourceid WHERE dateissued BETWEEN '$dateA' AND '$dateB' AND inventory.productid = '$productid' AND inventory.sourceid = '$sourceid'")->fetchAll('assoc');
            }
        }
        echo json_encode($purchases);
        die();
    }

    public function getendinginventory()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $month = $this->request->getData('month');
        $year = $this->request->getData('year');
        $productid = $this->request->getData('productid');
        $checkmnth = (int) $month - 1;

        if ($productid != "ALL") {
            $endinginv = $connection->execute("SELECT computedweight FROM endinginventory WHERE productid = '$productid' AND monthofinventory = '$checkmnth' AND yearofinventory = '$year'")->fetchAll('assoc');
        } else {
            $endinginv = $connection->execute("SELECT computedweight FROM endinginventory WHERE monthofinventory = '$checkmnth' AND yearofinventory = '$year'")->fetchAll('assoc');
        }

        echo json_encode($endinginv);
        die();
    }

    public function getallendinginventory()
    {
        //spanIDc_inv
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $month = $this->request->getData('month');
        $year = $this->request->getData('year');
        //$productid = $this->request->data('productid');

        $endinginv = $connection->execute("SELECT * FROM endinginventory WHERE monthofinventory = '$month' AND yearofinventory = '$year'")->fetchAll('assoc');

        echo json_encode($endinginv);
        die();
    }

    public function genreportinv()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $month = $this->request->getData('month');
        $year = $this->request->getData('year');
        $productid = $this->request->getData('productid');
        //$lmwinv = $this->request->data('month'); - 1;

        $tbl = "";

        if ($productid == "ALL") {
            $inv = $connection->execute("SELECT inv.transactiontype, DATE_FORMAT(inv.dateissued, '%m-%d-%Y') as dateissued, inv.timeissued, pro.productname, inv.weight FROM inventory as inv INNER JOIN product AS pro ON inv.productid = pro.productid WHERE MONTH(dateissued) = '$month' AND YEAR(dateissued) = '$year' UNION SELECT sls.transactiontype, DATE_FORMAT(sls.dateissued, '%m-%d-%Y') as dateissued, sls.timeissued, pro.productname, sls.weight FROM sales as sls INNER JOIN product as pro ON sls.productid = pro.productid WHERE MONTH(dateissued) = '$month' AND YEAR(dateissued) = '$year' ORDER BY dateissued, timeissued ASC")->fetchAll('assoc');
        } else {
            $inv = $connection->execute("SELECT inv.transactiontype, DATE_FORMAT(inv.dateissued, '%m-%d-%Y') as dateissued, inv.timeissued, pro.productname, inv.weight FROM inventory as inv INNER JOIN product AS pro ON inv.productid = pro.productid WHERE inv.productid = '$productid' AND MONTH(dateissued) = '$month' AND YEAR(dateissued) = '$year' UNION SELECT sls.transactiontype, DATE_FORMAT(sls.dateissued, '%m-%d-%Y') as dateissued, sls.timeissued, pro.productname, sls.weight FROM sales as sls INNER JOIN product as pro ON sls.productid = pro.productid WHERE sls.productid = '$productid' AND MONTH(dateissued) = '$month' AND YEAR(dateissued) = '$year' ORDER BY dateissued, timeissued ASC")->fetchAll('assoc');
        }
        echo json_encode($inv);
        die();
    }


    public function checkupdate()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $id = $this->Auth->user('id');
        $checkedresult = "";
        $finalquery = "";
        $alert = "";
        $mnthlyendinginvamnt = 0;
        $pmonth = 0;
        $fmnthlyendinginvamnt = 0;
        $idArray = [];

        $date = $this->request->getData('date');
        $month = $this->request->getData('month');
        $year = $this->request->getData('year');

        date_default_timezone_set('Asia/Manila');
        $time = date('H:i:s');

        $results = $connection->execute("SELECT * FROM product")->fetchAll('assoc');
        //inserts results to a local array
        foreach ($results as $data) {
            $idArray[] = $data['productid'];
        }

        $endinginvtable = TableRegistry::get('endinginventory');
        $mnthdiff = (int) $month - 3; //difference of month with minimun number of 3

        for ($i=$mnthdiff; $i <= (int) $month; $i++) {

            for ($var=0; $var < count($idArray); $var++) {
                $exists = $endinginvtable->exists(['productid' => $idArray[$var], 'monthofinventory' => $i, 'yearofinventory' => $year]); //endinginventorytable
                /*
                    checks if month of endinginventory is existing, if false = compute and insert, if true = reo-compute and update
                 */
                $results = $connection->execute("SELECT inv.transactiontype, inv.dateissued, inv.timeissued, pro.productname, inv.weight FROM inventory as inv INNER JOIN product AS pro ON inv.productid = pro.productid WHERE inv.productid = '$idArray[$var]' AND MONTH(dateissued) = '$i' AND YEAR(dateissued) = '$year' UNION SELECT sls.transactiontype, sls.dateissued, sls.timeissued, pro.productname, sls.weight FROM sales as sls INNER JOIN product as pro ON sls.productid = pro.productid WHERE sls.productid = '$idArray[$var]' AND MONTH(dateissued) = '$i' AND YEAR(dateissued) = '$year' ORDER BY STR_TO_DATE(dateissued, '%Y-%m-%d'), timeissued ASC")->fetchAll('assoc');

                foreach ($results as $data) {
                    if ($data['transactiontype'] == 'Sales') {
                        $mnthlyendinginvamnt = $mnthlyendinginvamnt - (float) $data['weight'];
                    } else {
                        $mnthlyendinginvamnt = $mnthlyendinginvamnt + (float) $data['weight'];
                    }
                }

                $pmonth = $i - 1; //past month value
                $results_ = $connection->execute("SELECT computedweight FROM endinginventory WHERE productid = '$idArray[$var]' AND monthofinventory = '$pmonth' AND yearofinventory = '$year'")->fetchAll('assoc');

                foreach ($results_ as $data) {
                    $fmnthlyendinginvamnt = $mnthlyendinginvamnt + sprintf('%.2f', $data['computedweight']);
                }

                switch($exists) {
                case true:
                    $finalquery = $connection->execute("UPDATE endinginventory SET datecomputed = CURDATE(), timecomputed = '$time', computedweight = '$fmnthlyendinginvamnt', userid = '$id' WHERE productid = '$idArray[$var]' AND monthofinventory = '$i' AND yearofinventory = '$year'");
                    $mnthlyendinginvamnt = 0;
                    break;
                case false;
                    $finalquery = $connection->execute("INSERT INTO endinginventory SET productid = '$idArray[$var]', monthofinventory = '$i', yearofinventory = '$year', datecomputed = CURDATE(), timecomputed = '$time', computedweight = '$fmnthlyendinginvamnt', userid = '$id'");
                    $mnthlyendinginvamnt = 0;
                    break;
                }
            }
        }

        $endinginv = $connection->execute("SELECT * FROM endinginventory WHERE monthofinventory = '$month' AND yearofinventory = '$year'")->fetchAll('assoc');
        echo json_encode($endinginv);
        die();
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
