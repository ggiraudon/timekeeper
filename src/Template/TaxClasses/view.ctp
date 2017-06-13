<section class="content-header">
  <h1>
    <?php echo __('Tax Class'); ?>
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
                                            <?= h($taxClass->id) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Company') ?></dt>
                                <dd>
                                    <?= $taxClass->has('company') ? $taxClass->company->name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Name') ?></dt>
                                        <dd>
                                            <?= h($taxClass->name) ?>
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

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Tax Class Rates']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($taxClass->tax_class_rates)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Tax Class Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Rate
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($taxClass->tax_class_rates as $taxClassRates): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($taxClassRates->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($taxClassRates->tax_class_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($taxClassRates->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($taxClassRates->rate) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'TaxClassRates', 'action' => 'view', $taxClassRates->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'TaxClassRates', 'action' => 'edit', $taxClassRates->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TaxClassRates', 'action' => 'delete', $taxClassRates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxClassRates->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
