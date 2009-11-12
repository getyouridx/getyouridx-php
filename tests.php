<?php

include_once 'getyouridx.php';

$idx_search = new IDXSearch('YOUR_API_KEY');
$idx_search->add_filter(new IDXFilter_In('mls_id', array('YOUR_MLSID')));
print_r($idx_search->result());

?>