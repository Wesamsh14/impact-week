<?php

class Posts extends CI_Controller {

  public function index() {
    $this->load->model('post');
    $all = $this->post->get_all_posts();
    $this->load->view('feed', ['all' => $all]);
  }

  public function add() {
    $this->output->enable_profiler(TRUE);
    $data = $this->input->post(null, TRUE);
    $this->load->model('post');
    $this->post->add_post($data);
    redirect('/posts');
  }

  public function toggle_edit_post() {
    $this->session->post_edit_id = $this->input->post('post_id', TRUE);
    redirect('/posts');
  }

  public function submit_edit_post() {
    $content = $this->input->post('edited_content_post', TRUE);
    $values = array(
      'content' => $content,
      'id' => $this->session->post_edit_id
    );
    $this->load->model('post');
    $this->post->update_post($values);
    $this->session->post_edit_id = NULL;
    redirect('/posts');
  }

  public function delete_post() {
    $id = $this->input->post('post_id');
    $this->post->delete_post($id);
    redirect('/posts');
  }

}

?>
