<?php

class utilities {

    public static function getDataFromCSV($file, $path)
    {
        $dataArray = array();
        $i = 0;
        
        if (!file_exists($path . $file))
        {
            // echo 'file: ' . $path.$file . ' not found.<br>';
            return array('menuItems' => null);
        }

        $open = fopen($path . $file, 'r');
        
        while(($data = fgetcsv($open, 1000, ',')) !== false)
        {

            $j = 0;
            $newArray = array();

            // no dropdown/accordian
            if (count($data) % 2 == 0)
            {
                
                while($j < count($data))
                {

                    $first = $data[$j++];
                    $second = $data[$j++];

                    $newArray[$first] = $second;
                   
                    // echo 'adding: ' . $first . ' => ' . $second . '<br>';
                }
                array_push($dataArray, $newArray);

            }
            else
            {

                while($j < count($data)-1)
                {
                    // array_push($newArray, [$data[$j++]=>$data[$j++]]);

                    $first = $data[$j++];
                    $second = $data[$j++];

                    $newArray[$first] = $second;

                    // echo 'adding: ' . $first . ' => ' . $second . '<br>';
                    
                }

                $subArray = self::getDataFromCSV($data[$j], $path);
        
                $newArray['menuItems'] = $subArray;

                array_push($dataArray, $newArray);

                // echo var_dump($dataArray) . '<br>';
            }
        
            $i++;
        
        }

        // echo '<br><br><br>' . var_dump($dataArray) . '<br>';
    
        return $dataArray;
    }


    public static function switchSlash($path, $switch=true)
    {
        if ($switch)
        {
            return str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
        }
        else
        {
            return str_replace(array('/', '\\'), '/', $path);
        }
    }

    public static function consoleLog($message, $data=[])
    {
        // echo $message;

        array_unshift($data, $message);
        echo "<script>console.log('". json_encode($data) ."');</script>";
    }
    
}