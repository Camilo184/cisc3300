<?php

require  'Items.php';


$Items = new Item("IPhone 16", 1000.00, "New IPhone 16");
echo $Items->toJson();
