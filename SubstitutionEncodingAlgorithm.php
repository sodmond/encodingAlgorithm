<?php

declare(strict_types=1);

/**
 * Class SubstitutionEncodingAlgorithm
 */
class SubstitutionEncodingAlgorithm implements EncodingAlgorithm
{
    /**
     * @var array
     */
    public $substitutions;

    /**
     * SubstitutionEncodingAlgorithm constructor.
     * @param $substitutions
     */
    public function __construct(array $substitutions)
    {
        $this->substitutions = $substitutions;
    }
    public function checkCase($input, $sub){
        if(ctype_upper($input)){
            return strtoupper($sub);
        }
        return $sub;
    }
    /**
     * Encodes text by substituting character with another one provided in the pair.
     * For example pair "ab" defines all "a" chars will be replaced with "b" and all "b" chars will be replaced with "a"
     * Examples:
     *      substitutions = ["ab"], input = "aabbcc", output = "bbaacc"
     *      substitutions = ["ab", "cd"], input = "adam", output = "bcbm"
     *
     * @param string $text
     * @return string
     */
    public function encode(string $text): string
    {
        /**
         * @todo: Implement it
         */
        
        $output = array();
        $input = str_split($text);
        $swapA = array();
        $swapB = array();
        foreach( $this->substitutions as $subst ){
            if( strlen($subst) <= 1 || strlen($subst) > 2 ){
                throw new InvalidArgumentException('Invalid Substitution');
            }
            if( $subst[0] == $subst[1] ){
                throw new InvalidArgumentException('Invalid substitution');
            }
            $swapA[] = $subst[0];
            $swapB[] = $subst[1];
        }
        $swap0 = implode("", $swapA);
        $swap1 = implode("", $swapB);
        foreach( $input as $txt ){
            if($txt == ""){ throw new InvalidArgumentException("Input is empty"); }
            $txt0 = strpos($swap0, strtolower($txt));
            $txt1 = strpos($swap1, strtolower($txt));
            if( $txt0 != "" ){
                $output[] = $this->checkCase($txt, $swap1[intval($txt0)]);
                continue;
            } else if( $txt1 != "" ){
                $output[] = $this->checkCase($txt, $swap0[intval($txt1)]);
                continue;
            } else if( $txt0 === 0 ){
                $output[] = $this->checkCase($txt, $swap1[0]);
                continue;
            } else if( $txt1 === 0 ){
                $output[] = $this->checkCase($txt, $swap0[0]);
                continue;
            }
            $output[] = $txt;
            
        }
        $result = implode("", $output);
        return $result;
        
    }
}
