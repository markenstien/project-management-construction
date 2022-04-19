<?php 	
	
		

	function wEmailHeader()
	{
		$logo = $image = URL.DS.'public/logo_white.png';

		$header = <<<EOF
			<div class="header" style="text-align: center;padding: 15px;">
				<div class="text-center" style="text-align: center;">
					<img src="{$logo}" style="width:200px">
					<h3 style="margin: 10px 0px;">PAINTMAN CONSTRUCTION</h3>
					<p style="margin: 10px 0px;">zone5 , gimenez park subdivision. conception pequena. naga city</p>
				</div>
			</div>
		EOF;

		return $header;
	}
	
	function wEmailFooter()
	{
		$logo = $image = URL.DS.'public/logo_white.png';

		$footer = <<<EOF
			<div class="footer" style="text-align: center;padding: 15px;">
				<h3 style="margin: 10px 0px;">Paintman Construction</h3>
				<div>
					<img src="{$logo}" style="width:150px">
				</div>
				<p style="margin: 10px 0px;">zone5 , gimenez park subdivision. conception pequena. naga city</p>
				<ul class="contacts" style="margin: 0px;padding: 0px;text-align: center;list-style: none;">
					<li>Email : paintmanconstruction@gmail.com</li>
					<li>Tel : 054-8812109</li>
					<li>Mobile : +639465212272</li>
				</ul>
			</div>
		EOF;

		return $footer;
	}

	function wEmailWrapper($content)
	{
		$wrapper = <<<EOF
			<div id="email_body" style="width: 800px;margin: 0px auto;font-family: tahoma , verdana , arial;background: #eee;">
				{$content}
			</div>
		EOF;

		return $wrapper;
	}

	function wEmailComplete($content)
	{
		$header = wEmailHeader();
		$content = wEmailBody($content);
		$footer = wEmailFooter();


		$bodyComplete = $header;
		$bodyComplete .= $content;
		$bodyComplete .= $footer;

		$empCompleteHTML = wEmailWrapper( $bodyComplete );

		return $empCompleteHTML;
	}

	/*
	*Contents : what will show on the email
	*styles : this will be the styles 
	*/
	function wEmailBody( $content = '' , $styles = [] )
	{
		return <<<EOF
			<div style="margin: 0px auto;font-family: tahoma , verdana , arial;background: #fff; padding: 20px 30px;line-height:160%">
				{$content}
			</div>
		EOF;
	}