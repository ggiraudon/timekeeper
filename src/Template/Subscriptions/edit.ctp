<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Subscription
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
        <?= $this->Form->create($subscription, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('company_id', ['options' => $companies]);
            echo $this->Form->input('client_id', ['options' => $clients]);
            echo $this->Form->input('name');
            echo $this->Form->input('amount');
            echo $this->Form->input('currency');
            echo $this->Form->input('interval');
            echo $this->Form->input('interval_count');
            echo $this->Form->input('status');
            echo $this->Form->input('payment_type');
            echo $this->Form->input('stripe_plan_id');
            echo $this->Form->input('stripe_subscription_id');
            echo $this->Form->input('paypal_subscription_id');
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
