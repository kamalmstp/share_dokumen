<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Repositori extends CI_Controller {
  private $sess;

  public function __construct(){
    parent::__construct();
    $this->sess = $this->M_Auth->session(array('root','admin'));
    if ($this->sess === FALSE) {
      redirect(site_url('admin/auth/logout'),'refresh');
    }
    $this->load->model('M_Repositori');
    $this->load->model('M_Category');
	}


    public function checkFileDoc($value){
        if (!empty($_FILES)) {
                $phpFileUploadErrors = array(
                    0 => 'There is no error, the file uploaded with success',
                    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
                    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
                    3 => 'The uploaded file was only partially uploaded',
                    4 => 'No file was uploaded',
                    6 => 'Missing a temporary folder',
                    7 => 'Failed to write file to disk.',
                    8 => 'A PHP extension stopped the file upload.',
                );
                $typeFileDoc = array('application/pdf','pdf');
          $sizeAllowed = 4096000; // 4MB
    
          if ($_FILES[$value]['error'] == 4) {
            return TRUE;
          } elseif ($_FILES[$value]['error'] == 0) {
            if (in_array($_FILES[$value]['type'], $typeFileDoc) == FALSE) {
              $this->form_validation->set_message('checkFileDoc', 'The filetype you are attempting to upload is not allowed.');
              return FALSE;
            } elseif($_FILES[$value]['size'] > $sizeAllowed){
              $this->form_validation->set_message('checkFileDoc', 'The file you are attempting to upload is larger than the permitted size.');
              return FALSE;
            } else {
              return TRUE;
            }
          } else {
            $this->form_validation->set_message('checkFileDoc', $phpFileUploadErrors[$_FILES[$value]['error']]);
            return FALSE;
          }  
            } else {
          return TRUE;
        }
      }

  
  // ==============================================
  //               LOAD VIEW
  // ==============================================

  public function index(){
    $data['datatables'] = true;
    $data['icheck']     = false;
    $data['switch']     = false;
    $data['select2']    = false;
    $data['daterange']  = false;
    $data['colorpicker']= false;
    $data['inputmask']  = false;
    $data['dropzonejs'] = false;
    $data['summernote'] = false;
    $data['session']    = $this->sess;
    $data['sidebar']    = 'repositori-index';
    $data['layout']     = 'layout-navbar-fixed  pace-warning';
    $data['title']      = 'Table Repositori';
    $data['card_title'] = 'Data Repositori';

    $data['swal'] = array(
      'type' => 'delete',
      'button'  => 'Yes, delete it!',
      'url' => NULL,
    );
    $data['breadcrumb'] = array(
      'Repositori' => site_url('admin/repositori/index'),
      'Table'   => site_url('admin/repositori/index'),
    );
    $data['btn_add']    = array(
      'url' => site_url('admin/repositori/add'),
      'name' => 'Add Repositori',
    );


    $this->load->view('admin/repositori/index.php', $data);
  }

  public function add(){
    $data['datatables'] = false;
    $data['icheck']     = false;
    $data['switch']     = false;
    $data['select2']    = false;
    $data['daterange']  = false;
    $data['colorpicker']= false;
    $data['inputmask']  = false;
    $data['dropzonejs'] = false;
    $data['summernote'] = false;
    $data['session']    = $this->sess;
    $data['sidebar']    = 'repositori-add';
    $data['layout']     = 'layout-navbar-fixed  pace-warning';
    $data['title']      = 'Add Repositori';
    $data['card_title'] = 'Form Input';


    $data['swal'] = array(
      'type' => 'button',
      'button'  => 'Check Data',
      'url' => site_url('admin/repositori/index'),
    );
    $data['breadcrumb'] = array(
      'Repositori' => site_url('admin/repositori/index'),
      'Add'     => site_url('admin/repositori/index'),
    );

    $data['category'] = $this->M_Category->getAll();
    $data['account'] = $this->sess['id'];

    $this->form_validation->set_rules($this->M_Repositori->rules());
    if ($this->form_validation->run() === TRUE) {
      $this->session->set_flashdata('notif', $this->M_Repositori->insert());
      redirect(site_url('admin/repositori/add'),'refresh');

    } else {
      $data['notif'] = $this->M_Auth->notification();
      $this->load->view('admin/repositori/add.php', $data);
    }
  }

  public function edit($id=null){
    if ($id != null) {
      $data['datatables'] = false;
      $data['icheck']     = false;
      $data['switch']     = false;
      $data['select2']    = false;
      $data['daterange']  = false;
      $data['colorpicker']= false;
      $data['inputmask']  = false;
      $data['dropzonejs'] = false;
      $data['summernote'] = false;
      $data['session']    = $this->sess;
      $data['sidebar']    = 'repositori-edit';
      $data['layout']     = 'layout-navbar-fixed  pace-warning';
      $data['title']      = 'Edit Repositori';
      $data['card_title'] = 'Form Input';
  
  
      $data['swal'] = array(
        'type' => 'button',
        'button'  => 'Check Data',
        'url' => site_url('admin/repositori/index'),
      );
      $data['breadcrumb'] = array(
        'Repositori' => site_url('admin/repositori/index'),
        'Add'     => site_url('admin/repositori/index'),
      );

      
      $data['id']   = $id;
      $data['data'] = $this->M_Repositori->getById($id);
  
      $this->form_validation->set_rules($this->M_Repositori->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata('notif', $this->M_Repositori->update($id));
        redirect(site_url('admin/repositori/edit/'.$id),'refresh');
  
      } else {
        $data['notif'] = $this->M_Auth->notification();
        $this->load->view('admin/repositori/edit.php', $data);
      }
    } else {
      redirect(site_url('admin/repositori/index'),'refresh');
    }
  }


  // ==============================================
  //               RETURN JSON ENCODE
  // ==============================================

  public function data(){
    $data = $this->M_Repositori->getAll();
    echo json_encode($data);
  }

  public function delete($id=null){
    if ($id != null) {
      $response = $this->M_Repositori->delete($id);
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Data not found!',
      );
    }
    echo json_encode($response);
  }

}

?>