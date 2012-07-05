

<div id="footer">
<!-- If you'd like to support WordPress, having the "powered by" link somewhere on your blog is the best way; it's our only promotion or advertising. -->
	<!--<p class="topOfThePage">
	<a href="#topOfThePage"> Torna a inizio pagina</a>
	
	</p>-->
	<?php
	$myId = 1009;
	$p = get_post($myId);
	echo $p->post_content;
	?>
</div>
</div>

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->
<?php /* "Just what do you think you're doing Dave?" */ ?>

		<?php wp_footer(); ?>
</body>
</html>
