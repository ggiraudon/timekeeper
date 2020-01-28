<section class="content-header">
  <h1>
<?php echo __('Client'); ?>
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


            <dt><?= __('Name') ?></dt>
            <dd>
              <?= h($client->name) ?>
            </dd>

            <dt><?= __('Phone') ?></dt>
            <dd>
              <?= h($client->phone) ?>
            </dd>

            <dt><?= __('Email') ?></dt>
            <dd>
              <?= h($client->email) ?>
            </dd>

            <dt><?= __('Currency') ?></dt>
            <dd>
              <?= h($client->currency) ?>
            </dd>


            <dt><?= __('Default Rate') ?></dt>
            <dd>
              <?= $this->Number->format($client->default_rate) ?>
            </dd>



            <dt><?= __('Billing Address') ?></dt>
            <dd>
              <?= $this->Text->autoParagraph(h($client->billing_address)); ?>
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
        <div class="box-body">

          <?php if (!empty($client->activities)): ?>

            <table id="activities-table" class="table table-bordered table-striped">
		<thead>
                <tr>
                  <th>
                    When
                  </th>
                  <th>
                    Billable Time
                  </th>
                  <th>
                    Notes
                  </th>
                  <th>
                    <?php echo __('Actions'); ?>
                  </th>
                </tr>
		</thead>
              <tbody>
                <?php foreach ($client->activities as $activities): ?>
                  <tr>
                    <td>
                      <?= h($activities->date_time) ?>
                    </td>

                    <td>
                      <?= h($activities->billable_time) ?>
                    </td>

                    <td>
                      <?= h($activities->notes) ?>
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
          <h3 class="box-title"><?= __('Related {0}', ['Invoices']) ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">

          <?php if (!empty($client->invoices)): ?>

            <table class="table table-hover">
              <tbody>
                <tr>

                  <th>
                    Date
                  </th>


                  <th>
                    Discount
                  </th>


                  <th>
                    <?php echo __('Actions'); ?>
                  </th>
                </tr>

                <?php foreach ($client->invoices as $invoices): ?>
                  <tr>

                   <td>
                      <?= h($invoices->invoice_date) ?>
                    </td>

                    <td>
                      <?= h($invoices->discount) ?>
                    </td>

                    <td class="actions">
                      <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoices->id], ['class'=>'btn btn-info btn-xs']) ?>

                        <?= $this->Html->link(__('Edit'), ['controller' => 'Invoices', 'action' => 'edit', $invoices->id], ['class'=>'btn btn-warning btn-xs']) ?>

                          <?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete', $invoices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoices->id), 'class'=>'btn btn-danger btn-xs']) ?>
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
          <h3 class="box-title"><?= __('Related {0}', ['Projects']) ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">

          <?php if (!empty($client->projects)): ?>

            <table class="table table-hover">
              <tbody>
                <tr>


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

                <?php foreach ($client->projects as $projects): ?>
                  <tr>



                    <td>
                      <?= h($projects->name) ?>
                    </td>

                    <td>
                      <?= h($projects->rate) ?>
                    </td>

                    <td class="actions">
                      <?= $this->Html->link(__('View'), ['controller' => 'Projects', 'action' => 'view', $projects->id], ['class'=>'btn btn-info btn-xs']) ?>

                        <?= $this->Html->link(__('Edit'), ['controller' => 'Projects', 'action' => 'edit', $projects->id], ['class'=>'btn btn-warning btn-xs']) ?>

                          <?= $this->Form->postLink(__('Delete'), ['controller' => 'Projects', 'action' => 'delete', $projects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projects->id), 'class'=>'btn btn-danger btn-xs']) ?>
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

<?php $this->start('scriptBotton'); ?>
<script>
  $(function () {
    $('#activities-table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>
<?php $this->end(); ?>
