<?php

declare(strict_types=1);

/**
 * Class OffsetEncodingAlgorithm
 */
class OffsetEncodingAlgorithm implements EncodingAlgorithm
{
    /**
     * Lookup string
     */
    public const CHARACTERS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * @var int
     */
    public $offset;

    /**
     * @param int $offset
     */
    public function __construct(int $offset = 13)
    {
        if( $offset < 0 ){
            throw new InvalidArgumentException("Invalid offset");
        }
        $this->offset = $offset;
    }

    /**
     * Encodes text by shifting each character (existing in the lookup string) by an offset (provided in the constructor)
     * Examples:
     *      offset = 1, input = "a", output = "b"
     *      offset = 2, input = "z", output = "B"
     *      offset = 1, input = "Z", output = "a"
     *
     * @param string $text
     * @return string
     */
    public function encode(string $text): string
    {
        /**
         * @todo: Implement it
         */
        $chars = $this::CHARACTERS;
        $output = array();
        if( $text != "" ){
            $input = str_split($text);
            foreach( $input as $txt ){
                if( $txt == " " ){
                    $output[] = " ";
                }
                else if($txt == "."){
                    $output[] = ".";
                }
                else{
                    $offset = strpos($chars, $txt) + $this->offset;
                    if( $offset > (strlen($chars) - 1) ){
                        $offset = $offset - strlen($chars);
                    }
                    $output[] = $chars[$offset];
                }
            }
            $result = implode("", $output);
            return $result;
        }
        return "";
    }
}
