<?php
$nf = new \NumberFormatter( null, \NumberFormatter::CURRENCY);
?>
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?= $company['name']?>
            <small class="pull-right">Date: <?= $invoice['invoice_date']?></small>
          </h2>
            </div>
        <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              From
              <address>
                <strong><?= $company['name']?></strong><br>
		<?= str_replace("\n","<br>",$company['billing_address'])?>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              To
              <address>
                <strong><?= $invoice->client['name']?></strong><br>
		<?= str_replace("\n","<br>",$invoice->client['billing_address'])?>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <b>Invoice <?= $invoice['label']?></b><br>
              <br>
              <b>Order ID:</b> <?= $invoice['order_id']?><br>
              <b>Payment Due:</b>  <?= $invoice['payment_due']?><br>
              <b>Account:</b>  <?= $invoice['account_no']?>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                      <th>Date</th>
                      <th>Description</th>
                      <th>Qty</th>
                      <th>Rate</th>
                      <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
		    <?php $invoice_subtotal=0;?>
		    <?php foreach ($invoice->activities as $activities): ?>
			<tr>
								
			    <td>
			    <?= date("Y-m-d",strtotime($activities->date_time)) ?>
			    </td>
			    <td>
			    <?= h($activities->notes) ?>
			    </td>
			    <td>
			    <?= h($activities->billable_time) ?>
			    </td>
			    <td>
			    <?= h($activities->rate) ?>
			    </td>
			    <td>
			    <?php $subtotal=$activities->billable_time * $activities->rate;
				   echo $nf->formatCurrency( $subtotal, $invoice->client['currency']);
				   $invoice_subtotal+=$subtotal;
			    ?>
			    </td>
			</tr>
		    <?php endforeach; ?>		    
                 </tbody>
            </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            <p class="lead">Payment Methods:</p>
            <?php echo $this->Html->image('credit/visa.png', array('alt' => 'Visa')); ?>
            <?php echo $this->Html->image('credit/mastercard.png', array('alt' => 'Mastercard')); ?>
            <?php echo $this->Html->image('credit/american-express.png', array('alt' => 'American Express')); ?>
            <?php echo $this->Html->image('credit/paypal2.png', array('alt' => 'Paypal')); ?>

            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            <?= $invoice['comments']?>
            </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due <?= $invoice['payment_due']?></p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
		<td><?php  echo $nf->formatCurrency( $invoice_subtotal, $invoice->client['currency']); ?>
              </tr>
              <tr>
                <th>Tax (9.3%)</th>
                <td>$FIXME</td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td>$FIXME</td>
              </tr>
              <tr>
                <th>Total:</th>
		<td><?php  echo $nf->formatCurrency( $invoice_subtotal, $invoice->client['currency']); ?>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

