<?php
$file = $theme['folder'] . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'aside' . DS . 'sidebar-menu.ctp';

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<ul class="sidebar-menu">
    <li class="header">TIMERS<i class="fa fa-plus-square add-timer" style="float:right;"></i></li>
    <?php
	$utc_now=gmdate("U",time());
	foreach($user_timers as $timer)
	{
		$playpause="fa-pause-circle";
		$status="running";
		$utc_start=gmdate("U",$timer->start->toUnixString());
		$counter=$utc_now-$utc_start+$timer->add;
		if($timer->paused==1)
		{
			$playpause="fa-play-circle";
			$status="paused";
			$counter=$timer->add;
		}

		$timer->start->setToStringFormat('yyyy-MM-dd HH:mm:ss');
		echo "<li class='treeview timerwrapper' id='twr-{$timer->id}' data-timer-id='{$timer->id}'>
			<div class='timercontrols'>
				<i class='timercontrol timer-play-pause fa $playpause'></i>
				<i class='timercontrol timer-stop fa fa-stop-circle'></i>
			</div>
			<div class='timerlabel timer-client' data-id='{$timer->client_id}'>{$timer->client->name}</div>
			<div class='timerlabel timer-project' data-id='{$timer->project_id}'>{$timer->project->name}</div>
			<div class='timerlabal timer-description' data-user-id='{$timer->user_id}'>{$timer->description}</div>
			<div class='timer' id='tmr-{$timer->id}' data-status='{$status}' data-timer='-{$counter}'></div>
		</li>";
	}


    ?>
    <script>
	$(".timer[data-status=running]").TimeCircles({animation: "ticks"});
	$(".timer[data-status=paused]").TimeCircles({animation: "ticks", start: false});
	$(".timer-play-pause").click(function(){
		var timer_id=$(this).parent().parent().attr('data-timer-id');
		var tmr_id='tmr-'+timer_id;
		var tmr_status=$('#'+tmr_id).attr('data-status');
		
		if(tmr_status=='running')
		{

			var timer_value = Math.abs($('#'+tmr_id).TimeCircles().getTime());
			var target_button=$(this);
			pauseTimer(timer_id,timer_value,function(data){
				target_button.removeClass('fa-pause-circle');
				target_button.addClass('fa-play-circle');
				$('#'+tmr_id).attr('data-status','paused');
				$('#'+tmr_id).attr('data-timer','-'+timer_value);
				$('#'+tmr_id).TimeCircles().stop();
			});


		}else{

			var target_button=$(this);
			startTimer(timer_id,function(data,timer_value){
				target_button.removeClass('fa-play-circle');
				target_button.addClass('fa-pause-circle');
				$('#'+tmr_id).attr('data-status','running');
				$('#'+tmr_id).attr('data-timer','-'+timer_value);
				$('#'+tmr_id).TimeCircles().start();
			});


		}



	});

	$(".timer-stop").click(function(){
		var timer_id=$(this).parent().parent().attr('data-timer-id');
		var tmr_id='tmr-'+timer_id;
		var tmr_status=$('#'+tmr_id).attr('data-status');
		var tmr_container=$('#'+tmr_id).parent();
		var tmr_client_id=tmr_container.children(".timer-client").first().attr('data-id');
		var tmr_project_id=tmr_container.children(".timer-project").first().attr('data-id');
		var tmr_description=tmr_container.children(".timer-description").first().html();
		var tmr_billable = Math.round(Math.abs($('#'+tmr_id).TimeCircles().getTime())/60,0);

		$("#ts_notes").val(tmr_description);
		$("#ts_billable_time").val(tmr_billable);
		$('#ts_client_id').html('<option>loading...</option>');
		$('#ts_project_id').html('<option>loading...</option>');
		$.ajax({
			type: "GET",
			url: "/api/clients/list.json",
			success: function(msg) {
				$('#ts_client_id').html('');
				$.each(msg.data, function(key,value) {
					$('#ts_client_id').append($('<option></option>').attr("value", key).text(value));
					});
				$('#ts_client_id').val(tmr_client_id);
				$.ajax({
					type: "GET",
					url: "/api/projects/list.json",
					data: { 'filter_field' : 'client_id', 'filter_value' : tmr_client_id },
					success: function(msg) {
						$('#ts_project_id').html('');
						$.each(msg.data, function(key,value) {
							$('#ts_project_id').append($('<option></option>').attr("value", key).text(value));
						});
						$('#ts_project_id').val(tmr_project_id);


					},
				error: function() {
				alert("Failed to load projects");
				}
				});


				$('#ts_client_id').change(function(){
						client_id = $(this).find(":selected").val();
						$('#ts_project_id').html('<option>loading...</option>');
						$.ajax({
							type: "GET",
							url: "/api/projects/list.json",
							data: { 'filter_field' : 'client_id', 'filter_value' : client_id },
							success: function(msg) {
								$('#ts_project_id').html('<option value=""></option>');
								$.each(msg.data, function(key,value) {
									$('#ts_project_id').append($('<option></option>').attr("value", key).text(value));
								});





							},
							error: function() {
							    alert("Failed to load projects");
							}
						    });
				});


			},
			error: function() {
			alert("Failed to load clients");
			}
		});

		$("#stop-timer").modal('toggle');
		$("#ts_save_btn").click(function(){

			addActivity(	$("#ts_user_id").val(),
					$("#ts_client_id").val(),
					$("#ts_project_id").val(),
					$("#ts_billable_time").val(),
					$("#ts_notes").val(),
					function(data){
						if(data.success)
						{
							deleteTimer(timer_id,function(data){
								$('#'+tmr_id).TimeCircles().stop();
								$('#twr-'+timer_id).remove();
								$("#stop-timer").modal('hide');
							});

						}


					});


		});

		$("#ts_cancel_btn").click(function(){
				deleteTimer(timer_id,function(data){
					$('#'+tmr_id).TimeCircles().stop();
					$('#twr-'+timer_id).remove();
					$("#stop-timer").modal('hide');
				});

		});




	});

	$(".add-timer").click(function(){
		$('#at_client_id').html('<option>loading...</option>');
		$('#at_project_id').html('<option value=""></option>');
		$.ajax({
			type: "GET",
			url: "/api/clients/list.json",
			success: function(msg) {
				$('#at_client_id').html('<option value=""></option>');
				$.each(msg.data, function(key,value) {
					$('#at_client_id').append($('<option></option>').attr("value", key).text(value));
					});

				$('#at_client_id').change(function(){
						client_id = $(this).find(":selected").val();
						$('#at_project_id').html('<option>loading...</option>');
						$.ajax({
							type: "GET",
							url: "/api/projects/list.json",
							data: { 'filter_field' : 'client_id', 'filter_value' : client_id },
							success: function(msg) {
								$('#at_project_id').html('<option value=""></option>');
								$.each(msg.data, function(key,value) {
									$('#at_project_id').append($('<option></option>').attr("value", key).text(value));
								});

							},
							error: function() {
							    alert("Failed to load projects");
							}
						    });
				});


			},
			error: function() {
			alert("Failed to load clients");
			}
		});

		$("#add-timer").modal('toggle');
		$("#at_save_btn").click(function(){

			addTimer(	$("#at_user_id").val(),
					$("#at_client_id").val(),
					$("#at_project_id").val(),
					$("#at_notes").val(),
					function(data){
						if(data.success)
						{
							$("#add-timer").modal('hide');
							 location.reload();

						}


					});


		});



	});



    </script>
