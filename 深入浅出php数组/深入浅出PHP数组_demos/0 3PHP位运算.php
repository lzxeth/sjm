<?php
echo 10%8;
echo '<br/>';
echo 10&7;die;


function multiple_choice($s)
{
    $options = array('A'=>1,'B'=>2,'C'=>4,'D'=>8);
    foreach($options as $key=>$value){
        if($value&$s){
            echo $key;
        }
    }
}

multiple_choice(5);


