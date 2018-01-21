<?php
require_once('engine.php');

function cekusernameUnik($username = '', $except = ''){
    global $db;
    if($except == ''){
        $query = $db->prepare('SELECT * FROM (SELECT username FROM pegawai UNION SELECT username FROM pegawai) as temp WHERE username = :username');
    }else{
        $query = $db->prepare('SELECT * FROM (SELECT username FROM pegawai UNION SELECT username FROM pegawai) as temp WHERE username = :username AND username NOT LIKE :except');
        $query->bindValue(':except', $except, PDO::PARAM_STR);
    }
    $query->bindValue(':username', $username, PDO::PARAM_STR);
    $query->execute();
    $row = $query->rowCount();
    return ($row > 0) ? false : true;
}

function cekusernameUnikCust($username = '', $except = ''){
    global $db;
    if($except == ''){
    	$query = $db->prepare('SELECT * FROM (SELECT username FROM customer UNION SELECT username FROM customer) as temp WHERE username = :username');
    }else{
    	$query = $db->prepare('SELECT * FROM (SELECT username FROM customer UNION SELECT username FROM customer) as temp WHERE username = :username AND username NOT LIKE :except');
    	$query->bindValue(':except', $except, PDO::PARAM_STR);
    }
    $query->bindValue(':username', $username, PDO::PARAM_STR);
    $query->execute();
    $row = $query->rowCount();
    return ($row > 0) ? false : true;
}

function cekNIPUnik($username = '', $except = ''){
    global $db;
    if($except == ''){
    	$query = $db->prepare('SELECT * FROM (SELECT nip FROM pegawai UNION SELECT nip FROM pegawai) as temp WHERE nip = :nip');
    }else{
    	$query = $db->prepare('SELECT * FROM (SELECT nip FROM pegawai UNION SELECT nip FROM pegawai) as temp WHERE nip = :nip AND username NOT LIKE :except');
    	$query->bindValue(':except', $except, PDO::PARAM_STR);
    }
    $query->bindValue(':nip', $username, PDO::PARAM_STR);
    $query->execute();
    $row = $query->rowCount();
    return ($row > 0) ? false : true;
}


	$except = (isset($_POST['except'])) ? $_POST['except'] : '';
	if(isset($_POST['username'])) {
		$validate = cekusernameUnik($_POST['username'], $except);
	}elseif(isset($_POST['nip'])){
        $validate = cekNIPUnik($_POST['nip'], $except);
    }elseif(isset($_POST['username_cust'])){
		$validate = cekusernameUnikCust($_POST['username_cust'], $except);
	}else{
		redirect(base_url());
	}
	//sleep(1);
   echo ($validate) ? true : false ;

?>
