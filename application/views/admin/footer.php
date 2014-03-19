        </div>
    </div>
    <div class="footer">欢迎您，
    <?php 
    	$CI=&get_instance();
    	$CI->load->library('session');
    	echo $CI->session->userdata("username");
    ?>   </div>
</div>
<!--[if IE 6]>
	<script type="text/javascript" src="js/DD_belatedPNG.js"></script>
	<script type="text/javascript">
	DD_belatedPNG.fix('.login');
	</script>
<![endif]-->

</body>
</html>
