<section class="content-header">
  <h1>
    <?php echo __('Subscription'); ?>
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
                                            <?= h($subscription->id) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Company') ?></dt>
                                <dd>
                                    <?= $subscription->has('company') ? $subscription->company->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Client') ?></dt>
                                <dd>
                                    <?= $subscription->has('client') ? $subscription->client->name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Name') ?></dt>
                                        <dd>
                                            <?= h($subscription->name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Currency') ?></dt>
                                        <dd>
                                            <?= h($subscription->currency) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Stripe Plan Id') ?></dt>
                                        <dd>
                                            <?= h($subscription->stripe_plan_id) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Stripe Subscription Id') ?></dt>
                                        <dd>
                                            <?= h($subscription->stripe_subscription_id) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Paypal Subscription Id') ?></dt>
                                        <dd>
                                            <?= h($subscription->paypal_subscription_id) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                        <dt><?= __('Amount') ?></dt>
                                <dd>
                                    <?= $this->Number->format($subscription->amount) ?>
                                </dd>
                                                                                                                <dt><?= __('Interval Count') ?></dt>
                                <dd>
                                    <?= $this->Number->format($subscription->interval_count) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                            
                                                                        <dt><?= __('Interval') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($subscription->interval)); ?>
                            </dd>
                                                    <dt><?= __('Status') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($subscription->status)); ?>
                            </dd>
                                                    <dt><?= __('Payment Type') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($subscription->payment_type)); ?>
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

</section>
