<?php
header("Content-Type: text/html; charset=gb2312");
class curl{
	public $ID;
	public $pass;
	public $user;
	public $num;  //$num为班级人数
	public $pm; //排名
	public $loginyes=0; //是否登录成功  1为登录成功；

	public function __construct($user , $pass , $School_ID ){
		$this->user = $user;
		$this->pass = $pass;
		$this->ID = $School_ID;

	}


	public function Catch_ff(){
		$cookie_file = tempnam("COO","cookie");
		$user = $this->user;
		$pass = $this->pass;
		$curlPost = "userName=$user&&password=$pass";
		$curlPost2 = "username=$user&&password=$pass";
		$login_url = 'https://security.scut.edu.cn:443/cas/login';
		//$cacert = getcwd();http://cwis.scut.edu.cn:9980/student/student/grade/flow_main.htm
		//$CA = true;https://security.scut.edu.cn/cas/login
		
		//$SSL = substr($url, 0, 8) == "https://" ? true : false;
		$curl = curl_init($login_url);

		curl_setopt($curl,CURLOPT_HEADER,0);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 5);
		//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		//curl_setopt($curl,CURLOPT_CAINFO,'../cacert.pem');
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl,CURLOPT_POST,1);
		//curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)');

		curl_setopt($curl,CURLOPT_COOKIEJAR, $cookie_file);
		curl_setopt($curl,CURLOPT_POSTFIELDS,$curlPost2);

		$data=curl_exec($curl);

		curl_close($curl);

		$b=preg_match('/<font color="red">(.*)<\/font>/U',$data,$arr);
		
		if($b){

			$this->loginyes = 0;
		}else{

			$this->loginyes = 1;
			$url = 'http://my.scut.edu.cn/Login';
			//$SSL = substr($url, 0, 8) == "https://" ? true : false;
			$curl = curl_init($url);

			curl_setopt($curl,CURLOPT_HEADER,0);
			curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_TIMEOUT, 5);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
			//curl_setopt($curl,CURLOPT_CAINFO,'../cacert.pem');
			//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl,CURLOPT_POST,1);
			//curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
			curl_setopt($curl,CURLOPT_COOKIEFILE, $cookie_file);
			curl_setopt($curl,CURLOPT_COOKIEJAR, $cookie_file);
			curl_setopt($curl,CURLOPT_POSTFIELDS,$curlPost);

			$data=curl_exec($curl);

			curl_close($curl);
			//echo $data;

			$curl = curl_init('http://cwis.scut.edu.cn:9980/student/login.jsp');

			curl_setopt($curl,CURLOPT_HEADER,1);
			curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
			//curl_setopt($curl, CURLOPT_REFERER, $login_url);
			//curl_setopt($curl,CURLOPT_COOKIEFILE, $cookie_file);
			//curl_setopt($curl,CURLOPT_COOKIEFILE, $cookie_file2);

			curl_setopt($curl,CURLOPT_COOKIEFILE, $cookie_file);
			//curl_setopt($curl,CURLOPT_COOKIEJAR, $cookie_file3);
			//curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
			//curl_setopt($curl,CURLOPT_POST,1);
			//curl_setopt($curl,CURLOPT_POSTFIELDS,$curlPost2);<a href="http://cwis.scut.edu.cn:9980/student/login.jsp?ticket=ST-62627-pbVtakxuDALTooIaVfjG" />">here</a>
			$data = curl_exec($curl);
			preg_match('/<a href="(.*)" \/>">here<\/a>/', $data, $arr);
			//echo $arr[1];
			curl_close($curl);



			$curl = curl_init($arr[1]);
			curl_setopt($curl,CURLOPT_HEADER,1);
			curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
			//curl_setopt($curl, CURLOPT_REFERER, $login_url);
			curl_setopt($curl,CURLOPT_COOKIEFILE, $cookie_file);
			curl_setopt($curl,CURLOPT_COOKIEJAR, $cookie_file);

			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
			//curl_setopt($curl,CURLOPT_POST,1);
			//curl_setopt($curl,CURLOPT_POSTFIELDS,$curlPost3);
			$data = curl_exec($curl);
			//preg_match("/<option value=\"2012\">(.*)<\/option>/", $data, $arr);
			//echo $arr[1];
			#echo $data;
			curl_close($curl);

			$curlPost3 = "academicYear=2012&&paixu=true";


			$curl = curl_init('http://cwis.scut.edu.cn:9980/student/student/grade/cepinList.jsp');
			curl_setopt($curl,CURLOPT_HEADER,0);
			curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
			//curl_setopt($curl, CURLOPT_REFERER, $login_url);
			curl_setopt($curl,CURLOPT_COOKIEFILE, $cookie_file);

			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($curl,CURLOPT_POST,1);
			curl_setopt($curl,CURLOPT_POSTFIELDS,$curlPost3);
			$data2 = curl_exec($curl);
			//$data2 = str_replace("\n",'',$data2);
			//preg_match_all("/<tr align=\"center\" valign=\"middle\" class=\"tittle3\">(.*)<\/tr>/U", $data2, $arr_zz);
			preg_match_all("/<tr.*>(.*)<\/tr>/iUs",$data2,$arr_zz);  //学生排名为$arr_zz[0][n]  n-2
			$arr_zz = str_replace("\n",'',$arr_zz[0]);
			preg_match_all("/[0-9]+/",$arr_zz[1],$num);  //$num[0][1]为班级人数

			curl_close($curl);

			$this->num = $num[0][1];

			return $arr_zz;
		}


		
	}



	public function getGrade($School_ID, $xueqi){//不提供学号就查本人，，，，
		$n = -2;
		$grade = array();  ///$grade 为获取的分数
		$arr_zz =$this->Catch_ff();
		foreach ($arr_zz as $arr){
			

			if(preg_match("/<a href=\"grade_info.jsp\?studentID=$School_ID\&academicYear=$xueqi\" target=\"_blank\">(.*)<\/a>/U",$arr,$gr)){
				$this->pm = $n;
				//echo $arr;
				$grade = $gr;
			}
			$n = $n + 1;

		}
		//echo $grade[1];
		//echo $nn."\n";
		//echo $grade[1];
		return $grade[1];
	}

	public function bfb(){

		$bfb = $this->pm/$this->num;
		$bfb = $bfb*100;
		return (int)$bfb."%";
	}

}


//$User = new curl('z.z09' , '940401' , '201230644099');
//$zz = $User->loginyes;
//echo $zz;
//$grade = $User->getGrade('201230644099','2012');


?>

 