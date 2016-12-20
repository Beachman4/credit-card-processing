<?php
namespace Finance;
class Program
{

    public $database;

    public function __construct()
    {
        $this->database = new Database();
    }


    /**
     * Master Run - get the file and pass it to the parse method and then call output
     */
    public function run()
    {
        global $argv;
        if (count($argv) > 1) {
            if (file_exists($argv[1])) {
                $file = fopen($argv[1], 'r');
                $this->parse($file);
            }
        } elseif ($file = fopen('php://stdin', 'r')) {
            $this->parse($file);
        }
        $this->output();
    }

    /**
     * @param $file
     * Parse the file and call the method according to the action
     */
    public function parse($file)
    {
        while(($line = fgets($file)) !== false) {
            $array = explode(' ', $line);
            //Trim whitespace after exploding, can't trim the line because it will remove spaces between
            for($i = 0; $i < count($array); $i++) {
                $array[$i] = trim($array[$i]);
            }
            $this->database->{strtolower($array[0])}($array);
        }
    }

    /**
     *  Generate the output and print it
     */
    public function output()
    {
        $cards = $this->database->getCards();
        usort($cards, function($a, $b) {
            return strcmp($a->name, $b->name);
        });
        foreach($cards as $card) {
            $output = "";
            if ($card->error) {
                $output .= "{$card->name}: error";
            } else {
                $output .= "{$card->name}: $".$card->balance;
            }
            echo $output . "\n";
        }
    }
}