<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
    <link rel="shortcut icon" href="favicon.ico" >
    <link rel="icon" type="image/gif" href="animated_favicon1.gif" >
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="index.css" />
	<title>Meeplez registration</title>
	</head>
	<body>
	
	<div id="header">
		<div style=margin:25px;>
		<strong>Meeplez.com</strong>
		</div>
	</div>
		
	<div id="colmask"> 
		<div id="colmid"> 
			<div id="colright"> 
				<div id="col1wrap"> 
					<div id="col1pad"> 
						<div id="col1"> 
							<center><h3>Register for a <strong>Meeplez</strong></h3></center><br/>
							<table class="reg">
								<form method="post" action="register2.php">
									<tr><td class="reg">First Name</td><td><input type="text" name="fname" />*</td></tr>
									<tr><td class="reg">Last Name</td><td><input type="text" name="lname" />*</td></tr>
									<tr><td class="reg">Address</td><td><input type="text" name="address1" /></td></tr>
									<tr><td class="reg">Address</td><td><input type="text" name="address2" /></td></tr>
									<tr><td class="reg">City</td><td><input type="text" name="city" /></td></tr>
									<tr><td class="reg">State</td><td>
										<select id="state" name="state">
										<option value="">Select One</option>
										<optgroup label="U.S. States">
										<option value="AK">Alaska</option>
										<option value="AL">Alabama</option>
										<option value="AR">Arkansas</option>
										<option value="AZ">Arizona</option>
										<option value="CA">California</option>
										<option value="CO">Colorado</option>
										<option value="CT">Connecticut</option>
										<option value="DC">District of Columbia</option>
										<option value="DE">Delaware</option>
										<option value="FL">Florida</option>
										<option value="GA">Georgia</option>
										<option value="HI">Hawaii</option>
										<option value="IA">Iowa</option>
										<option value="ID">Idaho</option>
										<option value="IL">Illinois</option>
										<option value="IN">Indiana</option>
										<option value="KS">Kansas</option>
										<option value="KY">Kentucky</option>
										<option value="LA">Louisiana</option>
										<option value="MA">Massachusetts</option>
										<option value="MD">Maryland</option>
										<option value="ME">Maine</option>
										<option value="MI">Michigan</option>
										<option value="MN">Minnesota</option>
										<option value="MO">Missouri</option>
										<option value="MS">Mississippi</option>
										<option value="MT">Montana</option>
										<option value="NC">North Carolina</option>
										<option value="ND">North Dakota</option>
										<option value="NE">Nebraska</option>
										<option value="NH">New Hampshire</option>
										<option value="NJ">New Jersey</option>
										<option value="NM">New Mexico</option>
										<option value="NV">Nevada</option>
										<option value="NY">New York</option>
										<option value="OH">Ohio</option>
										<option value="OK">Oklahoma</option>
										<option value="OR">Oregon</option>
										<option value="PA">Pennsylvania</option>
										<option value="PR">Puerto Rico</option>
										<option value="RI">Rhode Island</option>
										<option value="SC">South Carolina</option>
										<option value="SD">South Dakota</option>
										<option value="TN">Tennessee</option>
										<option value="TX">Texas</option>
										<option value="UT">Utah</option>
										<option value="VA">Virginia</option>
										<option value="VT">Vermont</option>
										<option value="WA">Washington</option>
										<option value="WI">Wisconsin</option>
										<option value="WV">West Virginia</option>
										<option value="WY">Wyoming</option>
										</optgroup>
										
										<optgroup label="Canadian Provinces">
										<option value="AB">Alberta</option>
										<option value="BC">British Columbia</option>
										<option value="MB">Manitoba</option>
										<option value="NB">New Brunswick</option>
										<option value="NF">Newfoundland</option>
										<option value="NT">Northwest Territories</option>
										<option value="NS">Nova Scotia</option>
										<option value="NU">Nunavut</option>
										<option value="ON">Ontario</option>
										<option value="PE">Prince Edward Island</option>
										<option value="QC">Quebec</option>
										<option value="SK">Saskatchewan</option>
										<option value="YT">Yukon Territory</option>
										</optgroup>
										</select>
									</td></tr>
									<tr><td class="reg">ZipCode</td><td><input type="text" name="zipcode" /></td></tr>
									
									<tr><td class="reg">Birthday</td><td>
										<select name="month">
											<option value="01">January</option>
											<option value="02">Febraury</option>
											<option value="03">March</option>
											<option value="04">April</option>
											<option value="05">May</option>
											<option value="06">June</option>
											<option value="07">July</option>
											<option value="08">August</option>
											<option value="09">September</option>
											<option value="10">October</option>
											<option value="11">November</option>
											<option value="12">December</option>
										</select>
										<select name="day">
											<?php
												for ($counter=1; $counter<=31; $counter++)
												{
													if ($counter < 10)
														$day = "0$counter";
													else
														$day = "$counter";
													print ("<option value=\"$day\">$day</option>");
												}
											?>
										</select>
										<select name="year">
											<?php
												for ($counter=2010; $counter>=1920; $counter--)
													print ("<option value=\"$counter\">$counter</option>");
											?>
										</select>
									*</td></tr>
									
									<tr><td class="reg">Email</td><td><input type="text" name="email" />*</td></tr>
									<tr><td class="reg">Password</td><td><input type="password" name="password" />*</td></tr>
									<tr><td class="reg">Re-enter Password</td><td><input type="password" name="password2" />*</td></tr>
									<tr><td class="reg"></td><td><input type="submit" name="Register" value="Register" /></td></tr>
								</form>
							</table>
							<p><center><small>Fields marked with * are required.</small></center></p>						
						</div>
					</div>
				</div>
				<div id="col2">
				
				</div>
				<div id="col3">
				
				</div>
			</div>
		</div>
	</div>		
	<div id="footer">

	</div>	

	</body>
</html>