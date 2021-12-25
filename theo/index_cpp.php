<?php
//proses
$lang = "cpp";
$command1 = "g++ -lm -std=c++0x inputPeserta.cpp -o compilePeserta"; // for compile
$command2 = "time compilePeserta <inputSoal.in> outputPemain.out";

echo "Com1 : " . $command1 . "<br>";
echo "Com2 : " . $command2 . "<br>";

$result = "Accepted";
$runtime = 0;

$descriptorspec = array(
    0 => array("pipe", "r"), // stdin is a pipe that the child will read from
    1 => array("pipe", "w"), // stdout is a pipe that the child will write to
    2 => array("pipe", "w") //stderr is a pipe that the child will write to
);
echo "Descriptor:";
print_r($descriptorspec);
echo "<br/>";

$cwd = '/var/www/html/compiler/theo/asset'; //The initial working dir for the command
$process = proc_open($command1, $descriptorspec, $pipes, $cwd);

if (is_resource($process)) {

    $out = stream_get_contents($pipes[1]);
    echo "1." . $out . "<br />";
    fclose($pipes[1]);

    $out = stream_get_contents($pipes[2]);
    echo "2." . $out . "<br />";
    fclose($pipes[2]);

    $return_value = proc_close($process);
    if ($return_value != 0)
        $result = 'Compile Error';
}


//Check time limit
if ($result == "Accepted") {
    $memory_limit = 64 * 1024; //64MB
    $time_limit = 30; //15second

    $process = proc_open('bash -c "ulimit -St ' . $time_limit . ' -Sm ' . $memory_limit . '; ' . $command2 . '"', $descriptorspec, $pipes, $cwd);
    // $process = proc_open($command2, $descriptorspec, $pipes, $cwd);
    echo "<br />";
    if (is_resource($process)) {
        $stream = stream_get_contents($pipes[2]);
        echo "Stream : " . $stream;

        fclose($pipes[2]);
        $return_value = proc_close($process);

        $timelimitstring = "CPU time limit exceeded";
        $memorylimitstring = "Memory size limit exceeded";

        if (strstr($stream, $timelimitstring) != null) {
            $result = 'Time Limit Exceeded';
        }

        if (strstr($stream, $memorylimitstring) != null) {
            $result = "Memory Limit Exceeded";
        }

        if ($result == "Accepted" && substr($stream, 1, 4) != "real") {
            $result = "Run Time Error";
        }

        $str = strstr($stream, "real");
        $im = strpos($str, "m");
        $is = strpos($str, "s");
        $m = substr($str, 5, $im - 5);
        $s = substr($str, $im + 1, $is - $im - 1);
        $runtime = number_format($m * 60 + $s, 3);
    }
}


//jika tetap masih AC(uda lewat TL), harus dicek sama tidak dengan output yang diinginkan
if ($result == "Accepted") {
    $process = proc_open('cmp outputPemain.out outputSoal.out', $descriptorspec, $pipes, $cwd);

    if (is_resource($process)) {
        $return_value = proc_close($process);
        if ($return_value != 0)
            $result = "Wrong Answer";
    }
}

echo "result : " . $result . "<br />";
echo "runtime : " . $runtime . "<br />";
