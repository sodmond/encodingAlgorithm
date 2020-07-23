<?php

declare(strict_types=1);

/**
 * Class CompositeEncodingAlgorithm
 */
class CompositeEncodingAlgorithm implements EncodingAlgorithm
{
    /**
     * @var EncodingAlgorithm[]
     */
    private $algorithms;

    /**
     * CompositeEncodingAlgorithm constructor
     */
    public function __construct()
    {
        //$this->algorithms = [];
    }

    /**
     * @param EncodingAlgorithm $algorithm
     */
    public function add(EncodingAlgorithm $algorithm): void
    {
        $this->algorithms = $algorithm;
    }

    /**
     * Encodes text using multiple Encoders (in orders encoders were added)
     *
     * @param string $text
     * @return string
     */
    public function encode(string $text): string
    {
        /**
         * @todo: Implement it
         */
        $algo = $this->algorithms;
        $output = "text encoded twice";
        if( $algo != null){
            $classname = get_class($algo);
            if($classname == "OffsetEncodingAlgorithm"){
                $new = new $algo($algo->offset);
                $output = $new->encode($text);
            }
            else if($classname == "SubstitutionEncodingAlgorithm"){
                $new = new $algo($algo->substitutions);
                $output = $new->encode($text);
            }
            return $output;
        }
        throw new Exception("Empty algorithm");
        
    }
}
