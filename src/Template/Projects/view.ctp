<section class="content-header">
  <h1>
    <?php echo __('Project'); ?>
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
                                            <?= h($project->id) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Client') ?></dt>
                                <dd>
                                    <?= $project->has('client') ? $project->client->name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Name') ?></dt>
                                        <dd>
                                            <?= h($project->name) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                        <dt><?= __('Rate') ?></dt>
                                <dd>
                                    <?= $this->Number->format($project->rate) ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Activities']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($project->activities)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    User Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Client Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Project Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Billable Time
                                    </th>
                                        
                                                                    
                                    <th>
                                    Notes
                                    </th>
                                        
                                                                    
                                    <th>
                                    When
                                    </th>
                                        
                                                                    
                                    <th>
                                    Invoice Id
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($project->activities as $activities): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($activities->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($activities->user_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($activities->client_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($activities->project_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($activities->billable_time) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($activities->notes) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($activities->when) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($activities->invoice_id) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Activities', 'action' => 'view', $activities->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Activities', 'action' => 'edit', $activities->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Activities', 'action' => 'delete', $activities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activities->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
