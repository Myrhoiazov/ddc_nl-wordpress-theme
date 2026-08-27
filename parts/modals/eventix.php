<?php 

?>
<div class="modal fade" id="eventixModal" tabindex="-1" aria-labelledby="eventixModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="eventixModalLabel"><?php echo __('Buy tickets', 'wp_denysmyr') ?></h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<iframe width="100%" height="700" src="" frameborder="0"></iframe>
			</div>
		</div>
	</div>
</div>
<script>
	const myModalEl = document.getElementById('eventixModal')
	myModalEl.addEventListener('show.bs.modal', event => {
		const eventixFrame = myModalEl.getElementsByTagName('iframe')[0];
		if (eventixFrame.src === location.href) { // empty
			eventixFrame.src = 'https://shop.eventix.io/a6bb8f0d-8fa3-11ee-bdc3-6a57c78572ab/tickets';
		}
	})
</script>