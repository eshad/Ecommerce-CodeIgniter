<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Productgallery_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get productgallery by ProductGalleryId
     */
    function get_productgallery($ProductGalleryId)
    {
        return $this->db->get_where('productgallery',array('ProductGalleryId'=>$ProductGalleryId))->row_array();
    }
        
    /*
     * Get all productgallery
     */
    function get_all_productgallery()
    {
        $this->db->order_by('ProductGalleryId', 'desc');
        return $this->db->get('productgallery')->result_array();
    }
	
	function get_productimages($productId)
    {        
        return $this->db->get_where('productgallery',array("productid"=>$productId,"isdelete"=>0,"isfeatured"=>0))->result_array();
    }
	
	function get_product_featureimage($productId)
    {        
		$this->db->limit(1);
        return $this->db->get_where('productgallery',array("productid"=>$productId,"isdelete"=>0,"isfeatured"=>1))->row();
    }
        
    /*
     * function to add new productgallery
     */
    function add_productgallery($params)
    {
        $this->db->insert('productgallery',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update productgallery
     */
    function update_productgallery($ProductGalleryId,$params)
    {
        $this->db->where('ProductGalleryId',$ProductGalleryId);
        return $this->db->update('productgallery',$params);
    }
    
	
	function update_featuredImage($ProductId,$params)
	{
		$this->db->where(array("ProductId"=>$ProductId,"IsFeatured"=>1));
		$this->db->update("productgallery",array("IsDelete"=>1));
		
		$this->add_productgallery($params);
	}
	
	
    /*
     * function to delete productgallery
     */
    function delete_productgallery($ProductGalleryId)
    {
        $this->db->where(array('productgalleryid'=>$ProductGalleryId));
		return $this->db->update('productgallery',array("isdelete"=>1));
    }
}