</ul>
	<div id="stop-timer" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Stop Timer</h4>
              </div>
              <div class="modal-body">
		<form id="stop-timer-form">
		  <?php
		    echo $this->Form->hidden('user_id', ['id' => 'ts_user_id', 'value' => $_user['User']['id']]);
		    echo $this->Form->input('client_id', ['id'=>'ts_client_id', 'options' => [], 'empty' => true]);
		    echo $this->Form->input('project_id', ['id'=>'ts_project_id', 'options' => [], 'empty' => true]);
		    echo $this->Form->input('billable_time', ['id'=>'ts_billable_time', 'empty' => true]);
		    echo $this->Form->input('notes', ['id'=>'ts_notes', 'empty' => true]);
		  ?>
		</form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button type="button" id="ts_save_btn" class="btn btn-primary">Save Activity</button>
                <button type="button" id="ts_cancel_btn" class="btn btn-danger">Cancel Timer</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


	<div id="add-timer" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add Timer</h4>
              </div>
              <div class="modal-body">
		<form id="stop-timer-form">
		  <?php
		    echo $this->Form->hidden('user_id', ['id' => 'at_user_id', 'value' => $_user['User']['id']]);
		    echo $this->Form->input('client_id', ['id'=>'at_client_id', 'options' => [], 'empty' => true]);
		    echo $this->Form->input('project_id', ['id'=>'at_project_id', 'options' => [], 'empty' => true]);
		    echo $this->Form->input('notes', ['id'=>'at_notes', 'empty' => true]);
		  ?>
		</form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button type="button" id="at_save_btn" class="btn btn-primary">Add Timer</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


<?php } ?>
