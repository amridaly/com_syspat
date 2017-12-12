<?php
defined('_JEXEC') or die;
?>
<?php
  if(empty($this->evaluations)) { ?>
    <p><?php echo JText::_('COM_SYSPAT_NO_EVALUATIONS_FOUND'); ?></p>  
  <?php  
  }
  else {?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Date evaluation</th>
      <th scope="col">Actions à réaliser</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($this->evaluations as $i=>$evaluation):?>
    <tr>

	  <td><?php echo $evaluation->EVAL_ACT_DATE;?></td>
      <td><?php echo $evaluation->DESCRIPTION; ?></td>
    </tr>
	<?php endforeach; ?>
	  </tbody>
</table>

    <?php  
    
  }
?>
