<?php
$result = "Accepted";
$runtime = 0;

//proses
$lang = "python";
$command2 = "time python3 submission/python.py soal/cpp.in";

$descriptorspec = array(
    0 => array("pipe", "r"), // stdin is a pipe that the child will read from
    1 => array("pipe", "w"), // stdout is a pipe that the child will write to
    2 => array("pipe", "w") //stderr is a pipe that the child will write to
);

$memory_limit = 64 * 1024; //64MB
$time_limit = 120; //15second

$process = proc_open("bash -c 'ulimit -St $time_limit -Sm $memory_limit ; $command2'", $descriptorspec, $pipes);

if (is_resource($process)) {
    $stream = stream_get_contents($pipes[2]);
    echo "Stream : " . $stream . "<br>";
    fclose($pipes[2]);

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

    if ($result == "Accepted") {
        // Get output
        $streamOutput = stream_get_contents($pipes[1]);
        echo "Output ".$streamOutput . "<br>";
        fclose($pipes[1]);

        $output = fopen("temp/result.out", "w");
        fwrite($output, $streamOutput);
        fclose($output);
    }

    
    $return_value = proc_close($process);

    $str = strstr($stream, "real");
    $str = str_replace(",", ".", $str);
    $im = strpos($str, "m");
    $is = strpos($str, "s");
    $m = substr($str, 5, $im - 5);
    $s = substr($str, $im + 1, $is - $im - 1);
    $runtime = number_format($m * 60 + $s, 3);
}

//jika tetap masih AC(uda lewat TL), harus dicek sama tidak dengan output yang diinginkan
if ($result == "Accepted") {
    $process = proc_open('cmp temp/result.out soal/cpp.out', $descriptorspec, $pipes);

    if (is_resource($process)) {
        $return_value = proc_close($process);
        if ($return_value != 0)
            $result = "Wrong Answer";
    }
}

echo "result : " . $result . "<br />";
echo "runtime : " . $runtime . "<br />";

// shell_exec('rm -r temp/*');
