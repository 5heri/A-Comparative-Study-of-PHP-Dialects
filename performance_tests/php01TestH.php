<hh

function test($arg) {}

function call_to_usr_func() {
        for ($i = 0; $i < 1000000; ++$i)
        test("hello");
}

$time_before = microtime(true);
call_to_usr_func();

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";

