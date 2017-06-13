<section class="content-header">
  <h1>
    Invoice
    <small><?= __('Add') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'index'], ['escape' => false]) ?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Form') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($invoice, array('role' => 'form')) ?>
          <div class="box-body">
	    <div class="input select"><label for="client-id">Client</label><select name="client_id" id="client-id">
			<option value=""></option>
		<?php 
			foreach($clients as $client):
		?>	

			<option value="<?= $client->id?>" data-rate="<?=$client->default_rate?>"><?=$client->name?></option>
		<?php
			endforeach;

		?>
	    </select></div>
          <?php
	
            echo $this->Form->input('date_time');
            echo $this->Form->input('discount');
          ?>
          </div>
          <!-- /.box-body -->
	  <div id="activities">
            <table id="activities-table" class="table table-bordered table-striped">
		<thead>
                <tr>
                  <th>
                  </th>
                  <th>
                    When
                  </th>
                  <th>
                    Billable Time
                  </th>
                  <th>
                    Project
                  </th>
                  <th>
                    Notes
                  </th>
                </tr>
		</thead>
		<tbody>
		</tbody>

	    </table>
	  </div>
          <div class="box-footer">
            <?= $this->Form->button(__('Save')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
<script>
$(document).ready(function() {
});   
</script>
<?php
$this->Html->css([
    'AdminLTE./plugins/datatables/dataTables.bootstrap',
  ],
  ['block' => 'css']);

$this->Html->script([
  'AdminLTE./plugins/datatables/jquery.dataTables.min',
  'AdminLTE./plugins/datatables/dataTables.bootstrap.min',
],
['block' => 'script']);
?>

<?php $this->start('scriptBotton'); ?>
<script>
  $(function () {
    var taxClasses = <?php echo(json_encode($taxClasses->jsonSerialize())); ?>;
    var activitiesTable = $('#activities-table').DataTable({

	    "processing": true,
//	    "serverSide": true,       
	    "ajax": {
	    "url" : "/api/activities/getUninvoiced.json",
	    "type": "GET",
	    "data" : function ( d ) {  return $('#client-id').serialize(); },
	    "dataSrc" : "activities"
	    },
	    "columns": [
		    {
			    "orderable" : false,
			    "render": function (data, type, JsonResultRow, meta) {
				qty=parseFloat(JsonResultRow.billable_time);
				if(JsonResultRow.rate)
				{
						rate=parseFloat(JsonResultRow.rate);

				}else{
					if(JsonResultRow.project.rate)
					{
						rate=parseFloat(JsonResultRow.project.rate);
					
					}else{

						rate=parseFloat($('#client-id').find(":selected").attr("data-rate"));
					}

				}
				cost=qty*rate;
			    	return '<input type="checkbox" class="activity" name="activities['+JsonResultRow.id+']" data-rate="'+rate+'" data-cost="'+cost+'">';
			    }
		    },
		    { data: 'date_time' },
		    { data: 'billable_time' },
		    { data: 'project.name' },
		    { data: 'notes' }
	    ],

	"paging": false,
	//	    "lengthChange": true,
	"searching": false,
	//	    "ordering": true,
		    "info": true,
		    "autoWidth": true
    });

	$('#client-id').change(function(){
		activitiesTable.ajax.reload();
	});


  });
</script>
<?php $this->end(); ?>
