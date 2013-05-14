
<?php
function create_instance($class, $params) {

    $reflection_class = new ReflectionClass($class);
    return $reflection_class->newInstanceArgs($params);
}
class Article
{
	public    $foo  = 'c public\n';
    protected $bar  = 'c protected\n';
    private   $baz  = ' c prive\n';
    /*function __construct()
    {
        echo __METHOD__,"\n";
    }*/
	
	function __construct($a, $b)
    {
       $this->bar = $a;
	   $this->foo = $b;
    }
	
	function funcname()
	{
		echo __FUNCTION__;
	}
	function getBar()
	{
		echo __FUNCTION__."\n";
		return  $this->bar;
	}
	function getFoo()
	{
		echo __FUNCTION__."\n";
		return  $this->foo;
	}
	function nonPasToi(){
	}
	function niToi(){
	}
}

const constname = "global";

/*$a = 'Article';
$obj = new $a; // affiche classname::__construct
$b = 'funcname';
$b(); // affiche funcname
echo constant('constname'), "\n"; // affiche global*/
$tab = array('test', 'Toto');
echo 'reflection class\n';
$class = new Article("moussa", "thimbo");
$article = new ReflectionClass($class);
$props   = $article->getProperties();

foreach ($props as $prop) {
    print $prop->getName() . "\n";
}

var_dump($props);

		foreach ($article->getMethods()  as $method) {
            if (substr($method->name, 0, 3) == 'get') {
                $propName = strtolower(substr($method->name, 3, 1)) . substr($method->name, 4);

                $result[$propName] = $method->invoke(new Article("test", "toto"));
            }
        }
var_dump($result);
        if(in_array("a", $result)) echo "yes A fonction";
?>

