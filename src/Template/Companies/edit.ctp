<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Company
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
        <?= $this->Form->create($company, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('name');
            echo $this->Form->input('billing_address');
            echo $this->Form->input('stripe_key');
            echo $this->Form->input('stripe_secret');
            echo $this->Form->input('stripe_mode');
            echo $this->Form->input('paypal_client_id',['type'=>'text']);
            echo $this->Form->input('paypal_secret');
            echo $this->Form->input('paypal_mode');
            echo $this->Form->input('invoice_number_format');
            echo $this->Form->input('next_invoice_number');
            echo $this->Form->input('next_ticket_number');
            echo $this->Form->input('imap_server');
            echo $this->Form->input('imap_port');
            echo $this->Form->input('imap_options');
            echo $this->Form->input('smtp_server');
            echo $this->Form->input('smtp_port');
            echo $this->Form->input('mail_username');
            echo $this->Form->input('mail_password',['type'=>'password']);
            echo $this->Form->input('base64logo');
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
