<?php 	

	class MailingController extends Controller
	{

		public function publicBasic()
		{
			$post = request()->posts();

			$thankYouMessage = " <p> Hi {$post['name']}! </p>";
			$thankYouMessage .= " <p> We have recieved your email , 
			we will surely get back to you within 24 hours!. </p>";


			$messageToTheTeam = "<p> Good day Paintman team!</p>";
			$messageToTheTeam .= "<p> <strong>We just have an inquiry!</trong> </p>";

			$messageToTheTeam .= "
				<table cellpadding='10' cellspacing='10'>
					<tbody>
						<tr>
							<td>Name</td>
							<td>{$post['name']}</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>{$post['email']}</td>
						</tr>
						<tr>
							<td>Message</td>
							<td>{$post['message']}</td>
						</tr>
					</tbody>
				<table>
			";


			$thankYouMessageEmailWrapper = wEmailComplete($thankYouMessage);

			$messageToTheTeamEmailWrapper = wEmailComplete($messageToTheTeam);

			//message for the inquirer
			_mail( $post['email'] , "Paintman Construction Team" , $thankYouMessageEmailWrapper );
			//message for the team
			_mail( MAILER_AUTH['username'] , "Paintman Construction Team" , $thankYouMessage );


			Flash::set("Thank you for reaching us! we assure you a reply withing 24 hours!");

			return request()->return();
			/*send and email */
		}
	}