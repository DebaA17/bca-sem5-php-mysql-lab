<?php
class Demo {
    public function __call($name, $args) {
        $method = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $params = array_map(fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'), $args);
        echo "Method {$method} does not exist. Params: " . implode(', ', $params);
    }
}

$obj = new Demo();
$obj->test(1, 2, 3);
?>
