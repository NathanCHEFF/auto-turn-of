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

/* new */
$out_p = 25;	// pin GPIO on board for control relay
$inp_p = 24;	// pin check voltage on input supply

exec("gpio mode {$inp_p} in",$out, $res);
exec("gpio mode {$out_p} out",$out, $res);
exec("gpio write {$out_p} 1",$out, $res);    // podhvat rele

while(1){
  $out = '';
  $res = '';
  exec("gpio read {$inp_p}",$out, $res);


  // if level on input is  LOW
  if( $out[0] != 1 ) {
    file_put_contents('avary.log',json_encode($out[0])."voltage on 29 pin not exists->".date("d.m.Y H:i:s")."\n",FILE_APPEND);
    `wall "voltage not exist on gpio. if voltage not turn on - system will be shutdown" -n`;
		
    sleep(300);
		
    $out='';
    exec("gpio read {$pin}",$out, $res);
		
    if( $out[0] != 1 ) {
      file_put_contents('empty.txt','shutdown ->'.date("d.m.Y H:i:s"),FILE_APPEND);
      exec("shutdown now");
    }	
  }
}

/* end */

?>
