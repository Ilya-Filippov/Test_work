<?$fibonachi = ["0","1"];
for ($i=0; count($fibonachi)<64; $i++){
    $j = $i + 1;
    array_push($fibonachi, $fibonachi[$i] + $fibonachi[$j]);
}?>
<?foreach ($fibonachi as $num):?>
    <p><?=$num?></p>
<?endforeach;?>
