<section class="content-header">
  <ol class="breadcrumb">
  </ol>
</section>

<!-- Main content -->
<section class="content" style="max-width:900px;">
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

		<dt><?= __('Billing Address') ?></dt>
		<dd>
		<?= $this->Text->autoParagraph(h($client->billing_address)); ?>
		</dd>
                </dl>
		<div>
                    <?= $this->Html->link("Logout" , ['controller' => 'clients', 'action' => 'logout'], ['class'=>'btn btn-info']) ?>
		</div>
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
                    <i class="fa fa-file-text-o"></i>
                    <h3 class="box-title"><?= __('{0}', ['Invoices']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($client->invoices)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Number
                                    </th>
                                        
                                                                    
                                    <th>
                                    Invoice Date
                                    </th>
                                        
                                                                    
                                    <th>
                                    Total
                                    </th>
                                        
                                                                    
                                    <th>
                                    Payment Due
                                    </th>
                                        
                                                                    
                                    <th>
                                    Status
                                    </th>
                                        
                                                                                                                                            
                                <th style="text-align:right;">
                                    <?php echo __('Pay Invoice'); ?>
                                </th>
                            </tr>

                            <?php foreach ($client->invoices as $invoices): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= $this->Html->link(h($invoices->label) , ['controller' => 'Invoices', 'action' => 'view', $invoices->id], ['class'=>'btn btn-info btn-xs']) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($invoices->invoice_date) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($invoices->total) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($invoices->payment_due) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($invoices->status) ?>
                                    </td>
                                                                                                            
                                    <td class="actions" style="text-align:right;">
                    <?php if($invoices->status!="PAID"):?>
                    <?= $this->Html->image("https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-rect-paypal-34px.png", ["alt"=>"PayPal","height"=>"31px", "url"=> ['controller' => 'Invoices', 'action' => 'paypalPay', $invoices->id]]) ?>
                        <form action="<?= $this->Url->build(["controller" => "Invoices","action" => "stripe-pay", $invoices->id])?>" method="POST" style="margin-top:5px;">
                          <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="<?=$this->request->session()->read("Auth.User.company.stripe_key")?>"
                            data-name="Invoice"
                            data-description="<?= h($invoices->label) ?>"
                            data-amount="<?= h($invoices->total)*100 ?>"
                            data-bitcoin="false"
                            data-label="Credit Card">
                          </script>
                        </form>

                    <?php endif;?>


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
                    <i class="fa fa-cloud"></i>
                    <h3 class="box-title"><?= __('{0}', ['Subscriptions']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($client->subscriptions)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                                                   
                                    <th>
                                    Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Amount
                                    </th>
                                        
                                                                    
                                    <th>
                                    Currency
                                    </th>
                                        
                                                                    
                                    <th>
                                    Interval
                                    </th>
                                        
                                                                   
                                    <th>
                                    Status
                                    </th>
                                        
                                                                    
                                    <th>
                                    Payment Type
                                    </th>
                                        
                                                                   
                                    <th>
                                    Created
                                    </th>
                                        
                                                                    
                                    <th>
                                    Modified
                                    </th>
                                        
                                                                                                                                            
                                <th style="text-align:right;">
                                    <?php echo __('Activate'); ?>
                                </th>
                            </tr>

                            <?php foreach ($client->subscriptions as $subscriptions): ?>
                                <tr>
                                                                       
                                    <td>
                                    <?= h($subscriptions->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($subscriptions->amount) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($subscriptions->currency) ?>
                                    </td>
                                                                        
                                    <td>
				   	<?= h($subscriptions->interval_count)." ".h($subscriptions->interval) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($subscriptions->status) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($subscriptions->payment_type) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($subscriptions->created) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($subscriptions->modified) ?>
                                    </td>


                <td class="actions" style="text-align:right;">
		<?php if($subscriptions->status!="ACTIVE"):?>
			    <?= $this->Html->image("https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-rect-paypal-34px.png", 
				["alt"=>"PayPal","height"=>"31px", "url"=> ['controller' => 'Subscriptions', 'action' => 'paypalActivate', $subscriptions->id]]) ?>
				<form action="<?= $this->Url->build(["controller" => "Subscriptions","action" => "stripe-activate", $subscriptions->id])?>" method="POST" style="margin-top:5px;">
					<script
					src="https://checkout.stripe.com/checkout.js" class="stripe-button"
					data-key="<?=$this->request->session()->read("Auth.User.company.stripe_key")?>"
					data-name="Subscription"
					data-description="<?= h($subscriptions->name) ?>"
					data-amount="<?= h($subscriptions->amount)*100 ?>"
					data-bitcoin="false"
					data-label="Credit Card">
					</script>
				</form>
		<?php endif;?>

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
                    <i class="fa fa-calendar-check-o"></i>
                    <h3 class="box-title"><?= __('Uninvoiced {0}', ['Activities']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($client->activities)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Date Time
                                    </th>
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
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($client->activities as $activities): ?>
                                <tr>
                                                                        
                                    <td nowrap>
                                    <?= h($activities->date_time->i18nFormat('yyyy-MM-dd')) ?>
                                    </td>
                                   <td>
                                    <?= h($activities->billable_time) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($activities->rate) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($activities->notes) ?>
                                    </td>
                                                                        
                                                                                                           
                                    <td class="actions">
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
               <!-- /.box-body -->
     <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-ticket"></i>
                    <h3 class="box-title"><?= __('Tickets') ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($client->tickets)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Ticket Number
                                    </th>
                                    <th>
                                    From
                                    </th>
                                    <th>
                                    Title
                                    </th>
                                    <th>
                                    Status
                                    </th>
                               <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($client->tickets as $tickets): ?>
                                <tr>
                                                                        
                                    <td nowrap>
                                    <?= $this->Html->link(h($tickets->ticket_number) , ['controller' => 'Tickets', 'action' => 'view', $tickets->id], ['class'=>'btn btn-info btn-xs']) ?>
                                    </td>
                                   <td>
                                    <?= h($tickets->from_email) ?>
                                    </td>
                                   <td>
                                    <?= h($tickets->ticket_title) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($tickets->status) ?>
                                    </td>
                                                                        
                                    <td class="actions">
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
