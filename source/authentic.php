<?php
/*************************************************************************************
			TARGET: https://cronos.cc.uoi.gr/
**************************************************************************************/
	$username = $_POST["username"];
	$password = $_POST["password"];
	$url_login = 'https://cronos.cc.uoi.gr/unistudent/login.asp';

	$login = curl_init();
	curl_setopt($login, CURLOPT_URL, $url_login);
	curl_setopt($login, CURLOPT_HEADER, false);			// να μην επιστρέφεται το header
	curl_setopt($login, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($login, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($login, CURLOPT_COOKIEJAR, "cookie.txt"); 
	curl_setopt($login, CURLOPT_COOKIEFILE, "cookie.txt"); 
	curl_setopt($login, CURLOPT_COOKIESESSION, true); 		//ksekiname neo session
	curl_setopt($login, CURLOPT_RETURNTRANSFER, true);		// μας επιστρέφει την σελίδα σε μεταβλητή
	curl_setopt($login, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:12.0) Gecko/20100101 Firefox/12.0");
	curl_setopt($login, CURLOPT_FOLLOWLOCATION, true);		// ακολοθούμε όλα τα redirects
	curl_setopt($login, CURLOPT_AUTOREFERER, true);
        
	$httppage = curl_exec($login);					// ανοίγουμε το λινκ
        
	curl_setopt($login, CURLOPT_POST, true);			// εισαγωγή στοιχείων πρόσβασης
	curl_setopt($login, CURLOPT_POSTFIELDS, 'userName='.$username.'&pwd='.$password.'&submit1=%C5%DF%F3%EF%E4%EF%F2&loginTrue=login');
	curl_setopt($login, CURLOPT_REFERER, 'https://cronos.cc.uoi.gr/unistudent/login.asp');
        
	$httppage = curl_exec($login);					// ανοίγουμε το λινκ αλλα με κωδικούς
	echo $httppage;

	/* μετάβαση στον πίνακα βαθμολογιών */
	$url_grades = "https://cronos.cc.uoi.gr/unistudent/stud_CResults.asp?studPg=1&mnuid=mnu3&";

	curl_setopt($login, CURLOPT_URL, $url_grades);
	curl_setopt($login, CURLOPT_POST, false); 
        curl_setopt($login, CURLOPT_COOKIEFILE, "cookie.txt");  

        curl_setopt($login, CURLOPT_RETURNTRANSFER, true);              // μας επιστρέφει την σελίδα σε μεταβλητή
        curl_setopt($login, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:12.0) Gecko/20100101 Firefox/12.0");
        curl_setopt($login, CURLOPT_FOLLOWLOCATION, true);              // ακολοθούμε όλα τα redirects
        curl_setopt($login, CURLOPT_AUTOREFERER, true);
        curl_setopt($login, CURLOPT_REFERER,'https://cronos.cc.uoi.gr/unistudent/login.asp');
	

	
	$fh = fopen('data_file.txt', 'w'); 
	curl_setopt($login, CURLOPT_FILE, $fh);
	$grades_data = curl_exec($login);

	echo $grades_data;
	curl_close($login);
?>
