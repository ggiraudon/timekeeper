<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Subscription'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subscriptions index large-9 medium-8 columns content">
    <h3><?= __('Subscriptions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('client_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('interval') ?></th>
                <th scope="col"><?= $this->Paginator->sort('interval_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stripe_plan_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stripe_subscription_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paypal_subscription_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subscriptions as $subscription): ?>
            <tr>
                <td><?= h($subscription->id) ?></td>
                <td><?= $subscription->has('company') ? $this->Html->link($subscription->company->name, ['controller' => 'Companies', 'action' => 'view', $subscription->company->id]) : '' ?></td>
                <td><?= $subscription->has('client') ? $this->Html->link($subscription->client->name, ['controller' => 'Clients', 'action' => 'view', $subscription->client->id]) : '' ?></td>
                <td><?= h($subscription->name) ?></td>
                <td><?= $this->Number->format($subscription->amount) ?></td>
                <td><?= h($subscription->currency) ?></td>
                <td><?= h($subscription->interval) ?></td>
                <td><?= $this->Number->format($subscription->interval_count) ?></td>
                <td><?= h($subscription->status) ?></td>
                <td><?= h($subscription->payment_type) ?></td>
                <td><?= h($subscription->stripe_plan_id) ?></td>
                <td><?= h($subscription->stripe_subscription_id) ?></td>
                <td><?= h($subscription->paypal_subscription_id) ?></td>
                <td><?= h($subscription->created) ?></td>
                <td><?= h($subscription->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $subscription->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subscription->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $subscription->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscription->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
