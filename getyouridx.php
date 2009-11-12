<?php

/*  Copyright 2009  GetYourIDX (email : info@getyouridx.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Array of Property Types
 */
$IDX_PROPERTYTYPES = array(
    1 => 'Houses',
    2 => 'Apartments',
    3 => 'Land',
    4 => 'Shared Ownership',
    5 => 'Other'
);

/**
 * Reverse Array of property Types
 */
$IDX_PROPERTYTYPES_REVERSE = array(
    'Single Family' => 1,
    'Condo/Townhouse' => 2,
    'Partial Ownership' => 3,
    'Mobile Home' => 4,
    'Forest Service Cabin' => 5
);
    
/**
 * The IDXException class represents exceptions raised.
 *
 * @category   IDX
 * @package    IDX
 * @copyright  Copyright (c) GetYourIDX.com. (http://www.getyouridx.com)
 * @license    GNU General Public License
 */
class IDXException extends Exception
{}


/**
 * The IDXFilter interface represents classes used to specify IDX data result filters.
 *
 * @category   IDX
 * @package    IDX
 * @copyright  Copyright (c) GetYourIDX.com. (http://www.getyouridx.com)
 * @license    GNU General Public License
 */
interface IDXFilter {
    public function toString();
}

/**
 * The IDXFilter_Limit interface specifies a filter to limit the result.
 *
 * @category   IDX
 * @package    IDX
 * @copyright  Copyright (c) GetYourIDX.com. (http://www.getyouridx.com)
 * @license    GNU General Public License
 */
class IDXFilter_Limit implements IDXFilter {
    
    public $limit;
    
    function __construct($limit) {
        $this->limit = $limit;
    }
    
    function toString() {
        return '&limit=' . urlencode($this->limit); 
    }
    
}
    
/**
 * The IDXFilter_Format interface specifies a filter to format the result.
 *
 * @category   IDX
 * @package    IDX
 * @copyright  Copyright (c) GetYourIDX.com. (http://www.getyouridx.com)
 * @license    GNU General Public License
 */
class IDXFilter_Format implements IDXFilter {
    
    public $format;
    
    function __construct($format) {
        $this->format = $format;
    }
    
    function toString() {
        return '&format=' . urlencode($this->format); 
    }
    
}
    
/**
 * The IDXFilter_Range interface specifies a filter based a range.
 *
 * @category   IDX
 * @package    IDX
 * @copyright  Copyright (c) GetYourIDX.com. (http://www.getyouridx.com)
 * @license    GNU General Public License
 */
class IDXFilter_Range implements IDXFilter {
    
    public $field;
    
    public $min;
    
    public $max;
    
    function __construct($field, $min, $max) {
        $this->field = $field;
        $this->min = $min;
        $this->max = $max;
    }
    
    function toString() {
        return 'fgt_' . urlencode($this->field) . '=' . urlencode($this->min-1) . '&flt_' . urlencode($this->field) . '=' . urlencode($this->max+1); 
    }
    
}
    
/**
 * The IDXFilter_Offset interface specifies a filter based a offset.
 *
 * @category   IDX
 * @package    IDX
 * @copyright  Copyright (c) GetYourIDX.com. (http://www.getyouridx.com)
 * @license    GNU General Public License
 */
class IDXFilter_Offset implements IDXFilter {
    
    public $offset;
    
    function __construct($offset) {
        $this->offset = $offset;
    }
    
    function toString() {
        return 'offset=' . urlencode($this->offset); 
    }
    
}

/**
 * The IDXFilter_Sort class specifies a filter on sort the query.
 *
 * @category   IDX
 * @package    IDX
 * @copyright  Copyright (c) GetYourIDX.com. (http://www.getyouridx.com)
 * @license    GNU General Public License
 */
class IDXFilter_Sort implements IDXFilter {
    
    public $field;
    
    public $direction;
    
    public static $SORT_PRICE_ASCENDING = 'ASC';
    
    public static $SORT_PRICE_DESCENDING = 'DESC';
    
    function __construct($field, $directon) {
        $this->field = $field;
        $this->direction = $directon;
    }
    
    function toString() {
        return 'sort=' . urlencode($this->field . ':' . $this->direction); 
    }
    
}
    
/**
 * The IDXFilter_LessThan class specifies a filter to query a field with a LessThan operator.
 *
 * @category   IDX
 * @package    IDX
 * @copyright  Copyright (c) GetYourIDX.com. (http://www.getyouridx.com)
 * @license    GNU General Public License
 */
