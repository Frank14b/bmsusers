<?php

declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Po component
 */
class PoComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function passSecurity($pass)
    {
        return sha1('#!Frank@2020' . $pass);
    }

    function WordWrap(&$text, $maxwidth)
    {
        $text = trim($text);
        if ($text === '')
            return 0;
        $space = $this->GetStringWidth(' ');
        $lines = explode("\n", $text);
        $text = '';
        $count = 0;

        foreach ($lines as $line) {
            $words = preg_split('/ +/', $line);
            $width = 0;

            foreach ($words as $word) {
                $wordwidth = $this->GetStringWidth($word);
                if ($wordwidth > $maxwidth) {
                    // Word is too long, we cut it
                    for ($i = 0; $i < strlen($word); $i++) {
                        $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
                        if ($width + $wordwidth <= $maxwidth) {
                            $width += $wordwidth;
                            $text .= substr($word, $i, 1);
                        } else {
                            $width = $wordwidth;
                            $text = rtrim($text) . "\n" . substr($word, $i, 1);
                            $count++;
                        }
                    }
                } elseif ($width + $wordwidth <= $maxwidth) {
                    $width += $wordwidth + $space;
                    $text .= $word . ' ';
                } else {
                    $width = $wordwidth + $space;
                    $text = rtrim($text) . "\n" . $word . ' ';
                    $count++;
                }
            }
            $text = rtrim($text) . "\n";
            $count++;
        }
        $text = rtrim($text);
        return $count;
    }


    public function convertBase64ToImage($path, $base64, $name)
    {
        $image_parts = explode(";base64,", $base64);
        //$image_type_aux = explode("image/", $image_parts[0]);
        //$image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $name . '.jpg';
        file_put_contents($path . $file, $image_base64);
    }


    function getNumPagesPdf($filepath)
    {
        $fp = @fopen(preg_replace("/\[(.*?)\]/i", "", $filepath), "r");
        $max = 0;
        if (!$fp) {
            return "Could not open file: $filepath";
        } else {
            while (!@feof($fp)) {
                $line = @fgets($fp, 255);
                if (preg_match('/\/Count [0-9]+/', $line, $matches)) {
                    preg_match('/[0-9]+/', $matches[0], $matches2);
                    if ($max < $matches2[0]) {
                        $max = trim($matches2[0]);
                        break;
                    }
                }
            }
            @fclose($fp);
        }

        return $max;
    }


    function pdf2text($filename)
    {

        // Read the data from pdf file
        $infile = @file_get_contents($filename, FILE_BINARY);
        if (empty($infile))
            return "";

        // Get all text data.
        $transformations = array();
        $texts = array();

        // Get the list of all objects.
        preg_match_all("#obj(.*)endobj#ismU", $infile, $objects);
        $objects = @$objects[1];

        // Select objects with streams.
        for ($i = 0; $i < count($objects); $i++) {
            $currentObject = $objects[$i];

            // Check if an object includes data stream.
            if (preg_match("#stream(.*)endstream#ismU", $currentObject, $stream)) {
                $stream = ltrim($stream[1]);

                // Check object parameters and look for text data. 
                $options = getObjectOptions($currentObject);
                if (!(empty($options["Length1"]) && empty($options["Type"]) && empty($options["Subtype"])))
                    continue;

                // So, we have text data. Decode it.
                $data = getDecodedStream($stream, $options);
                if (strlen($data)) {
                    if (preg_match_all("#BT(.*)ET#ismU", $data, $textContainers)) {
                        $textContainers = @$textContainers[1];
                        getDirtyTexts($texts, $textContainers);
                    } else
                        getCharTransformations($transformations, $data);
                }
            }
        }

        // Analyze text blocks taking into account character transformations and return results. 
        return getTextUsingTransformations($texts, $transformations);
    }


    /**
     * @param $interval
     * @param $datefrom
     * @param $dateto
     * @param bool $using_timestamps
     * @return false|float|int|string
     */
    public function datediff($interval, $datefrom, $dateto, $using_timestamps = false)
    {
        /*
    $interval can be:
    yyyy - Number of full years
    q    - Number of full quarters
    m    - Number of full months
    y    - Difference between day numbers
           (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
    d    - Number of full days
    w    - Number of full weekdays
    ww   - Number of full weeks
    h    - Number of full hours
    n    - Number of full minutes
    s    - Number of full seconds (default)
    */

        if (!$using_timestamps) {
            $datefrom = strtotime($datefrom, 0);
            $dateto   = strtotime($dateto, 0);
        }

        $difference        = $dateto - $datefrom; // Difference in seconds
        $months_difference = 0;

        switch ($interval) {
            case 'yyyy': // Number of full years
                $years_difference = floor($difference / 31536000);
                if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom) + $years_difference) > $dateto) {
                    $years_difference--;
                }

                if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto) - ($years_difference + 1)) > $datefrom) {
                    $years_difference++;
                }

                $datediff = $years_difference;
                break;

            case "q": // Number of full quarters
                $quarters_difference = floor($difference / 8035200);

                while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($quarters_difference * 3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                    $months_difference++;
                }

                $quarters_difference--;
                $datediff = $quarters_difference;
                break;

            case "m": // Number of full months
                $months_difference = floor($difference / 2678400);

                while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                    $months_difference++;
                }

                $months_difference--;

                $datediff = $months_difference;
                break;

            case 'y': // Difference between day numbers
                $datediff = date("z", $dateto) - date("z", $datefrom);
                break;

            case "d": // Number of full days
                $datediff = floor($difference / 86400);
                break;

            case "w": // Number of full weekdays
                $days_difference  = floor($difference / 86400);
                $weeks_difference = floor($days_difference / 7); // Complete weeks
                $first_day        = date("w", $datefrom);
                $days_remainder   = floor($days_difference % 7);
                $odd_days         = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?

                if ($odd_days > 7) { // Sunday
                    $days_remainder--;
                }

                if ($odd_days > 6) { // Saturday
                    $days_remainder--;
                }

                $datediff = ($weeks_difference * 5) + $days_remainder;
                break;

            case "ww": // Number of full weeks
                $datediff = floor($difference / 604800);
                break;

            case "h": // Number of full hours
                $datediff = floor($difference / 3600);
                break;

            case "n": // Number of full minutes
                $datediff = floor($difference / 60);
                break;

            default: // Number of full seconds (default)
                $datediff = $difference;
                break;
        }

        return $datediff;
    }

    function translateToWords($number, $tr = 'en')
    {
        /*****
         * A recursive function to turn digits into words
         * Numbers must be integers from -999,999,999,999 to 999,999,999,999 inclussive.    
         *
         *  (C) 2010 Peter Ajtai
         *    This program is free software: you can redistribute it and/or modify
         *    it under the terms of the GNU General Public License as published by
         *    the Free Software Foundation, either version 3 of the License, or
         *    (at your option) any later version.
         *
         *    This program is distributed in the hope that it will be useful,
         *    but WITHOUT ANY WARRANTY; without even the implied warranty of
         *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
         *    GNU General Public License for more details.
         *
         *    See the GNU General Public License: <http://www.gnu.org/licenses/>.
         *
         */
        // zero is a special case, it cause problems even with typecasting if we don't deal with it here
        $max_size = pow(10, 18);
        if (!$number) return "zero";
        if (is_int($number) && $number < abs($max_size)) {
            $suffix = $prefix = '';

            switch ($number) {
                    // set up some rules for converting digits to words
                case $number < 0:
                    $prefix = "negative";
                    $suffix = $this->translateToWords(-1 * $number);
                    $string = $prefix . " " . $suffix;
                    break;
                case 1:
                    $string = "one";
                    break;
                case 2:
                    $string = "two";
                    break;
                case 3:
                    $string = "three";
                    break;
                case 4:
                    $string = "four";
                    break;
                case 5:
                    $string = "five";
                    break;
                case 6:
                    $string = "six";
                    break;
                case 7:
                    $string = "seven";
                    break;
                case 8:
                    $string = "eight";
                    break;
                case 9:
                    $string = "nine";
                    break;
                case 10:
                    $string = "ten";
                    break;
                case 11:
                    $string = "eleven";
                    break;
                case 12:
                    $string = "twelve";
                    break;
                case 13:
                    $string = "thirteen";
                    break;
                    // fourteen handled later
                case 15:
                    $string = "fifteen";
                    break;
                case $number < 20:
                    $string = $this->translateToWords($number % 10);
                    // eighteen only has one "t"
                    if ($number == 18) {
                        $suffix = "een";
                    } else {
                        $suffix = "teen";
                    }
                    $string .= $suffix;
                    break;
                case 20:
                    $string = "twenty";
                    break;
                case 30:
                    $string = "thirty";
                    break;
                case 40:
                    $string = "forty";
                    break;
                case 50:
                    $string = "fifty";
                    break;
                case 60:
                    $string = "sixty";
                    break;
                case 70:
                    $string = "seventy";
                    break;
                case 80:
                    $string = "eighty";
                    break;
                case 90:
                    $string = "ninety";
                    break;
                case $number < 100:
                    $prefix = $this->translateToWords($number - $number % 10);
                    $suffix = $this->translateToWords($number % 10);
                    $string = $prefix . "-" . $suffix;
                    break;
                    // handles all number 100 to 999
                case $number < pow(10, 3):
                    // floor return a float not an integer
                    $prefix = $this->translateToWords(intval(floor($number / pow(10, 2)))) . " hundred";
                    if ($number % pow(10, 2)) $suffix = " and " . $this->translateToWords($number % pow(10, 2));
                    $string = $prefix . $suffix;
                    break;
                case $number < pow(10, 6):
                    // floor return a float not an integer
                    $prefix = $this->translateToWords(intval(floor($number / pow(10, 3)))) . " thousand";
                    if ($number % pow(10, 3)) $suffix = $this->translateToWords($number % pow(10, 3));
                    $string = $prefix . " " . $suffix;
                    break;
                case $number < pow(10, 9):
                    // floor return a float not an integer
                    $prefix = $this->translateToWords(intval(floor($number / pow(10, 6)))) . " million";
                    if ($number % pow(10, 6)) $suffix = $this->translateToWords($number % pow(10, 6));
                    $string = $prefix . " " . $suffix;
                    break;
                case $number < pow(10, 12):
                    // floor return a float not an integer
                    $prefix = $this->translateToWords(intval(floor($number / pow(10, 9)))) . " billion";
                    if ($number % pow(10, 9)) $suffix = $this->translateToWords($number % pow(10, 9));
                    $string = $prefix . " " . $suffix;
                    break;
                case $number < pow(10, 15):
                    // floor return a float not an integer
                    $prefix = $this->translateToWords(intval(floor($number / pow(10, 12)))) . " trillion";
                    if ($number % pow(10, 12)) $suffix = $this->translateToWords($number % pow(10, 12));
                    $string = $prefix . " " . $suffix;
                    break;
                    // Be careful not to pass default formatted numbers in the quadrillions+ into this function
                    // Default formatting is float and causes errors
                case $number < pow(10, 18):
                    // floor return a float not an integer
                    $prefix = $this->translateToWords(intval(floor($number / pow(10, 15)))) . " quadrillion";
                    if ($number % pow(10, 15)) $suffix = $this->translateToWords($number % pow(10, 15));
                    $string = $prefix . " " . $suffix;
                    break;
            }
        } else {
            echo "ERROR with - $number<br/> Number must be an integer between -" . number_format($max_size, 0, ".", ",") . " and " . number_format($max_size, 0, ".", ",") . " exclussive.";
        }

        if ($tr == 'fr') {
            return $this->translateamounttofr($string);
        } else {
            return $string;
        }
    }

    public function translateamounttofr($amount)
    {
        $words = [
            'ten' => 'dix',
            'eleven' => 'onze',
            'twelve' => 'douze',
            'thirteen' => 'treize',
            'fourteen' => 'quatorze',
            'fifteen' => 'quinze',
            'sixteen' => 'seize',
            'seventeen' => 'dix-sept',
            'eighteen' => 'dix-huit',
            'nineteen' => 'dix-neuf',

            'seventy-five' => 'soixante quinze',
            'seventy-one' => 'soixante onze',
            'seventy-two' => 'soixante douze',
            'seventy-tree' => 'soixante treize',
            'seventy-four' => 'soixante quatorze',
            'seventy-six' => 'soixante seize',
            'seventy-seven' => 'soixante dix-sept',
            'seventy-height' => 'soixante dix-huit',
            'seventy-nine' => 'soixante dix-neuf',

            'twenty' => 'vingt',
            'thirty' => 'trente',
            'forty' => 'quarante',
            'fifty' => 'cinquante',
            'sixty' => 'soixante',
            'seventy' => 'soixante-dix',
            'eighty' => 'quatre-vingt',
            'ninety' => 'quatre-vingt-dix',

            'one hundred' => 'cent',
            'two hundred' => 'deux cent',
            'three hundred' => 'trois cent',
            'four hundred' => 'quatre cent',
            'five hundred' => 'cinq cent',
            'six hundred' => 'six cent',
            'seven hundred' => 'sept cent',
            'eight hundred' => 'huit cent',
            'nine hundred' => 'neuf cent',
            'teen hundred' => 'dix cent',

            'one thousand' => 'mille',
            'two thousand' => 'deux mille',
            'three thousand' => 'trois mille',
            'four thousand' => 'quatre mille',
            'five thousand' => 'cinq mille',
            'six thousand' => 'six mille',
            'seven thousand' => 'sept mille',
            'eight thousand' => 'huit mille',
            'nine thousand' => 'neuf mille',
            'teen thousand' => 'dix mille',

            'one million' => 'un million',
            'two million' => 'deux million',
            'three million' => 'trois million',
            'four million' => 'quatre million',
            'five million' => 'cinq million',
            'six million' => 'six million',
            'seven million' => 'sept million',
            'eight million' => 'huit million',
            'nine million' => 'neuf million',
            'teen million' => 'dix million',

            'one billion' => 'un milliard',
            'two billion' => 'deux milliard',
            'three billion' => 'trois milliard',
            'four billion' => 'quatre milliard',
            'five billion' => 'cinq milliard',
            'six billion' => 'six milliard',
            'seven billion' => 'sept milliard',
            'eight billion' => 'huit milliard',
            'nine billion' => 'neuf milliard',
            'teen billion' => 'dix milliard',

            'one trillion' => 'un milliard de milliards',
            'thousand' => 'mille',
            'billion' => 'milliard',
            'million' => 'million',
            'hundred' => 'cent',

            'one' => 'un',
            'two' => 'deux',
            'three' => 'trois',
            'four' => 'quatre',
            'five' => 'cint',
            'six' => 'six',
            'seven' => 'sept',
            'eight' => 'huit',
            'nine' => 'neuf',
            'and' => '',
            //   'quadrillion' => 'mille trilliard',
        ];

        foreach ($words as $index => $key) {
            $amount = str_replace($index, $key, $amount);
        }

        return $amount;
    }

    public function uncompress($srcName, $dstName)
    {
        $sfp = gzopen($srcName, "rb");
        $fp = fopen($dstName, "w");

        while ($string = gzread($sfp, 4096)) {
            fwrite($fp, $string, strlen($string));
        }
        gzclose($sfp);
        fclose($fp);
    }

    public function zipextract($src, $target = ".")
    {
        // $zip = new ZipArchive();
        // if ($zip->open($src, ZipArchive::CREATE) == TRUE) {
        //     $zip->extractTo($target);
        //     $zip->close();

        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function delTree($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    public function full_copy($source, $target)
    {
        if (is_dir($source)) {
            @mkdir($target);
            $d = dir($source);
            while (FALSE !== ($entry = $d->read())) {
                if ($entry == '.' || $entry == '..') {
                    continue;
                }
                $Entry = $source . '/' . $entry;
                if (is_dir($Entry)) {
                    $this->full_copy($Entry, $target . '/' . $entry);
                    continue;
                }
                copy($Entry, $target . '/' . $entry);
            }

            $d->close();
        } else {
            copy($source, $target);
        }
    }

    public function roundUpToAny($n, $x = 25)
    {
        return (round($n) % $x === 0) ? round($n) : round(($n + $x / 2) / $x) * $x;
    }
}
