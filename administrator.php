<?php

/*
	File		administrator.php
	Deskripsi	Halaman adminstrasi
 */

require_once('includes/session.php');

sessionInit();

?>

<html>
	<head>
	
	</head>
	
	<body>
		<?php
		if(sessionGet('msg')) {
			?>
			
			Message:
			
			<?php
			echo sessionGet('msg');
		}	
		?>
		
		<div>
			User management
			
			<div>
				Add user
				<form action="administratorhandler.php" enctype="multipart/form-data" method="post">
					<input type="hidden" name="action" value="useradd" />
					<table>
						<tr>
							<td>Username</td>
							<td><input type="text" name="data[useradd][username]" maxlength="256" /></td>
						</tr>
						<tr>
							<td>Full Name</td>
							<td><input type="text" name="data[useradd][fullname]" maxlength="256" /></td>
						</tr>
						<tr>
							<td>Address</td>
							<td><textarea name="data[useradd][address]" maxlength="4096"></textarea></td>
						</tr>
						<tr>
							<td>E-Mail</td>
							<td><input type="text" name="data[useradd][email]" maxlength="256" /></td>
						</tr>
						<tr>
							<td>Photo</td>
							<td><input type="file" name="photo" /></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input type="password" name="data[useradd][password]" maxlength="256" /></td>
						</tr>
						<tr>
							<td>Password (again)</td>
							<td><input type="password" name="data[useradd][password2]" maxlength="256" /></td>
						</tr>
						<tr>
							<td>Role</td>
							<td>
								<input type="radio" name="data[useradd][role]" value="USER" selected />User
								<input type="radio" name="data[useradd][role]" value="ADMIN" />Administrator
							</td>
						</tr>
						<tr>
							<td>Status</td>
							<td>
								<input type="radio" name="data[useradd][status]" value="ACTIVE" />Active
								<input type="radio" name="data[useradd][status]" value="PENDING" />Pending
								<input type="radio" name="data[useradd][status]" value="DISABLED" />Disabled
							</tr>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" value="Submit" /></td>
						</tr>
					</table>
				</form>
			</div>
			
			<div>
				Modify user
				<form action="administratorhandler.php" enctype="multipart/form-data" method="post">
					<input type="hidden" name="action" value="usermod" />
					<table>
						<tr>
							<tr>
							<td>Username</td>
							<td><input type="text" name="data[usermod][username]" maxlength="256" /></td>
						</tr>
						<div>
							<tr>
								<td>Full Name</td>
								<td><input type="text" name="data[usermod][fullname]" maxlength="256" /></td>
							</tr>
							<tr>
								<td>Address</td>
								<td><textarea name="data[usermod][address]" maxlength="4096"></textarea></td>
							</tr>
							<tr>
								<td>E-Mail</td>
								<td><input type="text" name="data[usermod][email]" maxlength="256" /></td>
							</tr>
							<tr>
								<td>Photo</td>
								<td><input type="file" name="photo" /></td>
							</tr>
							<tr>
								<td>Password</td>
								<td><input type="password" name="data[usermod][password]" maxlength="256" /></td>
							</tr>
							<tr>
								<td>Password (again)</td>
								<td><input type="password" name="data[usermod][password2]" maxlength="256" /></td>
							</tr>
							<tr>
								<td>Role</td>
								<td>
									<input type="radio" name="data[usermod][role]" value="USER" selected />User
									<input type="radio" name="data[usermod][role]" value="ADMIN" />Administrator
								</td>
							</tr>
							<tr>
								<td colspan="2"><input type="submit" value="Submit" /></td>
							</tr>
						</div>
					</table>
				</form>
			</div>
			
			<div>
				Disable user
				<form action="administratorhandler.php" method="post">
					<input type="hidden" name="action" value="userdisable" />
					<table>
						<tr>
							<td>Username</td>
							<td><input type="text" name="data[userdisable][username]" maxlength="256" /></td>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" value="Submit" /></td>
						</tr>
					</table>
				</form>
			</div>
			
			<div>
				Remove user
				<form action="administratorhandler.php" method="post">
					<input type="hidden" name="action" value="userdel" />
					<table>
						<tr>
							<td>Username</td>
							<td><input type="text" name="data[userdel][username]" maxlength="256" /></td>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" value="Submit" /></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		
		<div>
			Course management
			
			<div>
				Add/remove Faculty
			</div>
			
			<div>
				Add/remove Program
			</div>
			
			<div>
				Add course
			</div>
			
			<div>
				Modify course
			</div>
				
			<div>
				Remove course
			</div>
			
			<div>
				Add course instance
			</div>
			
			<div>
				Delegate course instance to user
			</div>
			
			<div>
				Modify course instance
			</div>
			
			<div>
				Delete course instance
			</div>
		</div>
	</body>
</html>