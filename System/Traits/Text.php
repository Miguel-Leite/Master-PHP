<?php


namespace Master\Traits;

trait Text {

    
    /**
     * Method abridgeText
     *
     * @param string $text [explicite description]
     * @param int $limit [explicite description]
     * @param $continue $continue [explicite description]
     *
     * @return string
     */
    public static function abridgeText(string $text, int $limit, $continue = null):string
    {
        $text = strip_tags(trim($text));

        $array = explode(' ', $text);

        $totalWord = count($array);

        $textAbriged = implode(' ', array_slice($array,0,$limit));

        $continue = (empty($continue) ? ' ...' : ''.$continue);

        $result = ($limit < $totalWord ? $textAbriged . $continue : $text);

        return $result;
    }

}