<script type="text/javascript">
// $(document).ready(function(){
	// $("#form-contact-2").submit(function(){
		// $.get($(this).attr('href'),{},function(data){
			// $("#content").empty().append(data);
				//Variable des champs
				// name = $(this).find("input[name=name]").val();
				// email = $(this).find("input[name=email]").val();
				// subject = $(this).find("input[name=subject]").val();
				// message = $(this).find("textarea[name=message]").val();
				// url = $(this).attr("action");
				// alert(name+' '+url);
				// $.post(url,{name: name, email: email, subject: subject, content: message}, function( data ){ 
					// $("#form-contact").fadeOut();
					// alert(data);
				// },"json");
			// alert(data);
		// });
		// return false;
	// });
// });
</script>
<?php
echo $this->element(FRONTOFFICE.DS.'msg_flash'.DS.'message_flash.php');
?>
</br>
<?php
header("Content-Type: text/html; charset=UTF-8");
echo $content_for_layout;
?>
