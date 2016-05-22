<?php

class Application_Model_DbTable_Feed extends Zend_Db_Table_Abstract
{

    protected $_name = 'rss_feed';

    public function add($data)
    {
    	$row = $this->createRow();
		$row->rss_path = $data['rss_path'];
		return $row->save();
    }
    function getFeedById($id){
		return $this->find($id)->toArray();
	}
	function listFeeds(){
		return $this->fetchAll()->toArray();
	}
	function deleteFeed($id){
		return $this->delete('id='.$id);
	}
	function editFeed($id,$data){
            return $this->update($data,"id=".$id);
	}
}

