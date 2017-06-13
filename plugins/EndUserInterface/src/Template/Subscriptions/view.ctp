<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subscription'), ['action' => 'edit', $subscription->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subscription'), ['action' => 'delete', $subscription->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscription->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Subscriptions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subscription'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subscriptions view large-9 medium-8 columns content">
    <h3><?= h($subscription->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($subscription->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $subscription->has('company') ? $this->Html->link($subscription->company->name, ['controller' => 'Companies', 'action' => 'view', $subscription->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Client') ?></th>
            <td><?= $subscription->has('client') ? $this->Html->link($subscription->client->name, ['controller' => 'Clients', 'action' => 'view', $subscription->client->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subscription->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($subscription->currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Interval') ?></th>
            <td><?= h($subscription->interval) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($subscription->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Type') ?></th>
            <td><?= h($subscription->payment_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stripe Plan Id') ?></th>
            <td><?= h($subscription->stripe_plan_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stripe Subscription Id') ?></th>
            <td><?= h($subscription->stripe_subscription_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Paypal Subscription Id') ?></th>
            <td><?= h($subscription->paypal_subscription_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($subscription->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Interval Count') ?></th>
            <td><?= $this->Number->format($subscription->interval_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($subscription->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($subscription->modified) ?></td>
        </tr>
    </table>
</div>
