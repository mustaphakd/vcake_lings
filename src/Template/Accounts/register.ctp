
<?php

$this->assign('title', 'Login  to vHealings') ;



$view_data =  '<h2 class="margin-bottom-30">Create new account</h2>
                <form action="#">
                <div class="login-block">
					<div class="input-group margin-bottom-20">
						<span class="input-group-addon rounded-left"><i class="icon-pencil color-green"></i></span>
						<input type="text" class="form-control rounded-right" placeholder="Your name">
					</div>

					<div class="input-group margin-bottom-20">
						<span class="input-group-addon rounded-left"><i class="icon-user color-green"></i></span>
						<input type="text" class="form-control rounded-right" placeholder="Username">
					</div>

					<div class="input-group margin-bottom-20">
						<span class="input-group-addon rounded-left"><i class="icon-envelope color-green"></i></span>
						<input type="email" class="form-control rounded-right" placeholder="Your email">
					</div>

					<div class="input-group margin-bottom-30">
						<span class="input-group-addon rounded-left"><i class="icon-lock color-green"></i></span>
						<input type="password" class="form-control rounded-right" placeholder="Password">
					</div>

					<div class="checkbox margin-bottom-30">
						<label>
							<input type="checkbox"> I agree to terms &amp; conditions
						</label>

						<label>
							<input type="checkbox"> Subscribe to our newsletter
						</label>
					</div>

					<button type="submit" class="btn-u btn-block rounded">Create new</button>
					</div>
					</form>
					
					';

echo $this->element('accounts', ['view_data' => $view_data]);



