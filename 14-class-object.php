<?php
class Student {
    private $name;
    private $roll;

    public function __construct($name, $roll) {
        $this->name = trim((string)$name);
        $this->roll = (int)$roll;

        if ($this->name === '') {
            throw new InvalidArgumentException('Name cannot be empty.');
        }
    }

    public function show() {
        echo 'Name: ' . htmlspecialchars($this->name, ENT_QUOTES, 'UTF-8') . '<br>';
        echo 'Roll: ' . (int)$this->roll;
    }
}

try {
    $s = new Student('Debasis', 17);
    $s->show();
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
