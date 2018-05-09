<section class="content-header">
  <h1>
    <?php echo __('Ticket'); ?>
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
		<?= $this->Form->create($ticket, array('role' => 'form','url'=>'tickets/edit/'.$ticket->id)) ?>
		  <div class="box-body">
		  <?php 
                    echo "<div>"; 
			echo $this->Form->label('ticket_number'); echo h($ticket->ticket_number); 
		    echo "</div>";
		    echo "<div>"; 
			echo $this->Form->label('ticket_date'); echo h($ticket->ticket_date); 
		    echo "</div>";
		    echo "<div>"; 
			    echo $this->Form->input('client_id', ['options' => $clients, 'empty' => true]);
			    echo $this->Form->input('project_id', ['options' => $projects, 'empty' => true]);
		    echo "</div>";

		    echo $this->Form->input('from_email',['readonly'=>true,'style'=>'width:300px;border:none;']);
		    echo $this->Form->input('ticket_title',['style'=>'width:300px;']);
		    echo $this->Form->input('status',['options'=>['NEW'=>'NEW','OPEN'=>'OPEN','WAITING'=>'WAITING','STALLED'=>'STALLED','CLOSED'=>'CLOSED']]);
		  ?>
		  </div>
		  <!-- /.box-body -->
		  <div class="box-footer">
		    <?= $this->Form->button(__('Save')) ?>
		  </div>
		<?= $this->Form->end() ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->
<div class="row">
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-envelope"></i>
                <h3 class="box-title"><?php echo __('Add notes'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
		<?= $this->Form->create($ticket->ticket_notes, array('role' => 'form','url'=>'ticketNotes/add')) ?>
		  <div class="box-body">
		  <?php
		    echo $this->Form->hidden('ticket_id',['value'=>$ticket->id]);
		    echo $this->Form->input('content_plain',['style'=>'width:300px;']);
		    echo $this->Form->input('notify_client',['type'=>'checkbox']);
		  ?>
		  </div>
		  <!-- /.box-body -->
		  <div class="box-footer">
		    <?= $this->Form->button(__('Add')) ?>
		  </div>
		<?= $this->Form->end() ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
    <?php if(!empty($ticket->project_id)):?>
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-clock-o"></i>
                <h3 class="box-title"><?php echo __('Add Time'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
	        <?= $this->Form->create($ticket, array('role' => 'form','url'=>'tickets/addTime')) ?>
		  <div class="box-body">
                  <?php
                    echo $this->Form->hidden('user_id', ['value' => $_user['User']['id']]);
                    echo $this->Form->hidden('client_id', ['value' => $ticket->client_id]);
                    echo $this->Form->hidden('project_id', ['value' => $ticket->project_id]);
                    echo $this->Form->hidden('ticket_id', ['value' => $ticket->id]);
                    echo $this->Form->input('billable_time', ['required'=>true]);
                    echo $this->Form->input('rate', ['label'=>'rate (optional','empty' => true]);
                    echo $this->Form->input('notes', ['required'=>true]);
                  ?>
		  </div>
		  <!-- /.box-body -->
		  <div class="box-footer">
		    <?= $this->Form->button(__('Add')) ?>
		  </div>
		<?= $this->Form->end() ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
    <?php endif;?>
</div>
<!-- div -->


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Ticket Notes']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($ticket->ticket_notes)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                   <th>
                                    Content
                                    </th>
                            </tr>

                            <?php foreach ($ticket->ticket_notes as $ticketNotes): ?>
				 <tr>                                       
                                    <td>
                                    	<?= h($ticketNotes->created) ?>
					<pre><?=$ticketNotes->content_plain?></pre>
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Ticket Attachments']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($ticket->ticket_attachments)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                   <th>
                                    File Name
                                    </th>
                                                                                                                                           
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($ticket->ticket_attachments as $ticketAttachments): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($ticketAttachments->file_name) ?>
                                    </td>
                                                                        
                                    <td class="actions">
                                    <?= $this->Html->link(__('Download'), ['controller' => 'TicketAttachments', 'action' => 'download', $ticketAttachments->id], ['class'=>'btn btn-info btn-xs']) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TicketAttachments', 'action' => 'delete', $ticketAttachments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ticketAttachments->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
                    <h3 class="box-title"><?= __('Related {0}', ['Activities']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($ticket->activities)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>

                                    <th>
                                    Billable Time
                                    </th>


                                    <th>
                                    Rate
                                    </th>


                                    <th>
                                    Notes
                                    </th>


                                    <th>
                                    Date Time
                                    </th>



                           </tr>

                            <?php foreach ($ticket->activities as $activities): ?>
                                <tr>

                                    <td>
                                    <?= h($activities->billable_time) ?>
                                    </td>

                                    <td>
                                    <?= h($activities->rate) ?>
                                    </td>

                                    <td>
                                    <?= h($activities->notes) ?>
                                    </td>

                                    <td>
                                    <?= h($activities->date_time) ?>
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





        </div>
    </div>
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

</section>
