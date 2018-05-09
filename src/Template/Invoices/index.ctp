<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Invoices
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Invoices</h3>
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
              <th><?= $this->Paginator->sort('label') ?></th>
              <th><?= $this->Paginator->sort('client_id') ?></th>
              <th><?= $this->Paginator->sort('invoice_date') ?></th>
              <th><?= $this->Paginator->sort('discount') ?></th>
              <th><?= $this->Paginator->sort('pretotal') ?></th>
              <th><?= $this->Paginator->sort('total') ?></th>
              <th><?= $this->Paginator->sort('status') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($invoices as $invoice): ?>
              <tr>
                <td><?= $this->Html->link(h($invoice->label), ['action' => 'view', $invoice->id]) ?></td>
                <td><?= $invoice->has('client') ? $this->Html->link($invoice->client->name, ['controller' => 'Clients', 'action' => 'view', $invoice->client->id]) : '' ?></td>
                <td><?= h($invoice->invoice_date) ?></td>
                <td><?= $this->Number->format($invoice->discount) ?></td>
                <td><?= $this->Number->format($invoice->pretotal) ?></td>
                <td><?= $this->Number->format($invoice->total) ?></td>
                <td><?= h($invoice->status) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $invoice->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('PDF'), ['action' => 'view', $invoice->id.".pdf"], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $invoice->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $invoice->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
