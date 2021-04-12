
<?php
/*
To install and compile the WiringOP library :

mkdir downloads
cd downloads
git clone https://github.com/zhaolei/WiringOP.git -b h3
cd WiringOP/
sudo ./build


Make a test :

gpio readall


source: https://forum.armbian.com/topic/7067-orange-pi-pc-how-to-use-gpio-for-push-buttons-tutorial/
*/
	$pin=29;
  exec("gpio mode {$pin} in",$out, $res);

	while(1){
    $out = '';
    $res = '';

    exec("gpio read {$pin}",$out, $res);
    if( $out[0] != 1 ) {
      var_dump($out[0]."<-");
      file_put_contents('empty.txt',json_encode($out[0])."voltage on 29 pin not exists->".date("d.m.Y H:i:s")."\n",FILE_APPEND);
      `wall "voltage not exist on gpio. if voltage not turn on - system will be shutdown" -n`;
      sleep(300);
      $out='';
      exec("gpio read {$pin}",$out, $res);
        if( $out[0] != 1 ) {
        file_put_contents('empty.txt','shutdown ->'.date("d.m.Y H:i:s"),FILE_APPEND);
				exec("shutdown now");
      }
    }
		sleep(1);
	}
?>
