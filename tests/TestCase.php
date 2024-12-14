<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp() : Void {
        parent::setUp();
        DB::delete("delete from peminjaman");
        DB::delete("delete from bukus");
        DB::delete("delete from kategoris");
        DB::delete("delete from users");
    }
}
