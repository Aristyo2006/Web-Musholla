<?php
foreach(App\Models\Gallery::take(3)->get() as $g) {
    echo $g->image . "\n";
}
