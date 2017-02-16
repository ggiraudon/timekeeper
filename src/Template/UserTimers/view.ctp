<section class="content-header">
  <h1>
    <?php echo __('User Timer'); ?>
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
                                            <?= h($userTimer->id) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('User') ?></dt>
                                <dd>
                                    <?= $userTimer->has('user') ? $userTimer->user->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Client') ?></dt>
                                <dd>
                                    <?= $userTimer->has('client') ? $userTimer->client->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Project') ?></dt>
                                <dd>
                                    <?= $userTimer->has('project') ? $userTimer->project->name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Description') ?></dt>
                                        <dd>
                                            <?= h($userTimer->description) ?>
                                        </dd>
                                                                                                                                    
                                            
                                            
                                                                                                        <dt><?= __('Start') ?></dt>
                                <dd>
                                    <?= h($userTimer->start) ?>
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
