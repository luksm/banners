<div class="banners index">
	<h2><?php echo __('Banners'); ?></h2>
	<table cellpadding="0" cellspacing="0" id="banners">
		<thead>
			<tr>
				<th><?php echo __('Name'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>
		<tbody id="banners">
			<?php foreach ($banners as $banner): ?>
			<tr id="banner-<?php echo $banner['Banner']['id']; ?>">
				<td><?php echo h($banner['Banner']['name']); ?>&nbsp;</td>
				<td class="actions">
					<?php
					if ($banner['Banner']['published']) {
			            echo $this->Html->link(__('Published'), array('action' => 'select', $banner['Banner']['id']));
			        } else {
			            echo $this->Html->link(__('Unpublished'), array('action' => 'select', $banner['Banner']['id']));
			        }

		        	 ?>
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $banner['Banner']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $banner['Banner']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $banner['Banner']['id']), null, __('Are you sure you want to delete # %s?', $banner['Banner']['id'])); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Banner'), array('action' => 'add')); ?></li>
	</ul>
</div>
<?php
$js = <<<EOD
function sendOrderToServer() {
	var order = $("#banners").sortable("serialize");

	$.ajax({
		type: "POST", dataType: "json",
		url: "{$this->Html->url(array("controller" => "banners", "action" => "order"), array("full" => true))}",
		data: order,
		success: function(response) {
			console.log(response);
			if (response.status == "success") {
				window.location.href = window.location.href;
			} else {
				// alert('Some error occurred');
				console.log(response);
			}
		}
	});

}

$( document ).ready(function() {
	$("#banners").sortable({
		items: "tr",
		cursor: 'move',
		opacity: 0.6,
		update: function() {
			sendOrderToServer();
		}
	});
});
EOD;

/* Grab Google CDN's jQuery. fall back to local if necessary */
echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array('inline' => false));
echo $this->Html->scriptBlock("!window.jQuery && document.write(unescape('%3Cscript src=\"js/libs/jquery-1.11.0.min.js\"%3E%3C/script%3E'))", array('inline' => false));

/* Grab Google CDN's jQuery UI. fall back to local if necessary */
echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js', array('inline' => false));
echo $this->Html->scriptBlock("!window.jQuery && document.write(unescape('%3Cscript src=\"js/jquery-ui-1.10.4.min.js\"%3E%3C/script%3E'))", array('inline' => false));
echo $this->Html->scriptBlock($js, array('inline' => false, 'block' => "script"));
