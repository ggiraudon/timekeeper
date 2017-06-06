<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="clients view large-9 medium-8 columns content">
    <h3><?= h($client->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($client->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($client->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($client->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($client->currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($client->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($client->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($client->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Billing Address') ?></h4>
        <?= $this->Text->autoParagraph(h($client->billing_address)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Projects') ?></h4>
        <?php if (!empty($client->projects)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($client->projects as $projects): ?>
            <tr>
                <td><?= h($projects->name) ?></td>
                <td><?= h($projects->created) ?></td>
                <td><?= h($projects->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Projects', 'action' => 'view', $projects->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>

    <div class="related">
        <h4><?= __('Related Activities') ?></h4>
        <?php if (!empty($client->activities)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Date Time') ?></th>
                <th scope="col"><?= __('Billable Time') ?></th>
                <th scope="col"><?= __('Rate') ?></th>
                <th scope="col"><?= __('Notes') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($client->activities as $activities): ?>
            <tr>
                <td><?= h($activities->date_time) ?></td>
                <td><?= h($activities->billable_time) ?></td>
                <td><?= h($activities->rate) ?></td>
                <td style="width:1200px;"><?= h($activities->notes) ?></td>
                <td><?= h($activities->created) ?></td>
                <td><?= h($activities->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Activities', 'action' => 'view', $activities->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Invoices') ?></h4>
        <?php if (!empty($client->invoices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Invoice Date') ?></th>
                <th scope="col"><?= __('Label') ?></th>
                <th scope="col"><?= __('Discount') ?></th>
                <th scope="col"><?= __('Account Balance') ?></th>
                <th scope="col"><?= __('Due Override') ?></th>
                <th scope="col"><?= __('Order Id') ?></th>
                <th scope="col"><?= __('Payment Due') ?></th>
                <th scope="col"><?= __('Account No') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($client->invoices as $invoices): ?>
            <tr>
                <td><?= h($invoices->invoice_date) ?></td>
                <td><?= h($invoices->label) ?></td>
                <td><?= h($invoices->discount) ?></td>
                <td><?= h($invoices->account_balance) ?></td>
                <td><?= h($invoices->due_override) ?></td>
                <td><?= h($invoices->order_id) ?></td>
                <td><?= h($invoices->payment_due) ?></td>
                <td><?= h($invoices->account_no) ?></td>
                <td><?= h($invoices->status) ?></td>
                <td><?= h($invoices->created) ?></td>
                <td><?= h($invoices->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Invoices', 'action' => 'edit', $invoices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete', $invoices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Subscriptions') ?></h4>
        <?php if (!empty($client->subscriptions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Currency') ?></th>
                <th scope="col"><?= __('Interval') ?></th>
                <th scope="col"><?= __('Interval Count') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Payment Type') ?></th>
                <th scope="col"><?= __('Stripe Plan Id') ?></th>
                <th scope="col"><?= __('Stripe Subscription Id') ?></th>
                <th scope="col"><?= __('Paypal Subscription Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($client->subscriptions as $subscriptions): ?>
            <tr>
                <td><?= h($subscriptions->name) ?></td>
                <td><?= h($subscriptions->amount) ?></td>
                <td><?= h($subscriptions->currency) ?></td>
                <td><?= h($subscriptions->interval) ?></td>
                <td><?= h($subscriptions->interval_count) ?></td>
                <td><?= h($subscriptions->status) ?></td>
                <td><?= h($subscriptions->payment_type) ?></td>
                <td><?= h($subscriptions->stripe_plan_id) ?></td>
                <td><?= h($subscriptions->stripe_subscription_id) ?></td>
                <td><?= h($subscriptions->paypal_subscription_id) ?></td>
                <td><?= h($subscriptions->created) ?></td>
                <td><?= h($subscriptions->modified) ?></td>
                <td class="actions" style="text-align:center;">
		    <?php if($subscriptions->status!="ACTIVE"):?>
                    <?= $this->Html->image("https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-pill-paypal-26px.png", ["alt"=>"PayPal", "url"=> ['controller' => 'Subscriptions', 'action' => 'paypalActivate', $subscriptions->id]]) ?>
			<br/><center>OR</center>
			<form action="<?= $this->Url->build(["controller" => "Subscriptions","action" => "stripe-activate", $subscriptions->id])?>" method="POST">
			  <script
			    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			    data-key="pk_XgbbAaibNCcXqGzB0dKkzmgMR3ue2"
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
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Timers') ?></h4>
        <?php if (!empty($client->user_timers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Client Id') ?></th>
                <th scope="col"><?= __('Project Id') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Start') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($client->user_timers as $userTimers): ?>
            <tr>
                <td><?= h($userTimers->id) ?></td>
                <td><?= h($userTimers->user_id) ?></td>
                <td><?= h($userTimers->client_id) ?></td>
                <td><?= h($userTimers->project_id) ?></td>
                <td><?= h($userTimers->description) ?></td>
                <td><?= h($userTimers->start) ?></td>
                <td><?= h($userTimers->created) ?></td>
                <td><?= h($userTimers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserTimers', 'action' => 'view', $userTimers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserTimers', 'action' => 'edit', $userTimers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserTimers', 'action' => 'delete', $userTimers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userTimers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
