<?php

function badWords($input)
	{
	$badwords = array('go roll off', 'roll');
	$input = '<p>Mary is a <strong>b</strong>******. </p>';

$arr = explode(' ', $input);

foreach($arr as $key => $word)
{
    $word = str_replace('.', '', strip_tags($word));
    if(in_array($word, $badwords))
    {
        $arr[$key] = '*****';
    }
}

$output = implode(' ', $arr);
echo $output;