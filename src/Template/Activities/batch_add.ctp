<section class="content-header">
  <h1>
    Activity
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
        <?= $this->Form->create($activity, array('role' => 'form')) ?>
          <div class="box-body">
		<table id="form-entries">
		<tr>
			<th>Date</th>
			<th>Client</th>
			<th>Project</th>
			<th>Time</th>
			<th>Rate</th>
			<th>Notes</th>
		</tr>
		</table>
		<span class='fa fa-plus' id="btn_add_row"></span>
         </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Save')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    <table style="display:none;" id="row_template">
	<tr>
          <?=$this->Form->hidden('user_id[*num*]', ['id'=>'user_id_*num*','value' => $user_id,'label' => false]);?>
          <td><?=$this->Form->input('date_time[*num*]',['id'=>'date_time_*num*','type'=>'date','label' => false]);?></td>
          <td><?=$this->Form->input('client_id[*num*]',['id'=>'client_id_*num*','data_row_index'=>'*num*','options'=>$clients,'empty'=>true,'label' => false]);?></td>
          <td><?=$this->Form->input('project_id[*num*]',['id'=>'project_id_*num*','type'=>'select','empty'=>true,'data-target'=>'project-id','label' => false]);?></td>
          <td><?=$this->Form->input('billable_time[*num*]',['id'=>'billable_time_*num*','label' => false]);?></td>
          <td><?=$this->Form->input('rate[*num*]',['id'=>'rate_*num*','label' => false]);?></td>
          <td><?=$this->Form->input('notes[*num*]',['id'=>'notes_*num*','label' => false]);?></td>
	</tr>
    </table>
    </div>
  </div>
</section>
<script>

$(document).ready(function() {
    var row_num=0;
    function add_row()
    {
	    $('#form-entries').append($('#row_template').html().replace(/\*num\*/gi,row_num));
	    $("#client_id_"+row_num).combobox();
	    $("#client_id_"+row_num).change(function(){
		    client_id = $(this).find(":selected").val();
		    row_index = $(this).attr('data_row_index');
		    if($("#project_id_"+row_index).next().hasClass('ui-combobox')){
				$("#project_id_"+row_index).next().children("input").val('');
				$("#project_id_"+row_index).val('');
		    }
		    $.ajax({
			type: "GET",
			url: "/api/projects/list.json",
			data: { 'filter_field' : 'client_id', 'filter_value' : client_id },
			success: function(msg) {
				$("#project_id_"+row_index).html('<option value=""></option>');
				$.each(msg.data, function(key,value) {
					$("#project_id_"+row_index).append($('<option></option>').attr("value", key).text(value));
				});
				$("#project_id_"+row_index).combobox();
			},
			error: function() {
				alert("Failed to load projects");
			}
		    });
	     });
	     row_num++;

    }
    $('#btn_add_row').click(add_row);
    add_row();
    add_row();
    add_row();
    add_row();

});   
</script>
