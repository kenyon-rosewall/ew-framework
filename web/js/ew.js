$(document).ready(function() {
	$('#searchForm').submit(captureSearch);
});

function captureSearch(e) {
	var search = e.target[0];
	
	window.location = '/search/' + $(search).val();
	
	return false;
}