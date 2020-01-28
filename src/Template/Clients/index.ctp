<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Clients
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Clients</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="clients-table" class="table table-hover">
	    <thead>
            <tr>
              <th><?= __('Name') ?></th>
              <th><?= __('Default Rate') ?></th>
              <th><?= __('Currency') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
	    </thead>
	    <tbody>
            <?php foreach ($clients as $client): ?>
              <tr>
                <td><?= h($client->name) ?></td>
                <td><?= $this->Number->format($client->default_rate) ?></td>
                <td><?= h($client->currency) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $client->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $client->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $client->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
	    </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
<?php
$this->Html->css([
    '/plugins/datatables/dataTables.bootstrap',
  ],
  ['block' => 'css']);

$this->Html->script([
  '/plugins/datatables/jquery.dataTables.min',
  '/plugins/datatables/dataTables.bootstrap.min',
],
['block' => 'script']);
?>

<script>
  $(function () {
    $('#clients-table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>
