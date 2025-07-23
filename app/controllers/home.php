<?php

class Home extends Controller {
    public function index() {
	    $this->view(
        'home/index', 
        [
          'reviews' => $this->model('Review')->getAllReviewsByUserId(0)
        ]
      );
	    die;
    }
}
