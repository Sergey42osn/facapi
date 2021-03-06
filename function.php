<?php

    function getHome($url){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0" );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        $res = curl_exec($ch);

        curl_close($ch);

        return $res;

    }


    function writeImage($html, $folder)
    {
        $images = $html->find('img');

        foreach($images as $k => $img){

            //echo $k.'<br>';
            $path_info = pathinfo($img->src);
            $name_img = $path_info['basename'];
            $path_img = $folder.'/'.$name_img;

            if (!file_exists($path_img)) {

                $ch = curl_init('https://tandyr.pro/'.$img->src);
                $fp = fopen($folder.'/'.$name_img, 'w');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                //curl_setopt($ch,CURLOPT_TIMEOUT,20);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                $img = curl_exec($ch);
            
            }

        }

        return $img;

    }

    function writeHrefToFile($href){

            $file = 'sitemap.txt';
            // Открываем файл для получения существующего содержимого
            $current = file_get_contents($file);
            // Добавляем нового человека в файл
            //$current .= "$href;$product_name;$price_prod\n";
            $current = "$href\n";
            // Пишем содержимое обратно в файл
            $res = file_put_contents($file, $current,FILE_APPEND);

            echo $res.'<br>';

    }

    ?>