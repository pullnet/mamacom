<div class="two_colum">
	<div class="side">
		<div class="header_dmy"></div>
		<?php echo $this->Part_lib("sidenav_oven"); ?>
	</div>
	<div class="main">
		<div class="header_dmy"></div>
		<div class="m10">
			<h1 class="mtitle mb20">Config - config.php</h1>
			
			<?php echo $this->Form->create("Cnfig"); ?>
			
			<table class="mb20">
			<tr>
				<th>default_charset</th>
				<td>
					<p>default encording setting.</p>
					<label class="select w200">
						<?php echo $this->Form->select("default_charset",array("utf-8"=>"UTF-8"),array("value"=>"utf-8")); ?>
					</label>
				</td>
			</tr>
			<tr>
				<th>hash number</th>
				<td>
					<p>default hash number.</p>
					<?php echo $this->Form->input("hash_number",array("class"=>"w500","placeholder"=>"example : 123456789abcdefg...")); ?>
				</td>
			</tr>
			<tr>
				<th>hash password</th>
				<td>
					<p>default hash password.</p>
					<?php echo $this->Form->input("hash_password",array("class"=>"w500","placeholder"=>"example : 123456789abcdefg...")); ?>
				</td>
			</tr>
			<tr>
				<th>encrypt method</th>
				<td>
					<p>select encrypt method.</p>
					<label class="select w300">
						<?php
						$encrypt_method=array(
							"AES-128-CBC" =>"AES-128-CBC",
							"AES-128-CFB"=>"AES-128-CFB",
							"AES-128-CFB1"=>"AES-128-CFB1",
							"AES-128-CFB8"=>"AES-128-CFB8",
							"AES-128-ECB"=>"AES-128-ECB",
							"AES-128-OFB"=>"AES-128-OFB",
							"AES-192-CBC"=>"AES-192-CBC",
							"AES-192-CFB"=>"AES-192-CFB",
							"AES-192-CFB1"=>"AES-192-CFB1",
							"AES-192-CFB8"=>"AES-192-CFB8",
							"AES-192-ECB"=>"AES-192-ECB",
							"AES-192-OFB"=>"AES-192-OFB",
							"AES-256-CBC"=>"AES-256-CBC",
							"AES-256-CFB"=>"AES-256-CFB",
							"AES-256-CFB1"=>"AES-256-CFB1",
							"AES-256-CFB8"=>"AES-256-CFB8",
							"AES-256-ECB"=>"AES-256-ECB",
							"AES-256-OFB"=>"AES-256-OFB",
							"BF-CBC"=>"BF-CBC",
							"BF-CFB"=>"BF-CFB",
							"BF-ECB"=>"BF-ECB",
							"BF-OFB"=>"BF-OFB",
							"CAST5-CBC"=>"CAST5-CBC",
							"CAST5-CFB"=>"CAST5-CFB",
							"CAST5-ECB"=>"CAST5-ECB",
							"CAST5-OFB"=>"CAST5-OFB",
							"DES-CBC"=>"DES-CBC",
							"DES-CFB"=>"DES-CFB",
							"DES-CFB1"=>"DES-CFB1",
							"DES-CFB8"=>"DES-CFB8",
							"DES-ECB"=>"DES-ECB",
							"DES-EDE"=>"DES-EDE",
							"DES-EDE-CBC"=>"DES-EDE-CBC",
							"DES-EDE-CFB"=>"DES-EDE-CFB",
							"DES-EDE-OFB"=>"DES-EDE-OFB",
							"DES-EDE3"=>"DES-EDE3",
							"DES-EDE3-CBC"=>"DES-EDE3-CBC",
							"DES-EDE3-CFB"=>"DES-EDE3-CFB",
							"DES-EDE3-CFB1"=>"DES-EDE3-CFB1",
							"DES-EDE3-CFB8"=>"DES-EDE3-CFB8",
							"DES-EDE3-OFB"=>"DES-EDE3-OFB",
							"DES-OFB"=>"DES-OFB",
							"DESX-CBC"=>"DESX-CBC",
							"RC2-40-CBC"=>"RC2-40-CBC",
							"RC2-64-CBC"=>"RC2-64-CBC",
							"RC2-CBC"=>"RC2-CBC",
							"RC2-CFB"=>"RC2-CFB",
							"RC2-ECB"=>"RC2-ECB",
							"RC2-OFB"=>"RC2-OFB",
							"RC4"=>"RC4",
							"RC4-40"=>"RC4-40",
							"RC5-CBC"=>"RC5-CBC",
							"RC5-CFB"=>"RC5-CFB",
							"RC5-ECB"=>"RC5-ECB",
							"RC5-OFB"=>"RC5-OFB",
							"SEED-CBC"=>"SEED-CBC",
							"SEED-CFB"=>"SEED-CFB",
							"SEED-ECB"=>"SEED-ECB",
							"SEED-OFB"=>"SEED-OFB",
							"aes-128-cbc"=>"aes-128-cbc",
							"aes-128-cfb"=>"aes-128-cfb",
							"aes-128-cfb1"=>"aes-128-cfb1",
							"aes-128-cfb8"=>"aes-128-cfb8",
							"aes-128-ecb"=>"aes-128-ecb",
							"aes-128-ofb"=>"aes-128-ofb",
							"aes-192-cbc"=>"aes-192-cbc",
							"aes-192-cfb"=>"aes-192-cfb",
							"aes-192-cfb1"=>"aes-192-cfb1",
							"aes-192-cfb8"=>"aes-192-cfb8",
							"aes-192-ecb"=>"aes-192-ecb",
							"aes-192-ofb"=>"aes-192-ofb",
							"aes-256-cbc"=>"aes-256-cbc",
							"aes-256-cfb"=>"aes-256-cfb",
							"aes-256-cfb1"=>"aes-256-cfb1",
							"aes-256-cfb8"=>"aes-256-cfb8",
							"aes-256-ecb"=>"aes-256-ecb",
							"aes-256-ofb"=>"aes-256-ofb",
					);
					
							/*
[77] => bf-cbc
[78] => bf-cfb
[79] => bf-ecb
[80] => bf-ofb
[81] => cast5-cbc
[82] => cast5-cfb
[83] => cast5-ecb
[84] => cast5-ofb
[85] => des-cbc
[86] => des-cfb
[87] => des-cfb1
[88] => des-cfb8
[89] => des-ecb
[90] => des-ede
[91] => des-ede-cbc
[92] => des-ede-cfb
[93] => des-ede-ofb
[94] => des-ede3
[95] => des-ede3-cbc
[96] => des-ede3-cfb
[97] => des-ede3-cfb1
[98] => des-ede3-cfb8
[99] => des-ede3-ofb
[100] => des-ofb
[101] => desx-cbc
[102] => rc2-40-cbc
[103] => rc2-64-cbc
[104] => rc2-cbc
[105] => rc2-cfb
[106] => rc2-ecb
[107] => rc2-ofb
[108] => rc4
[109] => rc4-40
[110] => rc5-cbc
[111] => rc5-cfb
[112] => rc5-ecb
[113] => rc5-ofb
[114] => seed-cbc
[115] => seed-cfb
[116] => seed-ecb
[117] => seed-ofb
*/
						echo $this->Form->select("encrypt_method",$encrypt_method); ?>
					</label>
				</td>
			</tr>
			<tr>
				<th>Session control number</th>
				<td>
					<p>Thie website is original Session controll number.</p>
					<?php echo $this->Form->input("session_number",array("class"=>"w500","placeholder"=>"example : 123456789abcdefg...")); ?>
				</td>
			</tr>
			<tr>
				<th>Cookie control number</th>
				<td>
					<p>Thie website is original Cookie controll number.</p>
					<?php echo $this->Form->input("cookie_number",array("class"=>"w500","placeholder"=>"example : 123456789abcdefg...")); ?>
				</td>
			</tr>
			<tr>
				<th>Default TimeZone</th>
				<td>
					<?php
					$timezone=array(
						"Asia/Tokyo"=>"Asia/Tokyo",
						"America/Adak"=>"America/Adak",
						"Europe/Amsterdam"=>"Europe/Amsterdam",
					);
					echo $this->Form->select("timezone",$timezone,array("class"=>"w200")); ?>
				</td>
			</tr>
			<tr>
				<th>Cookie timelimit</th>
				<td>
					<?php echo $this->Form->input("cookie_limit",array("type"=>"number","min"=>0,"class"=>"w100","value"=>"3600")); ?> seconds after the current time.
				</td>
			</tr>
			<tr>
				<th>Cookie rootdirectory</th>
				<td>
					<?php echo $this->Form->input("cookie_defaultdir",array("class"=>"w500","value"=>"/")); ?>
				</td>
			</tr>
			<tr>
				<th>Turn off breakoff</th>
				<td>
					<p>Turn off line breaks to improve conversions.</p>
					<div id="swradio">
						<?php echo $this->Form->radio("breakoff",array(true=>"True",false=>"False"),array("value"=>true)); ?>
					</div>
				</td>
			</tr>
			</table>

			<div class="center">
				<?php echo $this->Form->submit("Config.php Save",array("class"=>"buttons big add")); ?>
			</div>
			
			<?php echo $this->Form->end(); ?>

		</div>
	</div><!--//#menustrip-->
</div>