<table cellpadding="0" cellspacing="0" width="100%" class="table table-striped">
    <thead>
            <tr>
                <th scope="col">Réf Act</th>
                <th scope="col">Code domaine</th>
                <th scope="col">Code sous domaine</th>
                <th scope="col">Actions à réaliser</th>
                <th scope="col">Date début</th>
                <th scope="col">Date echéance</th>
                <th scope="col">Structure</th>
                <th scope="col">Responsable</th>
            </tr>
    </thead>
    <tbody id="action-list">
	<?php for($i=0, $n = count($this->actions);$i<$n;$i++) { 
            $this->_actionEntryView->action = $this->actions[$i];
            echo $this->_actionEntryView->render();
	} ?>
	</tbody>
</table>
<?php echo $this->_pagination ?>