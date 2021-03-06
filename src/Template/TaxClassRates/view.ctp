<section class="content-header">
  <h1>
    <?php echo __('Tax Class Rate'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                                                                                                                <dt><?= __('Id') ?></dt>
                                        <dd>
                                            <?= h($taxClassRate->id) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Tax Class') ?></dt>
                                <dd>
                                    <?= $taxClassRate->has('tax_class') ? $taxClassRate->tax_class->name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Name') ?></dt>
                                        <dd>
                                            <?= h($taxClassRate->name) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                        <dt><?= __('Rate') ?></dt>
                                <dd>
                                    <?= $this->Number->format($taxClassRate->rate) ?>
                                </dd>
                                                                                                
                                            
                                            
                                    </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

</section>
