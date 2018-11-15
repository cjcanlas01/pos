<?php
use Cake\Core\Configure;

$file = Configure::read('Theme.folder') . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'aside-control-sidebar.ctp';

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">SETTINGS</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'userspage')); ?>">
                        <i class="menu-icon fa fa-user bg-blue"></i>

                        <div class="menu-info">
                            <h2 class="control-sidebar-subheading">Users</h4>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'productpage')); ?>">
                        <i class="menu-icon fa fa-briefcase bg-blue"></i>

                        <div class="menu-info">
                            <h2 class="control-sidebar-subheading">Products</h4>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'sofipage')); ?>">
                        <i class="menu-icon fa fa-archive bg-blue"></i>

                        <div class="menu-info">
                            <h2 class="control-sidebar-subheading">Source of Inventory</h4>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
<?php
}
?>
