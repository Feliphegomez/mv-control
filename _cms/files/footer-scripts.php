<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<!-- Vue And Axios -->
<script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/vue-router/2.2.1/vue-router.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
<script src="/assets/js/notify.min.js"></script>

<?php
	global $pageDataGlobal;

	if(isset($pageDataGlobal->messageGlobal) && $pageDataGlobal->messageGlobal != null)
	{
		echo '<script>';
			echo "$.notify(\"{$pageDataGlobal->messageGlobal}\", \"info\");";
		echo '</script>';
	}
?>