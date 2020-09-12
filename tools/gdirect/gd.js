/**
* Google Drive Link Generator
*/
$(function () {
	$('#generate').click(function () {
		var sharingurl = $.trim($('#sharingurl').val());
		if (sharingurl.length <= 0){
			$('#modalerror').modal('show'); 
			$('#errormsg').text("You didn't entered any URL in the textbox");
			return;
		}
		var googleid = '';
		var regexp = /https:\/\/drive\.google\.com\/file\/d\/(.*?)\/(edit|view)/;
		var match = sharingurl.match(regexp);
		if ( match ){
			googleid = match[1];
		}
		else{
			regexp = /https:\/\/drive\.google\.com\/open\?id\=(.*?)$/;
			match = sharingurl.match(regexp);
			if ( match ){
				googleid = match[1];
			}
		}
		if (googleid){
			$('#googlelink').val('https://drive.google.com/uc?export=download&id=' + googleid);
		}
		else{
			$('#modalerror').modal('show');
			$('#errormsg').text('Please, enter a valid Google Drive Sharing URL');
			$('#sharingurl').val("");
			$('#googlelink').val("");
		}
	});
});

$("#borrar").click(function () {
	$('#sharingurl').val("");
	$('#googlelink').val("");

});


$("#download").click(function () {
	var link = $('#googlelink').val();
	window.location.href=link;
});

tippy('#copy', {
	content: "Copied!",
	placement: 'top',
	animation: 'shift-away',
	theme: 'material',
	trigger: 'click',
	delay: [0, 100],
});

var clipboard = new ClipboardJS('#copy');
clipboard.on('success', function(e) {
	console.info('Action:', e.action);
	console.info('Text:', e.text);
	console.info('Trigger:', e.trigger);

	e.clearSelection();
});

clipboard.on('error', function(e) {
	console.error('Action:', e.action);
	console.error('Trigger:', e.trigger);
});