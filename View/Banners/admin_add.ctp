<div class="banners form">
	<h2><?php echo __('Add Banner'); ?></h2>
<?php echo $this->Form->create('Banner', array("type" => "file")); ?>
	<fieldset>
	<?php

        echo '<div><img alt="" id="image" src="http://placehold.it/700x182"></div>';
		echo $this->Form->input('image', array("type" => "file"));
		echo $this->Form->input('name');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('link');
		echo $this->Form->input('target', array("value" => "_blank", "type" => "checkbox", "label" => __("Open in a new window")));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Banners'), array('action' => 'index')); ?></li>
	</ul>
</div>
<?php
$js = <<<EOD
function readURL(input, id) {
    if (input.files && input.files[0]) {

        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$( document ).ready(function() {
    $("#BannerImage").change(function() { readURL(this, "image"); });
});
EOD;

/* Grab Google CDN's jQuery. fall back to local if necessary */
echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array('inline' => false));
echo $this->Html->scriptBlock("!window.jQuery && document.write(unescape('%3Cscript src=\"js/libs/jquery-1.11.0.min.js\"%3E%3C/script%3E'))", array('inline' => false));
echo $this->Html->scriptBlock($js, array('inline' => false, 'block' => "script"));
