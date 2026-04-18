<?php
use App\Models\Campaign;
use App\Models\Gallery;

$campaigns = Campaign::all();
foreach($campaigns as $c) {
    $gallery = $c->galleries()->whereNotNull('description')->where('description', '!=', '')->first();
    if ($gallery && (str_contains($c->description, 'On the other hand') || empty($c->description))) {
        $c->description = $gallery->description;
        $c->save();
        echo "Synced: {$c->title}\n";
    }
}
