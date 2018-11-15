<?php
use Cake\Core\Configure;

$file = Configure::read('Theme.folder'). DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'aside' . DS . 'sidebar-menu.ctp';
if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<ul class="sidebar-menu" >
    <li class="header">MAIN NAVIGATION</li>
    <li>
        <a href="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'loaddashboard')); ?>">
            <i class="fa fa-circle-o"></i>
            <span>DASHBOARD</span>
        </a>
    </li>
    <li>
        <a href="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'posmenupage')); ?>">
            <i class="fa fa-circle-o"></i>
            <span>CREATE TRANSACTION</span>
        </a>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-circle-o"></i> <span>REPORTS</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'purchasesreportspage')); ?>"><i class="fa fa-dot-circle-o"></i>Purchases</a></li>
            <li><a href="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'salesreportspage')); ?>"><i class="fa fa-dot-circle-o"></i>Sales</a></li>
            <li><a href="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'inventoryreportspage')); ?>"><i class="fa fa-dot-circle-o"></i>Inventory</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-circle-o"></i> <span>SETTINGS</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'userspage')); ?>"><i class="fa fa-dot-circle-o"></i>Users</a></li>
            <li><a href="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'productpage')); ?>"><i class="fa fa-dot-circle-o"></i>Products</a></li>
            <li><a href="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'sofipage')); ?>"><i class="fa fa-dot-circle-o"></i>Source of Inventory</a></li>
        </ul>
    </li>
</ul>
<?php } ?>
