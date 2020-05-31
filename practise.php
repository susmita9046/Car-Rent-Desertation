
<div id="error-name" style="color: red"></div>
<script type="text/javascript">
	var name = "Ganesh";
	var letters = /^[A-Za-z]+$/;
	if(!name.match(letters)){
		document.getElementById('error-name').innerHTML = 'Invalid Name';
	}
</script>