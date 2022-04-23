<?php
namespace App\Database\interfaces;

interface Crud{
    function create();
    function read();
    function update();
    function delete();
}