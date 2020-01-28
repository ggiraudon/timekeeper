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

			<option value="<?= $client->id?>" data-rate="<?=$client->default_rate?>" data-taxclass="<?=$client->tax_class_id?>"><?=$client->name?></option>
		<?php
			endforeach;

		?>
	    </select></div>
          <?php	
	    echo $this->Form->label('invoice_date', 'Invoice Date');
            echo $this->Form->date('invoice_date',['empty'=>false,'default'=>time(),'label'=>'Invoice Date']);
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
	  <div class="input"><label for="pretotal">Total (w/o tax)</label><input name="pretotal" id="pretotal" readonly></input></div>
          <?php  echo $this->Form->input('discount',['value'=>'0.00']); ?>
	  <div id="taxes">

	  </div>

	  <div class="input"><label for="total">Total</label><input name="total" id="total" readonly></input></div>
          <?php  echo $this->Form->input('comments'); ?>

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

  function update_totals(){
		pre_tax=0;
		post_discount=0;
		post_tax=0;
		$(".activity:checkbox:checked").each(function(index,item){
			pre_tax+=Number($(this).attr("data-cost"));

		});
		discount=Number($("#discount").val());	
		if(isNaN(discount)) { discount=0; }
		post_discount=Math.max(0,pre_tax-discount);

		$(".tax").each(function(){
			taxval=Math.round(Number($(this).attr("data-rate"))*post_discount)/100;
			$(this).val(taxval);
			post_tax+=taxval;
		});	
		post_tax+=post_discount;
		$("#pretotal").val(pre_tax);
		$("#total").val(post_tax);


  }


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
				qty=Number(JsonResultRow.billable_time);
				if(JsonResultRow.rate)
				{
						rate=Number(JsonResultRow.rate);

				}else{
					if(JsonResultRow.project.rate)
					{
						rate=Number(JsonResultRow.project.rate);
					
					}else{

						rate=Number($('#client-id').find(":selected").attr("data-rate"));
					}

				}
				cost=qty*rate;
			    	return '<input type="checkbox" class="activity" name="activities['+JsonResultRow.id+']" value="'+JsonResultRow.id+'" data-rate="'+rate+'" data-cost="'+cost+'">';
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
		activitiesTable.ajax.reload(function(){
			$(".activity").change(function(){
					 update_totals(); 
			});


		});
		tax_class=$('#client-id').find(":selected").attr("data-taxclass");
		$(taxClasses).each(function(index,item){
			if(item.id==tax_class){
				buffer="";
				$(item.tax_class_rates).each(function(idx,rate){
	    				buffer+='<div class="input"><label for="tax'+idx+'">'+rate.name+' ('+rate.rate+'%)</label><input class="tax" data-rate="'+rate.rate+'" name="tax['+rate.name+']" id="tax'+idx+'" readonly></input></div>';
					$("#taxes").html(buffer);

				});
			}
		});
		
	});
	$("#discount").keyup(function(){
			 update_totals(); 
	});
	$("#discount").change(function(){
			 update_totals(); 
	});





  });



</script>
<?php $this->end(); ?>
