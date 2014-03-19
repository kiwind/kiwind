<?php
	class Blog extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function Index($pagen=0)
		{
			$this->load->model('mblog');
			$this->load->library('Blogpage');
			$config['base_url'] = site_url().'blog/p';
		    $config['total_rows'] = $this->mblog->getTotal();
		    $config['per_page'] = 24;
		    $config['uri_segment'] = 3; 
		    $config['num_links'] = 1;
	      	$config['anchor_class'] = 'class=bg-ani ';
	      	$config['prev_tag_open'] = '<div class="page-btn pre-page">';
	      	$config['prev_tag_close'] = '</div>';
	      	$config['next_tag_open'] = '<div class="page-btn next-page">';
	      	$config['next_tag_close'] = '</div>';
	      	$this->blogpage->initialize($config);
	      	$pagen = $this->uri->segment(3);
	      	if($pagen==0)
	      	{
	      		$pagen=0;
	      	}
	      	else
	      	{
	      		$pagen=$pagen-1;
	      	}
			$res=$this->mblog->getList($pagen,$config['per_page']);

			$this->load->helper('common_helper');
			$data = array('res'=>$res,
						  'type'=>$this->mblog->getType(),
						  'catid'=>0,
						  'pagebar'=>$this->blogpage->create_links());
			$this->load->view('blog.html',$data);
		}

		function article($cat,$id)
		{
			$this->load->model('mblog');
			$data = array('article'=>$this->mblog->getArticle($id),
						  'type'=>$this->mblog->getType(),
						  'catid'=>$cat);
			$this->load->view('blog-article.html',$data);
		}
		
		function cat($id,$pagen=0)
		{
			$this->load->model('mblog');
			$this->load->helper('common_helper');
			$this->load->library('Blogpage');
			$config['base_url'] = site_url().'blog/cat/'.$id;
		    $config['per_page'] = 24;
		    $config['uri_segment'] = 4; 
		    $config['num_links'] = 1;
	      	$config['anchor_class'] = 'class=bg-ani ';
	      	$config['prev_tag_open'] = '<div class="page-btn pre-page">';
	      	$config['prev_tag_close'] = '</div>';
	      	$config['next_tag_open'] = '<div class="page-btn next-page">';
	      	$config['next_tag_close'] = '</div>';
	      	$pagen = $this->uri->segment(4);
	      	if($pagen==0)
	      	{
	      		$pagen=0;
	      	}
	      	else
	      	{
	      		$pagen=$pagen-1;
	      	}
			
			if($id == 4)
			{
				$config['total_rows'] = $this->mblog->getTotal();
				$res=$this->mblog->getList($pagen,$config['per_page']);
			}
			else
			{
				$config['total_rows'] = $this->mblog->getTotalByTid($id);
				$res=$this->mblog->getListByType($id,$pagen,$config['per_page']);
			}
			$this->blogpage->initialize($config);
			$data = array('res'=>$res,
						  'type'=>$this->mblog->getType(),
						  'catid'=>$id,
						  'pagebar'=>$this->blogpage->create_links());
			$this->load->view('blog-cat.html',$data);
		}
		
		function addGood()
		{
			$id = $this->input->post('id',true);
			$count = $this->input->post('count',true);
			$this->load->model('mblog');
			$this->mblog->updateGoodCount($id,$count);
			$this->output->set_output($count);
		}
	}
/* End of file */