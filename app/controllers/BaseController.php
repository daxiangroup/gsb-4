<?php

class BaseController extends Controller
{

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    protected function addFilters($filters = null)
    {
        if (is_null($filters)) {
            $this->beforeFilter('auth');
            $this->beforeFilter('csrf', array('on' => 'post'));

            return;
        }
    }
}
