<?php
$file = $theme['folder'] . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'aside' . DS . 'sidebar-menu.ctp';

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<ul class="sidebar-menu">

    <li class="header">MAIN NAVIGATION</li>
    <li class="treeview">
        <a href="<?php echo $this->Url->build('/clients'); ?>">
            <i class="fa fa-id-card"></i> <span>Clients</span>
        </a>
    </li>
    <li class="treeview">
        <a href="<?php echo $this->Url->build('/projects'); ?>">
            <i class="fa fa-flask"></i> <span>Projects</span>
        </a>
    </li>
    <li class="treeview">
        <a href="<?php echo $this->Url->build('/tickets'); ?>">
            <i class="fa fa-ticket"></i> <span>Tickets</span>
        </a>
    </li>
 
    <li class="treeview">
        <a href="<?php echo $this->Url->build('/activities?filter=uninvoiced'); ?>">
            <i class="fa fa-clock-o"></i> <span>Activities</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/activities?filter=uninvoiced'); ?>"><i class="fa fa-circle-o"></i>Not Invoiced</a></li>
            <li><a href="<?php echo $this->Url->build('/activities?filter=invoiced'); ?>"><i class="fa fa-circle-o"></i>Invoiced</a></li>
            <li><a href="<?php echo $this->Url->build('/activities/add'); ?>"><i class="fa fa-circle-o"></i>New</a></li>
            <li><a href="<?php echo $this->Url->build('/activities/batchAdd'); ?>"><i class="fa fa-circle-o"></i>Batch</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="<?php echo $this->Url->build('/invoices'); ?>">
            <i class="fa fa-money"></i> <span>Invoices</span>
        </a>
    </li>
</ul>
<?php } ?>
