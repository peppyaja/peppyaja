<?php
date_default_timezone_set('Asia/Jakarta');
include "func.php";

echo color("green","     * * * * * * * * * * * * * * * * * * * * * * ")."\n";
echo color("green","     *           "); echo color("purple","AUTO CREATE ACCOUNT"); echo color("green","           * ")."\n";
echo color("green","     *           "); echo color("purple","AUTO CLAIM VOUCHERS"); echo color("green","           * ")."\n";
echo color("green","     *               "); echo color("purple","AUTO SET PIN"); echo color("green","              * ")."\n";
echo color("green","     *          "); echo color("nevy","Created by : kurang beruntung chanel"); echo color("green","          * ")."\n";
echo color("green","     *             "); echo color("nevy","Version : subcribe"); echo color("green","               * ")."\n";
echo color("green","     *       "); echo color("nevy","Date : ".date('d-m-Y | H:i:s')); echo color("green","      * ")."\n";
echo color("green","     * * * * * * * * * * * * * * * * * * * * * * ")."\n\n";
echo color("green","     * * * * * * * * * * * * * * * * * * * * * * ")."\n";
echo color("green","     *           "); echo color("purple","AUTO CREATE ACCOUNT"); echo color("green","           * ")."\n";
echo color("green","     * * * * * * * * * * * * * * * * * * * * * * ")."\n";

