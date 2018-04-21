<?php $this->layout = 'AdminLTE.print'; ?>
<style>
@media print 
{
  @page { margin: 0; }
  body  { margin: 0; transform: scale(.8); }
}
</style>
<?php echo $this->element('invoice-content'); ?>

