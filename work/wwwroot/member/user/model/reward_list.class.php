<?php
/* *
* $Author ��PHPYUN�����Ŷ�
*
* ����: http://www.phpyun.com
*
* ��Ȩ���� 2009-2017 ��Ǩ�γ���Ϣ�������޹�˾������������Ȩ����
*
* ����������δ����Ȩǰ���£�����������ҵ��Ӫ�����ο����Լ��κ���ʽ���ٴη�����
*/
class reward_list_controller extends user{
	function index_action(){		
		$this->public_action();
		$urlarr=array("c"=>"reward_list","page"=>"{{page}}");
		$pageurl=Url('member',$urlarr);
		$where.="`uid`='".$this->uid."'order by id desc";
		$this->get_page("change",$where,$pageurl,"13");
		$num=$this->obj->DB_select_num("change","`uid`='".$this->uid."'");
		$this->yunset("num",$num);
		$statis = $this->member_satic();
		$statis[integral]=number_format($statis[integral]);
		$this->yunset("statis",$statis);
		$this->user_tpl('reward_list');
	}	
	function del_action(){
		if($this->usertype!='1' || $this->uid==''){
			$this->layer_msg('�Ƿ�������',8,0,$_SERVER['HTTP_REFERER']);
		}else{
			$rows=$this->obj->DB_select_once("change","`uid`='".$this->uid."' and `id`='".(int)$_GET['id']."' ");
			if($rows['id']){
				$this->obj->DB_update_all("reward","`num`=`num`-".$rows['num'].",`stock`=`stock`+".$rows['num']."","`id`='".$rows['gid']."'");
				$this->company_invtal($this->uid,$rows['integral'],true,"ȡ���һ�",true,2,'integral',24);
				$this->obj->DB_delete_all("change","`uid`='".$this->uid."' and `id`='".(int)$_GET['id']."' ");
			} 
			$this->obj->member_log("ȡ���һ�");
			$this->layer_msg('ȡ���ɹ���',9,0,$_SERVER['HTTP_REFERER']);
		}
	}
}
?>