<?php
use Cake\Core\Configure;

$file = Configure::read('Theme.folder') . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'aside' . DS . 'form.ctp';

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<form action="#" method="get" class="sidebar-form">
    <div class="input-group">
    </div>
</form>
<?php } ?>
