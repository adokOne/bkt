<div id="content">
	<form id="form1" action="index.php" method="post" enctype="multipart/form-data">
			<div>
				<span id="spanButtonPlaceHolder"></span>
			</div>

			<div class="fieldset flash" id="fsUploadProgress" style="display: none;"></div>
	</form>
</div>


<script>
$(document).ready(function(){

	var	swfu = new SWFUpload({
			flash_url : "/swf/swfupload.swf",
			upload_url: "/pictures/upload",
			post_params: {"hash" : "<?php echo $key ?>",
						  "event_id": <?php echo $event_id ?>},
			file_size_limit : "100 MB",
			file_types : "*.jpg",
			file_types_description : "Images",
			file_upload_limit : 50,
			file_queue_limit : 0,
			custom_settings : {
				progressTarget : "fsUploadProgress",
				cancelButtonId : "btnCancel"
			},
			debug: false,

			// Button settings
			button_image_url: "/img/select_file.gif",
			button_width: "117",
			button_height: "19",
			button_placeholder_id: "spanButtonPlaceHolder",
			button_text: '',
			button_text_left_padding: 12,
			button_text_top_padding: 3,
			
			// The event handler functions are defined in handlers.js
			file_queued_handler : fileQueued,
			file_queue_error_handler : fileQueueError,
			file_dialog_complete_handler : fileDialogComplete,
			upload_start_handler : uploadStart,
			upload_progress_handler : uploadProgress,
			upload_error_handler : uploadError,
			upload_success_handler : uploadSuccess,
			upload_complete_handler : uploadComplete,
			queue_complete_handler : queueComplete	// Queue plugin event
		});

});


</script>