<?php $this->layout = 'AdminLTE.print'; ?>
<style>
@media print 
{
  @page { margin: 0; }
  body  { margin: 1.6cm; }
}
</style>
<?php echo $this->element('invoice-content'); ?>

