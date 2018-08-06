# validate
```php
 $v = new \EasySwoole\Validate\Validate();
 
 $v->addColumn('page','参数错误','页面')->min(3,'最小值为3')->max(10);
 $v->addColumn('user.balance',null,'金额')->min(3)->func(function (\EasySwoole\Spl\SplArray $data,$col){
     var_dump($data->get($col));
     return false;
 },'自定义参数校验错误');
 
 $res = $v->validate(['page'=>4,'user'=>['balance'=>5]]);
 
 if($res != true){
     var_dump($v->getError()->__toString());
 }
```