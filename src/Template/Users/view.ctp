<section class="content-header">
  <h1>
    <?php echo __('User'); ?>
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
                                            <?= h($user->id) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Company') ?></dt>
                                <dd>
                                    <?= $user->has('company') ? $user->company->name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Username') ?></dt>
                                        <dd>
                                            <?= h($user->username) ?>
                                        </dd>
                                                                                                                                                                                                                                            <dt><?= __('Email') ?></dt>
                                        <dd>
                                            <?= h($user->email) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Role') ?></dt>
                                        <dd>
                                            <?= h($user->role) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Firstname') ?></dt>
                                        <dd>
                                            <?= h($user->firstname) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Lastname') ?></dt>
                                        <dd>
                                            <?= h($user->lastname) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Active') ?></dt>
                                        <dd>
                                            <?= h($user->active) ?>
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

                <?php if (!empty($user->activities)): ?>

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
                                    Rate
                                    </th>
                                        
                                                                    
                                    <th>
                                    Notes
                                    </th>
                                        
                                                                    
                                    <th>
                                    Date Time
                                    </th>
                                        
                                                                    
                                    <th>
                                    Invoice Id
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($user->activities as $activities): ?>
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
                                    <?= h($activities->rate) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($activities->notes) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($activities->date_time) ?>
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['User Timers']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($user->user_timers)): ?>

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
                                    Description
                                    </th>
                                        
                                                                    
                                    <th>
                                    Start
                                    </th>
                                        
                                                                    
                                    <th>
                                    Paused
                                    </th>
                                        
                                                                    
                                    <th>
                                    Add
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($user->user_timers as $userTimers): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($userTimers->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($userTimers->user_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($userTimers->client_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($userTimers->project_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($userTimers->description) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($userTimers->start) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($userTimers->paused) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($userTimers->add) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'UserTimers', 'action' => 'view', $userTimers->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserTimers', 'action' => 'edit', $userTimers->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserTimers', 'action' => 'delete', $userTimers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userTimers->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
