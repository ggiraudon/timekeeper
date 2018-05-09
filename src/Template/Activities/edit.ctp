<section class="content-header">
  <h1>
    Activity
    <small><?= __('Edit') ?></small>
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
          <?php
            echo $this->Form->hidden('user_id', ['value' => $activity->user_id]);
            echo $this->Form->input('client_id', ['options' => $clients]);
            echo $this->Form->input('project_id', ['options' => $projects, 'empty' => true]);
            echo $this->Form->input('billable_time');
            echo $this->Form->input('notes');
            echo $this->Form->input('date_time');
          ?>
          </div>
          <!-- /.box-body -->
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
	$('#client-id').change(function(){
	    client_id = $(this).find(":selected").val();
	    $.ajax({
		type: "GET",
		url: "/api/projects/list.json",
		data: { 'filter_field' : 'client_id', 'filter_value' : client_id },
		success: function(msg) {
			$('#project-id').html('<option value=""></option>');
			$.each(msg.data, function(key,value) {
				$('#project-id').append($('<option></option>').attr("value", key).text(value));
		});
		},
		error: function() {
		    alert("Failed to load projects");
		}
	    });
	});
});   
</script>
