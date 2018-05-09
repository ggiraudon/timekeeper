<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Tickets
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Tickets</h3>
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
              <th><?= $this->Paginator->sort('company_id') ?></th>
              <th><?= $this->Paginator->sort('client_id') ?></th>
              <th><?= $this->Paginator->sort('project_id') ?></th>
              <th><?= $this->Paginator->sort('ticket_number') ?></th>
              <th><?= $this->Paginator->sort('ticket_date') ?></th>
              <th><?= $this->Paginator->sort('from_email') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tickets as $ticket): ?>
              <tr>
                <td><?= h($ticket->id) ?></td>
                <td><?= $ticket->has('company') ? $this->Html->link($ticket->company->name, ['controller' => 'Companies', 'action' => 'view', $ticket->company->id]) : '' ?></td>
                <td><?= $ticket->has('client') ? $this->Html->link($ticket->client->name, ['controller' => 'Clients', 'action' => 'view', $ticket->client->id]) : '' ?></td>
                <td><?= $ticket->has('project') ? $this->Html->link($ticket->project->name, ['controller' => 'Projects', 'action' => 'view', $ticket->project->id]) : '' ?></td>
                <td><?= $this->Number->format($ticket->ticket_number) ?></td>
                <td><?= h($ticket->ticket_date) ?></td>
                <td><?= h($ticket->from_email) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $ticket->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ticket->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ticket->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