class IDXFilter_LessThan implements IDXFilter {
    
    public $field;
    
    public $value;
    
    function __construct($field, $value) {
        $this->field = $field;
        $this->value = $value;
    }
    
    function toString() {
        return 'fle_' . urlencode($this->field) . '=' . urlencode($this->value); 
    }
    
}

/**
 * The IDXFilter_GreaterThan class specifies a filter to query a field with a GreaterThan operator.
 *
 * @category   IDX
 * @package    IDX
 * @copyright  Copyright (c) GetYourIDX.com. (http://www.getyouridx.com)
 * @license    GNU General Public License
 */
class IDXFilter_GreaterThan implements IDXFilter {
    
    public $field;
    
    public $value;
    
    function __construct($field, $value) {
        $this->field = $field;
        $this->value = $value;
    }
    
    function toString() {
        return 'fge_' . urlencode($this->field) . '=' . urlencode($this->value); 
    }
    
}

/**
 * The IDXFilter_Equals class specifies a filter to query a field with an Equals operator.
 *
 * @category   IDX
 * @package    IDX
 * @copyright  Copyright (c) GetYourIDX.com. (http://www.getyouridx.com)
 * @license    GNU General Public License
 */
class IDXFilter_Equals implements IDXFilter {
    
    public $field;
    
    public $value;
    
    function __construct($field, $value) {
        $this->field = $field;
        $this->value = $value;
    }
    
    function toString() {
        return 'feq_' .  urlencode($this->field) . '=' . urlencode($this->value);
    }
    
}
    
/**
 * The IDXFilter_In class specifies a filter to query a field where the value is equal to one of the passed array items.
 *
 * @category   IDX
 * @package    IDX
 * @copyright  Copyright (c) GetYourIDX.com. (http://www.getyouridx.com)
 * @license    GNU General Public License
 */
class IDXFilter_In implements IDXFilter {
    
    public $field;
    
    public $value;
    
    function __construct($field, $value) {
        $this->field = $field;
        $this->value = $value;
    }
    
    function toString() {
        return 'fin_' .  urlencode($this->field) . '=' . urlencode(join(',', $this->value));
    }
    
}
    
/**
 * The IDXSearch class allows requesting data from the GetYourIDX Service based on a number of filters.
 *
 * @category   IDX
 * @package    IDX
 * @copyright  Copyright (c) GetYourIDX.com. (http://www.getyouridx.com)
 * @license    GNU General Public License
 */
class IDXSearch {
    
    /**
     * The API Key to use when communicating with the GetYourIDX Service
     */
    private $api_key = '';
    
    /**
     * The Service endpoint
     */
    private $service_url = 'http://www.getyouridx.com/api/property/';
    
    /**
     * An array of filters
     */
    private $filters = array();
    
    /**
     *
     */
    function __construct($apikey) {
        $this->api_key = $apikey;
    }
    
    /**
     * Adds a filter of type IDXFilter to the request
     */
    public function add_filter($filter) {
        $this->filters[] = $filter;
    }
    
    /**
     * Gets the resuts of the query
     */
    public function result() {
        
        //error_reporting(0);
        
        if (!$ret=@simplexml_load_file($this->service_url . $this->build_querystring())) {
            throw new IDXException('An Error occurred while retrieving the results');
        }
        
        return $ret;
        
    }
    
    /**
     * Builds the querystring based on the passed filters
     */
    private function build_querystring() {
        
        $qs = sprintf('?apikey=%s', $this->api_key);
        
        foreach ($this->filters as $item) {
            $qs .= '&' . $item->toString();
        }
        
        return $qs;
        
    }
    
}

/**
 * The IDXCity class allows requesting cities from the MLSID
 *
 * @category   IDX
 * @package    IDX
 * @copyright  Copyright (c) GetYourIDX.com. (http://www.getyouridx.com)
 * @license    GNU General Public License
 */
class IDXCity {
    
    /**
     * The API Key to use when communicating with the GetYourIDX Service
     */
    private $api_key = '';
    
    /**
     * The Service endpoint
     */
    private $service_url = 'http://www.getyouridx.com/api/city/';
    
    /**
     *
     */
    function __construct($apikey) {
        $this->api_key = $apikey;
    }
    
    /**
     *
     */
    function getByMLS($mls) {
        return @simplexml_load_file($this->service_url . '?apikey=' . $this->api_key . '&fin_mls_id=' . $mls);
    }
    
}

?>