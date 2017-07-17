<?php 

//
// Other functions
//

class GKTemplateUtilities {
    //
    private $parent;
    //
    function __construct($parent) {
    	$this->parent = $parent;
    }
    //
    public function overrideArrayParse($data, $duplicates = false) {
        $results = array();
        // for duplicates we need to store keys and values separately
        if($duplicates) {
        	$results = array(
        		"keys" => array(),
        		"values" => array()
        	);
        }
        
        // exploding settings
        $exploded_data = explode("\r\n", $data);
        // parsing
        for ($i = 0; $i < count($exploded_data); $i++) {
            if(isset($exploded_data[$i])) {
	            // preparing pair key-value
	            $pair = explode('=', trim($exploded_data[$i]));
	            // extracting key and value from pair
	            if(count($pair) == 2){
	            	$key = $pair[0];
	            	$value = $pair[1];
	            	// checking existing of key in config array
	            	if (!$duplicates && !isset($results[$key])) {
	            	    // setting value for key
	            	    $results[$key] = $value;
	            	} elseif($duplicates) {
	            		// storing keys and values separately
	            		$results['keys'][] = $key;
	            		$results['values'][] = $value;
	            	}
	            }
            }
        }

        // return results array
        return $results;
    }
}

// EOF