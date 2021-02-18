<?
const PI = 3.14;
class Figure{
  public $figure;
  public function getSquare() {}
  public function getFigure()
  {
    echo $this->figure;
  }
}

class Rectangle extends Figure{
  public $a,$b;
  public function __construct($inputData)
  {
    $this->figure=$inputData->figure;
    $this->a=$inputData->a;
    $this->b=$inputData->b;
  }
  public function getSquare()
  {
    return $this->a * $this->b;
  }
}

class Circle extends Figure{
  public $r;
  public function __construct($inputData)
  {
    $this->figure=$inputData->figure;
    $this->r=$inputData->r;
  }
  public function getSquare()
  {
    return PI * ($this->r * $this->r);
  }
}

class Triangle extends Figure{
  public $a,$h;
  function __construct($inputData)
  {
    $this->figure=$inputData->figure;
    $this->a=$inputData->a;
    $this->h=$inputData->h;
  }
  public function getSquare()
  {
    return $this->a / 2 * $this->h;
  }
}

function сreateFigure ()
{
  $fig = rand (0,2);
  $randObj = new stdClass();
  switch ($fig) {
  case 0:
    $randObj->figure = "Круг";
    $randObj->r = rand(1,10);
    return new Circle($randObj);
  break;
  case 1:
    $randObj->figure = "Прямоугольник";
    $randObj->a = rand(1,10);
    $randObj->b = rand(1,10);
    if($randObj->a == $randObj->b){
      $randObj->a - 1;
    }
    return new Rectangle($randObj);
  break;
  case 2:
    $randObj->figure = "Треугольник";
    $randObj->h = rand(1,10);
    $randObj->a = rand(1,10);
    return new Triangle($randObj);
  break;
  }
}

function getSort($a, $b)
{
  if ($a->getSquare() == $b->getSquare()) {
    return 0;
  }elseif($a->getSquare() < $b->getSquare()){
    return 1;
  }else{
    return -1;
  }
}

$string=file_get_contents("PreCreatedFigures.json");
$obj=json_decode($string);
$arFigure=array();

for ($i = 0;$i < count($obj); $i++) {
  $currentObj=$obj[$i];
  switch ($currentObj->figure) {
    case "Круг":
      $arFigure[]=new Circle($currentObj);
    break;
    case "Прямоугольник":
      $arFigure[]=new Rectangle($currentObj);
    break;
    case "Треугольник":
      $arFigure[]=new Triangle($currentObj);
    break;
  }
}

for ($i = 0;$i < 5; $i++) {
  $arFigure[] = сreateFigure();
}

usort($arFigure, "getSort");
foreach ($arFigure as $key => $value) {
  print_r ($arFigure[$key]->getFigure().", Площадь=".$arFigure[$key]->getSquare()."<br>");
}

$json = json_encode($arFigure);
$file = fopen('RandomCreatedFigures.json', 'w');
$write = fwrite($file,$json);
fclose($file);
?>
