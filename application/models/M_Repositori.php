<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Repositori extends CI_Model {
  private $table = 'repositori';
  private $primary = 'repositori_id';
  
  public function __construct(){
      parent::__construct();
  }

  public function rules() {
    $post = $this->input->post();

    $rules = array();

    if (isset($post['_name_'])) {
      $rules[] = array( 'field' => '_name_',
                        'label' => 'Name',
                        'rules' => 'required|trim|alpha_numeric_spaces|min_length[4]|max_length[20]');
    }

    if (isset($post['_description_'])) {
      $rules[] = array( 'field' => '_description_',
                        'label' => 'Description',
                        'rules' => 'required|trim|alpha_numeric_spaces|max_length[250]');
    }

    if (isset($post['_checkfile_'])) {
      $rules[] = array( 'field' => '_checkfile_',
                        'label' => 'Document',
                        'rules' => 'callback_checkFileDoc');
    }

    return $rules;
  
  }

  public function getById($id){
    return $this->db->get_where($this->table, array($this->primary => $id) )->row_array();
  }

  public function getAll($where = null) {
    $this->db->from('repositori, category, account');
    $this->db->where('repositori.category_id = category.category_id');
    $this->db->where('repositori.account_id = account.account_id');
    if ($where != null) {
      $this->db->where($where);
    }
    $this->db->order_by('repositori_id', 'DESC');
    return $this->db->get()->result_array();
  }

  public function insert(){
    $post = $this->input->post();
    if (!empty($post)){

      $uploadfile = upload_file('./uploads/file/','pdf');

      if ($uploadfile['status'] == 'error') {
        $response = array(
          'status' => 'error',
          'message' => $uploadfile['message'],
        );

      } else {

        $data = array(
          'repositori_id'           => NULL,
          'category_id'     => htmlspecialchars($post['_category_']),
          'name'         => htmlspecialchars($post['_name_']),
          'file'      => NULL,
          'account_id'     => htmlspecialchars($post['_account_']),
          'note'  => htmlspecialchars($post['_description_']),
        );

        if ($uploadfile['status'] == 'success') {
          $data['file'] = $uploadfile['data']['file_name'];
        }

        $data = $this->security->xss_clean($data);
        if($this->db->insert($this->table, $data)){
          $response = array(
            'status' => 'success',
            'message' => 'Success insert data',
          );
        } else {
          $response = array(
            'status' => 'error',
            'message' => 'Failed insert data',
          );
        }
      }
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Data not found!',
      );
    }
    return $response;
  }

  public function update($id){
    $post = $this->input->post();
    if (!empty($post)){
      $data = array(
        'name'         => htmlspecialchars($post['_name_']),
        'note'  => htmlspecialchars($post['_description_']),
      );

      $data = $this->security->xss_clean($data);
      $this->db->where($this->primary, $id);
      if($this->db->update($this->table, $data)){
        $response = array(
          'status' => 'success',
          'message' => 'Success update data',
        );
      } else {
        $response = array(
          'status' => 'error',
          'message' => 'Failed update data',
        );
      }
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Data not found!',
      );
    }
    return $response;
  }

  public function delete($id){
    if($this->db->delete($this->table, array($this->primary => $id))){
      $response = array(
        'status' => 'success',
        'message' => 'Success delete data',
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Failed delete data',
      );
    }

    return $response;
  }

}
?>