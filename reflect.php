<?php
   class Person {
    
       /**
        * For the sake of demonstration, we"re setting this private
        */
       private $_allowDynamicAttributes = false;
    
       /**
        * type=primary_autoincrement
        */
       protected $id = 0;
    
       /**
        * type=varchar length=255 null
        */
       protected $name;
    
       /**
        * type=text null
        */
       protected $biography;
    
       public function getId() {
           return $this->id;
       }
    
       public function setId($v) {
           $this->id = $v;
       }
    
       public function getName() {
           return $this->name;
       }
    
       public function setName($v) {
           $this->name = $v;
       }
    
       public function getBiography() {
           return $this->biography;
       }
    
       public function setBiography($v) {
           $this->biography = $v;
       }
   }
   

   $class = new ReflectionClass('Person'); // 建立 Person这个类的反射类 
   $instance  = $class->newInstanceArgs($args); // 相当于实例化Person 类

//$private_properties = $class->getProperties(ReflectionProperty::IS_PRIVATE);//只想获取到private属性[IS_STATIC,IS_PUBLIC,IS_PROTECTED,IS_PRIVATE]
   $properties = $class->getProperties();
   foreach ($properties as $property) {
       echo $property->getName() . "\n";
   }
   
//获取类的方法
/*
getMethods()       来获取到类的所有methods
hasMethod(string)  是否存在某个方法
getMethod(string)  获取方法
*/
//执行类的方法：
   $instance->getName(); // 执行Person 里的方法getName
   // 或者：
   $method = $class->getmethod('getName');  // 获取Person 类中的getName方法
   $method->invoke($instance);              // 执行getName 方法
   // 或者：
   $method = $class->getmethod('setName');  // 获取Person 类中的setName方法
   $method->invokeArgs($instance, array('snsgou.com'));

//通过ReflectionMethod，我们可以得到Person类的某个方法的信息
/*
是否“public”、“protected”、“private” 、“static”类型
方法的参数列表
方法的参数个数
反调用类的方法
*/
// 执行detail方法
$method = new ReflectionMethod('Person', 'test');
    
if ($method->isPublic() && !$method->isStatic()) {
    echo 'Action is right';
}
echo $method->getNumberOfParameters(); // 参数个数
echo $method->getParameters(); // 参数对象数组