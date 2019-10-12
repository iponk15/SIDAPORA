<?php 
    if(!empty($breadcrumb)){
        echo '<ul class="breadcrumb">';
            foreach ($breadcrumb as $key => $value) {
                echo '<li><a href="'.$value.'">'.$key.'</a></li>';
            }
        echo '</ul>';
    }
?>


<!-- <li><a href="index.html">Home</a></li>
<li><a href="javascript:;">Pages</a></li>
<li class="active">Careers</li> -->