<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create() ?>
          <div class="box-body">
		<?= $this->Form->input('username') ?>
		<?= $this->Form->input('password') ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer" style="text-align:center;">
            <?= $this->Form->button(__('Login')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
