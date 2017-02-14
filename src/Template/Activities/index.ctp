<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Activities
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Activities</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                </span>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('user_id') ?></th>
              <th><?= $this->Paginator->sort('client_id') ?></th>
              <th><?= $this->Paginator->sort('project_id') ?></th>
              <th><?= $this->Paginator->sort('billable_time') ?></th>
              <th><?= $this->Paginator->sort('notes') ?></th>
              <th><?= $this->Paginator->sort('when') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($activities as $activity): ?>
              <tr>
                <td><?= h($activity->id) ?></td>
                <td><?= $activity->has('user') ? $this->Html->link($activity->user->id, ['controller' => 'Users', 'action' => 'view', $activity->user->id]) : '' ?></td>
                <td><?= $activity->has('client') ? $this->Html->link($activity->client->name, ['controller' => 'Clients', 'action' => 'view', $activity->client->id]) : '' ?></td>
                <td><?= $activity->has('project') ? $this->Html->link($activity->project->name, ['controller' => 'Projects', 'action' => 'view', $activity->project->id]) : '' ?></td>
                <td><?= $this->Number->format($activity->billable_time) ?></td>
                <td><?= h($activity->notes) ?></td>
                <td><?= h($activity->when) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $activity->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $activity->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $activity->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <?php echo $this->Paginator->numbers(); ?>
          </ul>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