//function change(){
	$nama = nama();
	$email = str_replace(" ", "", $nama) . mt_rand(100, 999);
	ulang:
	echo color("nevy","?] Number : ");
	$nohp = trim(fgets(STDIN));
	$nohp = str_replace("62","62",$nohp);
	$nohp = str_replace("(","",$nohp);
	$nohp = str_replace(")","",$nohp);
	$nohp = str_replace("-","",$nohp);
	$nohp = str_replace(" ","",$nohp);

	if (!preg_match('/[^+0-9]/', trim($nohp))) {
		if (substr(trim($nohp),0,3)=='62') {
			$hp = trim($nohp);
		}
		else if (substr(trim($nohp),0,1)=='0') {
			$hp = '62'.substr(trim($nohp),1);
		} else if(substr(trim($nohp), 0, 2)=='62') {
			$hp = '6'.substr(trim($nohp), 1);
		} else {
			$hp = '1'.substr(trim($nohp),0,13);
		}
	}
		
	$data = '{"email":"'.$email.'@gmail.com","name":"'.$nama.'","phone":"+'.$hp.'","signed_up_country":"ID"}';
	$register = request("/v5/customers", null, $data);
	if(strpos($register, '"otp_token"')) {
		$otptoken = getStr('"otp_token":"','"',$register);
		echo color("green","+] Verification code has been sent")."\n";
		otp:
		echo color("nevy","?] OTP : ");
		$otp = trim(fgets(STDIN));
		$data1 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $otptoken . '"},"client_secret":"83415d06-ec4e-11e6-a41b-6c40088ab51e"}';
		$verif = request("/v5/customers/phone/verify", null, $data1);
		if(strpos($verif, '"access_token"')) {
			echo color("green","+] Register success");
			$token = getStr('"access_token":"','"',$verif);
			$uuid = getStr('"resource_owner_id":',',',$verif);
			echo "\n".color("yellow","+] Your access token : ".$token."\n\n");
			save("token.txt",$token);
				
			echo color("green","     * * * * * * * * * * * * * * * * * * * * * * ")."\n";
			echo color("green","     *           "); echo color("purple","AUTO CLAIM VOUCHERS"); echo color("green","           * ")."\n";
			echo color("green","     * * * * * * * * * * * * * * * * * * * * * * ")."\n";
			echo color("yellow","!] Claim Voc")."\n";
			echo color("yellow","!] Please wait");
			for($a=1;$a<=5;$a++) {
				echo color("yellow",".");
				sleep(3);
			}
			sleep(3);
			$gocar = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"COBAGOFOOD090320A"}');
			$message = fetch_value($gocar,'"message":"','"');
			echo "\n".color("green","+] Message: ".$message);
			sleep(3);
				
			$cekvoucher = request('/gopoints/v3/wallet/vouchers?limit=10&page=1', $token);
			$total = fetch_value($cekvoucher,'"total_vouchers":',',');
			$voucher1 = getStr1('"title":"','",',$cekvoucher,"1");
			$voucher2 = getStr1('"title":"','",',$cekvoucher,"2");
			$voucher3 = getStr1('"title":"','",',$cekvoucher,"3");
			$voucher4 = getStr1('"title":"','",',$cekvoucher,"4");
			$voucher5 = getStr1('"title":"','",',$cekvoucher,"5");
			$voucher6 = getStr1('"title":"','",',$cekvoucher,"6");
			$voucher7 = getStr1('"title":"','",',$cekvoucher,"7");
			$voucher8 = getStr1('"title":"','",',$cekvoucher,"8");
			$voucher9 = getStr1('"title":"','",',$cekvoucher,"9");
			$voucher10 = getStr1('"title":"','",',$cekvoucher,"10");
							
			echo "\n";
			echo "\n".color("yellow","!] Total Voucher ".$total." : ");
			echo "\n".color("green","1. ".$voucher1);
			echo "\n".color("green","2. ".$voucher2);
			echo "\n".color("green","3. ".$voucher3);
			echo "\n".color("green","4. ".$voucher4);
			echo "\n".color("green","5. ".$voucher5);
			echo "\n".color("green","6. ".$voucher6);
			echo "\n".color("green","7. ".$voucher7);
			echo "\n".color("green","8. ".$voucher8);
			echo "\n".color("green","9. ".$voucher9);
			echo "\n".color("green","10. ".$voucher10);
							
			$expired1 = getStr1('"expiry_date":"','"',$cekvoucher,'1');
			$expired2 = getStr1('"expiry_date":"','"',$cekvoucher,'2');
			$expired3 = getStr1('"expiry_date":"','"',$cekvoucher,'3');
			$expired4 = getStr1('"expiry_date":"','"',$cekvoucher,'4');
			$expired5 = getStr1('"expiry_date":"','"',$cekvoucher,'5');
			$expired6 = getStr1('"expiry_date":"','"',$cekvoucher,'6');
			$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'7');
			$expired8 = getStr1('"expiry_date":"','"',$cekvoucher,'8');
			$expired9 = getStr1('"expiry_date":"','"',$cekvoucher,'9');
			$expired10 = getStr1('"expiry_date":"','"',$cekvoucher,'10');
			
			setpin:
			echo "\n\n";
			echo color("green","     * * * * * * * * * * * * * * * * * * * * * * ")."\n";
			echo color("green","     *               "); echo color("purple","AUTO SET PIN"); echo color("green","              * ")."\n";
			echo color("green","     * * * * * * * * * * * * * * * * * * * * * * ")."\n";
			$data2 = '{"pin":"121212"}';
			$getotpsetpin = request("/wallet/pin", $token, $data2, null, null, $uuid);
			echo color("nevy","?] OTP PIN : ");
			$otpsetpin = trim(fgets(STDIN));
			$verifotpsetpin = request("/wallet/pin", $token, $data2, null, $otpsetpin, $uuid);
			echo $verifotpsetpin ."\n";
			echo color("green","+] Your PIN is Activated")."\n\n";
			echo color("green","     * * * * * * * * * * * * * * * * * * * * * * ")."\n";
			echo color("green","     *                   "); echo color("purple","DONE"); echo color("green","                  * ")."\n";
			echo color("green","     * * * * * * * * * * * * * * * * * * * * * * ")."\n";
		} else {
			echo color("red","x] Seems like the code isn't valid!!! \n");
			echo color("yellow","!] Please input again \n");
			goto otp;
		}
	} else {
		echo color("red","x] This number's already registered!!! \n");
		echo color("yellow","!] Please register again using other number \n");
		goto ulang;
	}
