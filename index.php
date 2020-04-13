<!--
Файл,у якокому продемонтстрований базовий синтаксис php, ООП в php
-->
<?php
  //типи даних
    $a = 10;//int
    $a1 = 20.10; //float
    $b = 'a';//str
    $arr = array(1, 2, 3, 4, 5); // звичайний масив
    // асоціативний масив, багатовимірний
    $user = array(
        'name' => 'Anna',
        'surname'=> 'Sherepa',
        'education' => array(
            'school',
            'university'
        )
    );
    // доступ до елементів масиву
    echo "$arr[0]</br>";
    echo "Name: " . $user['name'] . "  education: " . $user['education'][0] . " </br></br></br>";

    //різниця між "" і ''
    echo 'Integer: $a</br>';
    echo "Integer: $a</br></br></br>";

    //конкатенація
    echo  $a.$a1, '</br>';

    //арифметика
    echo "+:(" . $a . "+" . $a1 . ") -:(" . $a . "-" . $a1 . ") *:(" . $a . "*" . $a1 . ") /:(" . $a . "/" . $a1 . ") %:(" . $a . "%2) </br>";

    //foreach, if, вбудовані функції, користувацькі функції

    function show_array($arr, $i = 0){
        foreach ( $arr as $item){
            if(is_array($item)){
                echo "</br>Array $i: </br>";
                show_array($item, $i+1);
            }
            else {
                echo $item, '</br>';
            }
        }
    }
    show_array($user);
    // ООП в php. Реалізація класів, його полів, методів, наслідування, інкапсуляція
    //Class
    class Base{
        private $name;
        protected $surname;
        public function __construct($name = 'none', $surname = 'none'){
            echo 'Base constructor</<br>';
            $this->name = $name;
            $this->surname = $surname;
        }

        function show(){
            echo "</br></br>Name: $this->name Surname: $this->surname</br>";
        }

        public function __destruct(){
            echo 'Base destruct</br>';
        }
    }
    //створення об'єктів типу Base
    $obj = new Base();
    $obj->show();

    $obj1 = new Base("Alisa");
    $obj1->show();

    $obj2 = new Base("Misha", "Oleynik");
    $obj2->show();
    var_dump($obj2);

    //Наслідування класу Base
    class Derived extends Base{
        private $grade;
        public $nikname;

        public function __construct($grade = 0, $nikname = 'none', $name = 'none', $surname = 'none')
        {
            echo 'Derived constructor';
            //звернення до батьківських методів
            parent::__construct($name, $surname);
            $this->grade = $grade;
            $this->nikname = $nikname;
            //$this->name = $name; //ERROR, private variable
            $this->surname = $surname;// protected var
        }

        public function show(){
            parent::show();
            echo "Grade: $this->grade,  Nik: $this->nikname</br></br>";
        }

        public function __destruct(){
            echo 'Derived destruct';
            parent::__destruct();
        }
    }

    $objd = new Derived(10, 'Aly');
    $objd->show();
    $objd->nikname = 'All';
    var_dump($objd);
    //$objd->grade = 12; error, private
    //$objd->surname = 12; ERROR, protected
    //видалення об'єкту для демонстрації роботи деструктора
    unset($objd);

    //Робота з магічними методами. Можливість реалізації динамічних змінних
    class Member {
        private $username;
        private $data = array();
        public function __get( $property ) {
            echo 'Using getter</br>';
            if ( $property == "username" ) {
                return $this->username;
            } else {
                if ( array_key_exists( $property, $this->data ) ) {
                    return $this->data[$property];
                } else {
                    return null;
                }
            }
        }

        public function __set( $property, $value ) {
            echo 'Using setter</br>';
            if ( $property == "username" ) {
                $this->username = $value;
            } else {
                $this->data[$property] = $value;
            }
        }
    }

    $aMember = new Member();
    $aMember->username = "fred"; //присвоїть значення приватній змінній через метод __set
    $aMember->location = "San Francisco";//присвоїть значення приватній змінній через метод __set
                                         //Дані збережуться в асоціативному масиві data,
                                         //де назва змінної виступатиме ключем

    echo $aMember->username . "<br>";    // виведе "fred" за допомогою метода __get
    echo $aMember->location . "<br>";    // виведе  "San Francisco" за допомогою метода __get

    //Демонстрація поліморфізму у php

    abstract class Animal {
        private $name;
        public function __construct($name) {
            $this->name = $name;
        }
        abstract public function say();
        public function getName() {
            return $this->name;
        }
    }
    class Cat extends Animal {
        public function __construct($name) {
            parent::__construct($name);
        }

        public function say() {
            echo "meow-meow!</br>";
        }
    }

    class Dog extends Animal {

        public function __construct($name) {
            parent::__construct($name);
        }

        public function say() {
            echo "woof-woof!</br>";
        }
    }

    $example[] = new Cat("Tom");
    $example[] = new Dog("Bob");
    foreach ($example as $item){
        if($item instanceof Animal){
            echo "</br>It is {$item->getName()} </br> ";
            echo "It say`s:";
            $item->say();
        }
        else{
            echo 'It isn`t animal';
        }
    }

    //Класична реалісація шаблонного класу Singleton суть якого заключається у можливості створення лише одного об'єкту
    //даного класу
    class Singleton{
        private  static $single;
        public function getSingle(){
            if (self::$single === null) {
                self::$single = new self();
            }
            return self::$single;
        }
        //забороняє створювати об'єкт будь-яким іншим чином
        private function __construct(){}
        private function __clone(){}
        private function __wakeup(){}

        //зміні та методи для демонстрації, що в подальшому буде використовуватися саме 1 об'єкт цього класу
        private $field;
        public function getField(){
            return $this->field;
        }
        public function setField($field){
            $this->field = $field;
        }
    }

    $example = Singleton::getSingle();
    var_dump($example);
    echo '</br></br>';
    $example->setField("New field");

    $example2 = Singleton::getSingle();
    echo "{$example2->getField()}</br></br>";
?>

<!-- Кнопка перезоду на сторінку для роботи з формами-->
<form name="test" action="forms.php" method="post">
    <input type="submit" name="done" value="Go to forms">
</form>