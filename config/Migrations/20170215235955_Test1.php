<?php
use Migrations\AbstractMigration;

class Test1 extends AbstractMigration
{

    public function up()
    {

        $this->table('invoices')
            ->removeColumn('date_time')
            ->changeColumn('discount', 'decimal', [
                'default' => null,
                'limit' => 8,
                'null' => true,
            ])
            ->update();

        $this->table('user_timers', ['id' => false, 'primary_key' => ['']])
            ->addColumn('id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('user_id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('client_id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('project_id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('description', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('start', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('activities')
            ->addColumn('rate', 'decimal', [
                'after' => 'billable_time',
                'default' => null,
                'null' => true,
                'precision' => 8,
                'scale' => 2,
            ])
            ->update();

        $this->table('invoices')
            ->addColumn('invoice_date', 'date', [
                'after' => 'client_id',
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->addColumn('account_balance', 'decimal', [
                'after' => 'discount',
                'default' => null,
                'null' => true,
                'precision' => 8,
                'scale' => 2,
            ])
            ->addColumn('due_override', 'decimal', [
                'after' => 'account_balance',
                'default' => null,
                'null' => true,
                'precision' => 8,
                'scale' => 2,
            ])
            ->addColumn('comments', 'text', [
                'after' => 'due_override',
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->addColumn('status', 'string', [
                'after' => 'comments',
                'default' => null,
                'length' => 10,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('activities')
            ->removeColumn('rate')
            ->update();

        $this->table('invoices')
            ->addColumn('date_time', 'datetime', [
                'after' => 'client_id',
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->changeColumn('discount', 'decimal', [
                'default' => null,
                'null' => false,
                'precision' => 4,
                'scale' => 2,
            ])
            ->removeColumn('invoice_date')
            ->removeColumn('account_balance')
            ->removeColumn('due_override')
            ->removeColumn('comments')
            ->removeColumn('status')
            ->update();

        $this->dropTable('user_timers');
    }
}

