<?php
class RcS {

    function filesystem($e, $em) {

        echo "RcS filesystem \n";

        $em->fire('upstart:localFilesystem', $em);
        $em->fire('upstart:virtualFilesystem', $em);

    }

    function networking($e, $em) {
        echo "RcS networking \n";
    }

    function startup() {

        echo "RcS startup login \n" ;
    }

}

