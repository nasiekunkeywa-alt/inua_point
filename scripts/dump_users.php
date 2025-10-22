<?php
require __DIR__ . '/../vendor/autoload.php';
$users = \App\Models\User::all();
foreach ($users as $u) {
    echo $u->id . ' | ' . $u->email . ' | role_id=' . $u->role_id . PHP_EOL;
}
