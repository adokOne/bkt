<?php
/*ne ryhaty*/
class Statistic_Controller extends Controller {
	
	private static $_instance=null;
	
	private $standart;
	private $site;
	private $filter;
	
	public $stats;	
	private $values=array("MIN","MAX");
	private $params=array("Район"=>"district_id",
						  "Цена"=>"price",
						  "Комнат"=>"rooms_count",);
	
	
	public function __construct(){
		parent::__construct();
		$this->db=Database::instance();
		$this->stats=ORM::factory('option');
	}
	
	public function getStats($stat){
		switch ($stat){
			case 'standart':$method=$this->_standartStat();break;
			case 'site':$method=$this->_siteStat();break;
			case 'filter':$method=$this->_filterStat();break;
			default : $method=$this->stats;
		}
		return $method;
	}
	
	public function setStats($statsParams){
		foreach($statsParams as $param){
			$query='UPDATE options SET stat_count=stat_count+1 WHERE id='.$param;
			$this->db->query($query);
		}
	}
	public static function getInstance(){
		if(self::$_instance==null)
			self::$_instance= new Statistic_Controller();
		return self::$_instance;
	}
	
	
	public function index(){
		//var_dump($this->stats);
		var_dump($this->_siteStat());
	}
	private function _getParams($mod=null){
	
		$rooms=$this->db
		->select('DISTINCT rooms_count AS rooms')
		->from('ads')
		->where('active_until>='.time())
		->get();
		$price=$this->db
		->select('DISTINCT price')
		->from('ads')
		->where('active_until>='.time())
		->get();
		$district=ORM::factory('district')->find_all();
	
		foreach($district as $d)
		$district_id[$d->id]=$d->id;
		foreach($rooms as $z)
		$rooms_id[$z->rooms]=$z->rooms;
		foreach($price as $x)
		$price_id[$x->price]=$x->price;
		$params=array($district_id,$rooms_id,$price_id);
	
		switch ($mod){
			case 'rooms':return $rooms_id; break;
			case 'district_id':return $district_id ;break;
			case 'price':return $price_id; break;
			default: return $params;
		}
	
	}
	/*- стандартная статистика:*/
	private function _standartStat(){
		$this->standart['На сайте с']=date::rusdate2('j F Y',$this->user->created_at);
		$this->standart['Добавленных объявлений']=count($this->db
													->from('ads')
													->where('user_id',$this->user->id)
													->get());									
		$this->standart['Заявок']=count($this->db
													->from('messags')
													->where(array('recepient'=>$this->user->id,'parent_id'=>0))
													->get());
		$this->standart['Просмотров']=$this->db
											->from('ads')
											->select('SUM(views) AS total')
											->where('user_id',$this->user->id)
											->get()
											->current()
											->total;
		return (object)$this->standart;
	}
	/*статистика по срезам на сайте:*/
	private function _siteStat(){
			foreach($this->_getParams('rooms') as  $room){ 
				$this->site['rentPrice'][$room]=$this->db
											->from('ads')
											->select('SUM(price) AS totalPrice')
											->where('rooms_count',$room)
											->where('active_until>='.time())
											->get()
											->current()
											->totalPrice;
				$totalAds=count($this->db
									->from('ads')
									->where('rooms_count',$room)
									->where('active_until>='.time())
									->get());
				$this->site['rentPrice'][$room]=round($this->site['rentPrice'][$room]/$totalAds,2);
			}
			foreach ($this->_getParams('rooms') as $room)
					foreach($this->values as $v)
				$this->site['Price'][$room][$v]=round($this->db
											->from('ads')
											->select(''.$v.'(price) AS '.$v)
											->where('rooms_count',$room)
											->where('active_until>='.time())
											->get()
											->current()
											->$v,2);
			foreach($this->params as $Pname=>$param){
				if(isset($paramsValue))unset($paramsValue);
				switch($param){
					case 'district_id':$paramsValue=$this->_getParams('district_id');break;
					case 'rooms_count':$paramsValue=$this->_getParams('rooms');break;
					case 'price':$paramsValue=$this->_getParams('price');break;
				}
					
					foreach ($paramsValue as $val){
						$c[$param][$val]=count($this->db
										->select($param)
										->from('ads')
										->where($param,$val)
										->get());
						if($c[$param][$val]>=max($c[$param]))
						if($c!=0)$dis[$param]=$val;
					}
					switch($param){
						case 'district_id':
							$d=ORM::factory('district')->where('id',$dis[$param])->find();
							$dis[$param]=$d->name;break;
						case 'price':$dis[$param].=' грн';break;
					}
						
				$this->site['mostPopular'][$Pname]=$dis[$param];
			}
		return (object)$this->site;
	}
	/*статистика по удобствам:*/
	private function _filterStat(){
		$option=$this->stats->where('stat_count!=0')->find_all();
		if(count($option)!=0):
			foreach($option as $o)
				$summa[$o->name]=$o->stat_count;
			$total=array_sum($summa);
			foreach ($summa as $k=>$v){
				$stat[$k]=round($v/$total*100,1);
			}
			$this->stat=(object)$stat;
			return $this->stat;
		endif;
	}

}
?>