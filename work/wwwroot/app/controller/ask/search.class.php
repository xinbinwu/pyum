<?php
/*
* $Author ��PHPYUN�����Ŷ�
*
* ����: http://www.phpyun.com
*
* ��Ȩ���� 2009-2017 ��Ǩ�γ���Ϣ�������޹�˾������������Ȩ����
*
* ����������δ����Ȩǰ���£�����������ҵ��Ӫ�����ο����Լ��κ���ʽ���ٴη�����
 */
class search_controller extends ask_controller{ 
	function index_action(){
		
		$M=$this->MODEL('ask'); 
 		$hotuser=$M->GetHotUser(array("`add_time`>'".strtotime("-30 day")."'"),array('groupby'=>"uid","orderby"=>'num',"desc"=>'desc',"limit"=>10,"field"=>"uid,count(id) as num,sum(support) as support,nickname,pic"));
		foreach($hotuser as $k=>$v){
			if($v['pic']){
				$hotuser[$k]['pic']=$this->config['sy_weburl'].'/'.$v['pic'];
			}else{
				$hotuser[$k]['pic']=$this->config['sy_weburl'].'/'.$this->config['sy_friend_icon'];
			}
		}
		if(trim($_GET['keyword'])){$this->addkeywords(12,trim($_GET['keyword']));}
 		$this->atnask($M);
 		$this->hotclass();
		$this->yunset("getinfo",$_GET);   
		$this->yunset("hotuser",$hotuser);   
		$this->yunset("navtype","topic");
		$this->seo('ask_search');
		$this->ask_tpl('search');
	}
}
?>