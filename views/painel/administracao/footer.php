<!-- Footer -->
<footer class="footer pt-0">
<div class="row align-items-center justify-content-lg-between">
    <div class="col-lg-12">
        <div class="copyright text-center text-muted">&copy; Copyright 
            <?php
            $anos = date('Y', strtotime('- 2000 years'));
            echo date('Y', strtotime('- '.$anos.' years'))." - ".date('Y').", <span class='nome-site'>".NOME_DO_SITE."</span>";
            ?>. Todos os direitos reservados.
        </div>
    </div>
</div>
</footer>