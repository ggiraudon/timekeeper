<section class="content-header">
  <h1>
    Client
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
        <?= $this->Form->create($client, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->hidden('company_id', ['value'=>$_user['User']['company_id']]);
            echo $this->Form->input('name');
            echo $this->Form->input('billing_address');
            echo $this->Form->input('phone');
            echo $this->Form->input('email');
            echo $this->Form->input('default_rate');
            echo $this->Form->input('tax_class_id', ['options' => $taxClasses, 'empty' => true]);
            echo $this->Form->input('currency');
            echo $this->Form->input('username');
            echo $this->Form->input('password');
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
