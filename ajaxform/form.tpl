<form id="ajaxform">
	<label>Name <sup>*</sup></label>
	<input type="text" name="af_sender_name" class="form-control mb-2" value="{sender_name}">
	<label>E-Mail <sup>*</sup></label>
	<input type="email" name="af_sender_mail" class="form-control mb-2" value="{sender_mail}">
	<label>Message <sup>*</sup></label>
	<textarea name="af_sender_message" class="form-control mb-2">{sender_message}</textarea>
	
	<div class="checkbox">
		<label>
			<input type="checkbox" name="privacy_policy" value="accept"> I have read, understood and accept the privacy policy.
		</label>
	</div>
	
	<button class="btn btn-success" type="submit" name="sendform" value="send">SEND</button>
	<input type="hidden" name="csrf_token" value="{csrf_token}">
</form>
<p><sup>*</sup> mandatory fields</p>