<?php

class BSNav {
    private $act_tabs = array("stable" => "", "btable" => "", "pag" => "");
    public function __construct($active_pos) {
        $this->act_tabs[$active_pos] = " active";
    }
    public function generate_navigation() {
        
        echo '
            
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
                <a class="navbar-brand" href="/index.php">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link' . $this->act_tabs["stable"] . '" href="/simple/stable.php">Simple table</a>
                        <a class="nav-item nav-link' . $this->act_tabs["btable"] . '" href="/bigtable/btable.php">Big table</a>
                        <a class="nav-item nav-link' . $this->act_tabs["pag"] . '" href="/pagination/pag.php">Pagination</a>
                    </div>
                </div>
            
        </nav>
        ';
    }
}

?>
