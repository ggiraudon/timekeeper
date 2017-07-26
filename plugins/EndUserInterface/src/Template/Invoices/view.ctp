 <section class="content-header">
  <ol class="breadcrumb">
  </ol>
</section>

<!-- Main content -->
<section class="content" style="max-width:900px;">
     <h1>
        Invoice
        <small><?= $invoice['label']?></small>
      </h1>
      <ol class="breadcrumb">
    	<?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['controller'=>'clients','action' => 'index'], ['escape' => false])?>
      </ol>



<!-- Content Header (Page header) -->
    <?php echo $this->element('invoice-content'); ?>

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?php echo $this->Url->build(array('controller' => 'invoices', 'action' => 'printview', $invoice['id'])); ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
<?php /*
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
*/ ?>
        </div>
      </div>
    <!-- /.content -->
</section>

