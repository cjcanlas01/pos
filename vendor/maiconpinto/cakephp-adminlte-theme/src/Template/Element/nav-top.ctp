<?php
use Cake\Core\Configure;

$file = Configure::read('Theme.folder') . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'nav-top.ctp';

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<nav href="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'loaddashboard')); ?>" class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->
      <!-- Notifications: style can be found in dropdown.less -->
      <!-- Tasks: style can be found in dropdown.less -->

      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <?php echo $this->Html->image('user2-160x160.jpg', array('class' => 'user-image', 'alt' => 'User Image')); ?>
          <span class="hidden-xs">USER</span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <?php echo $this->Html->image('user2-160x160.jpg', array('class' => 'img-circle', 'alt' => 'User Image')); ?>

            <p>
              USER - WEBMASTER
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-right">
              <a href="<?php echo $this->Url->build(array('controller' => 'Users', 'action' => 'logout')); ?>" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
      </li>
      <!-- Control Sidebar Toggle Button -->
      <!-- <li>
        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
      </li> -->
    </ul>
  </div>
</nav>
<?php
}
?>
