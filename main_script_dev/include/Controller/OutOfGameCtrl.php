<?php

namespace Controller;

class OutOfGameCtrl extends AbstractCtrl
{
    public function render()
    {
        $output = '';
        $this->beforeRender();
        if ($this->view) {
            $output = $this->view->output();
        }
        $this->afterRender();

        return $output;
    }

    protected function beforeRender()
    {
    }

    protected function afterRender()
    {
    }
}