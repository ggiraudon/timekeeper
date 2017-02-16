<?php
$file = $theme['folder'] . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'footer.ctp';

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.2
    </div>
    <strong>TimeKEEPER</strong> - All rights
    reserved.
</footer>
<?php } ?>
