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

    public function loaddashboard()
    {
        $this->render('dashboard');
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

        $fileName = $this->request->data['image']['name'];
        $uploadPath =  WWW_ROOT.'img/';
        $uploadFile = $uploadPath.$fileName;

        if (move_uploaded_file($this->request->data['image']['tmp_name'], $uploadFile)) {
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

    public function searchprods()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');
        $proddata = $this->request->getData('proddata');

        $results = $connection->execute("SELECT * FROM product WHERE productname LIKE '%$proddata%'")->fetchAll('assoc');
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

        $fileName = $this->request->data['editimage']['name'];
        $uploadPath =  WWW_ROOT.'img/';
        $uploadFile = $uploadPath.$fileName;

        if (move_uploaded_file($this->request->data['editimage']['tmp_name'], $uploadFile)) {
            //DB query goes here
            $connection->execute("UPDATE product SET productname = '$varname', unitprice = '$varunitprice', image = '$uploadFile' WHERE  productid = '$varid'");
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

        if ((float) str_replace(',', '', $weight) <= (float) str_replace(',', '', $currentinv) ) {
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
                        $mnthlyendinginvamnt = $mnthlyendinginvamnt - (float) str_replace(",", "", $data['weight']);
                    } else {
                        $mnthlyendinginvamnt = $mnthlyendinginvamnt + (float) str_replace(",", "", $data['weight']);
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

    public function dashboardcomp()
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $result = array();
        $date = $this->request->getData('date');
        $month = $this->request->getData('month');
        $day = $this->request->getData('day');
        $year = $this->request->getData('year');

        //salescount
        $sales = $connection->execute("SELECT netamountdue as wt FROM sales WHERE DAY(dateissued) = '$day'")->fetchAll('assoc');
        $computesales = 0;
        foreach ($sales as $data) {
            $computesales = $computesales + (float) str_replace(',', '', $data['wt']);
        }

        $result[0] = $computesales;
        //purchasescount
        $purchases = $connection->execute("SELECT totalinventory as wt FROM inventory WHERE DAY(dateissued) = '$day'")->fetchAll('assoc');

        $computepurchases = 0;
        foreach ($purchases as $data) {
            $computepurchases = $computepurchases + (float) str_replace(',', '', $data['wt']);
        }

        $result[1] = $computepurchases;

        //currentinventory weight
        $endinginv = $connection->execute("SELECT computedweight FROM endinginventory WHERE monthofinventory = '$month' AND yearofinventory = '$year'")->fetchAll('assoc');

        $computeinv = 0;
        foreach ($endinginv as $data) {
            $computeinv = $computeinv + (float) $data['computedweight'];
        }

        $result[2] = $computeinv;

        //transactioncount
        $salesrecord = $connection->execute("SELECT COUNT(salesid) as id FROM sales")->fetchAll('assoc');
        $invrecord = $connection->execute("SELECT COUNT(inventoryid) as id FROM inventory")->fetchAll('assoc');

        //$result[3] = (int) $salesrecord + (int) $invrecord;
        $result[3] = $salesrecord;
        $result[4] = $invrecord;

        //barchart
        //sales
        for ($i = 0; $i < 12; $i++) {
            $mnth = $i + 1;
            $result[5][$i] = $connection->execute("SELECT COUNT(salesid) as id FROM sales WHERE MONTH(dateissued) = '$mnth'")->fetchAll('assoc');
        }
        //purchases
        for ($i = 0; $i < 12; $i++) {
            $mnth = $i + 1;
            $result[6][$i] = $connection->execute("SELECT COUNT(inventoryid) as id FROM inventory WHERE MONTH(dateissued) = '$mnth'")->fetchAll('assoc');
        }

        $tmpcompute = 0;
        $tmpcompute2 = 0;
        $linechartarr = array();
        $linechartarr = $this->linechartload($year);
        for ($x = 0; $x < 12; $x++) {
            $tmpcompute = 0;
            if ($x == 2) { //per quarter
                for ($y = 0; $y < 3; $y++) { //3 months index
                    $tmpcompute = $tmpcompute + $linechartarr[0][$y];
                    $tmpcompute2 = $tmpcompute2 + $linechartarr[1][$y];
                }
                $result[7][0][0] = $tmpcompute;
                $result[7][1][0] = $tmpcompute2;
            } else if ($x == 5) {
                for ($y = 3; $y < 6; $y++) { //3 months index
                    $tmpcompute = $tmpcompute + $linechartarr[0][$y];
                    $tmpcompute2 = $tmpcompute2 + $linechartarr[1][$y];
                }
                $result[7][0][1] = $tmpcompute2;
                $result[7][1][1] = $tmpcompute2;
            } else if ($x == 8) {
                for ($y = 6; $y < 9; $y++) { //3 months index
                    $tmpcompute = $tmpcompute + $linechartarr[0][$y];
                    $tmpcompute2 = $tmpcompute2 + $linechartarr[1][$y];
                }
                $result[7][0][2] = $tmpcompute;
                $result[7][1][2] = $tmpcompute2;
            } else if ($x == 11) {
                for ($y = 9; $y < 12; $y++) { //3 months index
                    $tmpcompute = $tmpcompute + $linechartarr[0][$y];
                    $tmpcompute2 = $tmpcompute2 + $linechartarr[1][$y];
                }
                $result[7][0][3] = $tmpcompute;
                $result[7][1][3] = $tmpcompute2;
            }
        }

        echo json_encode($result);
        die();
    }

    public function linechartload($currentyear)
    {
        $this->autoRender = false;
        $connection = ConnectionManager::get('default');

        $setAresult = array();
        $setBresult = array();
        $finalsetresult = array();

        $tmpA = 0;
        $tmpB = 0;

        $pastyear = $currentyear - 1;

        for ($x=0; $x<12;$x++) {
            $tmpA = 0;
            $tmpB = 0;
            $fmnth = $x + 1;
            $getdatasetA = $connection->execute("SELECT amountdue as ad FROM sales WHERE YEAR(dateissued) = '$currentyear' AND MONTH(dateissued) = '$fmnth'")->fetchAll('assoc');
            foreach ($getdatasetA as $data) {
                $tmpA = $tmpA + (float) str_replace(',', '', $data['ad']);
            }
            $setAresult[$x] = $tmpA;

            $getdatasetB = $connection->execute("SELECT amountdue as ad FROM sales WHERE YEAR(dateissued) = '$pastyear' AND MONTH(dateissued) = '$fmnth'")->fetchAll('assoc');
            foreach ($getdatasetB as $data) {
                $tmpB = $tmpB + (float) str_replace(',', '', $data['ad']);
            }
            $setBresult[$x] = $tmpB;
        }

        $finalsetresult[0] = $setAresult;
        $finalsetresult[1] = $setBresult;

        return $finalsetresult;
    }

    public function deleteprod()
    {
         $param_id = $this->request->getData('id');
         $prod_table = TableRegistry::get('Product');
         $product = $prod_table->get($param_id);

        if ($prod_table->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'productpage']);
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
