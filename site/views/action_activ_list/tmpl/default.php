<?php
defined('_JEXEC') or die;
?>
<?php
  if(empty($this->data)) { ?>
    <p><?php echo JText::_('COM_SYSPAT_NO_ACTIONS_FOUND'); ?></p>  
  <?php  
  }
  else {?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Réf Act</th>
      <th scope="col">Code domaine</th>
	  <th scope="col">Code sous domaine</th>
      <th scope="col">Actions à réaliser</th>
      <th scope="col">Pertinence</th>
	  <th scope="col">Indic PEFA</th>
      <th scope="col">Date début</th>
      <th scope="col">Date echéance</th>
      <th scope="col">Reconduction</th>
	  <th scope="col">Périodicité</th>
	  <th scope="col">Statut</th>
	  <th scope="col">Avancement</th>
    </tr>
  </thead>
  	<tfoot>
		<tr>
			<td colspan="0">
				<div class="jcb_pagination"><?php echo $this->pagination->getPagesLinks(); ?> - <?php echo $this->pagination->getPagesCounter(); ?></div>
			</td>
		</tr>
	</tfoot>
  <tbody>
  <?php foreach($this->data as $i=>$dataItem):?>
    <tr>
      <th scope="row"><?php echo $dataItem->ACTION_ACTIV_REF;?></th>
      <td><?php echo $dataItem->DOMAIN_CODE;?></td>
	  <td><?php echo $dataItem->DIMENSION_CODE;?></td>
      <td><?php echo $dataItem->DESCRIPTION; ?></td>
      <td><?php echo $dataItem->PERTINENCE; ?></td>
	  <td><?php echo $dataItem->INDICATOR_PEFA_CODE;?></td>
      <td><?php echo $dataItem->START_DATE; ?></td>
      <td><?php echo $dataItem->DUE_DATE; ?></td>
	  <td><?php echo $dataItem->IS_RENEWAL;?></td>
      <td><?php echo $dataItem->FREQUENCY; ?></td>
      <td><?php echo $dataItem->STATUS_CODE; ?></td>
	  <td><?php echo $dataItem->PROGRESS; ?></td>
    </tr>
	<?php endforeach; ?>
	  </tbody>
</table>

    <?php  
    
  }
?>
