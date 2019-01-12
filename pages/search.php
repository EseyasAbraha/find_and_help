<?php
if (!defined('ACCESS')) { die; }

use App\Library\UserTypes;

if (UserTypes::validType()) {
    return;
}

?>
<h1>Search Map</h1>

<br/>

<div class="row">
    <div class="col-md-12">
    </div>
</div>
