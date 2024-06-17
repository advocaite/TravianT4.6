<?php
namespace Controller;
class AnyCtrl extends AbstractCtrl
{
    public function render()
    {
        $output = '';
        $this->beforeRender();
        if(method_exists($this->view, 'output')) {
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