<section class="content-header">
  <h1>
    <?php echo __('Activity'); ?>
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
                                            <?= h($activity->id) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('User') ?></dt>
                                <dd>
                                    <?= $activity->has('user') ? $activity->user->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Client') ?></dt>
                                <dd>
                                    <?= $activity->has('client') ? $activity->client->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Project') ?></dt>
                                <dd>
                                    <?= $activity->has('project') ? $activity->project->name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Notes') ?></dt>
                                        <dd>
                                            <?= h($activity->notes) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Invoice') ?></dt>
                                <dd>
                                    <?= $activity->has('invoice') ? $activity->invoice->id : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                        <dt><?= __('Billable Time') ?></dt>
                                <dd>
                                    <?= $this->Number->format($activity->billable_time) ?>
                                </dd>
                                                                                                
                                                                                                        <dt><?= __('When') ?></dt>
                                <dd>
                                    <?= h($activity->when) ?>
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
