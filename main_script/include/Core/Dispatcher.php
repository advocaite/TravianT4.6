<?php

namespace Core;
class CntrlNotFoundException extends \Exception
{
}

class CntrlPermissionDeniedException extends \Exception
{
}

class Dispatcher
{
    public function dispatch($ctrl = NULL, $print = TRUE)
    {
        try {
            return $this->dispatcher($ctrl, $print);
        } catch (CntrlNotFoundException $e) {
            try {
                return $this->dispatcher("PageNotFoundCtrl", $print);
            } catch (CntrlNotFoundException $e) {
                die("There were errors in App!!! => " . $e->getMessage());
            } catch (CntrlPermissionDeniedException $e) {
                die("There were errors in App!!! => " . $e->getMessage());
            }
        } catch (CntrlPermissionDeniedException $e) {
            try {
                return $this->dispatcher("PermissionDeniedCtrl", $print);
            } catch (CntrlNotFoundException $e) {
                die("There were errors in App!!! => " . $e->getMessage());
            } catch (CntrlPermissionDeniedException $e) {
                die("There were errors in App!!! => " . $e->getMessage());
            }
        }
    }

    private function dispatcher($ctrl = NULL, $print = TRUE)
    {
        if ($ctrl == NULL) {
            $ctrl = filter_var(basename($_SERVER['PHP_SELF']), FILTER_SANITIZE_STRING);
            $ctrl = explode(".php", $ctrl)[0];
            $ctrl .= 'Cntrl';
        }
        $ctrl = 'Controller\\' . ucfirst($ctrl);
        if (!is_file(Autoloder::getFullPath($ctrl))) {
            //show a 404 page here.
            throw new CntrlNotFoundException($ctrl);
        }
        $ctrl = new $ctrl;
        if ($print) {
            echo $ctrl->render();
            return TRUE;
        } else {
            $x = $ctrl->render();
            return $x;
        }
    }

    private static $_self;

    public static function getInstance()
    {
        if (!(self::$_self instanceof self)) {
            self::$_self = new self();
        }
        return self::$_self;
    }
}