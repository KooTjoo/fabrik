<tr class="fabrik___heading">
<?php foreach ($this->headings as $key=>$heading) {?>
	<th class="<?php echo $this->headingClass[$key]['class']?>" style="<?php echo $this->headingClass[$key]['style']?>">
		<span class="heading"><?php echo  $heading; ?></span>
		<?php if (array_key_exists($key, $this->filters)) {
			$filter = $this->filters[$key];
			$required = $filter->required == 1 ? ' notempty' : '';
			echo '<div class="filter '.$required.'">
			<span>'.$filter->element.'</span></div>';
		}?>
	</th>
	<?php }?>
</tr>

<script type="text/javascript">
head.ready(function(){
	var list = document.id('list_<?php echo $this->list->renderid?>');
	var form = document.id('listform_<?php echo $this->list->renderid?>');
	 Fabrik.addEvent('fabrik.list.update', function(l){
			if(l.id == <?php echo (int)$this->list->renderid?>){
				list.getElements('.fabrik___heading span.filter').hide();
			}
			return true;
	 });


	list.getElements('span.heading').each(function(h){
		var f = h.getNext();
		if (f) {
			h.addClass('filtertitle');
			h.setStyle('cursor', 'pointer');
			if(i = f.getElement('input')) {
				i.set('placeholder', h.get('text'));
			}
			f.hide();
		}
	});
	list.addEvent('click:relay(span.heading)', function(e){
		var f = e.target.getNext();
		if (f) {
			f.toggle();
			var i = form.getElement('.fabrikFilterContainer');
			var offsetP = list.getOffsetParent() ? list.getOffsetParent() : document.body;
			var p = f.getPosition(offsetP);
			i.setPosition({'x': p.x - 5, 'y': p.y + f.getSize().y});
			i.toggle();
		}
	});

	form.getElement('.clearFilters').addEvent('click', function () {
		form.getElement('.fabrikFilterContainer').hide();
		form.getElements('.fabrik___heading .filter').hide();
	});

	form.getElement('.fabrik_filter_submit').addEvent('click', function () {
		form.getElement('.fabrikFilterContainer').hide();
		form.getElements('.fabrik___heading .filter').hide();
	});
});

</script>