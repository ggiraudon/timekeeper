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
                <dl class="dl-horizontal">
                                                                                                                <dt><?= __('Id') ?></dt>
                                        <dd>
                                            <?= h($ticket->id) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Company') ?></dt>
                                <dd>
                                    <?= $ticket->has('company') ? $ticket->company->name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('From Email') ?></dt>
                                        <dd>
                                            <?= h($ticket->from_email) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Ticket Title') ?></dt>
                                        <dd>
                                            <?= h($ticket->ticket_title) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Status') ?></dt>
                                        <dd>
                                            <?= h($ticket->status) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('User') ?></dt>
                                <dd>
                                    <?= $ticket->has('user') ? $ticket->user->id : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                        <dt><?= __('Ticket Number') ?></dt>
                                <dd>
                                    <?= $this->Number->format($ticket->ticket_number) ?>
                                </dd>
                                                                                                
                                                                                                        <dt><?= __('Ticket Date') ?></dt>
                                <dd>
                                    <?= h($ticket->ticket_date) ?>
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
					<pre>
					<?=$ticketNotes->content_plain?>
					</pre>
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

        </div>
    </div>
</section>
